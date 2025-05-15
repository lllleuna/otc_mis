<?php
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('a user can log in with valid credentials', function () {
    $response = $this->post(route('login'), [
        'email' => 'lyla60@example.org',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('otp.verification.form'));
    $this->assertAuthenticated();
});

test('a user cannot log in with incorrect credentials', function () {
    User::create([
        'email' => 'lyla60@example.org',
        'password' => Hash::make('correct-password'),
    ]);

    $response = $this->post(route('login'), [
        'email' => 'lyla60@example.org',
        'password' => 'wrong-password',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('a user is redirected to update password if password is not changed', function () {
    $user = User::create([
        'email' => 'lyla60@example.org',
        'password' => Hash::make('password'),
        'password_changed' => false,
    ]);

    $this->actingAs($user)
        ->get(route('dashboard'))
        ->assertRedirect(route('auth.update-password'));
});

test('an unauthenticated user is redirected to login page', function () {
    $this->get(route('dashboard'))->assertRedirect(route('auth.login'));
});

