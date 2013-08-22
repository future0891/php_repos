<?php
	class ProductAction extends Action {
		public function show() {
			
		}
		
		public function add() {
			$db = M("Channel");
			$data = $db->select();
			$this->assign('channel' , json_encode($data));
			$this->display();
		}
		
		public function update($pid = 0) {
			
		}
		
		public function delete($pid = 0) {
			
		}
	}
?>