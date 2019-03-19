<?php

namespace App\Http\Controllers;

use App\Model\Order;
use Illuminate\Http\Request;
use App\Model\Swiper;
use App\Model\Catrgory;
use App\Model\Goods;


class IndexController extends Controller
{
    //网站首页
    public function index()
    {
        //获取轮播图
        $swiper = Swiper::all()->where('status','=',1);
        //获取所有分类
        $category = Catrgory::all()->where('p_id','=',0);
        $info = Order::where('status','=',1)->orderBy('created_at','asc')->take(20)->get();
        //获取最新商家的20件商品
        $goods = Goods::where('status','=',1)->orderBy('created_at','asc')->take(20)->get();
        return view("index",['swipers'=>$swiper,'cate'=>$category,'info'=>$info,'goods'=>$goods]);
    }
}
