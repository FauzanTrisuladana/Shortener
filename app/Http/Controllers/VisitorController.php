<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public static function logVisitor(Request $request, $id_link)
    {
        $visitorIp = $request->ip();
        $userAgent = $request->header('User-Agent');
        $referrer = $request->headers->get('referer');
        $timestamp = now();

        // Parse browser dan device dari user agent
        $browser = self::parseBrowser($userAgent);
        $device = self::parseDevice($userAgent);

        // Parse country dan city dari IP
        [$country, $city] = self::parseCountryCity($visitorIp);
        Visitor::create([
            'id_link' => $id_link,
            'ip_address' => $visitorIp,
            'browser' => $browser,
            'referrer' => $referrer,
            'device' => $device,
            'country' => $country,
            'city' => $city,
            'user_agent' => $userAgent,
            'timestamp' => $timestamp,
        ]);
    }

    private static function parseBrowser($userAgent)
    {
        if (preg_match('/Chrome/', $userAgent)) return 'Chrome';
        if (preg_match('/Firefox/', $userAgent)) return 'Firefox';
        if (preg_match('/Safari/', $userAgent)) return 'Safari';
        if (preg_match('/Edge/', $userAgent)) return 'Edge';
        return 'Unknown';
    }

    private static function parseDevice($userAgent)
    {
        if (preg_match('/Mobile|Android|iPhone|iPod/', $userAgent)) return 'Mobile';
        if (preg_match('/Tablet|iPad/', $userAgent)) return 'Tablet';
        return 'Desktop';
    }

    private static function parseCountryCity($ip)
    {
        // Gunakan geoip() jika tersedia dari package
        if (function_exists('geoip')) {
            try {
                $geo = geoip($ip);
                return [
                    $geo->country ?? null,
                    $geo->city ?? null
                ];
            } catch (\Exception $e) {
                return [null, null];
            }
        }

        // Fallback: gunakan free IP geolocation API
        try {
            $response = @file_get_contents("http://ip-api.com/json/{$ip}?fields=country,city");
            if ($response) {
                $data = json_decode($response, true);
                return [
                    $data['country'] ?? null,
                    $data['city'] ?? null
                ];
            }
        } catch (\Exception $e) {
            return [null, null];
        }
    }

    public static function getTotalVisitors($userLinkIds)
    {
        return Visitor::whereIn('id_link', $userLinkIds)->count();
    }

    public static function getUniqueVisitors($userLinkIds)
    {
        return Visitor::whereIn('id_link', $userLinkIds)
            ->distinct('ip_address')
            ->count('ip_address');
    }

    public static function getChartData($userLinkIds, $days)
    {
        $clickActivity = Visitor::whereIn('id_link', $userLinkIds)
            ->where('timestamp', '>=', now()->subDays($days))
            ->select(\Illuminate\Support\Facades\DB::raw('DATE(timestamp) as date'), \Illuminate\Support\Facades\DB::raw('COUNT(*) as clicks'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = [];
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('d M');
            $found = $clickActivity->firstWhere('date', $date);
            $data[] = $found ? $found->clicks : 0;
        }
        return [$labels, $data];
    }

    public static function getAllTimeChartData($userLinkIds, $chart30Labels, $chart30Data)
    {
        $firstVisitor = Visitor::whereIn('id_link', $userLinkIds)
            ->orderBy('timestamp', 'asc')
            ->first();

        if ($firstVisitor && $firstVisitor->timestamp->diffInDays(now()) > 60) {
            // Group by month
            $clickActivityAll = Visitor::whereIn('id_link', $userLinkIds)
                ->select(\Illuminate\Support\Facades\DB::raw('DATE_FORMAT(timestamp, "%Y-%m") as month'), \Illuminate\Support\Facades\DB::raw('COUNT(*) as clicks'))
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();

            $labels = $clickActivityAll->pluck('month')->map(function($month) {
                return \Carbon\Carbon::parse($month)->format('M Y');
            })->toArray();
            $data = $clickActivityAll->pluck('clicks')->toArray();
        } else {
            // Group by day (same as 30 days if less than 60 days)
            $labels = $chart30Labels;
            $data = $chart30Data;
        }
        return [$labels, $data];
    }

    public static function getUniqueVisitorsData($userLinkIds, $days)
    {
        $uniqueActivity = Visitor::whereIn('id_link', $userLinkIds)
            ->where('timestamp', '>=', now()->subDays($days))
            ->select(\Illuminate\Support\Facades\DB::raw('DATE(timestamp) as date'), \Illuminate\Support\Facades\DB::raw('COUNT(DISTINCT ip_address) as unique_count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = [];
        $data = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $labels[] = now()->subDays($i)->format('d M');
            $found = $uniqueActivity->firstWhere('date', $date);
            $data[] = $found ? $found->unique_count : 0;
        }
        return [$labels, $data];
    }

    public static function getAllTimeUniqueChartData($userLinkIds, $chart30Labels, $chart30UniqueData)
    {
        $firstVisitor = Visitor::whereIn('id_link', $userLinkIds)
            ->orderBy('timestamp', 'asc')
            ->first();

        if ($firstVisitor && $firstVisitor->timestamp->diffInDays(now()) > 60) {
            // Group by month
            $uniqueVisitorsAll = Visitor::whereIn('id_link', $userLinkIds)
                ->select(\Illuminate\Support\Facades\DB::raw('DATE_FORMAT(timestamp, "%Y-%m") as month'), \Illuminate\Support\Facades\DB::raw('COUNT(DISTINCT ip_address) as unique_count'))
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();

            $labels = $uniqueVisitorsAll->pluck('month')->map(function($month) {
                return \Carbon\Carbon::parse($month)->format('M Y');
            })->toArray();
            $data = $uniqueVisitorsAll->pluck('unique_count')->toArray();
        } else {
            // Group by day (same as 30 days if less than 60 days)
            $labels = $chart30Labels;
            $data = $chart30UniqueData;
        }
        return [$labels, $data];
    }
}
