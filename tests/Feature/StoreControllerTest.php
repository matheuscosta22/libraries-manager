<?php

namespace Tests\Feature;

use App\Domains\Store\Models\Store;
use App\Domains\User\Models\User;
use Tests\TestCase;

class StoreControllerTest extends TestCase
{
    public function testCreateStore(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/stores', [
            'name' => $name = 'Test Store',
            'address' => $address = 'rua testing 2222',
        ]);
        $response->assertSuccessful();

        /** @var Store $store */
        $store = Store::query()->find(1);
        $this->assertEquals($name, $store->name);
        $this->assertEquals($address, $store->address);
        $this->assertEquals(true, $store->active);
    }

    public function testUpdateStore(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/stores', [
            'name' => 'Test Store',
            'address' => 'rua testing 2222',
        ]);
        $response->assertSuccessful();

        $response = $this->actingAs($user)->put('/api/stores/1', [
            'name' => $name = 'Test Store Update',
            'address' => $address = 'rua testing 7777',
        ]);
        $response->assertSuccessful();

        /** @var Store $store */
        $store = Store::query()->find(1);
        $this->assertEquals($name, $store->name);
        $this->assertEquals($address, $store->address);
        $this->assertEquals(true, $store->active);
    }

    public function testGetStore(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/stores', [
            'name' => $name = 'Test Store',
            'address' => 'rua testing 2222',
        ]);
        $response->assertSuccessful();

        $response = $this->actingAs($user)->get('/api/stores/1');
        $response->assertSuccessful();

        $this->assertEquals($name, $response->json()['name']);
    }

    public function testGetStores(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/stores', [
            'name' => $name = 'Test Store',
            'address' => 'rua testing 2222',
        ]);
        $response->assertSuccessful();

        $response = $this->actingAs($user)->get('/api/stores');
        $response->assertSuccessful();

        $this->assertEquals($name, $response->json()['data'][0]['name']);
    }

    public function testDeleteStore(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/stores', [
            'name' => 'Test Store',
            'address' => 'rua testing 2222',
        ]);
        $response->assertSuccessful();

        $response = $this->actingAs($user)->delete('/api/stores/1');
        $response->assertSuccessful();

        $this->assertDatabaseMissing('stores', [
            'id' => 1
        ]);
    }
}
