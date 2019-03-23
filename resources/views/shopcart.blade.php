<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>购物车</title>
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/cartlist.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="layui/css/layui.css">
    <script src="layui/layui.js"></script> 
    <div class="layui-layer-move"></div>
</head>
<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token();?>">
<body id="loadingPicBlock" class="g-acc-bg">
    <input name="hidUserID" type="hidden" id="hidUserID" value="-1" />
    <div>
        <!--首页头部-->
        <div class="m-block-header">
            <a href="/" class="m-public-icon m-1yyg-icon"></a>
            <a href="#" id="t" class="m-index-icon">退出</a>
        </div>
        <!--首页头部 end-->
        <div class="g-Cart-list">
            <ul id="cartBody">
                @foreach($cart as $v)
                <li>
                    <s class="xuan current" cart_id="{{$v->cart_id}}"  id="{{$v->goods_id}}"  ></s>
                    <a class="fl u-Cart-img" href="/v44/product/12501977.do">
                        <img src="uploads/goodsimg/{{$v->goods_img}}" border="0" alt="">
                    </a>
                    <div class="u-Cart-r">
                        <a href="/v44/product/12501977.do" class="gray6">{{$v->goods_name}}</a>
                        <span class="gray9">
                            <em>剩余124人次</em>
                        </span>
                        <div class="num-opt">
                            <em class="num-mius dis min" goods_id="{{$v->goods_id}}"><i></i></em>
                            <input class="text_box"  goods_id="{{$v->goods_id}}" name="num" maxlength="6" price="{{$v->self_price}}" type="text" value="{{$v->num}}" codeid="12501977">
                            <em class="num-add add" goods_id="{{$v->goods_id}}"><i></i></em>
                        </div>
                        <a href="javascript:;" cart_id="{{$v->cart_id}}" class="z-del"><s></s></a>
                    </div>    
                </li>
               @endforeach
            </ul>
            <div id="divNone" class="empty "  style="display: none"><s></s><p>您的购物车还是空的哦~</p><a href="https://m.1yyg.com" class="orangeBtn">立即潮购</a></div>
        </div>
        <div id="mycartpay" class="g-Total-bt g-car-new" style="">
            <dl>
                <dt class="gray6">
                    <s class="quanxuan current"></s>全选
                    <p class="money-total">合计<em class="orange total"><span>￥</span>17.00</em></p>
                    
                </dt>
                <dd>
                    <a href="javascript:;" id="a_payment" class="orangeBtn del w_account remove">删除</a>
                    <a href="javascript:;" id="a_payment" class="orangeBtn settle w_account">去结算</a>
                </dd>
            </dl>
        </div>
        <div class="hot-recom">
            <div class="title thin-bor-top gray6">
                <span><b class="z-set"></b>人气推荐</span>
                <em></em>
            </div>
            <div class="goods-wrap thin-bor-top">
                <ul class="goods-list clearfix">
                    @foreach ($goods as $v)
                    <li>
                        <a href="#" class="g-pic">
                            <img src="uploads/goodsimg/{{$v->goods_img}}" width="136" height="136">
                        </a>
                        <p class="g-name">
                            <a href="https://m.1yyg.com/v44/products/23458.do">{{$v->goods_name}}</a>
                        </p>
                        <ins class="gray9">价值:￥{{$v->self_price}}</ins>
                        <div class="btn-wrap">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span class="pgbar" style="width:1%;">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                            </div>
                            <div class="gRate" data-productid="23458">
                                <a href="javascript:;"><s></s></a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

       
        

<!--底部-->
@extends('base')

<script src="js/jquery-1.11.2.min.js"></script>
<!---商品加减算总数---->
    <script type="text/javascript">
    $(function () {
        $(".add").click(function () {
            var t = $(this).prev();
            t.val(parseInt(t.val()) + 1);
            GetCount();
        })
        $(".min").click(function () {
            var t = $(this).next();
            if(t.val()>1){
                t.val(parseInt(t.val()) - 1);
                GetCount();
            }
        })
    })
    </script>



    
    <script>

    // 全选        
    $(".quanxuan").click(function () {
        if($(this).hasClass('current')){
            $(this).removeClass('current');

             $(".g-Cart-list .xuan").each(function () {
                if ($(this).hasClass("current")) {
                    $(this).removeClass("current"); 
                } else {
                    $(this).addClass("current");
                } 
            });
            GetCount();
        }else{
            $(this).addClass('current');

             $(".g-Cart-list .xuan").each(function () {
                $(this).addClass("current");
                // $(this).next().css({ "background-color": "#3366cc", "color": "#ffffff" });
            });
            GetCount();
        }
        
        
    });
    
    // 单选
    $(".g-Cart-list .xuan").click(function () {
        if($(this).hasClass('current')){
            

            $(this).removeClass('current');

        }else{
            $(this).addClass('current');
        }
        if($('.g-Cart-list .xuan.current').length==$('#cartBody li').length){
                $('.quanxuan').addClass('current');

            }else{
                $('.quanxuan').removeClass('current');
            }
        // $("#total2").html() = GetCount($(this));
        GetCount();
        //alert(conts);
    });
  // 已选中的总额
    function GetCount() {
        var conts = 0;
        var aa = 0; 
        $(".g-Cart-list .xuan").each(function () {
            if ($(this).hasClass("current")) {
                for (var i = 0; i < $(this).length; i++) {
                    conts += parseInt($(this).parents('li').find('input.text_box').val());
                    // aa += 1;
                }
            }
        });
        
         $(".total").html('<span>￥</span>'+(conts).toFixed(2));
    }
    GetCount();
</script>
</body>
</html>
<script>
    layui.use(['layer'],function(){
    var layer=layui.layer;
        $(function(){
            $('.z-del').click(function(){
                var data = {};
                var cart_id =  $(this).attr('cart_id');
                var _token =  $('#_token').val();
                data._token=_token;
                data.cart_id=cart_id;
                
                $.ajax({
                    url:'catedel',
                    data:data,
                    type:'post',
                    success:function(msg){
                    console.log(msg);
                       if(msg.static==1){
                            layer.msg(msg.msg);
                            parent.location.href="shopcart";
                        }else{
                            layer.msg(msg.msg);
                        }
                    }
                });
            });
            //改变
            $('.text_box').change(function(){
                var data={};
                var j=$(this).val();
                var id=$(this).attr('goods_id');
                var _token =  $('#_token').val();
                data._token=_token;
                data.id=id;
                data.j=j;
                $.ajax({
                    url:'j',
                    data:data,
                    type:'post',
                    success:function(msg){
                        if(msg==2){
                            layer.msg('库存不足');
                            location.href="/shopcart";
                        }
                    }
                })
            })
            //结算 settle
            $('.settle').click(function(){
                var id = [];
                $(".g-Cart-list .xuan").each(function () {
                    if ($(this).hasClass("current")) {
                        for (var i = 0; i < $(this).length; i++) {
                            id.push($(this).attr('cart_id'));
                        }
                    }
                 });
                var data={};
                var _token =  $('#_token').val();
                data._token=_token;
                data.id=id;
                $.ajax({
                    url:'settle',
                    type:'post',
                    data:data,
                    success:function(msg){
                        console.log(msg);
                        if(msg.status==1){
                            layer.msg(msg.msg);
                            location.href="#";
                        }else{
                            layer.confirm(msg.msg, {
                                btn: ['不了','添加设置收获地址'] //按钮
                                }, function(){
                                layer.href="#";
                                }, function(){
                                location.href="writeaddr";
                            });
                        }
                    }
                })
            })
            //全删
            $('.del').click(function(){
                var id = [];
                $(".g-Cart-list .xuan").each(function () {
                    if ($(this).hasClass("current")) {
                        for (var i = 0; i < $(this).length; i++) {
                            id.push($(this).attr('cart_id'));
                            console.log(id);
                        }
                    }
                 });
                var data={};
                var cart_id =  $(this).attr('cart_id');
                var _token =  $('#_token').val();
                data._token=_token;
                data.id=id;
                $.ajax({
                    url:'cartdelete',
                    type:'post',
                    data:data,
                    success:function(msg){
                        if(msg.status==0){
                            layer.msg(msg.msg);
                            location.href="/shopcart";
                        }else{
                            layer.msg(msg.msg);
                            location.href="/shopcart";
                        }
                    }
                })
            })

            //减
            $('.num-mius').click(function(){
                var data={};
                var j=$(this).next().val();
                var id=$(this).attr('goods_id');
                var _token =  $('#_token').val();
                data._token=_token;
                data.id=id;
                data.j=j;
                $.ajax({
                    url:'j',
                    data:data,
                    type:'post',
                    success:function(msg){
                        if(msg.msg==2){
                            location.href="/shopcart";
                        }
                    }
                })
            })
            //退出
            $('#t').click(function(){
                var data={};
                data.t='t';
                var _token =  $('#_token').val();
                data._token=_token;
                $.ajax({
                    url:'t',
                    data:data,
                    type:'post',
                    success:function(msg){
                        if(msg.status==1){
                            layer.msg(msg.msg);
                            location.href="/index";
                        }else{
                            layer.msg(msg.msg);
                        }
                    }
                })
            })
            //加
            $('.num-add').click(function(){
                var data={};
                var j=$(this).prev().val();
                var id=$(this).attr('goods_id');
                var _token =  $('#_token').val();
                data._token=_token;
                console.log(j);
                console.log(id);
                data.id=id;
                data.j=j;
                $.ajax({
                    url:'j',
                    data:data,
                    type:'post',
                    success:function(msg){
                        if(msg==2){
                            layer.msg('库存不足');
                            location.href="/shopcart";
                        }
                    }
                })
            })
        });
    })
</script>