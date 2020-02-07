<?php

namespace App\Http\Controllers\Admin\Posts;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\Dashboard\PostService;
use App\Services\Dashboard\CoinService;
use App\Dictionaries\PostTypeDictionary;
use App\Http\Requests\Dashboard\PostRequest;
use App\Repositories\Dashboard\PostRepository;
use App\Exceptions\FailedDeleteModelException;
use App\Dictionaries\DashboardFlashTypeDictionary;

class RedditController extends Controller
{
    private $service;

    private $repository;

    private $coinService;

    public function __construct(PostService $service, PostRepository $repository, CoinService $coinService)
    {
        $this->service = $service;
        $this->repository = $repository;
        $this->coinService = $coinService;
    }

    public function index(): View
    {
        return view('admin.posts.reddit.index', [
            'posts' => $this->repository->getPagination(['type' => PostTypeDictionary::TYPE_REDDIT], 'id', ['coin']),
        ]);
    }

    public function create(): View
    {
        return view('admin.posts.reddit.create', ['coins' => $this->coinService->getAllForSelector()]);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.reddit.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.saved', ['object' => 'Post'])
        );
    }

    public function edit(int $id): View
    {
        return view('admin.posts.reddit.edit', [
            'post'  => $this->repository->getOne($id),
            'coins' => $this->coinService->getAllForSelector(),
        ]);
    }

    public function update(PostRequest $request, int $id): RedirectResponse
    {
        $post = $this->service->update($id, $request->validated());

        return redirect()->route('admin.reddit.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.updated', ['object' => 'Post', 'name' => $post->title])
        );
    }

    public function destroy(int $id): RedirectResponse
    {
        if ($this->service->delete($id) === false) {
            throw new FailedDeleteModelException();
        }

        return back()->with(DashboardFlashTypeDictionary::SUCCESS, trans('global.actions.objects.deleted', ['object' => 'Post']));
    }
}