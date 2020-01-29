<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Exceptions\FailedDeleteModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\SiteRequest;
use App\Repositories\Dashboard\SiteRepository;
use App\Services\Dashboard\SiteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteController extends Controller
{
    private $repository;
    private $service;

    public function __construct(SiteRepository $repository, SiteService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(): View
    {
        $sites = $this->repository->getPagination();

        return view('admin.settings.sites.index', compact('sites'));
    }

    public function create(): View
    {
        return view('admin.settings.sites.create');
    }

    public function store(SiteRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.settings.sites.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.saved', ['object' => 'Site'])
        );
    }

    public function edit(int $id): View
    {
        $site = $this->repository->getOne($id);

        return view('admin.settings.sites.edit', compact('site'));
    }

    public function update(SiteRequest $request, int $id): RedirectResponse
    {
        $site = $this->service->update($id, $request->validated());

        return redirect()->route('admin.settings.sites.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.updated', ['object' => 'Site', 'name' => $site->name])
        );
    }

    public function destroy(int $id): RedirectResponse
    {
        if ($this->service->delete($id) === false) {
            throw new FailedDeleteModelException();
        }

        return back()->with(DashboardFlashTypeDictionary::SUCCESS, trans('global.actions.objects.deleted', ['object' => 'Site']));
    }
}