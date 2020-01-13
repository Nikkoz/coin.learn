<?php

namespace App\Http\Controllers\Admin\Settings\SocialNetworks;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\SocialNetworks\SocialLinkService;
use App\Traits\JsonResponse as JsonResponseTrait;
use Illuminate\Http\JsonResponse;

class SocialLinkController extends Controller
{
    use JsonResponseTrait;

    /**
     * @var SocialLinkService
     */
    private $service;

    public function __construct(SocialLinkService $service)
    {
        $this->service = $service;
    }

    public function destroy(int $id): JsonResponse
    {
        if ($this->service->delete($id) === false) {
            return $this->sendError('Ошибка удаления ссылки. ');
        }

        return $this->sendOk('Ссылка удалена.');
    }
}