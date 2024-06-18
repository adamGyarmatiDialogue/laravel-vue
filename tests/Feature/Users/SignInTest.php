<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class SignInTest extends TestCase
{
    /**
     * Test to sign in - without data
     */
    public function testSignInWithoutData(): void
    {
        $response = $this
            ->json("POST", "/api/v1/users/login", []);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test to sign in - wrong data
     */
    public function testSignInWrongData(): void
    {
        $response = $this
            ->json("POST", "/api/v1/users/login", [
                "email" => "asd",
                "password" => "asd"
            ]);

        $response
            ->assertStatus(Response::HTTP_NOT_FOUND);
    }

    /**
     * Test to sign in - wrong password
     */
    public function testSignInWrongPassword(): void
    {
        $response = $this
            ->json("POST", "/api/v1/users/login", [
                "email" => "adam@gmail.com",
                "password" => "asd"
            ]);

        $response
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Test to sign in - successful
     */
    public function testSignInSuccessful(): void
    {
        $response = $this
            ->json("POST", "/api/v1/users/login", [
                "email" => "adam@gmail.com",
                "password" => "password"
            ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                "userToken",
            ]);
    }
}
