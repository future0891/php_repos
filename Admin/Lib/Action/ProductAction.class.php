<?php
	class ProductAction extends Action {
		public function index() {
			echo "1";
		}
		public function show() {
			
		}
		
		public function add() {
			$db = M("Channel");
			$data = $db->select();
			$this->assign('channel' , json_encode($data));
			$this->display();
		}
		
		/**
		 * 处理添加商品
		 */
		public function addProcess() {
			import("ORG.Net.UploadFile");
			$upload = new UploadFile();
			$upload->savePath = "./Public/Upload/";
			$upload->saveRule = time();
			if($upload->upload()) {
				echo "1";
			} else {
				echo "0";
			}
			
		}
		public function update($pid = 0) {
			
		}
		
		public function delete($pid = 0) {
			
		}
	}
?>