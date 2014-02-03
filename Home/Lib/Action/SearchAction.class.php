<?php
	class SearchAction extends CommonAction {
		//按品种查找商品	
		public function category($cid = 0) {
			if($cid !=0) {
				$this->pageContent();
				$model = new Model();
				$sql = "select id,pid,name from t_channel where pid=%d";
				$this->category = $model->query($sql , 0);
				
				$p_sql = "select c.id, c.name , p.price , pic.path from t_channel c LEFT JOIN t_product p on c.id = p.cid LEFT JOIN t_picture pic
								 on p.cid = pic.channel_id where p.cover = pic.id and c.pid = %d";
				$this->p_list = $model->query($p_sql , $cid);
				$this->display();
			}
		}
		//查找品牌
		public function brand($bid = 0) {
			if ($bid!=0) {
				$model = new Model();
			    $this->pageContent();
				$sql = "select * from t_channel where pid=%d";
				$this->brand = $model->query($sql , $bid);
				$this->display();
			}
		}
		
		//搜索查找
		public function keyword() {
			
		}
		
		//尺码查找
		public function size() {
			
		}
		
		
	}
?>