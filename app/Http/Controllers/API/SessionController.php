<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateSessionRequest;
use App\Services\SessionService;
use Illuminate\Http\JsonResponse;

class SessionController extends BaseController
{
    public function create(CreateSessionRequest $request): JsonResponse
    {
        (new SessionService())->execute($request);
        return $this->handleResponse(null, 'Session created successfully');
    }
}
