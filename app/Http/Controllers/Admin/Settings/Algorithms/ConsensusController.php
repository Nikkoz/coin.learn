<?php

namespace App\Http\Controllers\Admin\Settings\Algorithms;

use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Exceptions\FailedDeleteModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\Algorithms\ConsensusRequest;
use App\Repositories\Dashboard\Algorithms\ConsensusRepository;
use App\Services\Dashboard\Algorithms\ConsensusService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConsensusController extends Controller
{
    private $repository;

    private $service;

    public function __construct(ConsensusRepository $repository, ConsensusService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        $algorithms = $this->repository->getPagination();

        return view('admin.settings.algorithms.consensus.index', compact('algorithms'));
    }

    public function create(): View
    {
        return view('admin.settings.algorithms.consensus.create');
    }

    public function store(ConsensusRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.settings.algorithms.consensus.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.saved', ['object' => 'Algorithm'])
        );
    }

    public function edit(int $id): View
    {
        return view('admin.settings.algorithms.consensus.edit', [
            'algorithm' => $this->repository->getOne($id)
        ]);
    }

    public function update(ConsensusRequest $request, int $id): RedirectResponse
    {
        $algorithm = $this->service->update($id, $request->validated());

        return redirect()->route('admin.settings.algorithms.consensus.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.updated', ['object' => 'Algorithm', 'name' => $algorithm->name])
        );
    }

    public function destroy(int $id): RedirectResponse
    {
        if ($this->service->delete($id) === false) {
            throw new FailedDeleteModelException();
        }

        return back()->with(
            DashboardFlashTypeDictionary::SUCCESS, trans('global.actions.objects.deleted', ['object' => 'Algorithm']));
    }
}