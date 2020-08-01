<?php

namespace App\Http\Middleware;

use App\Http\Traits\ApiResponse;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class ProtectRoutes extends BaseMiddleware
{
  use ApiResponse;
  /**
   * The authentication guard factory instance.
   *
   * @var \Illuminate\Contracts\Auth\Factory
   */
  protected $auth;

  /**
   * Create a new middleware instance.
   *
   * @param  \Illuminate\Contracts\Auth\Factory  $auth
   * @return void
   */
  public function __construct(Auth $auth)
  {
    $this->auth = $auth;
  }

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  $guard
   * @return mixed
   */
  public function handle($request, Closure $next, $guard = 'api')
  {

    try {
      JWTAuth::parseToken()->authenticate();
    } catch (Exception $e) {
      if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
        return $this->failureResponse(401, 'Token is invalid.');
      } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
        return $this->failureResponse(401, 'Token is expired.');
      } else {
        return $this->failureResponse(401, 'Authorization Token not found.');
      }
    }

    if ($this->auth->guard($guard)->guest()) {
      return $this->failureResponse(401, 'Sorry, you cannot access this resource.');
    }

    return $next($request);
  }
}
