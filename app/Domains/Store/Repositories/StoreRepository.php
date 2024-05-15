<?php

namespace App\Domains\Store\Repositories;

use App\Domains\Store\Models\Store;
use App\Http\Requests\StoreRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class StoreRepository
{
    public function all(Request $request): LengthAwarePaginator
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);

        return Store::query()
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('name') . '%');
            })
            ->when($request->filled('address'), function ($query) use ($request) {
                $query->where('address', $request->input('address'));
            })
            ->when($request->filled('active'), function ($query) use ($request) {
                $query->where('active', $request->input('active'));
            })
            ->paginate($perPage, ['*'], 'page', $page);
    }

    public function delete(Store $store): void
    {
        $store->delete();
    }

    public function update(Store $store, StoreRequest $request): void
    {
        $store->name = $request->input('name');
        $store->address = $request->input('address');
        $store->active = $request->input('active', true);
        $store->save();
    }

    public function create(StoreRequest $request): void
    {
        $store = new Store();
        $store->name = $request->input('name');
        $store->address = $request->input('address');
        $store->active = true;
        $store->save();
    }
}
