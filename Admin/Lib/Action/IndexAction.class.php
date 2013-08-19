<?php
class IndexAction extends Action {
    public function index(){
    	$this->assign('data' ,$this->treeChannel());
    	$this->display();
    }
	
	private function treeChannel() {
		$data = array();
		for($i = 0 ; $i <10 ; $i++) {
			$data[$i]['id'] = $i;
			$data[$i]['pid'] = 0;
			$data[$i]['name'] = '树节点';
		}
		return json_encode($data);
		
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