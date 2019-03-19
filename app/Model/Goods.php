<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    /*
     * @content 根据分类id获取商品，如果id=0 获取所有商品
     * @params $id int 分类id
     * @return $data   商品信息
     * */
    public static function getGoods($id)
    {
        if($id==0){
           $data =  self::where('status','=',1)->orderBy('created_at','asc')->take(20)->get();
        }else{
            $data =  self::where(['status'=>1,'category'=>$id])->orderBy('created_at','asc')->take(20)->get();
        }

        return $data;
    }
    /*
    * @content 根据商品分类选择类型进行排序
    * @params $type string 类型
    * @return $data   商品信息
    * */

    public static function OrderGoods($type,$id)
    {
        $arr = ['最新'=>'created_at','人气'=>'sellnum','价值'=>'goods_price'];
       // return $arr[$type];
        if($id==0){
            $data =  self::where('status','=',1)->orderBy($arr[$type],'asc')->take(20)->get();
        }else{
            $data =  self::where(['status'=>1,'category'=>$id])->orderBy($arr[$type],'asc')->take(20)->get();
        }

        return $data;
    }
}
