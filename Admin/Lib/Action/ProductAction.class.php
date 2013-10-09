<?php
	class ProductAction extends Action {
		
		public function showList() {
			$db = M('Product');
			
			import("ORG.Util.Page");
			$count = $db->count();
			$Page = new Page($count , 22);
			$prodcut = $db->query("select pr.* , ch.name cname from t_product pr LEFT JOIN t_channel ch on pr.cid = ch.id limit ".$Page->firstRow." ," . $Page->listRows);
			$show = $Page->show();
			$this->assign('product' , $prodcut);
			$this->assign('pager' , $show);
			$this->display();
		}
		/**
		 * 按品种查看商品,选择操作
		 */
		public function showListByChannel($cid = 0) {
			$db = M("Channel");
			$db_pro = M("Product");
			$channel = $db->select();
			
			$this->assign("channel" , json_encode($channel));
			$this->display();
			
		}
		
		/**
		 * 显示可操作的商品列表
		 */
		public function showOptList($pid = 0) {
			import("ORG.Util.Page");
			$model = new Model();
			$ct= $model->query("select count(*)  as ct from t_product_attribute where product_id=".$pid);
			$count = $ct[0]["ct"];
			$page = new Page($count , 15);
			// $product = $db->where("product_id = ".$pid)->limit($page->firstRow.','.$page->listRows)->select();
			$sql = "select pa.* , pro.name from t_product_attribute pa left join t_product pro on pa.product_id = pro.id where pa.product_id = ".$pid." limit ".$page->firstRow.','.$page->listRows;
			$product = $model->query($sql);			
			$this->assign("data" , $product);
			 $this->display();			
		}
		
		/**
		 * 添加商品
		 */
		public function add($pid = 0) {
			$db = M("Channel");
			$pro = $db->where("id=".$pid)->find();
			$product_db = M("Product");
			$product = $product_db->where('cid='.$pid)->find();
			if ($pid!=0 && !empty($product) ) {
				$pic_db = M('Picture');
				$picture = $pic_db->where('channel_id='.$pid)->select();
				$this->assign('picture' , $picture);
				$this->assign('name' , $pro['name']);
				$this->assign('product' , $product);				
				$this->display('updatePanel');
			} else {
				$this->assign('name' , $pro['name']);
				$this->assign('cid' , $pro['id']);
				$this->assign('pid',$pro['pid']);
				$this->display();				
			}

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
			$ch_db = M("Channel");
			$product_db->name = $_POST['name'];
			$product_db->cid = $_POST['cid'];
			$product_db->description = $_POST['description'];
			$product_db->price = $_POST['price'];			
			$p_id = $product_db->add();
			foreach ($_POST['path'] as $k=> $p) {
				$pic_db->path = $p;
				$pic_db->product_id = $p_id ;
				$pic_db->recommend = $_POST['recommend'][$k];
				if($_POST['recommend'][$k] == null) $pic_db->recommend = 0;
				$pic_db->channel_id = $_POST['cid'];
				$pic_db->add();
			}
			$this->redirect("addProductPanel" , array("pid"=>$_POST['cid']) );
		}
		
		/**
		 * 更新文件
		 */
		public function update($cid = 0) {
			$db = M("Channel");
			$data = $db->select();
			$this->assign('channel' , json_encode($data));
						
			$product = array();
			$db_pro = M("Product");
			$db_pic = M("Picture");
			$pro = $db_pro->where('id='.$cid)->find();
			$pic = $db_pic->where('product_id='.$cid)->select();
			
			$product=$pro;
			$product['pic'] = $pic;
			
			$this->assign('product' ,$product);
			$this->display();
		}
		
		/**
		 * 更新商品面板
		 */
		public function updatePanel($pid = 0) {
			if($pid !=0) {
				$model = new Model();
				$sql = "select p.*,c.namefrom t_product p left join t_channel c on p.cid = c.id where c.id = ".$pid;
				$product = $model->query($sql);
				$this->assign('product' , $product[0]);
				$this->display();
			} else {
				echo "错误";
			}
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
			$this->redirect('showListByChannel');
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
			if($pid ==0) $pid = $_POST['pid'];
			$pic = $db->where("id=".$pid)->find();
			if(file_exists("./Public/Upload/".$pic['path'])) {
				unlink("./Public/Upload/".$pic['path']);
				if (file_exists("./Public/Upload/Thumb/s_".$pic['path'])) {
					unlink("./Public/Upload/Thumb/s_".$pic['path']);
				}
			
			}
			$db->where('id='.$pid)->delete();
			// $this->redirect("update" , array("pid"=>$pic['product_id']));
			$this->redirect("showListByChannel");
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
				$model = new Model();
				$product = $model->query("select pr.* , pa.inventory from t_product pr left join t_product_attribute pa on pr.id = pa.product_id where pr.cid = ".$cid);
			}
				
			$data = $db->select();
			$pids = $db->getField("pid" , true);

			foreach ($data as $k => $p) {
				if( in_array($p['id'], $pids) ) {
					$temp[$k] =array_merge( $data[$k] , array("url"=>U('showByChannel?pid=').$p['id'] , "target"=>"_self" ));
				} else {
					$temp[$k] =$data[$k];
				}
			}
			$this->assign('channel' , json_encode($temp));
			$this->assign("product" , $product);
			$this->display();
		}
		
		/**
		 * 排序商品列表
		 */
		public function showSortProduct(){
			$db_pro = M("Product");
			$db = M("Channel");
			$tree = $db->select();	
			$product = array();
			if (0==$cid) {
				$product = $db_pro->select();
			} else {
				// $product = $db_pro->where('cid ='.$cid)->select();
				$model = new Model();
				$product = $model->query("select pr.* , pa.inventory from t_product pr left join t_product_attribute pa on pr.id = pa.product_id where pr.cid = ".$cid);
			}
			$this->assign("product" , $product);
			$this->assign("channel" , json_encode($tree) );
			$this->display();
		}

		/**
		 * 商品排序
		 */
		public function productSort() {
			$sort = $_POST['sort'];
			$db = M("Product");
			$attr = M("Product_attribute");
			foreach ($sort as $k => $p) {
				$db->where("id=".$p)->setField("sort", ++$k);
			}
			echo "排序成功";
		}		
		/**
		 * 处理更新
		 */
		public function updateProcess() {
			$db_pro = M("Product");
			$db_pic = M("Picture");
			$db_pro->id = $_POST['id'];
			$db_pro->price = $_POST['price'];
			$db_pro->description = $_POST['description'];
			$db_pro->save();			
			foreach ($_POST['path'] as $p) {
				$data['path'] = $p;
				$data['channel_id'] = $_POST['cid'];
				$db_pic->add($data);
			}
			dump($_POST);
			$this->redirect("addProductPanel" , array("pid"=>$_POST['cid']) );

		}
		
		/**
		 * 添加商品库存尺码
		 */
		public function addAttPanel() {
			$db = M("Channel");
			$tree = $db->select();	
			$this->assign('channel' , json_encode($tree));
			$this->display();
		}
		
		public function addAtt($pid = 0) {
			// $db = M("Product");
			// $product = $db->where('id='.$pid)->find();
			$model = new Model();
			$sql = "select p.* , c.name from t_product p left join t_channel c on p.cid = c.id where c.id=".$pid;
			$product = $model->query($sql);
			$db = M("Product_attribute");
			$attr = $db->where("product_id=".$pid)->select();
			$this->assign('attr' , $attr);
			$this->assign('product' , $product[0]);
			$this->display();
		}
		
		/**
		 * 库存尺码处理
		 */
		public function attrProcess() {
			$attr = M("Product_attribute");
			$attr->size = $_POST['size'];
			$attr->inventory = $_POST['inventory'];
			$attr->product_id = $_POST['product_id'];
			$attr->add();
			$this->redirect('Product/addAttPanel');
		}
		
		/**
		 * 更新库存尺码
		 */
		public function attrUpdate($pid=0) {
			$db = M("Product_attribute");
			if($pid !=0) $attr =$db->where("id=".$pid)->find();
			$this->assign('attr' , $attr);
			$this->display();
		}
		
		public function attrUpdateProcess() {
			$db = D("Product_attribute");
			if($db->create()) {
				$db->save();
			}				
		}
		
		/**
		 * Ajax 删除商品尺码库存
		 */
		public function attr_delete() {
			$db = M("Product_attribute");
			$result = $db->where('id='.$_POST['pid'])->delete();
			echo $result;
		}
		
		/**
		 * 添加商品属性 
		 */
		public function addProductPanel($pid = 0) {
			if($pid!=0) {
				$this->assign('pid' , $pid);
			}
			$this->display();
		}
		
		public function productInfo($pid = 0) {
			$model = new Model();
			$sql = "select p.* ,c.name  from t_product p left join t_channel c on p.cid = c.id where p.cid= ".$pid; 
			$product = $model->query($sql);
			$p_sql = "select path from t_picture  where channel_id = ".$pid;
			$picture = $model->query($p_sql);
			$this->assign('product' , $product[0]);
			$this->assign('picture' , $picture);
			$this->display();
		}
		
	}
?>