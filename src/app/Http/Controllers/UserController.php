<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }

  public function show()
  {
    return view('users');
  }

  public function store(Request $request)
  {
    //获取参数
    $page = $request->has('page') ? $request->input('page') : 0;
    $pageSize = $request->has('limit') ? $request->input('limit') : 15;

    $where = [];
    if ($request->has('search')) {
      $search = $request->input('search');
      $where[] = ['name', 'like', '%' . $search . '%'];
      $where[] = ['email', 'like', '%' . $search . '%'];
    }
    //验证参数

    //到模型处理
    $users = new User();
    $list = $users->where($where)
      ->orderBy('updated_at', 'desc')
      ->orderBy('id', 'desc')
      ->simplePaginate($pageSize);
    // ->paginate($pageSize);
    // ->toJson();

    return response()->json($list);
  }


  public function create(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
      'password' => ['required', 'string', 'max:255'],
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    return response()->json(['code' => 0, 'msg' => 'ok']);
  }

  public function delete(Request $request)
  {
    $result = DB::table('users')->delete($request->id);
    if (!$result) {
      return response()->json(['code' => 1, 'msg' => 'fail']);
    }
    return response()->json(['code' => 0, 'msg' => 'ok']);
  }
}
