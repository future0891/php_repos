<?php
class IndexAction extends  CommonAction {
    public function index(){
    		$this->pageContent();
			$model = new Model();
			$disSql = "select pro.id ,c.name , p.path , d.pre_price ,d.after_price from t_discout d left join t_channel c on c.id = d.channel_id left join 
							t_picture p on c.id = p.channel_id left join t_product pro on p.channel_id = pro.cid  where  pro.cover = p.id";
			$this->discout = $model->query($disSql);				
			$this->display();
    }
	

}

?>