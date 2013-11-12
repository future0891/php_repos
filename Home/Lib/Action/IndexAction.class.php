<?php
class IndexAction extends Action {
    public function index(){
    		$model = new Model();
			$sql = "select c.name , pr.cover ,pr.price , pic.path,c.id
						 from t_channel c LEFT JOIN t_product pr on c.id = pr.cid LEFT JOIN t_picture pic
						on pic.channel_id = c.id where pic.id=pr.cover";
			$product = $model->query($sql);
			$this->assign("new_product" , $product);
			$sql = "select id,pid,name from t_channel where pid=%d";
			$category = $model->query($sql , 0);
			$this->assign("category" , $category);						
			$this->display();
    }
}

?>