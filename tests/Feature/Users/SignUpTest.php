<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Tests\TestCase;

class SignUpTest extends TestCase
{
    /**
     * Test Sign Up function - Wrong data
     */
    public function testSignUpWrongData(): void
    {
        $response = $this
            ->json("POST", "/api/v1/users", [], []);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test sign up - wrong password
     */
    public function testSignUpWrongPasswords(): void
    {
        $response = $this
            ->json("POST", "/api/v1/users", [
                "firstName" => "Test",
                "lastName" => Str::random(25),
                "username" => "teszt" . Str::random(25),
                "email" => "teszt" . Str::random(25) . "@example.com",
                "password" => "my-password-1234",
                "reTypedPassword" => "my-password-1234-1234",
            ], []);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test sign up - wrong username
     */
    public function testSignUpWrongUsername(): void
    {
        $response = $this
            ->json("POST", "/api/v1/users", [
                "firstName" => "Test",
                "lastName" => Str::random(25),
                "username" => "teszt.username",
                "email" => "teszt" . Str::random(25) . "@example.com",
                "password" => "my-password-1234",
                "reTypedPassword" => "my-password-1234",
            ], []);

        $response
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Test sign up - wrong email
     */
    public function testSignUpWrongEmail(): void
    {
        $response = $this
            ->json("POST", "/api/v1/users", [
                "firstName" => "Test",
                "lastName" => Str::random(25),
                "username" => "teszt" . Str::random(25),
                "email" => "teszt@email.hu",
                "password" => "my-password-1234",
                "reTypedPassword" => "my-password-1234",
            ], []);

        $response
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * Successfull sign up
     */
    public function testSignUpSuccessfull(): void
    {
        $response = $this
            ->json("POST", "/api/v1/users", [
                "firstName" => "Test",
                "lastName" => Str::random(25),
                "username" => "teszt" . Str::random(25),
                "email" => "teszt" . Str::random(25) . "@email.hu",
                "password" => "my-password-1234",
                "reTypedPassword" => "my-password-1234",
            ], []);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                "message",
            ]);
    }
}
