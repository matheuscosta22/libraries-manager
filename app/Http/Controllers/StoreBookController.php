<?php

namespace App\Http\Controllers;


use App\Domains\StoreBook\Models\StoreBook;
use App\Domains\StoreBook\Repositories\StoreBookRepository;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreBookController extends Controller
{
    public function destroy(StoreBook $storeBook): JsonResponse
    {
        (new StoreBookRepository())->delete($storeBook);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function store(StoreBookRequest $request): JsonResponse
    {
        (new StoreBookRepository())->create($request);
        return response()->json([], Response::HTTP_CREATED);
    }
}
