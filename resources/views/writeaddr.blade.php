<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>填写收货地址</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/writeaddr.css">
    <link rel="stylesheet" href="layui/css/layui.css">
    <link rel="stylesheet" href="dist/css/LArea.css">
</head>
<body>
<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token();?>">
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">填写收货地址</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="#" class="m-index-icon">保存</a>
</div>
<div class=""></div>
<!-- <form class="layui-form" action="">
  <input type="checkbox" name="xxx" lay-skin="switch">  
  
</form> -->
<form class="layui-form" action="">
  <div class="addrcon">
    <ul>
      <li><em>收货人</em><input type="text" id="consignee_name" placeholder="请填写真实姓名"></li>
      <li><em>手机号码</em><input type="number" id="consignee_tel" placeholder="请输入手机号"></li>
      <li><em>所在区域</em><input type="text" id="province" placeholder="请选择所在区域"></li>
    </ul>
    <div class="setnormal"><span>设为默认地址</span><input type="checkbox" name="status" lay-skin="switch">  </div>
  </div>
</form>

<!-- SUI mobile -->
<script src="dist/js/LArea.js"></script>
<script src="dist/js/LAreaData1.js"></script>
<script src="dist/js/LAreaData2.js"></script>
<script src="js/jquery-1.11.2.min.js"></script>
<script src="layui/layui.js"></script>

<script>
  //Demo
layui.use('form', function(){
  var form = layui.form();
  //监听提交
  $('.m-index-icon').click(function(){
    var consignee_name = $('#consignee_name').val();
    var consignee_tel = $('#consignee_tel').val();
    var province = $('#province').val();
    var status = $("input[name='status']:checked").val();
    if(status){
      status=1;
    }else{
      status=2;
    }
    if(consignee_name==''){
      layer.msg('亲必填项不可为空哦');
    }else
    if(consignee_tel==''){
      layer.msg('亲必填项不可为空哦');
    }else
    if(province==''){
      layer.msg('亲必填项不可为空哦');
    }
    var data = {};
    var _token =  $('#_token').val();
    data._token=_token;
    data.consignee_name=consignee_name;
    data.consignee_tel=consignee_tel;
    data.province=province;
    data.status=status;
    $.ajax({
        url:'writeadd',
        data:data,
        type:'post',
        success:function(msg){
        console.log(msg);
           // if(msg.static==1){
           //      layer.msg(msg.msg);
           //      parent.location.href="shopcart";
           //  }else{
           //      layer.msg(msg.msg);
           //  }
        }
    });
  });
})
</script>


</body>
</html>
