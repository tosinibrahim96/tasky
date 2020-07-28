<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    $this->withoutExceptionHandling();

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

    $this->withoutExceptionHandling();

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

    $this->withoutExceptionHandling();

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

  /**
   * Successful login with email address.
   *
   * @return void
   */
  public function test_user_login_email_successful()
  {
    $this->withoutExceptionHandling();

    $this->post('api/v1/auth/register', [
      'email' => 'randomemail@istrategy.com',
      'username' => 'randomusername',
      'password' => 'secret'
    ]);

    $response = $this->post('api/v1/auth/login', [
      'username_or_email' => 'randomemail@istrategy.com',
      'password' => 'secret',
    ]);

    $response->assertSuccessful();
    $response->assertJsonFragment(['status' => true, 'message' => 'Login successful']);
    $response->assertJsonCount(2, 'data');
  }


  /**
   * Unauthorized login with email address.
   *
   * @return void
   */
  public function test_user_login_wrong_email_or_password()
  {
    $this->withoutExceptionHandling();

    $this->post('api/v1/auth/register', [
      'email' => 'randomemail@istrategy.com',
      'username' => 'randomusername',
      'password' => 'secret'
    ]);

    $response = $this->post('api/v1/auth/login', [
      'username_or_email' => 'randomemai@istrategy.com',
      'password' => 'secret',
    ]);

    $response->assertUnauthorized();
    $response->assertJsonFragment(['status' => false, 'message' => 'Email or Password incorrect.']);

    $response1 = $this->post('api/v1/auth/login', [
      'username_or_email' => 'randomemail@istrategy.com',
      'password' => 'secrt',
    ]);

    $response1->assertUnauthorized();
    $response1->assertJsonFragment(['status' => false, 'message' => 'Email or Password incorrect.']);
  }


  /**
   * User login with email address.
   *
   * @return void
   */
  public function test_user_login_username_successful()
  {

    $this->withoutExceptionHandling();

    $this->post('api/v1/auth/register', [
      'email' => 'randomemail@istrategy.com',
      'username' => 'randomusername',
      'password' => 'secret'
    ]);

    $response = $this->post('api/v1/auth/login', [
      'username_or_email' => 'randomusername',
      'password' => 'secret',
    ]);

    $response->assertSuccessful();
    $response->assertJsonFragment(['status' => true, 'message' => 'Login successful']);
    $response->assertJsonCount(2, 'data');
  }




  /**
   * Unauthorized login with username.
   *
   * @return void
   */
  public function test_user_login_wrong_username_or_password()
  {
    $this->withoutExceptionHandling();

    $this->post('api/v1/auth/register', [
      'email' => 'randomemail@istrategy.com',
      'username' => 'randomusername',
      'password' => 'secret'
    ]);

    $response = $this->post('api/v1/auth/login', [
      'username_or_email' => 'randomusernam',
      'password' => 'secret',
    ]);

    $response->assertUnauthorized();
    $response->assertJsonFragment(['status' => false, 'message' => 'Username or Password incorrect.']);


    $response1 = $this->post('api/v1/auth/login', [
      'username_or_email' => 'randomusername',
      'password' => 'secre',
    ]);

    $response1->assertUnauthorized();
    $response1->assertJsonFragment(['status' => false, 'message' => 'Username or Password incorrect.']);
  }


  /**
   * Ensure proper email or username validation.
   *
   * @return void
   */
  public function test_login_emailorusername_validations()
  {

    $this->withoutExceptionHandling();

    $this->post('api/v1/auth/register', [
      'email' => 'randomemail@istrategy.com',
      'username' => 'randomusername',
      'password' => 'secret'
    ]);

    $response = $this->post('api/v1/auth/login', [
      'username_or_email' => '',
      'password' => 'secret',
    ]);

    $response->assertStatus(400);
    $response->assertJson(['status' => false, 'message' => ['errors' => ['The username or email field is required.']]]);


    $response = $this->post('api/v1/auth/login', [
      'username_or_email' => 1,
      'password' => 'secret',
    ]);

    $response->assertStatus(400);
    $response->assertJson(['status' => false, 'message' => ['errors' => ['The username or email must be a string.']]]);
  }


  /**
   * Ensure the password is always required.
   *
   * @return void
   */
  public function test_password_is_required()
  {

    $this->withoutExceptionHandling();

    $this->post('api/v1/auth/register', [
      'email' => 'randomemail@istrategy.com',
      'username' => 'randomusername',
      'password' => 'secret'
    ]);

    $response = $this->post('api/v1/auth/login', [
      'username_or_email' => 'randomusername',
      'password' => ' ',
    ]);

    $response->assertStatus(400);
    $response->assertJson(['status' => false, 'message' => ['errors' => ['The password field is required.']]]);
  }
}
