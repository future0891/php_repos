<?php
	class ChannelAction extends Action {
		public function add() {
			$this->assign('channel' , $this->genTree());
			$this->display();
		}
		
		private function genTree() {
			$db = M('Channel');
			$channel = $db->select();
			return json_encode($channel);
		}
		public function addProcess() {
			$db = M("Channel");
			if($db->create()) {
				$db->add();
			}
			$this->redirect('add');
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
			$this->redirect('Channel/showInfo/' , array('pid' => $pid) );
		}
		public function delete($id = -1) {
			if(-1!=$id) {
				$db = M("Channel");
				$pid = $db->where('id='.$id)->getField('pid');
				$db->where('id='.$id)->delete();
			}
			if($pid ==null) {
				$pid = 0;
			}
			$this->redirect('Channel/showInfo/' , array('pid' => $pid) );
		}
	}

?>