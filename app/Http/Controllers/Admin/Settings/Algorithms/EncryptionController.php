<?php

namespace App\Http\Controllers\Admin\Settings\Algorithms;

use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Entities\Settings\Encryption;
use App\Exceptions\FailedDeleteModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Settings\Algorithms\EncryptionRequest;
use App\Repositories\Dashboard\Algorithms\EncryptionRepository;
use App\Services\Dashboard\Algorithms\EncryptionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EncryptionController extends Controller
{
    /**
     * @var EncryptionRepository
     */
    private $repository;

    /**
     * @var EncryptionService
     */
    private $service;

    public function __construct(EncryptionRepository $repository, EncryptionService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index()
    {
        $algorithms = $this->repository->getPagination();

        return view('admin.settings.algorithms.encryption.index', compact('algorithms'));
    }

    public function create(): View
    {
        return view('admin.settings.algorithms.encryption.create');
    }

    public function store(EncryptionRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.settings.algorithms.encryption.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('settings.blade.algorithms.saved')
        );
    }

    public function edit(int $id): View
    {
        return view('admin.settings.algorithms.encryption.edit', [
            'algorithm' => $this->repository->getOne($id)
        ]);
    }

    public function update(EncryptionRequest $request, int $id): RedirectResponse
    {
        $this->service->update($id, $request->validated());

        return redirect()->route('admin.settings.algorithms.encryption.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('settings.blade.algorithms.saved')
        );
    }

    public function destroy(int $id): RedirectResponse
    {
        if ($this->service->delete($id) === false) {
            throw new FailedDeleteModelException();
        }

        return back()->with(DashboardFlashTypeDictionary::SUCCESS, trans('settings.blade.algorithms.deleted'));
    }
}
