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
		
		/**
		 * 添加商品处理
		 */
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
			$db = M("Channel");
			$data = $db->select();
			$this->assign('channel' , json_encode($data));
						
			$product = array();
			$db_pro = M("Product");
			$db_pic = M("Picture");
			$pro = $db_pro->where('id='.$pid)->find();
			$pic = $db_pic->where('product_id='.$pid)->select();
			
			$product=$pro;
			$product['pic'] = $pic;
			
			$this->assign('product' ,$product);
			$this->display();
		}
		
		/**
		 * 删除商品以及图片
		 */
		public function delete($pid = 0) {
			$pro_db = M("Product");
			$pic_db = M("Picture");
			$pic = $pic_db->where('product_id='.$pid)->field('path')->select();
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
		
		/**
		 * 删除已经存在的图片
		 */
		public function delExistPic($pid = 0) {
			$db = M("Picture");
			$pic = $db->where("id=".$pid)->find();
			if(file_exists("./Public/Upload/".$pic['path'])) {
				unlink("./Public/Upload/".$pic['path']);
				if (file_exists("./Public/Upload/Thumb/s_".$pic['path'])) {
					unlink("./Public/Upload/Thumb/s_".$pic['path']);
				}
			
			}
			$db->where('id='.$pid)->delete();
			$this->redirect("update" , array("pid"=>$pic['product_id']));
		}
		/**
		 * 按品种显示
		 */
		public function showByChannel($cid = 0) {
			$db_pro = M("Product");
			$db = M("Channel");
			$tree = $db->select();	
			$product = array();
			if (0==$cid) {
				$product = $db_pro->select();
			} else {
				$product = $db_pro->where('cid ='.$cid)->select();
			}
				
			$data = $db->select();
			$pids = $db->getField("pid" , true);
			if (in_array($cid, $haystack)) {
				
			}
			foreach ($data as $k => $p) {
				if( in_array($p['id'], $pids) ) {
					$temp[$k] =array_merge( $data[$k] , array("url"=>"__URL__/showByChannel/pid/".$p['id'] , "target"=>"_self" ));
				} else {
					$temp[$k] =$data[$k];
				}
			}
			$this->assign('channel' , json_encode($temp));
			$this->assign("product" , $product);
			$this->display();
		}
		
		public function showSortProduct(){
			$db_pro = M("Product");
			$db = M("Channel");
			$tree = $db->select();	
			$product = array();
			if (0==$cid) {
				$product = $db_pro->select();
			} else {
				$product = $db_pro->where('cid ='.$cid)->select();
			}
			$this->assign("product" , $product);
			$this->display();
		}
		
		/**
		 * 处理更新
		 */
		public function updateProcess() {
			$db_pro = M("Product");
			$db_pic = M("Picture");
			
			$product = $_POST;
			$db_pro->where('id='.$product['id'])->save($product);
			foreach ($product['path'] as $p) {
				$data['path'] = $p;
				$data['product_id'] = $product['id'];
				$db_pic->add($data);
			}
			
		}
		
		
		public function productSort() {
			$sort = $_POST['sort'];
			$db = M("Product");
			foreach ($sort as $k => $p) {
				$db->where("id=".$p)->setField("sort", ++$k);
			}
			echo "排序成功";
		}
		
		
		
	}
?>