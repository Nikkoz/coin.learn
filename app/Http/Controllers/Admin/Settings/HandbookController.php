<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Entities\Coin\Handbook;
use App\Http\Controllers\Controller;
use App\Repositories\Dashboard\HandbookRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HandbookController extends Controller
{
    private $repository;

    public function __construct(HandbookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $handbooks = $this->repository->getPagination();

        return view('admin.settings.handbooks.index', compact('handbooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Entities\Coin\Handbook $handbook
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Handbook $handbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Entities\Coin\Handbook $handbook
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Handbook $handbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request    $request
     * @param \App\Entities\Coin\Handbook $handbook
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Handbook $handbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Entities\Coin\Handbook $handbook
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Handbook $handbook)
    {
        //
    }
}
