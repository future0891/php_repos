<?php
	class PublicAction extends Action {
		function header() {
			$this->display();
		}
		
		function leftColumn() {
			$model = new Model();
			$sql = "select id,pid,name from t_channel where pid=%d";
			$category = $model->query($sql , 0);
			$this->assign("category" , $category);			
			$this->display();
		}
		
		function rightColumn() {
			$this->display();
		}		
		
		function footer() {
			$this->display();
		}
	}
?>