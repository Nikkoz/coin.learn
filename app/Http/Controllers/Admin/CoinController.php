<?php

namespace App\Http\Controllers\Admin;

use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Exceptions\FailedDeleteModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CoinRequest;
use App\Repositories\Dashboard\Algorithms\ConsensusRepository;
use App\Repositories\Dashboard\Algorithms\EncryptionRepository;
use App\Repositories\Dashboard\CoinRepository;
use App\Repositories\Dashboard\SocialNetworks\SocialNetworkRepository;
use App\Services\Dashboard\CoinService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

    /**
     * @var SocialNetworkRepository
     */
    private $socialNetworkRepository;

    public function __construct(
        CoinRepository $repository,
        CoinService $service,
        EncryptionRepository $algorithmEncryptionRepository,
        ConsensusRepository $algorithmConsensusRepository,
        SocialNetworkRepository $socialNetworkRepository
    )
    {
        $this->repository = $repository;
        $this->algorithmEncryptionRepository = $algorithmEncryptionRepository;
        $this->algorithmConsensusRepository = $algorithmConsensusRepository;
        $this->service = $service;
        $this->socialNetworkRepository = $socialNetworkRepository;
    }

    public function index(Request $request): View
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
                'value'    => "%$value%"
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
                'consensus'  => $this->algorithmConsensusRepository->getAllForSelector(),
            ],
            'networks'   => $this->socialNetworkRepository->getAllForSelector(),
        ]);
    }

    public function store(CoinRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.coins.index')->with(DashboardFlashTypeDictionary::SUCCESS, trans('coin.saved'));
    }

    public function edit(int $id): View
    {
        return view('admin.coins.edit', [
            'coin'       => $this->repository->getOne($id),
            'algorithms' => [
                'encryption' => $this->algorithmEncryptionRepository->getAllForSelector(),
                'consensus'  => $this->algorithmConsensusRepository->getAllForSelector(),
            ],
            'networks'   => $this->socialNetworkRepository->getAllForSelector(),
        ]);
    }

    public function update(CoinRequest $request, int $id): RedirectResponse
    {
        $this->service->update($id, $request->validated());

        return redirect()->route('admin.coins.index')->with(DashboardFlashTypeDictionary::SUCCESS, trans('coin.updated', ['name' => $request->name]));
    }

    public function destroy(int $id)
    {
        if ($this->service->delete($id) === false) {
            throw new FailedDeleteModelException();
        }

        return back()->with(DashboardFlashTypeDictionary::SUCCESS, trans('coin.deleted'));
    }
}