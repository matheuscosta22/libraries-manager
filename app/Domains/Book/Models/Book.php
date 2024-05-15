<?php

namespace App\Domains\Book\Models;

use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $name
 * @property $isbn
 * @property $value
 */
class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'isbn',
        'value'
    ];

    protected static function newFactory(): BookFactory
    {
        return new BookFactory();
    }
}
