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
			$data[$i]['pId'] = 0;
			$data[$i]['name'] = '树节点';
		}
		return json_encode($data);
		
	}
	public function showChannel($id=0) {
		$this->assign('data' , $this->treeChannel());
		$this->display();
	}
}