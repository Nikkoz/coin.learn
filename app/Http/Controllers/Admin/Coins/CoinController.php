<?php

namespace App\Http\Controllers\Admin\Coins;

use App\Dictionaries\DashboardFlashTypeDictionary;
use App\Exceptions\FailedDeleteModelException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CoinRequest;
use App\Repositories\Dashboard\CoinRepository;
use App\Services\Dashboard\Algorithms\ConsensusService;
use App\Services\Dashboard\Algorithms\EncryptionService;
use App\Services\Dashboard\CoinService;
use App\Services\Dashboard\SocialNetworks\SocialNetworkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CoinController extends Controller
{
    /**
     * @var CoinRepository
     */
    private $repository;

    /**
     * @var EncryptionService
     */
    private $algorithmEncryptionService;

    /**
     * @var ConsensusService
     */
    private $algorithmConsensusService;

    /**
     * @var CoinService
     */
    private $service;

    /**
     * @var SocialNetworkService
     */
    private $socialNetworkService;

    public function __construct(
        CoinRepository $repository,
        CoinService $service,
        EncryptionService $algorithmEncryptionService,
        ConsensusService $algorithmConsensusService,
        SocialNetworkService $socialNetworkService
    )
    {
        $this->repository = $repository;
        $this->algorithmEncryptionService = $algorithmEncryptionService;
        $this->algorithmConsensusService = $algorithmConsensusService;
        $this->service = $service;
        $this->socialNetworkService = $socialNetworkService;
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
                'encryption' => $this->algorithmEncryptionService->getAllForSelector(),
                'consensus'  => $this->algorithmConsensusService->getAllForSelector(),
            ],
            'networks'   => $this->socialNetworkService->getAllForSelector(),
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
                'encryption' => $this->algorithmEncryptionService->getAllForSelector(),
                'consensus'  => $this->algorithmConsensusService->getAllForSelector(),
            ],
            'networks'   => $this->socialNetworkService->getAllForSelector(),
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