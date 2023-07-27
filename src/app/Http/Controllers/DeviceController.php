<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }

  public function show()
  {
    return view('devices');
  }

  public function store(Request $request)
  {
    // 获取参数
    $page = $request->has('page') ? $request->input('page') : 0;
    $pageSize = $request->has('limit') ? $request->input('limit') : 15;

    // 检索条件
    $where = [];
    if ($request->has('search')) {
      $search = $request->input('search');
      $where[] = ['imei', 'like', '%' . $search . '%'];
    }

    $list = DB::table('devices', 'd')
      ->select(['d.id', 'd.imei', 'd.name', 'd.model', 'd.buy_date', 'd.distributor', 'w.address', 'w.province', 'w.city', 'w.district', 'w.district', 'w.street', 'w.updated_at'])
      ->where($where)
      ->leftJoin('device_work_real_time as w', 'w.imei', '=', 'd.imei')
      ->orderBy('w.updated_at', 'desc')
      ->orderBy('d.id', 'desc')
      ->paginate($pageSize);

    return response()->json($list);
  }

  public function more(Request $request)
  {
    $imei = $request->input('imei');

    $result = DB::table('device_work_real_time')
      ->where('imei', '=', $imei)
      ->first();
    return response()->json($result);
  }
}
