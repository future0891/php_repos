<?php
	class PublicAction extends Action {
		function header() {
			$this->display();
		}
		
		function leftColumn() {
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