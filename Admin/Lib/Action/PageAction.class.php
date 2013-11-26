<?php
	class PageAction extends AuthAction {
		public function rotator() {
			$this->channel = genTree();
			
			$this->display();
		}
		
		/**
		 * 轮显组件处理
		 */
		public function rotatorHandle() {
			$data = array();
			$data['path'] = $_POST['path'];
			$data['sort'] = $_POST['sort'];
			$data['label'] = $_POST['label'];
			$data['description'] = $_POST['description'];
			$data['product_id'] = $_POST['product_id'];
			M("Rotator")->add($data);
			$this->success("图片上传成功");			
		}
	}
?>