<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }

  public function show()
  {
    $userId = Auth::id();

    $company = DB::table('company', 'c')
      ->leftJoin('company_member as cm', 'cm.company_id', '=', 'c.id')
      ->where('cm.user_id', '=', $userId)
      ->first();

    return view('home', [
      'company' => $company
    ]);
  }
}
