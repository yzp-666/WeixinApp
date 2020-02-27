<?php


namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        // 获取参数
        // 参数校验
        $request = Request::instance();
        $params = $request->param();

        $result = $this->batch()->check($params);
        if(!$result){
            $e = new ParameterException([
                'msg' => $this->error,
            ]);
            throw $e;
        }
        else{
            return true;
        }
    }
}