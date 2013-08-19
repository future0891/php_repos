<?php
	class ChannelAction extends Action {
		public function add() {
			$this->display();
		}
		
		public function addProcess() {
			$db = M("Channel");
			if($db->create()) {
				$db->add();
			}
			$this->redirect('add');
		}
		
		public function showInfo($id=0) {
			$db = M("Channel");
			$data = $db->where("pid=".$id)->select();
			$this->assign('data' , $data);
			$this->display();
		}
		
		public function update($id=0) {
			if(0!=$id) {
				$db = M("Channel");
				$data =$db->where("id=".$id)->find();
				$this->assign('data' , $data);
			}
			$this->display();
		}
		
	}

?>