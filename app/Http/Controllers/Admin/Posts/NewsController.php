<?php

namespace App\Http\Controllers\Admin\Posts;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Services\Dashboard\PostService;
use App\Services\Dashboard\SiteService;
use App\Dictionaries\PostTypeDictionary;
use App\Services\Dashboard\HandbookService;
use App\Repositories\Dashboard\PostRepository;
use App\Exceptions\FailedDeleteModelException;
use App\Http\Requests\Dashboard\Posts\PostRequest;
use App\Dictionaries\DashboardFlashTypeDictionary;

class NewsController extends Controller
{
    private $service;

    private $repository;

    private $siteService;

    private $handbookService;

    public function __construct(
        PostService $service,
        PostRepository $repository,
        SiteService $siteService,
        HandbookService $handbookService
    )
    {
        $this->service = $service;
        $this->repository = $repository;
        $this->siteService = $siteService;
        $this->handbookService = $handbookService;
    }

    public function index(): View
    {
        return view('admin.posts.news.index', [
            'news' => $this->repository->getPagination([
                'type' => PostTypeDictionary::TYPE_POST,
            ]),
        ]);
    }

    public function create(): View
    {
        return view('admin.posts.news.create', [
            'sites' => $this->siteService->getAllForSelector(),
            'handbooks' => $this->handbookService->getAllForSelector(),
        ]);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.news.index')->with(
            DashboardFlashTypeDictionary::SUCCESS,
            trans('global.actions.objects.saved', ['object' => 'Post'])
        );
    }

    public function edit(int $id): View
    {
        return view('admin.posts.news.edit', [
            'post'  => $this->repository->getOne($id),
            'sites' => $this->siteService->getAllForSelector(),
            'handbooks' => $this->handbookService->getAllForSelector(),
        ]);
    }

    public function update(PostRequest $request, int $id): RedirectResponse
    {
        $post = $this->service->update($id, $request->validated());

        return redirect()->route('admin.news.index')->with(
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