<?php

namespace Tests\Feature;

use App\Domains\Book\Models\Book;
use App\Domains\Store\Models\Store;
use App\Domains\User\Models\User;
use Tests\TestCase;

class BookAvailableControllerTest extends TestCase
{
    public function testGetAvailableBooks(): void
    {
        $user = User::factory()->create();
        /** @var Store $store */
        $store = Store::factory()->create();
        /** @var Book $book */
        $book = Book::factory()->create();
        $response = $this->actingAs($user)->post('/api/store-books', [
            'store_id' => $store->id,
            'book_id' => $book->id,
        ]);

        $response->assertSuccessful();

        $response = $this->actingAs($user)->get('/api/books/available/' . $store->id);
        $this->assertEquals($book->id, $response->json('data')[0]['id']);
    }
}
