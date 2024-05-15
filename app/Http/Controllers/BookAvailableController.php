<?php

namespace App\Http\Controllers;


use App\Domains\Book\Repositories\BookRepository;
use App\Domains\Store\Models\Store;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookAvailableController extends Controller
{
    public function __invoke(Store $store, Request $request): JsonResponse
    {
        $books = (new BookRepository())->storeBooksAvailable($store, $request);
        return response()->json($books);
    }
}
