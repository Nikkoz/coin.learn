<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\Dashboard\ExchangeService;
use App\Exceptions\FailedDeleteModelException;
use App\Repositories\Dashboard\ExchangeRepository;
use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Http\Requests\Dashboard\Settings\ExchangeRequest;
use App\Services\Dashboard\SocialNetworks\SocialNetworkService;

class ExchangeController extends Controller
{
    private $repository;

    private $service;

    private $networkService;

    public function __construct(
        ExchangeRepository $repository,
        ExchangeService $service,
        SocialNetworkService $networkService
    )
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->networkService = $networkService;
    }

    public function index(): View
    {
        $exchanges = $this->repository->getPagination();

        return view('admin.settings.exchanges.index', compact('exchanges'));
    }

    public function create(): View
    {
        $networks = $this->networkService->getAllForSelector();

        return view('admin.settings.exchanges.create', compact('networks'));
    }

    public function store(ExchangeRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.settings.exchanges.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.saved', ['object' => 'Exchange'])
        );
    }

    public function edit(int $id): View
    {
        $exchange = $this->repository->getOne($id);
        $networks = $this->networkService->getAllForSelector();

        return view('admin.settings.exchanges.edit', compact('exchange', 'networks'));
    }

    public function update(ExchangeRequest $request, int $id): RedirectResponse
    {
        $exchange = $this->service->update($id, $request->validated());

        return redirect()->route('admin.settings.exchanges.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.updated', ['object' => 'Exchange', 'name' => $exchange->name])
        );
    }

    public function destroy(int $id): RedirectResponse
    {
        if ($this->service->delete($id) === false) {
            throw new FailedDeleteModelException();
        }

        return back()->with(DashboardFlashTypeDictionary::SUCCESS, trans('global.actions.objects.deleted', ['object' => 'Exchange']));
    }
}