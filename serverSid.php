<?php
//载入ucpass类
require_once('lib/Ucpaas.class.php');

//初始化必填
//填写在开发者控制台首页上的Account Sid
$options['accountsid']='da3f8e03476844bddb3fd45abb24f2d0';
//填写在开发者控制台首页上的Auth Token
$options['token']='23f757bad208226ec301e117e40006ed';

//初始化 $options必填
$ucpass = new Ucpaas($options);