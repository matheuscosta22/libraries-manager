<?php

namespace App\Domains\Store\Models;

use App\Domains\Book\Models\Book;
use Database\Factories\StoreFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property $id
 * @property $name
 * @property $address
 * @property $active
 */
class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'active'
    ];

    protected static function newFactory(): StoreFactory
    {
        return new StoreFactory();
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'store_books', 'store_id', 'book_id');
    }
}
