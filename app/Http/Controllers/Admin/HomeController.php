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
        $coins = $this->coinService->getCount();
        $sites = $this->siteService->getCount();

        return view('admin.home', compact('coins', 'sites'));
    }
}