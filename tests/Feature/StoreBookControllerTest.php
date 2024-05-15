<?php

namespace Tests\Feature;

use App\Domains\Book\Models\Book;
use App\Domains\Store\Models\Store;
use App\Domains\User\Models\User;
use Tests\TestCase;

class StoreBookControllerTest extends TestCase
{
    public function testCreateStoreBook(): void
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
        $this->assertEquals($book->id, $store->books()->toBase()->first()->id);
    }

    public function testDeleteStoreBook(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/store-books', [
            'store_id' => Store::factory()->create()->id,
            'book_id' => Book::factory()->create()->id,
        ]);
        $response->assertSuccessful();

        $response = $this->actingAs($user)->delete('/api/store-books/1');
        $response->assertSuccessful();

        $this->assertDatabaseMissing('store_books', [
            'id' => 1
        ]);
    }
}
