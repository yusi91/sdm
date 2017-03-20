<?php
  class M_Message extends ICT_Model{
    public function __construct(){
      parent::__construct();
      $this->table = "messages";
    }

    private $table;

    //PUBLIC SECTION
    public function getAllDataMessages($select = null, $filter = null, $group_by = null, $sort = null){
      $where = $this->generateFilter($filter);
      $result = parent::getAllData($this->table, $select, $where, $sort, null, $group_by);
      return $result;
    }

    // private section
    public function generateFilter($filter){
      $where = null;

      if(isset($filter["receiver"]) && $filter["receiver"] != null && $filter["receiver"] != ""){
        $where[] = array("EQUAL", "receiver", $filter["receiver"]);
      }
      if(isset($filter["owner"]) && $filter["owner"] != null && $filter["owner"] != ""){
        $where[] = array("EQUAL", "owner", $filter["owner"]);
      }
      if(isset($filter["readstate"]) && $filter["readstate"] != null && $filter["readstate"] != ""){
        $where[] = array("EQUAL", "readstate", $filter["readstate"]);
      }
      if(isset($filter["livestate"]) && $filter["livestate"] != null && $filter["livestate"] != ""){
        $where[] = array("EQUAL", "livestate", $filter["livestate"]);
      }
      if(isset($filter["livestate"]) && $filter["livestate"] != null && $filter["livestate"] != ""){
        $where[] = array("EQUAL", "livestate", $filter["livestate"]);
      }
      if(isset($filter["sender"]) && $filter["sender"] != null && $filter["sender"] != ""){
        $where[] = array("EQUAL", "sender", $filter["sender"]);
      }

      return $where;
    }
  }
?>
