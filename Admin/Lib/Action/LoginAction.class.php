<?php
	class LoginAction extends Action {
		// 用户登录页面
	    public function login() {
	        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
	            $this->display();
	        }else{
	            $this->redirect('Index/index');
	        }
	    }
		

	    // 用户登出
	    public function logout() {
	        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
	            unset($_SESSION[C('USER_AUTH_KEY')]);
	            unset($_SESSION);
	            session_destroy();
	            $this->success('登出成功！',U("Login/login"));
	        }else {
	            $this->error('已经登出！');
	        }
	    }
	
	    // 登录检测
	    public function checkLogin() {
	        if(empty($_POST['account'])) {
	            $this->error('帐号错误！');
	        }elseif (empty($_POST['password'])){
	            $this->error('密码必须！');
	        }
	        // elseif (empty($_POST['verify'])){
	            // $this->error('验证码必须！');
	        // }
	        //生成认证条件
	        $map            =   array();
	        // 支持使用绑定帐号登录
	        $map['account']	= $_POST['account'];
	        $map["status"]	=	array('gt',0);
	        // if(session('verify') != md5($_POST['verify'])) {
	            // $this->error('验证码错误！');
	        // }
	        import ( 'ORG.Util.RBAC' );
	        $authInfo = RBAC::authenticate($map);
	        //使用用户名、密码和状态的方式进行认证
	        if(false === $authInfo) {
	            $this->error('帐号不存在或已禁用！');
	        }else {
	            if($authInfo['password'] != md5(trim($_POST['password'])) ) {
	                 $this->error('密码错误！');
	             }
	            $_SESSION[C('USER_AUTH_KEY')]	=	$authInfo['id'];
	            $_SESSION['email']	=	$authInfo['email'];
	            $_SESSION['loginUserName']		=	$authInfo['nickname'];
	            $_SESSION['lastLoginTime']		=	$authInfo['last_login_time'];
	            $_SESSION['login_count']	=	$authInfo['login_count'];
	            if($authInfo['account']=='admin') {
	                $_SESSION['administrator']		=	true;
	            }
	            //保存登录信息
	            // $User	=	M('User');
	            // $ip		=	get_client_ip();
	            // $time	=	time();
	            // $data = array();
	            // $data['id']	=	$authInfo['id'];
	            // $data['last_login_time']	=	$time;
	            // $data['login_count']	=	array('exp','login_count+1');
	            // $data['last_login_ip']	=	$ip;
	            // $User->save($data);
	
	            // 缓存访问权限
	            RBAC::saveAccessList();
	             $this->success('登录成功！',U("Index/index"));    
	          }
	    }		
	}
?>