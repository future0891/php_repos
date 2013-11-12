<?php
	class RbacAction extends Action {
		//添加管理角色
		public function addRole() {
			$this->display();
		}
		//处理添加角色
		public function addRoleProccess() {
			if( M("Role")->add($_POST)) {
				$this->success("添加角色成功!");
			}
			
		}
		
		public function nodeManager() {
			$db = M("Node");
			$field = array('id' , 'name' , 'remark' , 'pid'); 
			$node = $db->field($field)->select();
			$node = node_merge($node);
			$this->assign("node" , $node);
			$this->display();
		}
		//添加管理节点
		public function addNode($level = 0 , $pid=0) {
			if($level == 1 ) {
				$name="项目";
				$this->assign("level" , $level );
				$this->assign("pid" , $pid );
				$this->assign("name" , $name );
			} elseif ($level == 2) {
				$name="模块";
				$this->assign("level" , $level );
				$this->assign("pid" , $pid );
				$this->assign('name' , $name );
			} elseif ($level == 3) {
				$name="方法";
				$this->assign("level" , $level );
				$this->assign("pid" , $pid );
				$this->assign('name' , $name);				
			} else {
				$this->error("节点错误");
			}
			$this->display();
		}
		
		//处理添加节点
		public function addNodeProcess() {
			M("Node")->add($_POST);
			$this->success("添加节点成功" , U('Rbac/nodeManager') );
		}
		
		//角色权限控制列表
		public function roleAccess() {
			$roles = M("role")->select();
			$this->roles = $roles;
			$this->display();
		}
		//角色添加权限处理
		public function roleAccessProcess() {
			$db = M("Access");
			$db->where(array("role_id"=>$_POST['rid']))->delete();
			$data[] = array();
			foreach ($_POST['access'] as $v) {
				$temp = explode("_", $v);
				$data['role_id'] = $_POST['rid'];
				$data['node_id'] = $temp[0];
				$data['level'] = $temp[1];
				$db->add($data);
			}
			$this->success("权限添加成功!");
		}
		//添加角色权限
		public function addAccess($rid=0 ,$remark="") {
			if($rid!=0) {
				$db = M("Node");
				$field = array('id' , 'name' , 'remark' , 'pid'); 
				$node = $db->field($field)->select();
				$access = M("Access")->where(array('role_id'=> $rid))->getField('node_id' , true);
				
				$node = node_merge($node , $access);
				$this->assign("node" , $node);
				$this->assign("rid" , $rid);
				$this->assign("remark" , $remark);				
				$this->display();
			}
		}
		
		//添加用户
		public function addUser() {
			$role = M("Role")->where(array('status'=>1))->select();
			$this->assign('role' , $role);
			$this->display();
		}
		
		//处理添加用户
		public function addUserProcess() {
			$user = array(
				"account" => trim($_POST['username']),
				"password" => md5(trim($_POST['password']) ),
				"status" =>1,
				"create_time" => time(),
			);
			$uid = M("User")->add($user);
			
			$ru = array(
				"role_id" =>$_POST['role_id'],
				"user_id" =>$uid,
			);
			M("Role_user")->add($ru);
			
			$this->success("添加用户成功!");
		}
		
		
	}
?>