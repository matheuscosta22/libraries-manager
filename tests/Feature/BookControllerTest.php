<?php

namespace Tests\Feature;

use App\Domains\Book\Models\Book;
use App\Domains\User\Models\User;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    public function testCreateBook(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/books', [
            'name' => $name = 'Test Book',
            'isbn' => $isbn = 134456757354,
            'value' => $value = 10.45
        ]);
        $response->assertSuccessful();

        /** @var Book $book */
        $book = Book::query()->find(1);
        $this->assertEquals($name, $book->name);
        $this->assertEquals($isbn, $book->isbn);
        $this->assertEquals($value, $book->value);
    }

    public function testUpdateBook(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/books', [
            'name' => 'Test Book',
            'isbn' => 134456757354,
            'value' => 10.45
        ]);
        $response->assertSuccessful();

        $response = $this->actingAs($user)->put('/api/books/1', [
            'name' => $name = 'Test Book Update',
            'isbn' => $isbn = 2222222222,
            'value' => $value = 15.45
        ]);
        $response->assertSuccessful();

        /** @var Book $book */
        $book = Book::query()->find(1);
        $this->assertEquals($name, $book->name);
        $this->assertEquals($isbn, $book->isbn);
        $this->assertEquals($value, $book->value);
    }

    public function testGetBook(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/books', [
            'name' => $name = 'Test Book',
            'isbn' => 134456757354,
            'value' => 10.45
        ]);
        $response->assertSuccessful();

        $response = $this->actingAs($user)->get('/api/books/1');
        $response->assertSuccessful();

        $this->assertEquals($name, $response->json()['name']);
    }

    public function testGetBooks(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/books', [
            'name' => $name = 'Test Book',
            'isbn' => 134456757354,
            'value' => 10.45
        ]);
        $response->assertSuccessful();

        $response = $this->actingAs($user)->get('/api/books');
        $response->assertSuccessful();

        $this->assertEquals($name, $response->json()['data'][0]['name']);
    }

    public function testDeleteBook(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/books', [
            'name' => 'Test Book',
            'isbn' => 134456757354,
            'value' => 10.45
        ]);
        $response->assertSuccessful();

        $response = $this->actingAs($user)->delete('/api/books/1');
        $response->assertSuccessful();

        $this->assertDatabaseMissing('books', [
            'id' => 1
        ]);
    }
}
