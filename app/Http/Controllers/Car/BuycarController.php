<?php

namespace App\Http\Controllers\Car;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuycarController extends Controller
{
    /*
     * @content 购物车首页
     * */
    public function index()
    {
        return view("car.shopcart");
    }
}
