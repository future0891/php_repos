<?php
	class PublicAction extends Action {
		function header() {
			$this->display();
		}
		
		function leftColumn() {
			$this->display();
		}
		public function error() {
			$this->display();
		}
		public function success() {
			$this->success();
		}
		
		
		public function getImage() {
			$data = array();
			import("ORG.Net.UploadFile");
			
			$upload = new UploadFile();
			$upload->allowExts          = explode(',', 'jpg,gif,png,jpeg');
			// $upload->allowTypes          = array('jpg', 'gif', 'png', 'jpeg');

			$upload->savePath = "./Public/Upload/";
			$upload->thumb = true;
			$upload->thumbPrefix        = 's_,m_';  //生产1张缩略图
			$upload->thumbPath = "./Public/Upload/Thumb/";
	        //设置缩略图最大宽度
	        $upload->thumbMaxWidth      = '100 ,200';
	        //设置缩略图最大高度
	        $upload->thumbMaxHeight     = '100 ,200';
			if($upload->upload()) {
				$info= $upload->getUploadFileInfo();
				$data['path'] = $info[0]['savename']; 
				echo $data["path"];
			} else {
				echo "0";
			}
			
		}
	}
?>