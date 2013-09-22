<?php
	class ProductAction extends Action {
		function showProduct($id = 0) {
			if($id !=0) {
				$pro = M("Product");
				$pic = M("Picture");
				$attr = M("Product_attribute");
				
				$product = $pro->where("id=".$id)->find();
				$pic = $pic->where("product_id=".$id)->select();
				$this->assign("pic" , $pic);
				$this->assign("product" , $product);
			}
			$this->display("info");
		}
		
		function info($pid=0) {
			if(0!=$pid) {
				$model = new Model();
				$sql = "select * from t_product where id=".$pid;
				$product = $model->query($sql);
				$sql = "select * from t_picture where product_id=".$pid;
				$picture = $model->query($sql);
				$this->assign("picture" , $picture);
				$this->assign("product" , $product);
				dump($picture);
			}
		}
	}
?>