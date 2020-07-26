<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

  use RefreshDatabase;

  /**
   * Create a new account.
   *
   * @return void
   */
  public function test_a_user_can_create_a_new_account()
  {
    $this->withoutExceptionHandling();

    $response = $this->post('api/v1/auth/register', [
      'email' => 'email@mail1.come',
      'username' => 'first-username15',
      'password' => 'password'
    ]);

    $response->assertCreated();
    $this->assertCount(1, User::all());
  }

  /**
   * Handle email validations.
   *
   * @return void
   */
  public function test_email_validations()
  {

    $response = $this->post('api/v1/auth/register', [
      'email' => 'emailmail1come',
      'username' => 'first-username15',
      'password' => 'password'
    ]);

    $response->assertStatus(400);
    $response->assertJson(['status' => false, 'message' => ['errors' => ['The email must be a valid email address.']]]);


    $response1 = $this->post('api/v1/auth/register', [
      'email' => '',
      'username' => 'first-username15',
      'password' => 'password'
    ]);

    $response1->assertStatus(400);
    $response1->assertJson(['status' => false, 'message' => ['errors' => ['The email field is required.']]]);


    $this->post('api/v1/auth/register', [
      'email' => 'email@mail.com',
      'username' => 'username1',
      'password' => 'password'
    ]);
    $response2 = $this->post('api/v1/auth/register', [
      'email' => 'email@mail.com',
      'username' => 'username2',
      'password' => 'password'
    ]);

    $response2->assertStatus(400);
    $response2->assertJson(['status' => false, 'message' => ['errors' => ['The email has already been taken.']]]);
  }


  /**
   * Handle username validations.
   *
   * @return void
   */
  public function test_username_validations()
  {

    $response = $this->post('api/v1/auth/register', [
      'email' => 'email@mail.com',
      'username' => 1,
      'password' => 'password'
    ]);

    $response->assertStatus(400);
    $response->assertJson(['status' => false, 'message' => ['errors' => ['The username must be a string.']]]);


    $response1 = $this->post('api/v1/auth/register', [
      'email' => 'email@mail.com',
      'username' => '',
      'password' => 'password'
    ]);

    $response1->assertStatus(400);
    $response1->assertJson(['status' => false, 'message' => ['errors' => ['The username field is required.']]]);


    $this->post('api/v1/auth/register', [
      'email' => 'email@mail.com',
      'username' => 'username1',
      'password' => 'password'
    ]);
    $response2 = $this->post('api/v1/auth/register', [
      'email' => 'email@mail1.com',
      'username' => 'username1',
      'password' => 'password'
    ]);

    $response2->assertStatus(400);
    $response2->assertJson(['status' => false, 'message' => ['errors' => ['The username has already been taken.']]]);
  }

  /**
   * Handle username validations.
   *
   * @return void
   */
  public function test_password_validations()
  {

    $response1 = $this->post('api/v1/auth/register', [
      'email' => 'email@mail.com',
      'username' => 'user',
      'password' => ''
    ]);

    $response1->assertStatus(400);
    $response1->assertJson(['status' => false, 'message' => ['errors' => ['The password field is required.']]]);

    $response2 = $this->post('api/v1/auth/register', [
      'email' => 'email@mail1.com',
      'username' => 'user1',
      'password' => 'pas'
    ]);

    $response2->assertStatus(400);
    $response2->assertJson(['status' => false, 'message' => ['errors' => ['The password must be at least 6 characters.']]]);
  }
}
