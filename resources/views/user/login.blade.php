@extends("master")

@section('title',"登录")

@section('content')
    <div class="wrapper">
        <div class="registerCon">
            <div class="binSuccess5">
                <ul>
                    <li class="accAndPwd">
                        <dl>
                            <div class="txtAccount">
                                <input id="txtAccount" type="text" placeholder="请输入您的手机号码"><i></i>
                            </div>
                            <cite class="passport_set" style="display: none"></cite>
                        </dl>
                        <dl>
                            <input id="txtPassword" type="password" placeholder="密码" value="" maxlength="20" /><b></b>
                        </dl>
                        <dl>
                            <input id="verifycode" type="text" placeholder="请输入验证码"  maxlength="4" /><b></b>
                            <img src="{{url('/verify/create')}}" alt="" id="img">
                        </dl>
                    </li>

                    </p>
                    </p>
                </ul>
                <a id="btnLogin" href="javascript:;" class="orangeBtn loginBtn">登录</a>
            </div>
            <div class="forget">
                <a href="/user/forget">忘记密码？</a><b></b>
                <a href="/user/register">新用户注册</a>
            </div>
        </div>
        <div class="oter_operation gray9" style="display: none;">

            <p>登录666潮人购账号后，可在微信进行以下操作：</p>
            1、查看您的潮购记录、获得商品信息、余额等<br />
            2、随时掌握最新晒单、最新揭晓动态信息
        </div>
    </div>

    </body>
    </html>
    @endsection
    @section('my-js')
        <script type="text/javascript">
            $(".footer").attr("style","display:none")
            $("#img").click(function(){
                $(this).attr('src',"{{url('/verify/create')}}"+"?"+Math.random())
            })
        </script>

        @endsection

