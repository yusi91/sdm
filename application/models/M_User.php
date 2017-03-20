<?php
  class M_User extends ICT_Model{
    public function __construct()
    {
      parent::__construct();
      $this->table = $this->scheme.".user";
    }

    private $table;
    private $full_table;

    //PUBLIC SECTION
    
    public function getAllDataUser($filter = null, $sort = null)
    {
        // $where = $this->generateWhere($filter);
        $limit = 100;
        $result = parent::getAllData($this->table, null, null, $sort, null, null, $limit);
        //$result = $this->getAllData($table, null, $where, $sort, null, null, $limit);
        // $this->checkInput($result);
        return $result;

    }

    // public function insert_user()
    // {
    //     $input  = array('' => , );
    //     $result = parent::insertData($this->table, $input);
    //     //$result = $this->getAllData($table, null, $where, $sort, null, null, $limit);
    //     // $this->checkInput($result);
    //     return $result;

    // }

    public function insert_user($input){
      if(!$this->valnikateDuplicate($input)){
        return null;
      }

      $result = parent::insertData($this->table, $input);
      return $result;
    }


    public function getAllDataUserLog($filter = null, $sort = null)
    {
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
    }

    // public function insertData($table, $input){
    //     $input = $this->setAuditInformation($input, 1); 
    // }

    
    public function updatePasswordUser($password)
    {
        $username = $_SESSION["userinfo"]["username"];
        $where = array("username" => $username);
        $value = array("password"=>$password);
        
        return parent::update($this->table, $value, $where);
    }

    public function updateUserInfo($username, $input)
    {
        $where = array("username" => $username);

        return parent::update($this->table, $input, $where);
    }

    public function getSingleUserInfo($username)
    {
        $join_an8 = "(SELECT kode AS an8_kode, nama AS an8_nama FROM address_book) join_an8";
        $join[] = array("join_table"=> $join_an8, "join_on" => "an8 = an8_kode","join_heading"=>"left" );
        $where[] = array("equal", "username", $username);

        $result = parent::getAllData($this->table, null, $where, null, $join);
        // $this->checkinput($result);die();
        if(count($result) > 0)
        {
          return $result[0];
        }
      
      return null;
    }

    public function getDataUser($filter)
    {
        $result = $this->getData($this->table, $filter);
        return $result;
    }

//PRIVATE SECTION
    private function validateDuplicate($input){
      $filter = null;
      if($input["nik"] != ""){
        $filter["nik"] = ["not_equal", "nik", $input["nik"]];
      }

      $filter["nik"] = ["equal","nik",$input["nik"]];
      $result = parent::getAllData($this->table, null, $filter);
      if(count($result) > 0){
        $err_msg[] = "<Strong>Code</strong> is Duplicated";
        $this->session->set_flashdata("err_msg", $err_msg);
        return false;
      }

      return true;
    }


  }
?>
