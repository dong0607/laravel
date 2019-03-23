<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\extend\send\Send;
use Illuminate\Support\Facades\DB;
class IndexController extends Controller
{
	protected static $arrCate;

  public function writeadd(Request $request){
    $user_id=session('user_id');
    $consignee_name=$request->input('consignee_name');
    $consignee_tel=$request->input('consignee_tel');
    $province=$request->input('province');
    $status=$request->input('status');
    $ctime=time();
  }

  /**
   * 收获地址展示 get
   */
  public function WriteAddr(){
    return view('writeaddr');
  }
  /**
   * 支付
   * @param Request $request [description]
   */
  public function Settle(Request $request){
    $cart_id=$request->input('id');
    $user_id=session('user_id');
    if(empty($user_id)){
      $arr=array('status'=>2,'msg'=>'请先登录');
      return $arr;
    }
    $order_address=DB::table('order_address')->where('user_id',$user_id)->where('status',1)->get();
    if(empty($order_address)){
      $arr=array('status'=>1,'msg'=>'支付，该状态，订单表添加');
      return $arr;
    }else{
      $arr=array('status'=>2,'msg'=>'您还没有默认的收货地址,请添加收货地址');
      return $arr;
    }
  }

  /**
   * get 传参数 主页点击商品图片跳到详情页面
   */
  public function shopcontent(Request $request){
      $goods_id = empty($_GET['goods_id'])?'':$_GET['goods_id'];
      if(!empty($goods_id)){
        $info = DB::table('shop_goods')->where('goods_id',$goods_id)->get()->toArray();
        $goods_imgs=rtrim($info[0]->goods_imgs,'|');
        $imgs=explode("|",$goods_imgs);
        // print_r($imgs);die;
        return view('shopcontent',['arr'=>$info,'imgs'=>$imgs]);
      }else{
        return view('index');
      }
  }
  //退出
  public function t(Request $request){
    $user=session("username");
    if(empty($user)){
          $arr = array('status' => 4, 'msg' => '清先登录');
           return $arr;
        }else{
      if(!empty($user)){
        $user=session_unset();
        if(empty($user)){
          $arr=array('status'=>1,'msg'=>'退出成功');
          return $arr;
        }else{
          $arr=array('status'=>0,'msg'=>'退出失败');
          return $arr;
        }
      }else{
        $arr=array('status'=>0,'msg'=>'退出失败');
        return $arr;
      }
    }
  }
  //短信发送验证
  public function TelCode(Request $request){
        $obj = new send();
        $arr=$request->input();
        $tel=$arr['userMobile'];
        if(empty($tel)){
          $error=array(
            'status'=>0,
            'msg'=>'手机号不可为空',
          );
          return $error;
        }
        $num = rand(1000,9999);
        $time=time()+60;
        $data['tel']=$tel;
          $data['time']=$time;
          $data['code']=$num;
          $codedata = DB::table('enroll')->where(['tel'=>$data['tel'],'status'=>1])->first();
          if(!empty($codedata)){
            $error=array(
            'status'=>0,
            'msg'=>'此号已注册',
          );
          return $error;
          }
          // $obj->show($data['tel'],$data['code'])
          if(100!=100){
            $error=array(
            'status'=>0,
            'msg'=>'系统错误',
          );
          return $error;
          }
          $telcode = DB::table('enroll')->insert($data);
          if($telcode){
            $error=array(
            'status'=>1,
            'msg'=>'短信发送成功',
          );
          return $error;
          }else{
            $error=array(
            'status'=>0,
            'msg'=>'短信发送失败',
          );
          return $error;
          }
  }
  //注册入库
  public function RegisterAdd(Request $request){
      $arr = $request->input();
      $code=$arr['code'];
      if(empty($code)){
        $error=array(
          'status'=>0,
          'msg'=>'验证码不可为空'
        );
        return $error;
      }
      // print_r($arr);die;
      $codedata = DB::table('enroll')->where(['tel'=>$arr['userMobile']])->where(['code'=>$arr['code']])->first();

      if($codedata){
        if($codedata->status==0){
        if(60<=time()-$codedata->time){
          $error=array(
              'status'=>0,
              'msg'=>'验证码不可用'
            );
            return $error;
        }else{
          if(empty($arr['pwd'])){
              $error = array(
                'status'=>0,
                'msg'=>"密码不可为空"
              );
              return $error;
            }

            if(empty($arr['conpwd'])){
              $error=array(
                'status'=>0,
                'msg'=>"确认密码不可为空"
              );
              return $error;
            }

            if($arr['pwd']!=$arr['conpwd']){
              $error=array(
                'status'=>0,
                'msg'=>"密码和确认密码不一致"
              );
              return $error;
            }

            $where=['user_tel'=>$arr['userMobile']];
            $user_tel = DB::table('user')->where($where)->first();
            if($user_tel){
            $error=array(
              'status'=>0,
              'msg'=>"手机号已注册"
            );
            return $error;
            }
            
            $user_tel = $arr['userMobile'];
            $pwd = $arr['pwd'];
            $user_pwd = md5($pwd);
            $insert=['user_tel'=>$user_tel,'user_pwd'=>$user_pwd];
            $info = DB::table('user')->insert($insert);
            if($info){
              DB::table('enroll')->where(['id'=>$codedata->id])->update(['status'=>1]);
              $win=array(
                'status'=>1,
                'msg'=>"注册成功"
              );
              return $win;
            }
        } 
      }else{
        $error=array(
            'status'=>0,
            'msg'=>'手机号或验证码错误'
          );
          return $error;
      }
      }else{
        $error=array(
          'status'=>0,
          'msg'=>'手机号或验证码错误'
        );
        return $error;
      }
  }

	//注册展示
	public function Register(){
		return view('Register');
	}
	//注册验证码
	public function Regauth(){
		return view('regauth');
	}

  /*
     * @content 发送手机验证码
     * @params  $mobile  要发送的手机号
     * 
     * */
    private function sendMobile($mobile)
    {
        $host = env("MOBILE_HOST");
        $path = env("MOBILE_PATH");
        $method = "POST";
        $appcode = env("MOBILE_APPCODE");
        $headers = array();
        $code = Common::createcode(4);
        session(['mobilecode'=>$code]);
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：".$code."，3分钟内有效！&mobile=".$mobile;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);
    }

	/**
	 * 登录
	 * get
	 */
	public function Login(){
		return view('login');
	}
  /**
   * post 登录
   * @param Request $request [description]
   */
  public function Loginadd(Request $request){
    $user_tel=$request->input('user_tel');
    $user_pwd=$request->input('user_pwd');
    $pwd=md5($user_pwd);
    $code=$request->input('code');
    $verifycode=session('verifycode');
    if($code!=$verifycode){
      $arr=array('static'=>2,'msg'=>'验证码错误');
      return $arr;
    }else
   $info = DB::table('user')->where('user_tel',$user_tel)->where('user_pwd',$pwd)->get();
   if($info){
    $user_id=DB::table('user')->where('user_id',$info[0]->user_id)->get();
      session(['username'=>$user_tel,'user_id'=>$user_id[0]->user_id]);
      $arr=array('static'=>1,'msg'=>'登录成功');
      return $arr;
   }else{
      $arr=array('static'=>2,'msg'=>'登录失败');
      return $arr;
   }
  }

    /**
     * 微信商城首页展示
     * Index
     */
    public function Index(){
    	$goods_arr=DB::table('shop_goods')->select('goods_id','goods_name','goods_img','self_price')->get()->toArray();
      $category = DB::table('shop_category')->where('pid',0)->get();
    	$arr=DB::table('shop_goods')->select('goods_id','goods_name','goods_img','self_price')->paginate(2);
    	return view('index',['goods_arr'=>$goods_arr,'arr'=>$arr,'category'=>$category]);
    }


    /**
     * 商品分类
     * get 
     */
    public function Allshops(){
      $cate_id=empty($_GET['cate_id'])?'':$_GET['cate_id'];
      $category = DB::table('shop_category')->where('pid',0)->get();
      // print_r($cate_id);die;
      if(empty($cate_id)){
        $goods=DB::table('shop_goods')->get();
      }else{
        $this->get($cate_id);
        $arr=array_filter(self::$arrCate);
        $goods=DB::table('shop_goods')->whereIn('cate_id',$arr)->get();
      }
    	return view('allshops',['category'=>$category,'goods'=>$goods]);
    }
    /**
     * 分类查询
     */
    public function Category(Request $request){
    	$cate_id=$request->input('cate_id');
    	if($cate_id==0){
    		$goods=DB::table('shop_goods')->get();
    	}else{
    		$this->get($cate_id);
	    	$arr=array_filter(self::$arrCate);
	    	$goods=DB::table('shop_goods')->whereIn('cate_id',$arr)->get();
    	}
    	return view('li',['goods'=>$goods]);
    }

    /**
     * 购物车展示
     * get
     */
   	public function Shopcart(){
      $user_id=session('user_id');
      if(empty($user_id)){
        return redirect('index');
      }else{
        $cart = DB::table('shop_cart')
            ->leftJoin('shop_goods', 'shop_cart.goods_id', '=', 'shop_goods.goods_id')
            ->where('shop_cart.status',1)
            ->where('shop_cart.user_id',$user_id)
            ->get();
        $goods = DB::table('shop_goods')->take(4)->get();
        return view('shopcart',['cart'=>$cart,'goods'=>$goods]);
      }
   	}
    /**
     * 购物车添加
     * @param Request $request [description]
     */
    public function Cateadd(Request $request){
      $goods_id=$request->input('goods_id');
      if(empty($goods_id)){
        $arr=array(
          'status'=>0,
          'msg'=>'请选择商品',
        );
        return $arr;
      }
      $user_id=session('user_id');
      if(empty($user_id)){
             $arr = array('status' => 4, 'msg' => '清先登录');
             return $arr;
          }
      $arr=DB::table('shop_goods')->where(['goods_id'=>$goods_id])->get();
      if(empty($arr)){
        $arr=array(
          'status'=>0,
          'msg'=>'商品已下架',
        );
        return $arr;
      }
      $user = session('username');
      $user_id = DB::table('user')->where(['user_tel'=>$user])->select('user_id')->get();
      $data=[
        'goods_id'=>$arr['0']->goods_id,
        'user_id'=>$user_id[0]->user_id,
        'goods_id'=>$arr['0']->goods_id,
        'num'=>$arr['0']->goods_num,
        'self_price'=>$arr['0']->self_price,
        'time'=>time(),
      ];
      $data_arr=DB::table('shop_cart')->where(['goods_id'=>$data['goods_id']])->where(['user_id'=>$user_id[0]->user_id])->get();
      if(empty($data_arr[0]->goods_id)||$data_arr[0]->status!=1){
        $arr_cart=DB::table('shop_cart')->insert($data);
        
      }else{
        $int=$data_arr[0]->num+1;
        $arr_cart=DB::table('shop_cart')->where(['goods_id'=>$data['goods_id']])->update(['num'=>$int]);
      }
      if($arr_cart){
        $arr=array(
          'status'=>1,
          'msg'=>'加入购物车成功',
        );
        return $arr;
      }else{
        $arr=array(
          'status'=>0,
          'msg'=>'商品已下架',
        );
        return $arr;
      }
    }
    //库存修改
    public function j(Request $request){
      $val=$request->input();
      $int=$val['j'];
      $id=$val['id'];
      $where=['goods_id'=>$id];
      $arr = DB::table('shop_goods')->select('goods_num')->where($where)->get();
      $goods_num=$arr[0]->goods_num;
      $intval=intval($int);
      if($intval>$goods_num){
        $intval=$goods_num;
      }
      if($intval<=0){
        $intval=1;
      }
      $update=['num'=>$intval];
      $info = DB::table('shop_cart')->where($where)->update($update);
      if($info){
        return 1;
      }else{
        return 2;
      }
    }

    //购物车删除
    //多删
    public function cartdelete(Request $request){
      $array=$request->input('id');
      if(empty(session('username'))){
        $arr = array('status' => 4, 'msg' => '清先登录');
             return $arr;
      }else{
        foreach($array as $k=>$v) {
          // print_r($v);
          $update=DB::table('shop_cart')->where(['cart_id'=>$v])->update(['status'=>2]);
        }
        if($update){
          $arr=array(
            'status'=>1,
            'msg'=>'删除成功'
          );
          return $arr;
        }else{
          $arr=array(
            'status'=>0,
            'msg'=>'删除失败'
          );
          return $arr;
        }
      }
      
    }
    /**
     * 单删
     * @param Request $request [description]
     */
    public function Catedel(Request $request){
      $cart_id=$request->input('cart_id');
      $info = DB::table('shop_cart')->where('cart_id',$cart_id)->update(['status'=>2]);
      if($info){
        $arr=array('static'=>1,'msg'=>'删除成功');
        return $arr;
      }else{
        $arr=array('static'=>0,'msg'=>'删除失败');
        return $arr;
      }
    }
    /**
     * 查询全部商品
     * @param Request $request [description]
     */
    public function Cateseek(Request $request){
      $txtSearch=$request->input('txtSearch');
      $goods = DB::table('shop_goods')->where('goods_name','like',"%$txtSearch%")->get();
      return view('li',['goods'=>$goods]);
    }

    /**
     * 排序 post
     * @param Request $request [description]
     */
    public function Catesort(Request $request){
      $catesort=$request->input('status');
      if($catesort==1){
        $info=DB::table('shop_goods')->orderby('self_price','desc')->get();
      }else{
        $info=DB::table('shop_goods')->orderby('self_price','asc')->get();
      }
      return view('li',['goods'=>$info]);
    }
    /**
     * [Catesort1 description]
     * @param Request $request [description]
     */
    public function Catesort1(Request $request){
      $catesort=$request->input('status');
      if($catesort==1){
        $info=DB::table('shop_goods')->orderby('market_price','desc')->get();
      }else{
        $info=DB::table('shop_goods')->orderby('market_price','asc')->get();
      }
      return view('li',['goods'=>$info]);
    }
    /**
     * 分类查修？
     * @param Request $request [description]
     */
    public function Catesort2(Request $request){
      $catesort=$request->input('status');
      if($catesort==1){
        $info=DB::table('shop_goods')->orderby('goods_num','desc')->get();
      }else{
        $info=DB::table('shop_goods')->orderby('goods_num','asc')->get();
      }
      return view('li',['goods'=>$info]);
    }


 

   	/**
   	 * 我的潮购
   	 */
   	public function Userpage(){
   		return view('userpage');
   	}

   	/**
   	 * 递归
   	 * @param  [type] $id [description]
   	 * @return [type]     [description]
   	 */
    private function get($id){
    	$cate=DB::table('shop_category')->select('cate_id')->where('pid',$id)->get();
    	if(count($cate)!=0){
    		foreach($cate as $k=>$v){
	    		$cate_id=$v->cate_id;
	    		$id=$this->get($cate_id);
	    		self::$arrCate[]=$id;
    		}
    	}
    	if(count($cate)==0){
    		return $id;
    	}
    }


}


































































































	