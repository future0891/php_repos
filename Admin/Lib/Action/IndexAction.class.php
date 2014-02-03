<?php
class IndexAction extends AuthAction {
    public function index(){
    	$this->display();
    }
	public function welcom() {
		$this->display();
	}
	
	public function testTree() {
		$this->display();
	}
}