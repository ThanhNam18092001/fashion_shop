<?php

namespace Tests\Feature;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class UserTest extends TestCase
{
    // use RefreshDatabase;
    // use DatabaseMigrations;

    // === Register ===
    /** @test */
    public function userCanViewRegister()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /** @test */
    public function registerSuccessfully()
    {
        $dataUpdate = [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            // 'password' => Hash::make('password')
            'password' => '12345678',
        ];
        $response = $this->post('/register', [
            'name' => $dataUpdate['name'],
            'email' => $dataUpdate['email'],
            'password' => $dataUpdate['password'],
            'password_confirmation' => $dataUpdate['password']
        ]);
        $response->assertStatus(302);
    }

    // === Login ===
    /** @test */
    public function userCanViewLogin()
    {
        // $this->withoutExceptionHandling();
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('auth.login')->assertSee('Login');
    }

    /** @test */
    public function loginRedirectToDashboardSuccessfully()
    {
        $response = $this->post('/login', [
            'email' => 'admin@gmail.com',
            'password' => '12345678',
        ]);
        $this->withoutExceptionHandling();
        $response->assertStatus(200);
    }
}
