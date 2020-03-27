<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePostiveInt;
use app\api\service\Pay as PayService;
class Pay extends BaseController
{
    protected $beforeActionList =[
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    public function getPreOrder($id='')
    {
        (new IDMustBePostiveInt()) ->goCheck();
        $pay = new PayService($id);
        return $pay->pay();
    }

    public function receiveNotify()
    {
        // 通知频率为15/15/30/180...3600 /秒
        // 要返回微信处理成功的消息
        // 1.检测库存量， 超卖
        // 2.更新这个订单的status
        // 3.减库存
        // 如果成功处理返回微信成功处理消息，否则返回没有成功处理

        // 特点：post请求 xml格式 不能自己设置参数
        $notify = new WxNotify();
        $notify->Handle();
    }
}