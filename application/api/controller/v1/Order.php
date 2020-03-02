<?php


namespace app\api\controller\v1;


use think\Controller;

class Order extends Controller
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
}