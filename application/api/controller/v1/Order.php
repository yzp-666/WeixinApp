<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\OrderPlace;
use app\api\service\Order as OrderService;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Controller;
use app\api\service\Token as TokenService;
class Order extends BaseController
{
    // 用户选择商品后，提交选择商品的信息
    // 接收信息后，检测订单相关商品的库存量
    // 有库存，把订单数据存入数据库中，并返回客户端消息可以支付了
    // 调用支付接口支付
    // 还需要再次检测库存量
    // 服务器调用微信支付接口进行支付
    // 微信会返回支付结果 （异步）
    // 成功 再进行库存量检测
    // 如果支付成功进行库存量扣除
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    public function placeOrder(){
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();
        $order = new OrderService();
        $status = $order->place($uid, $products);
        return $status;
    }

}