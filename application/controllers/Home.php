<?php 
  class Home extends ICT_Controller{
    
    public function __construct(){
      parent::__construct();
      $this->setupMasterPage();
    }
    //PUBLIC PROPERTY
    public $data;

    //PUBLIC FUNCTION SECTION
    public function index(){
      //$this->checkInput($_SESSION["userinfo"]);
      // die();
      $this->data["Container"] = $this->load->view("Home/index",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }
    
    public function Rekening(){
      $this->data["Container"] = $this->load->view("Home/Rekening",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    private function setupMasterPage(){
      $this->data["HeadMenu"] = "Home";
      $this->data["Menu"] = "";
      $this->data["HeadBreadCrumb"] = "";
      $this->data["Title"] = "Home";
    }    
  }


?>