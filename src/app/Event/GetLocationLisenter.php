<?php

namespace App\Event;

use App\Event\GetLocation;
use App\Models\DeviceWorkRealTime;
use App\Utils\LbsQQUtil;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

/**
 * 实现ShouldQueue从队列执行耗时任务
 */
class GetLocationLisenter implements ShouldQueue
{
    /**
     * 创建事件监听器
     */
    public function __construct()
    {
        //
    }

    /**
     * 处理事件
     * 调用逆地理位置解析获取位置,保存详细位置省市区街道，
     */
    public function handle(GetLocation $event): void
    {
        Log::info("处理GetLocation事件,获取地理位置");

        // $lbs = new LbsAmapUtil();
        $lbs = new LbsQQUtil();
        if (!$lbs->regeo($event->data['lon'], $event->data['lat'])) {
            Log::error("逆地理位置解析失败", ['LbsQQUtil' => $lbs->error]);
        }
        DeviceWorkRealTime::where('imei', '=', $event->data['imei'])
            ->update($lbs->getResult());
    }
}
