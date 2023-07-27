<?php

namespace App\Http\Controllers;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }

  public function show()
  {
    return view('work');
  }

  public function list(Request $request)
  {
    // 获取参数
    $page = $request->has('page') ? $request->input('page') : 0;
    $pageSize = $request->has('limit') ? $request->input('limit') : 15;

    $where = [];
    if ($request->has('imei')) {
      $imei =  $request->input('imei');
      $where[] = ['d.imei', 'like', '%' . $imei . '%'];
    }
    if ($request->has('start_time')) {
      $start_time =  $request->input('start_time') . ' 00:00:00';
      $where[] = ['wd.created_at', '>=', $start_time];
    }
    if ($request->has('end_time')) {
      $end_time =  $request->input('end_time') . ' 23:59:59';
      $where[] = ['wd.created_at', '<=', $end_time];
    }

    // 车辆检索
    $orWhere_car = null;
    if ($request->has('search_car')) {
      $search_car = $request->input('search_car');
      $orWhere_car = function (Builder $query) use (&$search_car) {
        $query->orWhere('c.mark', 'like', '%' . $search_car . '%')
          ->orWhere('c.plate', 'like', '%' . $search_car . '%')
          ->orWhere('c.type', 'like', '%' . $search_car . '%');
      };
    }


    $builder = DB::table('work_data', 'wd')
      ->select(['wd.*', 'd.imei', 'c.mark', 'c.plate', 'c.type'])
      ->leftJoin('devices as d', 'd.id', '=', 'wd.device_id')
      ->leftJoin('car as c', 'c.device_id', '=', 'd.id')
      ->where($where)
      ->orderBy('created_at', 'desc')
      ->orderBy('id', 'desc');

    if (!empty($orWhere_car)) {
      $builder->where($orWhere_car);
    }

    $list = $builder->paginate($pageSize);

    return response()->json($list);
  }
}
