<?php

namespace App\Domains\Book\Repositories;

use App\Domains\Book\Models\Book;
use App\Domains\Store\Models\Store;
use App\Http\Requests\BookRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class BookRepository
{
    public function all(Request $request): LengthAwarePaginator
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        return Book::query()
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('name') . '%');
            })
            ->when($request->filled('isbn'), function ($query) use ($request) {
                $query->where('isbn', $request->input('isbn'));
            })
            ->when($request->filled('value'), function ($query) use ($request) {
                $query->where('value', $request->input('name'));
            })
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function delete(Book $book): void
    {
        $book->delete();
    }

    public function update(Book $book, BookRequest $request): void
    {
        $book->name = $request->input('name');
        $book->isbn = $request->input('isbn');
        $book->value = $request->input('value');
        $book->save();
    }

    public function create(BookRequest $request): void
    {
        $book = new Book();
        $book->name = $request->input('name');
        $book->isbn = $request->input('isbn');
        $book->value = $request->input('value');
        $book->save();
    }

    public function storeBooksAvailable(Store $store, Request $request): LengthAwarePaginator
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        return $store->books()
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input( 'name') . '%');
            })
            ->when($request->filled('isbn'), function ($query) use ($request) {
                $query->where('isbn', $request->input('isbn'));
            })
            ->when($request->filled('value'), function ($query) use ($request) {
                $query->where('value', $request->input('name'));
            })
            ->paginate($perPage, ['*'], 'page', $page);
    }
}
