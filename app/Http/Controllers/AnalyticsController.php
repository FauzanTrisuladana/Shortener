<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $userLinkIds = LinkController::getUserLinkIds($userId);
        $links = LinkController::getAllLinks($userId);
        $totalActiveLinks = LinkController::getActiveLinksCount($userId);
        $totalVisitors = VisitorController::getTotalVisitors($userLinkIds);
        $percentageChange = VisitorController::getPercentageChange($userLinkIds);
        $clickRate = VisitorController::getClickRate($userLinkIds);
        $top5sCountries = VisitorController::getTopCountries($userLinkIds, 5);

        [$chart7Labels, $chart7Data] = VisitorController::getChartData($userLinkIds, 7);
        [$chart7UniqueLabels, $chart7UniqueData] = VisitorController::getUniqueVisitorsData($userLinkIds, 7);
        [$chart30Labels, $chart30Data] = VisitorController::getChartData($userLinkIds, 30);
        [$chart30UniqueLabels, $chart30UniqueData] = VisitorController::getUniqueVisitorsData($userLinkIds, 30);
        [$chartAllLabels, $chartAllData] = VisitorController::getAllTimeChartData($userLinkIds, $chart30Labels, $chart30Data);
        [$chartAllUniqueLabels, $chartAllUniqueData] = VisitorController::getAllTimeUniqueChartData($userLinkIds, $chart30UniqueLabels, $chart30UniqueData);

        return view('analytics', compact(
            'links',
            'totalVisitors',
            'percentageChange',
            'totalActiveLinks',
            'clickRate',
            'top5sCountries',
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
            'chartAllUniqueData'
        ));
    }
}
