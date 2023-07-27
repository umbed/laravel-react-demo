<?php

namespace App\Models;

use App\Event\GetLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use App\Utils\LbsQQUtil;
use Illuminate\Support\Facades\DB;

class DeviceWorkRealTime extends Model
{
  protected $table = 'device_work_real_time';

  /**
   * 从坐标位置获取地理位置信息
   */
  public function getLocationInfo($lon, $lat)
  {
    // $lbs = new LbsAmapUtil();
    $lbs = new LbsQQUtil();
    if (!$lbs->regeo($lon, $lat)) {
      Log::error("逆地理位置解析失败", ['LbsQQUtil' => $lbs->error]);
      return null;
    }
    return $lbs->getResult();
  }


  /**
   * 设备上传设备信息，
   * 需要上传具体位置信息，只在这里调用逆地理解析更新位置信息
   */
  public function updateLocationInfo($lon, $lat, $imei)
  {
    $data = $this->getLocationInfo($lon, $lat);
    if (is_null($data)) {
      return false;
    }

    $data['lon'] = $lon;
    $data['lat'] = $lat;
    $result = DB::table($this->table)
      ->updateOrInsert(
        ['imei' =>  $imei],
        $data
      );
      
    return $result;
  }
}
