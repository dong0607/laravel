﻿<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>666潮人购</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="layui/css/layui.css">
    <link rel="stylesheet" href="layui/css/layui.css">
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/index.css" rel="stylesheet" type="text/css" />

</head>
<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token();?>">
<body fnav="1" class="g-acc-bg">
    <div class="marginB" id="loadingPicBlock">
        <!--首页头部-->
        <div class="m-block-header" style="display: none">
        	<div class="search"></div>
        	<a href="/" class="m-public-icon m-1yyg-icon"></a>
        </div>
        <!--首页头部 end-->

        <!-- 关注微信 -->
        <div id="div_subscribe" class="app-icon-wrapper" style="display: none;">
            <div class="app-icon">
                <a href="javascript:;" class="close-icon"><i class="set-icon"></i></a>
                <a href="javascript:;" class="info-icon">
                    <i class="set-icon"></i>
                    <div class="info">
                        <p>点击关注666潮人购官方微信^_^</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- 焦点图 --> <div class="hotimg-wrapper">
            <div class="hotimg-top"></div>
            <section id="sliderBox" class="hotimg">
        		<ul class="slides" style="width: 600%; transition-duration: 0.4s; transform: translate3d(-828px, 0px, 0px);">
        			<li style="width: 414px; float: left; display: block;" class="clone">
        				<a href="#">
        					<img src="images/TB1jGmgMgHqK1RjSZFgSuu7JXXa.jpg" alt="">
        				</a>
        			</li>
        			<li class="" style="width: 414px; float: left; display: block;">
        				<a href="#">
        					<img src="images/TB10vPXKpXXXXacXXXXvKyzTVXX-520-280.jpg" alt="">
        				</a>
        			</li>
        			<li style="width: 414px; float: left; display: block;" class="flex-active-slide">
        				<a href="#"><img src="images/TB1d2_1LSzqK1RjSZFLXXcn2XXa-520-280.jpg_q90_.webp" alt="">
        				</a>
        			</li>
        			<li style="width: 414px; float: left; display: block;" class="">
        				<a href="#"><img src="images/TB1_ebDLzDpK1RjSZFrXXa78VXa-520-280.jpg_q90_.webp" alt=""></a>
        			</li>
        			<li style="width: 414px; float: left; display: block;" class="">
        				<a href="http://weixin.1yyg.com/v27/products/23559.do?pf=weixin">
        					<img src="images/TB1JNHwKFXXXXafXVXXSutbFXXX.jpg" alt="">
        				</a>
        			</li>
        		</ul>
            </section>
        </div>
        <!-- <script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script> <script src="http://cdn.bootcss.com/flexslider/2.6.2/jquery.flexslider.min.js"></script> -->
        <!--分类-->
        <div class="index-menu thin-bor-top thin-bor-bottom">
            <ul class="menu-list">
                @foreach($category as $v)
                <li>
                    <a href="allshops?cate_id={{$v->cate_id}}" id="btnNew">
                        <i class="xinpin"></i>
                        <span class="title">{{$v->cate_name}}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <!--导航-->
        <div class="success-tip">
        	<div class="left-icon"></div>
        	<ul class="right-con">
				<li>
					<span style="color: #4E555E;">
						<a href="#" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>
				<li>
					<span style="color: #4E555E;">
						<a href="#" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>
				<li>
					<span style="color: #4E555E;">
						<a href="#" style="color: #4E555E;">恭喜<span class="username">啊啊啊</span>获得了<span>iphone7 红色 128G 闪耀你的眼</span></a>
					</span>
				</li>
			</ul>
        </div>

        <!-- 热门推荐 -->
        <div class="line hot">
        	<div class="hot-content">
        		<i></i>
        		<span>商品列表</span>
        		<div class="l-left"></div>
        		<div class="l-right"></div>
        	</div>
        </div>
        <div class="hot-wrapper">
        	<ul class="clearfix">
                @foreach ($arr as $k => $v)
        		<li style="border-right:1px solid #e4e4e4; ">
        			<a href="">
        				<p class="title">{{$v->goods_name}}</p>
        				<p class="subtitle">价值：￥{{$v->self_price}}</p>
        				<a href="shopcontent?goods_id={{$v->goods_id}}">
                            <img  class="img" src="uploads/goodsimg/{{$v->goods_img}}" alt="">
                        </a>
        			</a>
        		</li>
                @endforeach
        	</ul>
        </div>
        <!-- 猜你喜欢 -->
        <div class="line guess">
        	<div class="hot-content">
        		<i></i>
        		<span>猜你喜欢</span>
        		<div class="l-left"></div>
        		<div class="l-right"></div>
        	</div>
        </div>
        <!--商品列表-->
        <div class="goods-wrap marginB">
            <ul id="ulGoodsList" class="goods-list clearfix">
                @foreach ($goods_arr as $k => $v)
            	<li id="23558" codeid="12751965" goodsid="23558" codeperiod="28436">
            		<a href="shopcontent?goods_id={{$v->goods_id}}" class="g-pic">
                            <img class="lazy" src="uploads/goodsimg/{{$v->goods_img}}" name="goodsImg" width="136" height="136">
            		</a>
            		<p class="g-name">{{$v->goods_name}}</p>
            		<ins class="gray9">价值：￥{{$v->self_price}}</ins>
            		<div class="Progress-bar">
            			<p class="u-progress">
            				<span class="pgbar" style="width: 96.43076923076923%;">
            					<span class="pging"></span>
            				</span>
            			</p>
            		</div>
            		<div class="btn-wrap" name="buyBox" limitbuy="0" surplus="58" totalnum="1625" alreadybuy="1567">
            			<a href="shopcontent?goods_id={{$v->goods_id}}" class="buy-btn" codeid="12751965">立即潮购</a>
            			<div class="gRate" codeid="12751965" canbuy="58">
            				<a href="javascript:;"></a>
            			</div>
            		</div>

            	</li>
                @endforeach
            </ul>
            <div class="loading clearfix"><b></b>正在加载</div>
        </div>  
<!--底部-->
@extends('base')
<div id="div_fastnav" class="fast-nav-wrapper">
    <ul class="fast-nav">
        <li id="li_menu" isshow="0">
            <a href="javascript:;"><i class="nav-menu"></i></a>
        </li>
        <li id="li_top" style="display: none;">
            <a href="javascript:;"><i class="nav-top"></i></a>
        </li>
    </ul>
    <div class="sub-nav four" style="display: none;">
        <a href="#"><i class="announced"></i>最新揭晓</a>
        <a href="#"><i class="single"></i>晒单</a>
        <a href="#"><i class="personal"></i>我的潮购</a>
        <a href="#"><i class="shopcart"></i>购物车</a>
    </div>
</div>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="layui/layui.js"></script> 
<script src="js/all.js"></script>
<script src="js/index.js"></script>
<script src="js/lazyload.min.js"></script>
<script>
   
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


        });
    
</script>
</body>
</html>
