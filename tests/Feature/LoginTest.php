<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * Show login view test
     *
     * @test
     */
    public function showLoginForm()
    {
        $response = $this->get('/login');
        $response
            ->assertSee('Login')
            ->assertStatus(200);
    }
    /**
     * Success Login Test
     *
     * @test
     */
    public function succesLogIn()
    {
        $response = $this->post('/login_user',[
            'username'=>'ale',
            'password'=>'framework'
        ]);
        $response->assertRedirect('/users');
    }
    
}
