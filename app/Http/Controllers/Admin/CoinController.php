<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Dashboard\Algorithms\ConsensusRepository;
use App\Repositories\Dashboard\Algorithms\EncryptionRepository;
use App\Repositories\Dashboard\CoinRepository;
use App\Services\Dashboard\CoinService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Coin $coin
     *
     * @return Response
     */
    public function show(Coin $coin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Coin $coin
     *
     * @return Response
     */
    public function edit(Coin $coin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Coin                $coin
     *
     * @return Response
     */
    public function update(Request $request, Coin $coin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Coin $coin
     *
     * @return Response
     */
    public function destroy(Coin $coin)
    {
        //
    }
}