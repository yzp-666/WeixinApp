<?php


namespace app\api\model;

use think\Db;
use think\Exception;
use think\Model;

class Banner extends Model
{
//    protected $table = 'banner'; 设置模型所查询的表 默认class name

// 设置隐藏的字段
    protected $hidden = ['delete_time','update_time'];

// 设置只显示的字段
//    protected $visible = ['id'];

    public function items()
    {
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }
//        hasMany() 接收三个参数 关联模型的名字， 外键/关联数据， id/当前模型的主键

    public static function getBannerByID($id)
    {
        $banner = self::with(['items', 'items.img'])->find($id);
        return $banner;
    }
}
//        git,find,all,select
//        git,find 只能返回一条数据库查询的记录{}
//        all, select 返回的是一组对象[{}]
        /**
         * 三种方式查询数据库
         * @原生sql
         * @构造器
         * @使用模型/关联模型
         **/
//        $result = Db::query('select * from banner_item where banner_id=?',[$id]);
//        return $result;
//        $result = Db::table('banner_item')
//            ->where('banner_id', '=', $id)
//            ->select();
//         Db::table()->where()方法不能返回最终查询结果，返回的是Query对象
//         find() 方法只能返回一个一维数组; select() 会返回一个二维数组
//         where('字段名','表达式','查询条件')
//         三种方法写构造器
//         表达式，数组，闭包
//        $result = Db::table('banner_item')
//            ->where(function ($query) use ($id){
//                $query->where('banner_id', '=', $id);
//            })
//            ->select();
//         ORM 对象关系映射
//         模型  业务逻辑合集
//        return $result;