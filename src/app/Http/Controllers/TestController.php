<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth:sanctum', 'verified']);
  }

  public function tokenCreate(Request $request)
  {
    $token_name = "test";
    $token = $request->user()->createToken($token_name);

    return ['token' => $token->plainTextToken];
  }

  public function testAuth(Request $request)
  {
    return ['test' => 'ok'];
  }
}
