<?php
  class M_Login extends ICT_Model{
    public function __construct(){
      parent::__construct();
      $this->table = $this->scheme.".user";
    }

    private $table;

    //PUBLIC SECTION
    public function checkLogin($data){
      $where[] = array("equal", "username", $data["username"]);
      $where[] = array("equal", "password", $data["password"]);


      
      $result = parent::getAllData($this->table, null, $where);
      // $this->checkinput($result);die();
      if(count($result) > 0){
        // $this->insertUserLog($result[0]);
        $this->session->set_userdata(array("userinfo" => $result[0]));
        return true;
      }

      return false;
    }

    public function setLogoutTime($username, $session_id){
      $table = "user_log";

      //set where----------------------------------------------------
      $where["username"] = $username;
      $where["session_id"] = $session_id;
      //-------------------------------------------------------------
      //binding data-------------------------------------------------
      $input["logout_date"] = date("Y-m-d");
      $input["logout_time"] = date("H:i:s");
      //-------------------------------------------------------------
      //do update to table===========================================
      $this->db->where($where);
      $this->db->update($table, $input);
      //=============================================================
    }

    //PRIVATE SECTION
    private function generateSessionId($user){
      $prefix_list=array("sembaja","ptsb","sembara","ramen","x-ray","voodo","apache","thor","blink","govan");
      $rand_keys = array_rand($prefix_list, 10);
      $prefix=$prefix_list[$rand_keys[0]];
      $session_id=uniqid ($prefix."-".$user, true);

      return $session_id;
    }

    private function insertUserLog($userInfo){
      $table = "user_log";
      $session_id = $this->generateSessionId( $userInfo["username"]);
      $this->session->set_userdata(array("session_id" => $session_id) );

      //binding data-------------------------------------------------
      $input["username"] = $userInfo["username"];
      $input["password"] = $userInfo["password"];
      $input["an8"] = $userInfo["an8"];
      $input["bu"] = $userInfo["bu"];
      $input["no_hp"] = $userInfo["no_hp"];
      $input["email"] = $userInfo["email"];
      $input["site"] = $userInfo["site"];
      $input["login_date"] = date("Y-m-d");
      $input["login_time"] = date("H:i:s");
      $input["session_id"] = $session_id;

      //-------------------------------------------------------------

      //do insert to table===========================================
      $this->db->insert($table, $input);
      //=============================================================
    }
  }
?>
