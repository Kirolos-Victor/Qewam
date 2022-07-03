<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_register_method()
    {
        $formData = [
            'name' => 'test',
            'email' => 'tester@gmail.com',
            'password' => 'password',
            'confirm_password' => 'password'
        ];
        $this->json('POST', url('api/register'), $formData)->assertStatus(200);
    }

    public function test_login_method()
    {
        $formData = [
            'email' => 'test@test.com',
            'password' => '123456789',
        ];
        $this->json('POST', url('api/login'), $formData)->assertStatus(200);
    }
}
