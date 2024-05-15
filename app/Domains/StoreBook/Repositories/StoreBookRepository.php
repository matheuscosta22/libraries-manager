<?php

namespace App\Domains\StoreBook\Repositories;

use App\Domains\StoreBook\Models\StoreBook;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\StoreRequest;

class StoreBookRepository
{
    public function delete(StoreBook $storeBook): void
    {
        $storeBook->delete();
    }

    public function create(StoreBookRequest $request): void
    {
        $storeBook = new StoreBook();
        $storeBook->store_id = $request->input('store_id');
        $storeBook->book_id = $request->input('book_id');
        $storeBook->save();
    }
}
