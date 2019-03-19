@extends("master")

@section("title","注册")
@section("content")
    <div class="wrapper">
        <input name="hidForward" type="hidden" id="hidForward" />
        <div class="registerCon">
            <ul>
                <li class="accAndPwd">
                    <dl>
                        <s class="phone"></s><input id="userMobile" maxlength="11" type="number" placeholder="请输入您的手机号码" value="" />
                        <span class="clear">x</span>
                    </dl>
                    <dl>
                        <s class="phone"></s><input id="phone_code" maxlength="6" type="number" placeholder="请输入手机验证码" value="" />
                        <button class="layui-btn layui-btn-primary" style="float: right">点击获取验证码</button>
                        <span class="clear">x</span>
                    </dl>
                    <br>

                </li>
                <li><a id="btnNext" href="javascript:;" class="orangeBtn loginBtn">下一步</a></li>
            </ul>
        </div>
       </div>
    @endsection

<div class="layui-layer-move"></div>

        @section('my-js')
            <script type="text/javascript">
                $(".footer").attr("style","display:none")
            </script>
            <script>
                $('.registerCon input').bind('keydown',function(){
                    var that = $(this);
                    if(that.val().trim()!=""){

                        that.siblings('span.clear').show();
                        that.siblings('span.clear').click(function(){
                            console.log($(this));

                            that.parents('dl').find('input:visible').val("");
                            $(this).hide();
                        })

                    }else{
                        that.siblings('span.clear').hide();
                    }

                })
                function show(){
                    if($('.registerCon input').attr('type')=='password'){
                        $(this).prev().prev().val($("#passwd").val());
                    }
                }
                function hide(){
                    if($('.registerCon input').attr('type')=='text'){
                        $(this).prev().prev().val($("#passwd").val());
                    }
                }
                $('.registerCon s').bind({click:function(){
                    if($(this).hasClass('eye')){
                        $(this).removeClass('eye').addClass('eyeclose');

                        $(this).prev().prev().prev().val($(this).prev().prev().val());
                        $(this).prev().prev().prev().show();
                        $(this).prev().prev().hide();


                    }else{
                        console.log($(this  ));
                        $(this).removeClass('eyeclose').addClass('eye');
                        $(this).prev().prev().val($(this).prev().prev().prev().val());
                        $(this).prev().prev().show();
                        $(this).prev().prev().prev().hide();

                    }
                }
                })

                function registertel(){
                    // 手机号失去焦点
                    $('#userMobile').blur(function(){
                        reg=/^1(3[0-9]|4[57]|5[0-35-9]|8[0-9]|7[06-8])\d{8}$/;//验证手机正则(输入前7位至11位)
                        var that = $(this);

                        if( that.val()==""|| that.val()=="请输入您的手机号")
                        {
                            layer.msg('请输入您的手机号！');
                        }
                        else if(that.val().length<11)
                        {
                            layer.msg('您输入的手机号长度有误！');
                        }
                        else if(!reg.test($("#userMobile").val()))
                        {
                            layer.msg('您输入的手机号不存在!');
                        }
                        else if(that.val().length == 11){
                            // ajax请求后台数据
                        }
                    })

                }
                registertel();
                // 购物协议
                $('dl.a-set i').click(function(){
                    var that= $(this);
                    if(that.hasClass('gou')){
                        that.removeClass('gou').addClass('none');
                        $('#btnNext').css('background','#ddd');

                    }else{
                        that.removeClass('none').addClass('gou');
                        $('#btnNext').css('background','#f22f2f');
                    }

                })
                // 下一步提交
                $('#btnNext').click(function() {
                    if ($('#userMobile').val() == '') {
                        layer.msg('请输入您的手机号！');
                    }
                    $.ajax({
                        url: "/user/doregister",
                        type: "post",
                        data:{tel:$('#userMobile').val(),_token:'{{csrf_token()}}'},
                        success:function(res){
                            console.log(res)
                        }
                    })
                })



            </script>


        @endsection

