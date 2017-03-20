<?php 
	class M_Saldo extends ICT_Model{
		public function __construct(){
			parent::__construct();
			$this->table = "saldo_distributor";
		}

		public $table;

		//public section
		public function getAllDataSaldo($filter, $sort){
		    $where = $this->generateWhereTable($filter);
		    $result = null;
		    $result = parent::getAllData($this->table, null, $where, $sort);
		    return $result;
		}

		//private section
		private function generateWhereTable($filter){
	      $where = null;
	      if(isset($filter["site"]) && $filter["site"] != ""){
	        $where[] = array("EQUAL","site", $filter["site"]);  
	      }
	      if(isset($filter["sdan8"]) && $filter["sdan8"] != ""){
	        $where[] = array("EQUAL","sdan8", $filter["sdan8"]);  
	      }
	      return $where;
	    }
	}
?>