<?php

namespace App\Http\Controllers;


use App\Domains\Store\Models\Store;
use App\Domains\Store\Repositories\StoreRepository;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $storeRepository = new StoreRepository();
        return response()->json($storeRepository->all($request));
    }

    public function show(Store $store): JsonResponse
    {
        return response()->json($store);
    }

    public function destroy(Store $store): JsonResponse
    {
        (new StoreRepository())->delete($store);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function update(StoreRequest $request, Store $store): JsonResponse
    {
        (new StoreRepository())->update($store, $request);
        return response()->json();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        (new StoreRepository())->create($request);
        return response()->json([], Response::HTTP_CREATED);
    }
}
