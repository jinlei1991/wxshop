@extends("master")

@section('title','商品列表')

@section('content')
    <link rel="stylesheet" href="{{url('css/mui.min_1.css')}}">
    <style>
        .goodList>ul>li a s {
            width:17px;
            height:22px;
            display:block;
            background-position:0 -6px;
            margin:0 auto;
            position:relative;
            top:9px;
            left:-1px;
            background: {{url('/images/set.png')}};
            background-size: 35px auto;
        }
    </style>
    <body class="g-acc-bg" fnav="0" style="position: static">
    <div class="page-group">
        <div id="page-infinite-scroll-bottom" class="page">
            <div class="pro-s-box thin-bor-bottom" id="divSearch">
                <div class="box">
                    <div class="border">
                        <div class="border-inner"></div>
                    </div>
                    <div class="input-box">
                        <i class="s-icon"></i>
                        <input type="text" placeholder="输入“汽车”试试" id="txtSearch" />
                        <i class="c-icon" id="btnClearInput" style="display: none"></i>
                    </div>
                </div>
                <a href="javascript:;" class="s-btn" id="btnSearch">搜索</a>
            </div>

            <!--搜索时显示的模块-->
            <div class="search-info" style="display: none;">
                <div class="hot">
                    <p class="title">热门搜索</p>
                    <ul id="ulSearchHot" class="hot-list clearfix"><li wd='iPhone'><a class="items">iPhone</a></li><li wd='三星'><a class="items">三星</a></li><li wd='小米'><a class="items">小米</a></li><li wd='黄金'><a class="items">黄金</a></li><li wd='汽车'><a class="items">汽车</a></li><li wd='电脑'><a class="items">电脑</a></li></ul>
                </div>
                <div class="history" style="display: none">
                    <p class="title">历史记录</p>
                    <div class="his-inner" id="divSearchHotHistory">
                        <ul class="his-list thin-bor-top">
                            <li wd="小米移动电源" class="thin-bor-bottom"><a class="items">小米移动电源</a></li>
                            <li wd="苹果6" class="thin-bor-bottom"><a class="items">苹果6</a></li>
                            <li wd="苹果电脑" class="thin-bor-bottom"><a class="items">苹果电脑</a></li>
                        </ul>
                        <div class="cle-cord thin-bor-bottom" id="btnClear">清空历史记录</div>
                    </div>
                </div>
            </div>

            <div class="all-list-wrapper">

                <div class="menu-list-wrapper" id="divSortList">
                    <ul id="sortListUl" class="list">
                        <li cateid='0' class='current'><span class='items'>全部商品</span></li>
                        @foreach($cates as $cate)
                            <li cateid='{{$cate->c_id}}'><span class='items'>{{$cate->category_name}}</span></li>
                            @endforeach
                    </ul>
                </div>

                <div class="good-list-wrapper">
                    <div class="good-menu thin-bor-bottom">
                        <ul class="good-menu-list" id="ulOrderBy">
                            <li  class="current sort"><a href="javascript:;">人气</a></li>
                            <li class="sort"><a href="javascript:;">最新</a></li>
                            <li class="sort"><a href="javascript:;">价值</a><span class="i-wrap"><i class="up"></i><i class="down"></i></span></li>
                            <!--价值(由高到低30,由低到高31)-->
                        </ul>
                    </div>

                    <div class="good-list-inner">
                        <div  class="good-list-box  mui-content mui-scroll-wrapper">
                            <div class="goodList mui-scroll">
                                <ul id="ulGoodsList" class="mui-table-view mui-table-view-chevron">
                                    @foreach($goods as $good)
                                        <li id="">
                                    <span class="gList_l fl">
                                          <a href="/goods/detail/{{$good['goods_id']}}">
                                        <img class="lazy" src="{{url($good['goods_img'])}}">
                                              </a>
                                    </span>
                                            <div class="gList_r">
                                                <a href="/goods/detail/{{$good['goods_id']}}">
                                                <h3 class="gray6">{{$good['goods_name']}}</h3>
                                                <em class="gray9">{{$good['goods_price']}}</em></a>
                                                <div class="gRate">
                                                    <div class="Progress-bar">
                                                        <p class="u-progress">
                                                    <span style="width:{{($good['stock']/$good['store'])*100}}%;" class="pgbar">
                                                        <span class="pging"></span>
                                                    </span>
                                                        </p>
                                                        <ul class="Pro-bar-li">
                                                            <li class="P-bar01"><em>{{$good['store']-$good['stock']}}</em>已参与</li>
                                                            <li class="P-bar02"><em>{{$good['store']}}</em>总需人次</li>
                                                            <li class="P-bar03"><em>{{$good['stock']}}</em>剩余</li>
                                                        </ul>
                                                    </div>
                                                    <a codeid="{{$good['goods_id']}}" class="" canbuy="{{$good['stock']}}"><s></s></a>
                                                </div>
                                            </div>
                                           </li>
                                        @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('my-js')
    <script>
      /*  jQuery(document).ready(function() {
            $("img.lazy").lazyload({
                placeholder : "{{url('images/loading2.gif')}}",
                effect: "fadeIn",
            });
        });*/
        $(function(){
           var type ={{$cateid}};
            $("li[cateid='"+type+"']").addClass("current").siblings('li').removeClass('current');
        })
    /*    $(document).on("click","#ulGoodsList li img",function(){
            var goodsid = $(this).attr('goods_id');
            location.href="/goods/detail/"+goodsid
        })*/

        // 点击切换类别
        $('#sortListUl li').click(function() {
            $(this).addClass('current').siblings('li').removeClass('current');
            var typeid = $(this).attr('cateid')
            $.ajax({
                type:"post",
                url: "/goods/list",
                data: {_token:'{{csrf_token()}}',cateid:typeid},
                success: function (msg) {
                    var str ='<input type="hidden" value="'+typeid+'" id="type"> <li id="">';
                    for(var i in msg){
                        str += '<span class="gList_l fl">';
                        str += '<img class="lazy" src="http://www.wxshop.com/'+msg[i]["goods_img"]+'" style="display: block;"/>';
                        str += '</span>';
                        str += '<div class="gList_r">';
                        str += '<h3 class="gray6">'+msg[i]['goods_name']+'</h3>';
                        str += '<em class="gray9">'+msg[i]['goods_price']+'</em>';
                        str += '<div class="gRate">';
                        str += '<div class="Progress-bar">'
                        str += '<p class="u-progress">';
                        str += '<span style="width: '+(msg[i]['stock']/msg[i]['store'])*100+'%;" class="pgbar">';
                        str += '<span class="pging"></span>';
                        str += '</span>';
                        str += '</p>';
                        str += '<ul class="Pro-bar-li">';
                        str += '<li class="P-bar01"><em>'+(msg[i]['store']-msg[i]['stock'])+'</em>已参与</li>';
                        str += '<li class="P-bar02"><em>'+msg[i]['store']+'</em>总需人次</li>';
                        str += '<li class="P-bar03"><em>'+msg[i]['stock']+'</em>剩余</li>';
                        str += '</ul>';
                        str += '</div>';
                        str += '<a codeid="12785750" class="" canbuy="'+msg[i]['stock']+'"><s></s></a>';
                        str += '</div>';
                        str += '</div>';
                    }

                    $("#ulGoodsList").html(str);
                }
            })
        })
        mui.init({
            pullRefresh: {
                container: '#pullrefresh',
                down: {
                    contentdown : "下拉可以刷新",//可选，在下拉可刷新状态时，下拉刷新控件上显示的标题内容
                    contentover : "释放立即刷新",//可选，在释放可刷新状态时，下拉刷新控件上显示的标题内容
                    contentrefresh : "正在刷新...",
                    callback: pulldownRefresh
                },
                up: {
                    contentrefresh: '正在加载...',
                    callback: pullupRefresh
                }
            }
        });
        /**
         * 下拉刷新具体业务实现
         */
        function pulldownRefresh() {
            setTimeout(function() {
                var table = document.body.querySelector('.mui-table-view');
                var cells = document.body.querySelectorAll('.mui-table-view-cell');

                mui('#pullrefresh').pullRefresh().endPulldownToRefresh(); //refresh completed
            }, 1500);
        }
        var count = 0;
        /**
         * 上拉加载具体业务实现
         */
        function pullupRefresh() {
            setTimeout(function() {
                mui('#pullrefresh').pullRefresh().endPullupToRefresh((++count > 2)); //参数为true代表没有更多数据了。
                var table = document.body.querySelector('.mui-table-view');
                var cells = document.body.querySelectorAll('.mui-table-view-cell');
            }, 1500);
        }
        $(".sort").click(function(){
            var sort = $(this).text();
           var typeid = $("#type").val()?$("#type").val():0;
            $.ajax({
                type:"post",
                url: "/goods/sort",
                data: {_token:'{{csrf_token()}}',sorttype:sort,typeid:typeid},
                success: function (msg) {
                   var str ='<li id="">';
                    for(var i in msg){
                       // str += '<a href="/goods/detail/'+msg[i]['goods_id']+'">';
                        str += '<span class="gList_l fl">';
                        str += '<img class="lazy" src="http://www.wxshop.com/'+msg[i]["goods_img"]+'" style="display: block;"/>';
                        str += '</span>';
                        str += '<div class="gList_r">';
                        str += '<h3 class="gray6">'+msg[i]['goods_name']+'</h3>';
                        str += '<em class="gray9">'+msg[i]['goods_price']+'</em>';
                        str += '<div class="gRate">';
                        str += '<div class="Progress-bar">'
                        str += '<p class="u-progress">';
                        str += '<span style="width: '+(msg[i]['stock']/msg[i]['store'])*100+'%;" class="pgbar">';
                        str += '<span class="pging"></span>';
                        str += '</span>';
                        str += '</p>';
                        str += '<ul class="Pro-bar-li">';
                        str += '<li class="P-bar01"><em>'+(msg[i]['store']-msg[i]['stock'])+'</em>已参与</li>';
                        str += '<li class="P-bar02"><em>'+msg[i]['store']+'</em>总需人次</li>';
                        str += '<li class="P-bar03"><em>'+msg[i]['stock']+'</em>剩余</li>';
                        str += '</ul>';
                        str += '</div>';
                        str += '<a codeid="12785750" class="" canbuy="'+msg[i]['stock']+'"><s></s></a>';
                        str += '</div>';
                        str += '</div>';
                    }

                  $("#ulGoodsList").html(str);
                }
            })
        })
    </script>
@endsection()

