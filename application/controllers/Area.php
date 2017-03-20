<?php
  class Area extends ICT_Controller{
    public function __construct(){
      parent::__construct();
      $this->setupMasterPage();
      $this->loader();
    }
    //PUBLIC PROPERTY
    public $data;

    //PUBLIC FUNCTION SECTION
    public function index(){
      // BEGIN GET DATA
      $filter = $this->generateFilter();
      $sort = $this->generateSortIndex();
      $this->data["list_of_data"] = $this->M_Area->getAreas($filter, $sort);
      // END GET DATA

      // BEGIN SET FILTER TO DATA FOR VIEW
      $this->data["Filter"] = $filter;
      // END SET FILTER TO DATA FOR VIEW

      $this->data["Container"] = $this->load->view("Area/index",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function create(){
      $this->data["objData"] = $this->bindingData();
      if($this->input->post("btnSubmit") == "Submit"){
        if($this->validateInput($this->data["objData"])){
          $result = $this->M_Area->insertData($this->data["objData"]);
          if($result != null){
            return redirect(base_url()."Area/Detail?id=".$result);
          }
          else{
            $this->data["err_msg"] = $_SESSION["err_msg"];
          }
        }
      }

      $this->data["Container"] = $this->load->view("Area/input",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function edit(){
      $this->data["objData"] = $this->M_Area->getArea($this->input->get("id"));
      if($this->input->post("btnSubmit") == "Submit"){
        $this->data["objData"] = $this->bindingData();
        if($this->validateInput($this->data["objData"])){
          $old_id = $this->data["objData"]["id"];
          $result = $this->M_Area->updateData($this->data["objData"], $old_id);
          if($result){
            return redirect(base_url()."Area/detail?id=".$old_id);
          }
          else{
            $this->data["err_msg"] = $_SESSION["err_msg"];
          }
        }
      }

      $this->data["Container"] = $this->load->view("Area/input",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function detail(){
      $id = $this->input->get("id");
      $this->data["objData"] = $this->M_Area->getArea($id);

      $this->data["Container"] = $this->load->view("Area/detail",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function delete(){
      $id = $this->input->get("id");
      $this->M_Area->deleteData($id);

      return redirect(base_url()."Area");
    }

    public function getJsonArea(){
      $id = $this->input->get("id");
      $result = $this->M_Area->getArea($id);
      
      echo json_encode($result);
    }

    //PRIVATE FUNCTION SECTION
    //
    private function validateInput($input){
      $input_validate = null; 

      //BEGIN SET TO FORMAT VALIDATE ON PARENT CLASS
      $code = ["required", "Code", $input["code"]];
      $input_validate[] = $code;
      $name = ["required", "Name", $input["name"]];
      $input_validate[] = $name;
      //END SET

      if(!parent::validateAllInput($input_validate)){
        $this->data["err_msg"] = $_SESSION["err_msg"];
        return false;
      }
      return true;
    }

    private function bindingData(){
      $objData["id"] = $this->input->post("Id");
      $objData["code"] = $this->input->post("Code");
      $objData["name"] = $this->input->post("Name");

      return $objData;
    }

    private function generateSortIndex(){
      $sorting_data[0] = "code"; $sorting_data[1] = "asc";

      $sort[] = $sorting_data;
      return $sort;
    }

    private function generateFilter(){
      $filter["Code_Like"] = $this->input->post("Code");
      $filter["Name_Like"] = $this->input->post("Name");

      return $filter;
    }

    private function setupMasterPage(){
      $this->data["HeadMenu"] = "MasterData";
      $this->data["Menu"] = "Area";
      $this->data["HeadBreadCrumb"] = "Master Data";
      $this->data["Title"] = "Area";
      // $this->data["Sub_Title"] = "tabs, accordions & navbars";
    }

    private function loader(){
      $this->load->model("M_Area");
    }
  }
?>
