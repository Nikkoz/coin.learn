<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Exceptions\FailedDeleteModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\HandbookRequest;
use App\Repositories\Dashboard\HandbookRepository;
use App\Services\Dashboard\CoinService;
use App\Services\Dashboard\HandbookService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HandbookController extends Controller
{
    private $repository;

    private $coinService;

    private $service;

    public function __construct(HandbookRepository $repository, HandbookService $service, CoinService $coinService)
    {
        $this->repository = $repository;
        $this->coinService = $coinService;
        $this->service = $service;
    }

    public function index(): View
    {
        $handbooks = $this->repository->getPagination([], 'id', ['coin']);

        return view('admin.settings.handbooks.index', compact('handbooks'));
    }

    public function create(): View
    {
        $coins = $this->coinService->getAllForSelector();

        return view('admin.settings.handbooks.create', compact('coins'));
    }

    public function store(HandbookRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.settings.handbooks.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.saved', ['object' => 'Handbook'])
        );
    }

    public function edit(int $id): View
    {
        $coins = $this->coinService->getAllForSelector();
        $handbook = $this->repository->getOne($id);

        return view('admin.settings.handbooks.edit', compact('handbook', 'coins'));
    }

    public function update(HandbookRequest $request, int $id): RedirectResponse
    {
        $handbook = $this->service->update($id, $request->validated());

        return redirect()->route('admin.settings.handbooks.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.updated', ['object' => 'Handbook', 'name' => $handbook->title])
        );
    }

    public function destroy(int $id): RedirectResponse
    {
        if ($this->service->delete($id) === false) {
            throw new FailedDeleteModelException();
        }

        return back()->with(DashboardFlashTypeDictionary::SUCCESS, trans('global.actions.objects.deleted', ['object' => 'Handbook']));
    }
}
