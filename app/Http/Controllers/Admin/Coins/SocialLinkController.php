<?php

namespace App\Http\Controllers\Admin\Coins;

use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Exceptions\FailedDeleteModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SocialLinkRequest;
use App\Repositories\Dashboard\CoinRepository;
use App\Repositories\Dashboard\SocialNetworks\SocialLinkRepository;
use App\Services\Dashboard\SocialNetworks\SocialLinkService;
use App\Services\Dashboard\SocialNetworks\SocialNetworkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SocialLinkController extends Controller
{
    private $service;

    private $repository;

    private $coinRepository;

    private $networkService;

    public function __construct(
        SocialLinkService $service,
        SocialLinkRepository $repository,
        CoinRepository $coinRepository,
        SocialNetworkService $networkService
    )
    {
        $this->service = $service;
        $this->repository = $repository;
        $this->coinRepository = $coinRepository;
        $this->networkService = $networkService;
    }

    public function index(int $coinId): View
    {
        $links = $this->repository->getPagination(['coin_id' => $coinId], 'id', ['network']);
        $coin = $this->coinRepository->getOne($coinId);

        return view('admin.coins.links.index', compact('links', 'coin'));
    }

    public function create(int $coinId): View
    {
        $coin = $this->coinRepository->getOne($coinId);
        $networks = $this->networkService->getAllForSelector();

        return view('admin.coins.links.create', compact('coin', 'networks'));
    }

    public function store(SocialLinkRequest $request, int $coinId): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.links.index', $coinId)->with(
            DashboardFlashTypeDictionary::SUCCESS, trans('global.actions.objects.saved')
        );
    }

    public function edit(int $coinId, int $id): View
    {
        $coin = $this->coinRepository->getOne($coinId);
        $link = $this->repository->getOne($id);
        $networks = $this->networkService->getAllForSelector();

        return view('admin.coins.links.edit', compact('coin', 'link', 'networks'));
    }

    public function update(SocialLinkRequest $request, int $coinId, int $id): RedirectResponse
    {
        $socialLink = $this->service->update($id, $request->validated());

        return redirect()->route('admin.links.index', $coinId)->with(
            DashboardFlashTypeDictionary::SUCCESS, trans(
            'global.actions.objects.updated', ['object' => 'Link', 'name' => $socialLink->link]
        ));
    }

    public function destroy(int $coinId, int $id): RedirectResponse
    {
        if ($this->service->delete($id) === false) {
            throw new FailedDeleteModelException();
        }

        return back()->with(DashboardFlashTypeDictionary::SUCCESS, trans('global.actions.objects.deleted', ['object' => 'Link']));
    }
}