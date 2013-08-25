<?php
	class ProductAction extends Action {
		public function index() {
			echo "1";
		}
		public function showList() {
			$db = M('Product');
			$prodcut = $db->select();
			$this->assign('product' , $prodcut);
			$this->display();
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
		public function getImage() {
			$data = array();
			import("ORG.Net.UploadFile");
			$upload = new UploadFile();
			$upload->allowExts          = explode(',', 'jpg,gif,png,jpeg');
			// $upload->allowTypes          = array('jpg', 'gif', 'png', 'jpeg');

			$upload->savePath = "./Public/Upload/";
			$upload->thumb = true;
			$upload->thumbPrefix        = 's_';  //生产1张缩略图
			$upload->thumbPath = "./Public/Upload/Thumb/";
	        //设置缩略图最大宽度
	        $upload->thumbMaxWidth      = '100';
	        //设置缩略图最大高度
	        $upload->thumbMaxHeight     = '100';
			if($upload->upload()) {
				$info= $upload->getUploadFileInfo();
				$data['path'] = $info[0]['savename']; 
				echo $data["path"];
			} else {
				echo "0";
			}
			
		}
		public function addProcess() {
			$product_db = M("Product");
			$pic_db = M("Picture");
			$product_db->name = $_POST['name'];
			$product_db->cid = $_POST['cid'];
			$product_db->inventory = $_POST['inventory'];
			$product_db->description = $_POST['description'];
			$product_db->price = $_POST['price'];			
			$p_id = $product_db->add();
			foreach ($_POST['path'] as $p) {
				$pic_db->path = $p;
				$pic_db->product_id = $p_id ;
				$pic_db->add();
			}
			$this->redirect("add");
		}
		
		/**
		 * 更新文件
		 */
		public function update($pid = 0) {
			
		}
		/**
		 * 删除商品以及图片
		 */
		public function delete($pid = 0) {
			$pro_db = M("Product");
			$pic_db = M("Picture");
			$pic = $pic_db->where('product_id='.$pid)->field('path')->select();
			dump($pic);
			foreach ($pic as $p) {
				unlink("./Public/Upload/".$p['path']);
				unlink("./Public/Upload/Thumb/s_".$p['path']);
			}
			$pro_db->where('id='.$pid)->delete();
			$pic_db->where('product_id='.$pid)->delete();
			$this->redirect('showList');
		}
		/**
		 * Ajax 处理删除文件
		 */
		public function delPic() {
			$file = "./Public/Upload/".$_POST['pic'];
			$thumb = "./Public/Upload/Thumb/s_".$_POST['pic'];
			if(file_exists($file)) {
				unlink($file);
				if (file_exists($thumb)) {
					unlink($thumb);
				}
			}
		}
		
		
	}
?>