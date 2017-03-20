<?php
  class M_UserLog extends ICT_Model{
    public function __construct(){
      parent::__construct();
      $this->table = "W55RS05";
      $this->full_table = $this->scheme.".".$this->table;
    }

    private $table;
    private $full_table;

    //PUBLIC SECTION
    public function getAllDataUserLog($filter = null, $sort = null){
      $table = "user_log";
      //===================================================================================================
      $where = $this->generateWhere($filter);
	  //===================================================================================================
      // $join_an8 = "(SELECT  kode AS an8_kode, nama AS an8_nama FROM address_book ) join_an8";
      // $join[] = array("join_table"=> $join_an8, "join_on" => "CAST(an8_kode AS CHAR CHARACTER SET utf8) = an8","join_heading"=>"left" );
      //===================================================================================================
      $limit = 100;
      //===================================================================================================
      // $this->getQuery($table, null, $where, $sort, $join, null, $limit);die();
      $result = parent::getAllData($table, null, $where, $sort, null, null, $limit);

      $real_result = null;
      if($result != null && count($result) > 0){
      	foreach ($result as $value) {
      		$row = $value;
      		$where_ab = null;
      		$where_ab[] = array("EQUAL", "kode", trim($value["an8"]));
      		$ab_data = parent::getAllData("address_book",null, $where_ab);
      		$row["ab"] = null;
      		if($ab_data != null && count($ab_data) > 0){
      			$row["ab"] = $ab_data[0];
      		}
      		$real_result[] = $row;
      	}
      }

      return $real_result;
    }

    public function getDataUserRating($filter = null){
      $table = "user_log";
      //===================================================================================================
      $where = $this->generateWhere($filter);
      //===================================================================================================
      $select = "count(username) as count_login, username";
      $group_by = array("username");
      $sort[] = array("count_login","DESC");
      //===================================================================================================
      $result = parent::getAllData($table, $select, $where, $sort, null, $group_by);

      return $result;
    }

    //PRIVATE SECTION
    private function generateJoinTable(){
      $join = null;

      return $join;
    }

    private function generateWhere($filter){
      $where = null;
      if($filter["username"] != null && $filter["username"] != ""){
        $where[] = array("EQUAL","username", $filter["username"]);
      }

      return $where;
    }
  }
?>
