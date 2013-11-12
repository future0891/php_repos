<?php
	class ChannelAction extends AuthAction {

		public function showChannel() {
			$db = M("Channel");
			$data = $db->order('order ')->select();
			$pid = $this->_param('pid');
			if($pid == null) $pid = 0;
			$this->assign('pid' , $pid);
			$this->assign('page' , $this->_param('page'));
			$this->assign('channel' , $this->genTree());
			$this->display();
			
		}
		/**
		 * 生成品种树
		 */
		public function channelInfo() {
			$db = M("Channel");
			$data = $db->select();
			foreach($data as $k => $v) {
				if($v['pid'] ==0) {
					if(empty($db->where('pid=' .$v['id'])->count()) ) {
						$data[$k]["iconSkin"] = "emptyChannel";
						$data[$k]["noadd"] = "true";
					}
				}
			}
			echo json_encode($data); 
		}		
	
		public function add() {
			$this->assign('channel' , $this->genTree());
			$this->display();
		}
		
		private function genTree() {
			$db = M('Channel');
			$channel = $db->select();
			foreach ($channel as $key => $value) {
				if($value['pid'] ==0) {
					$channel[$key]['isParent'] ='true';
				}
			}
			return json_encode($channel);
		}
		public function addProcess() {
			$db = M("Channel");
			if($db->create()) {
				$db->add();
			}
			$this->redirect('showChannel' ,array('page'=>$_POST['pid']));
		}
		
		public function showInfo($pid=0) {
			$db = M("Channel");
			$data = $db->where("pid=".$pid)->select();
			$this->assign('data' , $data);
			$this->display();
		}
		
		public function update($id=0) {
			if(0!=$id) {
				$db = M("Channel");
				$data =$db->where("id=".$id)->find();
				$this->assign('channel' , $this->genTree());
				$this->assign('data' , $data);
				$this->assign('pname' , $db->where('id='.$data['pid'])->getField('name'));
			}
			$this->display();
		}
		
		public function updateProcess($id=0) {
			if(0!=$id) {
				$db = M("Channel");
				if($db->create()) {
					$db->where("id=".$id)->save($_POST);
				}
			$pid = $db->where("id=".$id)->getField('pid');
			}
			$this->redirect('showChannel' , array('page' => $pid) );
		}
		
		public function delete() {
			$id = $this->_param("id");
			if(0 !=$id) {
				$db = M("Channel");
				$pid = $db->where('id='.$id)->getField('pid');
				$db->where('id='.$id)->delete();
			}
			if($pid ==null) {
				$pid = 0;
			}
			$this->redirect('showChannel',array("page"=>$pid) );
		}
		
		public function sortChannel($channel =0) {
			$this->display();
		}
		
		public function sortChannelPanel($channel =0) {
			$db = M("Channel");
			$product = $db->where("pid=".$channel)->order("sort")->select();
			$this->assign('product' , $product);
			$this->display();
		}
		
		// 排序ui ajax排序处理 
		public function sortChannelProccess() {
			if(IS_AJAX) {
				$db = M("Channel");
				foreach ($_POST['sort'] as $k => $v) {
					$db->where('id='.$v)->setField("sort" , ++$k);
				}
				echo "排序成功";
			} else {
				echo "排序失败!";
			}
		}

	}

?>