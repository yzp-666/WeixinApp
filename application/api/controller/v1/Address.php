<?php


namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\User;
use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Controller;

class Address extends BaseController
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
    ];

    public function createOrUpdateAddress(){
        $validate = new AddressNew();
        $validate->goCheck();
        (new AddressNew())->goCheck();
        // 根据Token获取uid
        // 根据uid数据判断用户是否存在,不存在抛出异常
        // 获取用户从客户端传来的地址信息
        // 根据用户地址信息是否存在，判断添加地址或跟新地址
        $uid = TokenService::getCurrentUid();
        $user = User::get($uid);
        if(!$user){
            throw new UserException();
        }
        $dataArray = $validate->getDataByRule(input('post.'));
        $userAddress = $user->address;
        if(!$userAddress) {
            $user->address()->save($dataArray);
        } else{
            $user->address->save($dataArray);
        }
        return json(new SuccessMessage(), 201);
    }

}