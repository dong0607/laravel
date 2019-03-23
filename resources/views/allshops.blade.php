<!DOCTYPE html>
<html lang="en">
<head>
    <title>商品列表</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="app-id=518966501" name="apple-itunes-app" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link rel="stylesheet" href="css/mui.min_1.css">
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/goods.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="layui/css/layui.css">
    <script src="layui/layui.js"></script> 
    <div class="layui-layer-move"></div>
</head>
<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token();?>">
<body class="g-acc-bg" fnav="0" style="position: static">
<div class="page-group">
    <div id="page-infinite-scroll-bottom" class="page">
    
        <!--触屏版内页头部-->
        <div class="m-block-header" id="div-header" style="display: none">
            <strong id="m-title"></strong>
            <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
            <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
        </div>
      
        <div class="pro-s-box thin-bor-bottom" id="divSearch">
            <div class="box">
                <div class="border">
                    <div class="border-inner"></div>
                </div>
                <div class="input-box">
                    <i class="s-icon" ><input type="hidden" id="hidden" value=""></i>
                    <input type="text"  placeholder="搜索全部商品" id="txtSearch" />
                    <i class="c-icon" id="btnClearInput" style="display: none"></i>
                </div>
            </div>
            <a href="javascript:;" class="s-btn" id="btnSearch">搜索</a>
        </div>

        <!--搜索时显示的模块-->

        <div class="all-list-wrapper">

            <div class="menu-list-wrapper" id="divSortList">
                <ul id="sortListUl" class="list">
                    
                        <li sortid='0' class=''>
                            <a class="cate" cate_id="0">
                            <span class='items'>全部商品</span>
                            </a>
                        </li>
                    
                    @foreach ($category as $k => $v)
                    <li sortid='100' reletype='1' linkaddr=''>
                        <a cate_id="{{$v->cate_id}}"  class="cate">
                            <span  class='items'>
                                {{$v->cate_name}}
                            </span>
                        </a> 
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="good-list-wrapper">
                <div class="good-menu thin-bor-bottom">
                    <ul class="good-menu-list" id="ulOrderBy">
                        <li orderflag="20" status="1" class="20"><a href="javascript:;">人气</a></li>
                        <li orderflag="50" class="50"><a href="javascript:;">最新</a></li>
                        <li orderflag="30" class="30"><a href="javascript:;">价值</a><span class="i-wrap"><i class="up"></i><i class="down"></i></span></li>
                        <!--价值(由高到低30,由低到高31)-->
                    </ul>
                </div>
                
                <div class="good-list-inner">
                    <div id="pullrefresh" class="good-list-box  mui-content mui-scroll-wrapper">
                        <div class="goodList mui-scroll">
                            <ul id="ulGoodsList" class="mui-table-view mui-table-view-chevron">
                                @foreach($goods as $k => $v)
                                <li id="23468">
                                    <span class="gList_l fl">
                                        <img class="lazy" src="uploads/goodsimg/{{$v->goods_img}}">
                                    </span>    
                                    <div class="gList_r">
                                        <h3 class="gray6">{{$v->goods_name}}</h3>        
                                        <em class="gray9">价值：￥{{$v->self_price}}</em>
                                        <div class="gRate">            
                                            <div class="Progress-bar">    
                                                <p class="u-progress">
                                                    <span style="width: {{$v->goods_num/1}}%;" class="pgbar">
                                                        <span class="pging"></span>
                                                    </span>
                                                </p>                
                                                <ul class="Pro-bar-li">
                                                    <li class="P-bar01"><em>7342</em>已参与</li>
                                                    <li class="P-bar02"><em>7988</em>总需人次</li>
                                                    <li class="P-bar03"><em>{{$v->goods_num}}</em>剩余</li>
                                                </ul>            
                                            </div>           
                                            <a codeid="12785750" goods_id="{{$v->goods_id}}" class="cateadd" canbuy="646"><s></s></a>        
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
       
       <!--底部-->
        @extends('base')    
    </div>
</div>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/lazyload.min.js"></script>
<script src="js/mui.min.js"></script>
<script>
   
        jQuery(document).ready(function() {
            $("img.lazy").lazyload({
                placeholder : "images/loading2.gif",
                effect: "fadeIn",
            });
        });
    
</script>
<script>
    // 点击切换类别
    $('#sortListUl li').click(function(){
        $(this).addClass('current').siblings('li').removeClass('current');
    })
</script>
<script>
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
            for (var i = cells.length, len = i + 3; i < len; i++) {
                var li = document.createElement('li');
                var str='';
                // li.className = 'mui-table-view-cell';
                str += '<span class="gList_l fl">';        
                str += '<img class="lazy" data-original="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" src="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" style="display: block;"/>';
                str += '</span>';
                str += '<div class="gList_r">';
                str += '<h3 class="gray6">(第'+i+'云)苹果（Apple）iPhone 7 Plus 256G版 4G手机</h3>';        
                str += '<em class="gray9">价值：￥7988.00</em>';
                str += '<div class="gRate">';           
                str += '<div class="Progress-bar">'    
                str += '<p class="u-progress">';
                str += '<span style="width: 91.91286930395593%;" class="pgbar">';
                str += '<span class="pging"></span>';
                str += '</span>';
                str += '</p>';                
                str += '<ul class="Pro-bar-li">';
                str += '<li class="P-bar01"><em>7342</em>已参与</li>';
                str += '<li class="P-bar02"><em>7988</em>总需人次</li>';
                str += '<li class="P-bar03"><em>646</em>剩余</li>';
                str += '</ul>';            
                str += '</div>';           
                str += '<a codeid="12785750" class="" canbuy="646"><s></s></a>';        
                str += '</div>';    
                str += '</div>';
                //下拉刷新，新纪录插到最前面；
                li.innerHTML = str;
                table.insertBefore(li, table.firstChild);
            }
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
            for (var i = cells.length, len = i + 20; i < len; i++) {
                var li = document.createElement('li');
                // li.className = 'mui-table-view-cell';
                var str='';
                str += '<span class="gList_l fl">';        
                str += '<img class="lazy" data-original="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" src="https://img.1yyg.net/GoodsPic/pic-200-200/20160908104402359.jpg" style="display: block;"/>';
                str += '</span>';
                str += '<div class="gList_r">';
                str += '<h3 class="gray6">(第'+i+'云)苹果（Apple）iPhone 7 Plus 256G版 4G手机</h3>';        
                str += '<em class="gray9">价值：￥7988.00</em>';
                str += '<div class="gRate">';           
                str += '<div class="Progress-bar">'    
                str += '<p class="u-progress">';
                str += '<span style="width: 91.91286930395593%;" class="pgbar">';
                str += '<span class="pging"></span>';
                str += '</span>';
                str += '</p>';                
                str += '<ul class="Pro-bar-li">';
                str += '<li class="P-bar01"><em>7342</em>已参与</li>';
                str += '<li class="P-bar02"><em>7988</em>总需人次</li>';
                str += '<li class="P-bar03"><em>646</em>剩余</li>';
                str += '</ul>';            
                str += '</div>';           
                str += '<a codeid="12785750" class="" canbuy="646"><s></s></a>';        
                str += '</div>';    
                str += '</div>';
                li.innerHTML = str;
                table.appendChild(li);
            }
        }, 1500);
    }
</script>

</body>
</html>
<script>
    $(function(){
        layui.use(['layer'],function(){
        var layer=layui.layer;
        $(document).on('click','.cate',function(){
            var data = {};
            var cate_id =  $(this).attr('cate_id'); 
            $('#hidden').val(cate_id);
            var _token =  $('#_token').val();
            data.cate_id=cate_id;
            data._token=_token;
            $.ajax({
                url:'category',
                data:data,
                type:'post',
                success:function(msg){
                    $('#ulGoodsList').html(msg);
                }
            });
       });

        $('.cateadd').click(function(){
            var data = {};
            var goods_id =  $(this).attr('goods_id');
            var _token =  $('#_token').val();
            data.goods_id=goods_id;
            data._token=_token;
            $.ajax({
                url:'cateadd',
                data:data,
                type:'post',
                success:function(msg){
                    console.log(msg);
                   if(msg.static==1){
                        layer.msg(msg.msg);
                        parent.location.href="/shopcart";
                    }else{
                        layer.msg('请先登录');
                    }
                }
            });
        });

        $(document).on('click','.s-icon',function(){
            var data = {};
            var txtSearch =  $('#txtSearch').val();
            var cart_id =  $('#cate_id').val();
            console.log(cart_id);
            var _token =  $('#_token').val();
            data.txtSearch=txtSearch;
            data._token=_token;
            $.ajax({
                url:'cateseek',
                data:data,
                type:'post',
                success:function(msg){
                    console.log(msg);
                   $('#ulGoodsList').html(msg);
                }
            });
       });
        $(document).on('click','.20',function(){
            var data = {};
           var status = $(this).attr('status');
            if(status==1){
                $(this).attr('status',2);
            }else{
                $(this).attr('status',1);
            }
            console.log(status);
            var _token =  $('#_token').val();
            data._token=_token;
            data.status=status;
            $.ajax({
                url:'catesort',
                data:data,
                type:'post',
                success:function(msg){
                    console.log(msg);
                    $('#ulGoodsList').html(msg);
                }
            });
        });
        $(document).on('click','.30',function(){
            var data = {};
           var status = $(this).attr('status');
            if(status==1){
                $(this).attr('status',2);
            }else{
                $(this).attr('status',1);
            }
            console.log(status);
            var _token =  $('#_token').val();
            data._token=_token;
            data.status=status;
            $.ajax({
                url:'catesort',
                data:data,
                type:'post',
                success:function(msg){
                    console.log(msg);
                    $('#ulGoodsList').html(msg);
                }
            });
        });
        $(document).on('click','.50',function(){
            var data = {};
           var status = $(this).attr('status');
            if(status==1){
                $(this).attr('status',2);
            }else{
                $(this).attr('status',1);
            }
            console.log(status);
            var _token =  $('#_token').val();
            data._token=_token;
            data.status=status;
            $.ajax({
                url:'catesort',
                data:data,
                type:'post',
                success:function(msg){
                    console.log(msg);
                    $('#ulGoodsList').html(msg);
                }
            });
        });
        
        })
    })
</script>
