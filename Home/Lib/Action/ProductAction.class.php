<?php
	class ProductAction extends CommonAction {
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
				$sql = "select c.name ,c.id ,pr.description ,pr.price , pr.cover 
							 from t_channel c LEFT JOIN t_product pr on c.id = pr.cid where c.id=".$pid;
				$product = $model->query($sql);
				$pic_sql = "select path  from t_picture  where channel_id = ".$product[0]['id'];
				$picture = $model->query($pic_sql);
				$cover = $model->query("select path from t_picture where id=".$product[0]['cover']);
				$attr_sql= "select size from t_product_attribute where channel_id= ".$pid;
				$attr = $model->query($attr_sql);
				$this->assign("product" , $product[0]);
				$this->assign('picture' , $picture);
				$this->assign('size' , $attr);
				$this->assign('cover' , $cover[0]['path']);
				$this->pageContent();
				$this->display();
			}
		}
	}
?>