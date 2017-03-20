<?php
  class Dashboard extends ICT_Controller{
    public function __construct(){
      parent::__construct();
      $this->setupMasterPage();
    }
    //PUBLIC PROPERTY
    public $data;

    //PUBLIC FUNCTION SECTION
    public function index(){
   	  $dashboard = $this->input->get("db");
   	  $title_name = str_replace("_", " ", $dashboard);
   	  $this->setupMasterPage($dashboard, $title_name);
   	  $this->data["DashBoard_Type"] = $dashboard."_".$_SESSION["userinfo"]["type"];
   	  $this->data["dist_kode"] = $_SESSION["userinfo"]["an8"];
   	  $this->data["ticket"] = $this->getTicketTableau();

      $this->data["Container"] = $this->load->view("Dashboard/index",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    //PRIVATE FUNCTION SECTION
    //
    private function getTicketTableau(){
    	$username = 'admincds'; // Username
	    $server = 'http://10.10.2.26/trusted';  // Tableau URL
	    $view = 'views/Regional/Obesity?:embed=yes'; // View URL
	    $ch = curl_init($server); // Initializes cURL session

	    $data = array('username' => $username); // What data to send to Tableau Server

	    curl_setopt($ch, CURLOPT_POST, true); // Tells cURL to use POST method
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // What data to post
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return ticket to variable

	    $ticket = curl_exec($ch); // Execute cURL function and retrieve ticket
	    curl_close($ch); // Close cURL session

	    return $ticket;
    }

    private function setupMasterPage($menu_name = null, $title_name = null){
      $this->data["HeadMenu"] = "Dashboard";
      $this->data["Menu"] = $menu_name;
      $this->data["HeadBreadCrumb"] = "Dashboard";
      $this->data["Title"] = $title_name;
    }
  }
?>
