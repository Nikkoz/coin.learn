<?php

namespace App\Http\Controllers\Admin\Coins;

use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Exceptions\FailedDeleteModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\HandbookRequest;
use App\Repositories\Dashboard\CoinRepository;
use App\Repositories\Dashboard\HandbookRepository;
use App\Services\Dashboard\CoinService;
use App\Services\Dashboard\HandbookService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HandbookController extends Controller
{
    private $repository;

    private $coinRepository;

    private $service;

    private $coinService;

    public function __construct(
        HandbookRepository $repository,
        CoinRepository $coinRepository,
        HandbookService $service,
        CoinService $coinService
    )
    {
        $this->repository = $repository;
        $this->coinRepository = $coinRepository;
        $this->service = $service;
        $this->coinService = $coinService;
    }

    public function index(int $coinId): View
    {
        $coin = $this->coinRepository->getOne($coinId);
        $handbooks = $this->repository->getPagination(['coin_id' => $coinId], 'id', ['coin']);

        return view('admin.coins.handbooks.index', compact('handbooks', 'coin'));
    }

    public function create(int $coinId): View
    {
        $coin = $this->coinRepository->getOne($coinId);
        $coins = $this->coinService->getAllForSelector();

        return view('admin.coins.handbooks.create', compact('coin', 'coins'));
    }

    public function store(HandbookRequest $request, int $coinId): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.coins.handbooks.index', $coinId)->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.saved', ['object' => 'Handbook'])
        );
    }

    public function edit(int $coinId, int $id): View
    {
        $coin = $this->coinRepository->getOne($coinId);
        $coins = $this->coinService->getAllForSelector();
        $handbook = $this->repository->getOne($id);

        return view('admin.coins.handbooks.edit', compact('handbook', 'coin', 'coins'));
    }

    public function update(HandbookRequest $request, int $coinId, int $id): RedirectResponse
    {
        $handbook = $this->service->update($id, $request->validated());

        return redirect()->route('admin.coins.handbooks.index', $coinId)->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.updated', ['object' => 'Handbook', 'name' => $handbook->title])
        );
    }

    public function destroy(int $coinId, int $id): RedirectResponse
    {
        if ($this->service->delete($id) === false) {
            throw new FailedDeleteModelException();
        }

        return back()->with(DashboardFlashTypeDictionary::SUCCESS, trans('global.actions.objects.deleted', ['object' => 'Handbook']));
    }
}