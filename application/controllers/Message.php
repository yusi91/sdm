<?php
  class Message extends ICT_Controller{
    public function __construct(){
      parent::__construct();
      $this->setupMasterPage();
      $this->loader();
      $this->getMessageData();
    }
    //PUBLIC PROPERTY
    public $data;

    //PUBLIC FUNCTION SECTION
    public function index(){
      $title = "INBOX";
      if(
      strtoupper($this->input->get("type_inbox")) == "INBOX" ||
      strtoupper($this->input->get("type_inbox")) == "SENT"  ||
      strtoupper($this->input->get("type_inbox")) == "DRAFT" || 
      strtoupper($this->input->get("type_inbox")) == "TRASH" ){
        $title = strtoupper($this->input->get("type_inbox"));
      }
      $this->data["title_mode"] = $title;
      $this->data["list_of_data"] = $this->getInboxData();
      $this->data["Container"] = $this->load->view("Message/index",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }
    public function composeMessage(){
      $this->data["Container"] = $this->load->view("Message/composeMessage",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    //PRIVATE FUNCTION SECTION
    //
    
    private function getMessageData(){
      //count section
      $this->data["count_inbox"] = $this->getCountInboxData();
      $this->data["count_sent"] = $this->getCountSentData();
    }

    //***********************************************   COUNT DATA   ******************************************************
    private function getInboxData(){
      //INBOX : select * from messages where livestate='live'  and owner='$receiver' and receiver='$receiver'   group by title and originator   order by date desc,readstate desc,time desc
      // SENT : select * from messages where livestate='live'  and owner='$receiver' and sender='$receiver'     group by title                  order by date desc,readstate desc,time desc 
      //TRASH : select * from messages where livestate='trash' and owner='$receiver'                                                            order by date desc,readstate desc,time desc
      // XXX DRAFT : select * from messages where livestate='draft' and owner='$receiver'                                                            order by date desc,readstate desc,time desc

      $type_inbox = strtoupper($this->input->get("type_inbox")) ;
      $filter = null;
      $group_by = null;

      //FILTER====================================================
      if($type_inbox == "INBOX"){
        $filter["livestate"] = 'live';
        $filter["owner"] = $_SESSION["userinfo"]["username"];
        $filter["receiver"] = $_SESSION["userinfo"]["username"];

        $group_by = "title, originator";
      }
      else if($type_inbox == "SENT" ){
        $filter["livestate"] = 'live';
        $filter["owner"] = $_SESSION["userinfo"]["username"];
        $filter["sender"] = $_SESSION["userinfo"]["username"];

        $group_by = "title";
      }
      else if($type_inbox == "DRAFT" ){
        $filter["livestate"] = 'draft';
        $filter["owner"] = $_SESSION["userinfo"]["username"];
      }
      else if($type_inbox == "TRASH" ){
        $filter["livestate"] = 'trash';
        $filter["owner"] = $_SESSION["userinfo"]["username"];
      }
      else{
        //ELSE = INBOX MODE
        $filter["livestate"] = 'live';
        $filter["owner"] = $_SESSION["userinfo"]["username"];
        $filter["receiver"] = $_SESSION["userinfo"]["username"];

        $group_by = "title, originator";
      }

      //order by
      $sort[] = array("date","DESC");
      $sort[] = array("readstate","DESC");
      $sort[] = array("time","DESC");

      //set result
      $result_db = $this->M_Message->getAllDataMessages(null, $filter, $group_by, $sort);
      return $result_db;
      // echo json_encode($result_db) ;
    }

    private function getCountInboxData(){
      //SELECT====================================================
      $select = "count(receiver) as count_inbox";

      //FILTER====================================================
      $filter["receiver"] = $_SESSION["userinfo"]["username"];
      $filter["owner"] = $_SESSION["userinfo"]["username"];
      $filter["readstate"] = 'unread';
      $filter["livestate"] = 'live';

      //GROUP BY==================================================
      $group_by = "title";

      //order by
      $sort[] = array("date","DESC");
      $sort[] = array("time","DESC");

      //set result
      $count_inbox = 0;
      $result_db = $this->M_Message->getAllDataMessages($select, $filter, $group_by, $sort);
      if($result_db != null && count($result_db) > 0){
        $count_inbox = $result_db[0]["count_inbox"];
      }

      return $count_inbox;
    }

    private function getCountSentData(){
      //SELECT====================================================
      $select = "count(sender) as count_sent";

      //FILTER====================================================
      $filter["sender"] = $_SESSION["userinfo"]["username"];
      $filter["owner"] = $_SESSION["userinfo"]["username"];
      $filter["readstate"] = 'unread';
      $filter["livestate"] = 'live';

      //GROUP BY==================================================
      $group_by = "title";

      //order by
      $sort[] = array("date","DESC");
      $sort[] = array("time","DESC");

      //set result
      $count_inbox = 0;
      $result_db = $this->M_Message->getAllDataMessages($select, $filter, $group_by, $sort);
      if($result_db != null && count($result_db) > 0){
        $count_inbox = $result_db[0]["count_sent"];
      }

      return $count_inbox;
    }
    //************************************************   END COUNT DATA   **************************************************

    private function loader(){
      $this->load->model("M_Message");
    }

    private function setupMasterPage(){
      $this->data["HeadMenu"] = "Home";
      $this->data["Menu"] = "";
      $this->data["HeadBreadCrumb"] = "";
      $this->data["Title"] = "Message";
    }
  }
?>
