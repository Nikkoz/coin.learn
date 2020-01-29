<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\CoinService;
use App\Services\Dashboard\SiteService;

class HomeController extends Controller
{
    private $coinService;
    private $siteService;

    public function __construct(CoinService $coinService, SiteService $siteService)
    {
        $this->coinService = $coinService;
        $this->siteService = $siteService;
    }

    public function index()
    {
        $coins = $this->coinService->getCoinsCount();
        $sites = $this->siteService->getSitesCount();


        return view('admin.home', compact('coins', 'sites'));
    }
}