<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Visitor;

class LinkAnaliticController extends Controller
{
    /**
     * Display analytics for a specific link.
     */
    public function analytics($id)
    {
        $link = Link::where('id_link', $id)
            ->where('id_user', auth()->id())
            ->firstOrFail();

        $userLinkIds = collect([$id]); // Hanya untuk link ini

        // Get statistics
        $totalVisitors = VisitorController::getTotalVisitors($userLinkIds);
        $uniqueVisitors = VisitorController::getUniqueVisitors($userLinkIds);
        $percentageChange = VisitorController::getPercentageChange($userLinkIds);

        // Get chart data
        [$chart7Labels, $chart7Data] = VisitorController::getChartData($userLinkIds, 7);
        [$chart7UniqueLabels, $chart7UniqueData] = VisitorController::getUniqueVisitorsData($userLinkIds, 7);
        [$chart30Labels, $chart30Data] = VisitorController::getChartData($userLinkIds, 30);
        [$chart30UniqueLabels, $chart30UniqueData] = VisitorController::getUniqueVisitorsData($userLinkIds, 30);
        [$chartAllLabels, $chartAllData] = VisitorController::getAllTimeChartData($userLinkIds, $chart30Labels, $chart30Data);
        [$chartAllUniqueLabels, $chartAllUniqueData] = VisitorController::getAllTimeUniqueChartData($userLinkIds, $chart30UniqueLabels, $chart30UniqueData);

        // Get geographic data
        $topCountries = VisitorController::getTopCountries($userLinkIds, 5);
        $topCities = VisitorController::getTopCities($userLinkIds, 5);
        $topDevices = VisitorController::getTopDevices($userLinkIds);
        $topBrowsers = VisitorController::getTopBrowsers($userLinkIds);

        // Get recent visitors
        $recentVisitors = Visitor::where('id_link', $id)
            ->orderBy('timestamp', 'desc')
            ->limit(20)
            ->get();

        return view('link-analytics', compact(
            'link',
            'id',
            'totalVisitors',
            'uniqueVisitors',
            'percentageChange',
            'chart7Labels',
            'chart7Data',
            'chart7UniqueLabels',
            'chart7UniqueData',
            'chart30Labels',
            'chart30Data',
            'chart30UniqueLabels',
            'chart30UniqueData',
            'chartAllLabels',
            'chartAllData',
            'chartAllUniqueLabels',
            'chartAllUniqueData',
            'topCountries',
            'topCities',
            'topDevices',
            'topBrowsers',
            'recentVisitors'
        ));
    }
}
