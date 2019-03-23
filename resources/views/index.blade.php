@extends('master')


@section('title')
	乐美
@endsection
@section('content')
	<div class="marginB" id="loadingPicBlock">
		<h1>aaaa</h1>
		<!-- 焦点图 -->
		<div class="hotimg-wrapper">
			<div class="hotimg-top"></div>
			<section id="sliderBox" class="hotimg">
				<ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">
					@foreach($swipers as $swiper)
						<li style="width: 414px; float: left; display: block;" class="clone">
							<a href="{{$swiper->url}}">
								<img src="{{url($swiper->imgurl)}}" alt="{{$swiper->alt}}">
							</a>
						</li>
						@endforeach
				</ul>
			</section>
		</div>

		<!--分类-->
		<div class="index-menu thin-bor-top thin-bor-bottom">
			<ul class="menu-list">
				@foreach($cate as $c)
					<li>
						<a href="/goods/allshops/{{$c->c_id}}">
						<i class="fenlei"></i>
							<span class="title">{{$c->category_name}}</span>
						</a>
					</li>
					@endforeach
			</ul>
		</div>
		<!--最新成交-->
		<div class="success-tip">
			<div class="left-icon"></div>
			<ul class="right-con">
				@foreach($info as $i)
					<li>
					<span style="color: #4E555E;">
						<a href="goods/detail/{{$i->goods_id}}" style="color: #4E555E;">恭喜<span class="username">{{$i->usernme}}</span>获得了<span>{{$i->goodsname}}</span></a>
					</span>
					</li>
					@endforeach
			</ul>
		</div>

		<!-- 热门推荐 -->
		<div class="line hot">
			<div class="hot-content">
				<i></i>
				<span>潮人推荐</span>
				<div class="l-left"></div>
				<div class="l-right"></div>
			</div>
		</div>
		<!--商品列表-->
		<div class="goods-wrap marginB">
			<ul id="ulGoodsList" class="goods-list clearfix">
				@foreach($goods as $good)
						<li>
							<a href="/goods/detail/{{$good['goods_id']}}" class="g-pic">
								<img class="lazy" name="goodsImg" data-original="{{url($good['goods_img'])}}" width="136" height="136">
							</a>
							<p class="g-name">{{$good['goods_name']}}{{$good['goods_intruct']}}</p>
							<ins class="gray9">{{$good['goods_price']}}</ins>
							<div class="Progress-bar">
								<p class="u-progress">
            				<span class="pgbar" style="width:{{($good['stock']/$good['store'])*100}}%">
            					<span class="pging"></span>
            				</span>
								</p>

							</div>
							<div class="btn-wrap" name="buyBox">
								<a href="" class="buy-btn">立即购买</a>
								<div class="gRate">
									<a href="javascript:;"></a>
								</div>
							</div>
						</li>
					@endforeach
			</ul>
			<div class="loading clearfix"><b></b>人家是有底线的</div>
		</div>
		<div id="div_fastnav" class="fast-nav-wrapper">
			<ul class="fast-nav">
				<li id="li_menu" isshow="0">
					<a href="javascript:;"><i class="nav-menu"></i></a>
				</li>
				<li id="li_top" style="display: none;">
					<a href="javascript:;"><i class="nav-top"></i></a>
				</li>
			</ul>
		</div>
		</div>
@endsection

@section('my-js')
			<script>
				$(function () {
					$('.hotimg').flexslider({
						directionNav: false,   //是否显示左右控制按钮
						controlNav: true,   //是否显示底部切换按钮
						pauseOnAction: false,  //手动切换后是否继续自动轮播,继续(false),停止(true),默认true
						animation: 'slide',   //淡入淡出(fade)或滑动(slide),默认fade
						slideshowSpeed: 3000,  //自动轮播间隔时间(毫秒),默认5000ms
						animationSpeed: 150,   //轮播效果切换时间,默认600ms
						direction: 'horizontal',  //设置滑动方向:左右horizontal或者上下vertical,需设置animation: "slide",默认horizontal
						randomize: false,   //是否随机幻切换
						animationLoop: true   //是否循环滚动
					});
					setTimeout($('.flexslider img').fadeIn());
				});
				jQuery(document).ready(function() {
					$("img.lazy").lazyload({
						placeholder : "images/loading2.gif",
						effect: "fadeIn",
					});

					// 返回顶部点击事件
					$('#div_fastnav #li_menu').click(
							function(){
								if($('.sub-nav').css('display')=='none'){
									$('.sub-nav').css('display','block');
								}else{
									$('.sub-nav').css('display','none');
								}

							}
					)
					$("#li_top").click(function(){
						$('html,body').animate({scrollTop:0},300);
						return false;
					});

					$(window).scroll(function(){
						if($(window).scrollTop()>200){
							$('#li_top').css('display','block');
						}else{
							$('#li_top').css('display','none');
						}

					})


				});
			</script>
	<script type="text/javascript">
		$("#div-header").attr("style","display:none")
</script>
@endsection



