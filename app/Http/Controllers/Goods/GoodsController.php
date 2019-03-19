<?php

namespace App\Http\Controllers\Goods;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Catrgory;
use App\Model\Goods;

class GoodsController extends Controller
{
    /*
     * @content 全部商品
     * */
    public function allshops($id = 0)
    {
        $category = Catrgory::all()->where('p_id','=',0);
        $goods = Goods::getGoods($id);
        return view('goods.allshops',['cates'=>$category,'goods'=>$goods,'cateid'=>$id]);
    }

    /*
     * @content 商品详情
     * @params $id int 商品id
     * */
    public function detail($id)
    {
        return view("goods.detail");
    }
    /*
   * @content 根据分类获取商品列表
   * @params $id int 分类id
   * */

    public function GetCategoryInfo(Request $request)
    {
        $id = $request->cateid;
        $goods = Goods::getGoods($id);
        return $goods;
    }

    /*
    * @content 根据选择类型实现商品排序
    * @params $id int 分类id
    * */
    public function GetSortList(Request $request)
    {
       $type = $request->sorttype;
        $id = $request->typeid;
       // echo $id;die;
        $goods = Goods::OrderGoods($type,$id);
       // dd($goods);die;
        return $goods;
    }

}
