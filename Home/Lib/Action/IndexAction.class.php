<?php
class IndexAction extends Action {
    public function index(){
    		$model = new Model();
			$sql = "select * from t_product pr left join t_picture pic on pr.id = pic.product_id  limit 0 , 10";
			$product = $model->query($sql);
			$this->assign("new_product" , $product);
			$this->display('index');
    }
}

?>