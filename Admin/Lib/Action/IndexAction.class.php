<?php
class IndexAction extends Action {
    public function index(){
    	$this->display();
    }
	
	
	public function showChannel($id=0) {
		$db = M("Channel");
		$data = $db->select();
		$this->display();
	}
	public function channelInfo() {
		$db = M("Channel");
		$data = $db->select();
		echo json_encode($data);
	}
}