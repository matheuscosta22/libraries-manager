<?php

namespace App\Http\Controllers;


use App\Domains\Book\Models\Book;
use App\Domains\Book\Repositories\BookRepository;
use App\Http\Requests\BookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $bookRepository = new BookRepository();
        return response()->json($bookRepository->all($request));
    }

    public function show(Book $book): JsonResponse
    {
        return response()->json($book);
    }

    public function destroy(Book $book): JsonResponse
    {
        (new BookRepository())->delete($book);
        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function update(BookRequest $request, Book $book): JsonResponse
    {
        (new BookRepository())->update($book, $request);
        return response()->json();
    }

    public function store(BookRequest $request): JsonResponse
    {
        (new BookRepository())->create($request);
        return response()->json([], Response::HTTP_CREATED);
    }
}
