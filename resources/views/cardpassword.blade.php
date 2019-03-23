<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <title>我的潮购</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />

    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/c-password.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="layui/css/layui.css">



</head>
<body>
	<!--触屏版内页头部-->
	<div class="m-block-header" id="div-header">
	    <strong id="m-title">奖品确认</strong>
	    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
	    <a href="/" class="m-index-icon"><i class="m-public-share"></i></a>
	</div>
	<div class="getinfo clearfix">
		<div class="shopimg fl">
			<img src="images/goods1.jpg" alt="">
		</div>
		<div class="shoptitle fl">
			<p>(第<em>1</em>潮购)虚拟商品666</p>
			<p>本期参与：<em class="red">50</em>人次</p>
		</div>
		<div class="geticon fr">
			<img src="images/luck.png" alt="">
		</div>
	</div>
	<div class="line"></div>
	<div class="getmethod">
		<span class="red">恭喜您中奖了，请选择使用方式</span>
		<ul class="getlist">
			<li class="qu">
				<em>提取卡密</em>
				<i class="checked"></i>
			</li>
			<li class="send">
				<em>转赠他人</em>
				<i class=""></i>
			</li>
			<!-- <li class="recharge">
				<em>充值余额</em>
				<i class=""></i>
			</li> -->
			<li class="aggrement clearfix">
				<em class="checked"></em>
				<span>我已阅读并同意《666潮人购购物协议》</span>
			</li>
		</ul>
		<a href="javascript:;" class="next" id="next">下一步</a>
	</div>
	<div class="repart">
		<a href="javascript:;" class="parttip">手气不错，要乘胜追击哟！</a>
		<a href="" class="part">再次参与</a>
	</div>
	
	<!-- 各种弹框 -->
	<div class="qucard" style="display: none">
		<span>您将得到虚拟卡密信息</span>
		<div class="opera-btn clearfix">
			<a href="" class="btn-no">取消</a>
			<a href="" class="btn-yes">确定</a>
		</div>
	</div>
	<div class="sendcard" style="display: none">
		<span>您将转增虚拟卡密信息</span>
		<div class="opera-btn clearfix">
			<a href="" class="btn-no">取消</a>
			<a href="" class="btn-yes">确定</a>
		</div>
	</div>
	<div id="cardinfo" style="display: none">
		<span class="tip">恭喜您中奖啦</span>
		<div class="cardimg">
			<img src="images/goods1.jpg" alt="">
			<span>(第1潮购)虚拟商品66666</span>
		</div>
		<p class="cardtitle clearfix">卡密/兑换码派发：</p>
		<div class="cardopera">
		<span class="cardname">卡密</span><span class="watch">点击查看密码</span>
		<span class="copy">复制</span>
		</div>
	</div>
	<div class="receive" style="display: none">
		<span class="tip">转赠他人</span>
		<div class="cardimg">
			<img src="images/goods1.jpg" alt="">
			<span>(第1潮购)虚拟商品66666</span>
		</div>
		<p class="cardtitle clearfix">我们将以短信方式发送给您输入的手机号</p>
		<div class="send clearfix">
			<input type="number" placeholder="请输入需要转赠的手机号">
			<a href="Javascript:;">发送</a>
		</div>
		
	</div>


   
    
	
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/all.js"></script>
    <script src="layui/layui.js"></script>
    <script>
    $('.getlist li').click(
        function(){
            if($(this).children('i').hasClass('checked')){
               
            }else{
            	$(this).children('i').addClass('checked');
	            $(this).siblings('li').children('i').removeClass('checked')
            }  
        }
    )
    // 
    $('.getlist li.aggrement em').click(function(){
    	if($(this).hasClass('checked')){
                $(this).removeClass('checked');
            }else{
            	$(this).addClass('checked');
            }  
    })
    // 下一步
    $('#next').click(function(){
    	if($('.getlist li.qu').children('i').hasClass('checked')){

			layer.open({
			  // type: 1, 
			  btn:['取消','确定'],
			  title: false,
			  closeBtn: 0, //不显示关闭按钮
			  anim: 2,
			  shadeClose: true, //开启遮罩关闭
			  content: '您将得到虚拟卡密信息',
			  yes: function(index, layero){
			  	layer.close(index);
			  },
			  btn2: function(index, layero){
			  	layer.open({
			  		type: 1,
			  		title: false,
			  		area:['310px','auto'],
			  		content: $('#cardinfo')
			  	})
			  }
			})
    	}else if($('.getlist li.send').children('i').hasClass('checked')){
    			layer.open({
				  btn:['取消','确定'],
				  title: false,
				  closeBtn: 0, //不显示关闭按钮
				  anim: 2,
				  shadeClose: true, //开启遮罩关闭
				  content: '您将转增虚拟卡密信息',
				  yes: function(index, layero){
				  	layer.close(index);
				  },
				  btn2: function(index, layero){
				  	layer.open({
				  		type: 1,
				  		title: false,
				  		content: $('.receive')
				  	})
				  }
				})

    	}
    })

    
    </script>
    
</body>
</html>
