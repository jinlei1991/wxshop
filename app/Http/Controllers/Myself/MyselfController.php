<?php

namespace App\Http\Controllers\Myself;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyselfController extends Controller
{
    /*
     * @content 我的首页
     * */
    public function index()
    {
        return view("myself.userpage");
    }
}
