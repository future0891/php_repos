<?php
	class ArticleAction extends AuthAction {
		public function addPanel() {
			$this->display();
		}
		
		public function addProcess() {
			M("Article")->add($_POST);
		}
	}
?>