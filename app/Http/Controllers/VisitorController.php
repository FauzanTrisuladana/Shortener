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
}
