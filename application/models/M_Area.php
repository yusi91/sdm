<?php
  class M_Area extends ICT_Model{
    public function __construct(){
      parent::__construct();
      $this->table = "Area";
    }

    private $table;

    //PUBLIC SECTION
    public function getAreas($filter = null, $sort = null){
      $where = $this->generateWhere($filter);
      $result = parent::getAllData($this->table, null, $where, $sort);
      return $result;
    }

    public function getSites($filter = null, $sort = null){
      $where = $this->generateWhere($filter);
      $result = parent::getAllData("site", null, $where, $sort);
      return $result;
    }

    public function getArea($id){
      $where_id["id"] = $id;
      return parent::getData($this->table, $where_id);
    }
     public function getSite($id){
      $where_id["id"] = $id;
      return parent::getData("site", $where_id);
    }

    public function insertData($input){
      if(!$this->validateDuplicate($input)){
        return null;
      }

      $result = parent::insertDataAutoIncrement($this->table, $input);
      return $result;
    }

    public function updateData($input, $old_id){
      if(!$this->validateDuplicate($input)){
        return false;
      }

      $where_old_id = ["id" => $old_id];
      if(!parent::update($this->table, $input, $where_old_id)){
        return false;
      }

      return true;
    }

    public function deleteData($id){
      $arr_id = ["id" => $id];
      return parent::delete($this->table, $arr_id);
    }

    //PRIVATE SECTION
    private function validateDuplicate($input){
      $filter = null;
      if($input["id"] != ""){
        $filter["id"] = ["not_equal", "id", $input["id"]];
      }

      $filter["code"] = ["equal","code",$input["code"]];
      $result = parent::getAllData($this->table, null, $filter);
      if(count($result) > 0){
        $err_msg[] = "<Strong>Code</strong> is Duplicated";
        $this->session->set_flashdata("err_msg", $err_msg);
        return false;
      }

      return true;
    }

    private function generateWhere($filter){
      $where[] = null;
      if($filter["Code_Like"] != null && $filter["Code_Like"] != ""){
        $code_like[] = "like";
        $code_like[] = "code";
        $code_like[] = $filter["Code_Like"];
        $where[] = $code_like;
      }
      if($filter["Name_Like"] != null && $filter["Name_Like"] != ""){
        $name_like[] = "like";
        $name_like[] = "name";
        $name_like[] = $filter["Name_Like"];
        $where[] = $name_like;
      }

      return $where;
    }


  }
?>
