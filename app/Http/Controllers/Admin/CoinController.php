<?php

namespace App\Http\Controllers\Admin;

use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CoinRequest;
use App\Repositories\Dashboard\Algorithms\ConsensusRepository;
use App\Repositories\Dashboard\Algorithms\EncryptionRepository;
use App\Repositories\Dashboard\CoinRepository;
use App\Services\Dashboard\CoinService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Entities\Coin\Coin;

class CoinController extends Controller
{
    /**
     * @var CoinRepository
     */
    private $repository;

    private $algorithmEncryptionRepository;

    private $algorithmConsensusRepository;

    /**
     * @var CoinService
     */
    private $service;

    public function __construct(
        CoinRepository $repository,
        CoinService $service,
        EncryptionRepository $algorithmEncryptionRepository,
        ConsensusRepository $algorithmConsensusRepository
    )
    {
        $this->repository = $repository;
        $this->algorithmEncryptionRepository = $algorithmEncryptionRepository;
        $this->algorithmConsensusRepository = $algorithmConsensusRepository;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $params = [];

        if (($value = $request->get('status')) !== null && $value !== '-1') {
            $params['status'] = $value;
        }

        if (($value = $request->get('type')) !== null && $value !== '-1') {
            $params['type'] = $value;
        }

        if (!empty($value = $request->get('q'))) {
            $params['name'] = [
                'operator' => 'LIKE',
                'value' => "%$value%"
            ];
        }

        $coins = $this->repository->getPagination($params);

        return view('admin.coins.index', compact('coins'));
    }

    public function create(): View
    {
        return view('admin.coins.create', [
            'algorithms' => [
                'encryption' => $this->algorithmEncryptionRepository->getAllForSelector(),
                'consensus' => $this->algorithmConsensusRepository->getAllForSelector(),
            ]
        ]);
    }

    public function store(CoinRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.coins.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('coin.saved')
        );
    }

    public function edit(Coin $coin)
    {

    }

    public function update(Request $request, Coin $coin)
    {

    }

    public function destroy(Coin $coin)
    {

    }
}