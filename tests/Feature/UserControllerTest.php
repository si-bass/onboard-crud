<?php

use App\Models\User;
use App\Models\Role;

use function Pest\Laravel\{get, post, put, delete};

it('has users list', function () {
    $user = User::factory()->create();

    $response = get('/api/users');

    $response->assertExactJson([
        'responseCode' => 200,
        'responseMessage' => 'Successful',
        'data' => [
            'users' => [
                [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->username,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]
            ]
        ]
    ]);
    $response->assertStatus(200);
});

it('can create user', function () {
    Role::create([
        'name' => 'admin',
        'display_name' => 'Administrator',
    ]);

    $response = post('/api/users', [
        'name' => fake()->name(),
        'email' => fake()->safeEmail(),
        'username' => fake()->userName(),
        'password' => 'password',
        'password_confirm' => 'password',
        'remember_token' => 'abcd',
        'roles' => ['admin']
    ]);

    $response->assertExactJson([
        'responseCode' => 201,
        'responseMessage' => 'Successful',
    ]);
    $response->assertStatus(201);
});

it('has single user', function () {
    $user = User::factory()->create();

    $response = get('/api/users/' . $user->id);

    $response->assertExactJson([
        'responseCode' => 200,
        'responseMessage' => 'Successful',
        'data' => [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ]
        ]
    ]);
    $response->assertStatus(200);
});

it('does not have a user', function () {
    $response = get('/api/users/12345');

    $response->assertExactJson([
        'responseCode' => 404,
        'responseMessage' => 'User id 12345 not found',
    ]);
    $response->assertStatus(404);
});

it('can update a user', function () {
    $user = User::factory()->create();

    $response = put('/api/users/' . $user->id, [
        'name' => fake()->name(),
        'email' => fake()->email(),
        'username' => fake()->userName()
    ]);

    $response->assertExactJson([
        'responseCode' => 200,
        'responseMessage' => 'Successful',
    ]);
    $response->assertStatus(200);
});

it('can delete a user', function () {
    $user = User::factory()->create();

    $response = delete('/api/users/' . $user->id);

    $response->assertExactJson([
        'responseCode' => 200,
        'responseMessage' => 'Successful',
    ]);
    $response->assertStatus(200);
});
