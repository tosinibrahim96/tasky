<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesMiddlewareTest extends TestCase
{

  use RefreshDatabase;

  /**
   * access a protected route without token.
   *
   * @return void
   */
  public function test_route_without_token()
  {
    $this->withoutExceptionHandling();

    $response = $this->get('api/v1/protected');

    $response->assertUnauthorized();
    $response->assertJson(['status' => false, 'message' => 'Authorization Token not found.']);
  }


  /**
   * access a protected route with invalid token.
   *
   * @return void
   */
  public function test_route_invalid_token()
  {
    $this->withoutExceptionHandling();

    $wrong_token = 'randomstring';
    $response = $this->get('api/v1/protected', ['Authorization' => 'Bearer ' . $wrong_token]);

    $response->assertUnauthorized();
    $response->assertJson(['status' => false, 'message' => 'Token is invalid.']);
  }



  /**
   * access a protected route with expired token.
   *
   * @return void
   */
  public function test_route_expired_token()
  {
    $this->withoutExceptionHandling();

    $expired_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvYXV0aFwvbG9naW4iLCJpYXQiOjE1OTU5MzgxMjYsImV4cCI6MTU5NTk0MTcyNiwibmJmIjoxNTk1OTM4MTI2LCJqdGkiOiJTVXZjMlo4cXV0cjZpaURpIiwic3ViIjoiODVhZjVmZmQtNjg0Mi00MWIzLTg3MmItZjhmODgwMGFiOGRhIiwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.yJm9f53guuf-uLUxpmOS-niig3remtRabh1kpdGw5WU';

    $response = $this->get('api/v1/protected', ['Authorization' => 'Bearer ' . $expired_token]);

    $response->assertUnauthorized();
    $response->assertJson(['status' => false, 'message' => 'Token is expired.']);
  }


  /**
   * access an unprotected route.
   *
   * @return void
   */
  public function test_unprotected_route()
  {
    $this->withoutExceptionHandling();

    $response = $this->get('api/v1/dashboard');

    $response->assertSuccessful();
  }
}
