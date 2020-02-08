<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\FormulaService;
use App\Repositories\Dashboard\FormulaRepository;
use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Http\Requests\Dashboard\Settings\FormulaRequest;

class FormulaController extends Controller
{
    private $repository;

    private $service;

    public function __construct(FormulaRepository $repository, FormulaService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index(): View
    {
        return view('admin.settings.formula.index', [
            'formula' => $this->repository->get(),
        ]);
    }

    public function update(FormulaRequest $request, int $id)
    {
        $this->service->update($id, $request->validated());

        return redirect()->route('admin.settings.formula.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.updated', ['object' => 'Formula', 'name' => ''])
        );
    }
}
