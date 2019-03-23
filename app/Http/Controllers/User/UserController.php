<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Common;

class UserController extends Controller
{
    /*
     * @content 用户登录页面
     * */
    public function login()
    {
       // echo session('verifycode');
        return view("user.login");
    }
    /*
    * @content 用户注册页面
    * */
    public function register()
    {
        return view("user.register");
    }
    /*
    * @content 用户忘记密码页面
    * */
    public function forget()
    {
        return view("user.forget");
    }


    public function doregister(Request $request)
    {
        //$mobile = $request->mobile;
       // $this->sendMobile($mobile=15901429613);
    }

    /*
     * @content 发送手机验证码
     * @params  $mobile  要发送的手机号
     *
     * */
    private function sendMobile($mobile)
    {
        $host = env("MOBILE_HOST");
        $path = env("MOBILE_PATH");
        $method = "POST";
        $appcode = env("MOBILE_APPCODE");
        $headers = array();
        $code = Common::createcode(4);
        session(['mobilecode'=>$code]);
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：".$code."，3分钟内有效！&mobile=".$mobile;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);
    }
}
