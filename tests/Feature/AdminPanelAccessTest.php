<?php

use App\Models\User;

test('guest can not access admin panel page', function () {
    $response = $this->get('/admin');

    $response->assertRedirect('/admin/login');
});

test('non admin user receives forbidden response on admin panel page', function () {
    $user = User::factory()->user()->create();

    $response = $this->actingAs($user)->get('/admin');

    $response->assertForbidden();
});

test('admin user can access admin panel page', function () {
    $admin = User::factory()->admin()->create();

    $response = $this->actingAs($admin)->get('/admin');

    $response->assertOk();
});
