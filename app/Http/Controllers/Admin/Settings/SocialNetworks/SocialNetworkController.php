<?php

namespace App\Http\Controllers\Admin\Settings\SocialNetworks;

use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Exceptions\FailedDeleteModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\SocialNetworks\SocialNetworkRequest;
use App\Repositories\Dashboard\SocialNetworks\SocialNetworkRepository;
use App\Services\Dashboard\SocialNetworks\SocialNetworkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SocialNetworkController extends Controller
{
    private $repository;

    private $service;

    public function __construct(SocialNetworkRepository $repository, SocialNetworkService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(): View
    {
        return view('admin.settings.social.networks.index', [
            'networks' => $this->repository->getPagination(),
        ]);
    }

    public function create(): View
    {
        return view('admin.settings.social.networks.create');
    }

    public function store(SocialNetworkRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.settings.social.networks.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.saved', ['object' => 'Network'])
        );
    }

    public function edit(int $id): View
    {
        return view('admin.settings.social.networks.edit', [
            'network' => $this->repository->getOne($id),
        ]);
    }

    public function update(SocialNetworkRequest $request, int $id): RedirectResponse
    {
        $network = $this->service->update($id, $request->validated());

        return redirect()->route('admin.settings.social.networks.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.updated', ['object' => 'Network', 'name' => $network->name])
        );
    }

    public function destroy(int $id): RedirectResponse
    {
        if ($this->service->delete($id) === false) {
            throw new FailedDeleteModelException();
        }

        return back()->with(DashboardFlashTypeDictionary::SUCCESS, trans('global.actions.objects.deleted', ['object' => 'Network']));
    }
}