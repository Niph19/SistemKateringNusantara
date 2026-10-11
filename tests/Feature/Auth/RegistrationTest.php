<?php

use App\Models\User;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'admin',
    ]);

    $this->assertAuthenticated();
    expect(User::query()->where('email', 'test@example.com')->value('role'))->toBe('customer');
    $response->assertRedirect(route('profile.edit'));
});
