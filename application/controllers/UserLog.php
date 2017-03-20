<?php
  class UserLog extends ICT_Controller{
    public function __construct(){
      parent::__construct();
      $this->setupMasterPage();
      $this->loader();
    }
    //PUBLIC PROPERTY
    public $data;

    //PUBLIC FUNCTION SECTION
    public function index(){
      $this->setupMasterPage("UserLog","User Log");
      // BEGIN GET DATA
      $filter = $this->generateFilter();
      $this->data["filter"] = $filter;
      $sort = $this->generateSort();
      $this->data["list_of_data"] = null;
      // END GET DATA

      $this->data["list_of_data"] = $this->M_UserLog->getAllDataUserLog($filter, $sort);

      $this->createInputView();
      $this->data["Container"] = $this->load->view("UserLog/index",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function UserRating(){
      $this->setupMasterPage("UserRating","User Rating");
      // BEGIN GET DATA
      $filter = $this->generateFilter();
      $this->data["filter"] = $filter;
      $this->data["list_of_data"] = null;
      // END GET DATA

      $this->data["list_of_data"] = $this->M_UserLog->getDataUserRating($filter);

      $this->createInputView();
      $this->data["Container"] = $this->load->view("UserLog/UserRating",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function exportExcel(){
      // BEGIN GET DATA
      $filter = $this->generateFilter();
      $this->data["filter"] = $filter;
      $sort = $this->generateSort();
      $list_of_data = null;
      // END GET DATA
      $list_of_data = $this->M_UserLog->getAllDataUserLog($filter, $sort);
      $header = array("No","id","Username","Nama Distributor","Site","Tanggal Login","Waktu Login","Tanggal Logout","Waktu Logout");
      $values = null;
      $row_num = 1;
      foreach ($list_of_data as $key => $data) {
        $value = null;
        $value[] = $row_num++;
        $value[] = ($data["Id"] != null && $data["Id"] != "" ? $data["Id"] : " ");
        $value[] = ($data["username"] != null && $data["username"] != "" ? $data["username"] : " ");
        $value[] = ($data["ab"] != null? $data["ab"]["nama"] : " ");
        $value[] = ($data["site"] != null && $data["site"] != "" ? $data["site"] : " ");
        $value[] = ($data["login_date"] != null && $data["login_date"] != "" ? date("d-m-Y", strtotime($data["login_date"])) : " ");
        $value[] = ($data["login_time"] != null && $data["login_time"] != "" ? date("H:i:s", strtotime($data["login_time"])) : " ");
        $value[] = ($data["logout_date"] != null && $data["logout_date"] != "" ? date("d-m-Y", strtotime($data["logout_date"])) : " ");
        $value[] = ($data["logout_time"] != null && $data["logout_time"] != "" ? date("H:i:s", strtotime($data["logout_time"])) : " ");

        $values[] = $value;
      }
      $title_name = "UserLog";
      parent::generateExcel($title_name,$header,$values);
    }

    public function exportExcelUserRating(){
      // BEGIN GET DATA
      $filter = $this->generateFilter();
      $list_of_data = null;
      $list_of_data = $this->M_UserLog->getDataUserRating($filter);
      // END GET DATA
      //SET VALUE FOR CALCULATE RATE
      $cds_release=strtotime("2014/05/01");
      $today=time();
      $selisih=abs($cds_release-$today);
      $selisih=(intval($selisih))/86400;
      //END SET VALUE FOR CALCULATE RATE  

      $header = array("No","Username","Total Login", "Average Login Per Day");
      $values = null;
      $row_num = 1;
      foreach ($list_of_data as $key => $data) {
        $value = null;
        $value[] = $row_num++;
        $value[] = ($data["username"] != null && $data["username"] != "" ? $data["username"] : " ");
        $value[] = ($data["count_login"] != null && $data["count_login"] != "" ? number_format($data["count_login"], 0) : "0");
        $value[] = ($data["count_login"] != null && $data["count_login"] != "" ? number_format($data["count_login"] / $selisih, 3): "0");

        $values[] = $value;
      }
      $title_name = "UserRating";
      parent::generateExcel($title_name,$header,$values);
    }


    public function getJSONUserLogByUsername(){
      // BEGIN GET DATA
      $filter = $this->generateFilter();
      $sort = $this->generateSort();
      $list_of_data = null;
      // END GET DATA
      $list_of_data = $this->M_UserLog->getAllDataUserLog($filter, $sort);
      $list_of_data = $this->formatResultJSON($list_of_data);

      echo json_encode($list_of_data);
    }

    //PRIVATE FUNCTION SECTION
    //
    private function formatResultJSON($dataJSON){
      $values = null;
      if($dataJSON != null && count($dataJSON) > 0){
        $row_num = 1;
        foreach ($dataJSON as $key => $data) {
          $value = null;
          $value[] = $row_num++;
          // $value[] = ($data["Id"] != null && $data["Id"] != "" ? $data["Id"] : " ");
          $value[] = ($data["username"] != null && $data["username"] != "" ? $data["username"] : " ");
          $value[] = ($data["ab"] != null? $data["ab"]["nama"] : " ");
          $value[] = ($data["site"] != null && $data["site"] != "" ? $data["site"] : " ");
          $value[] = ($data["login_date"] != null && $data["login_date"] != "" ? date("d-m-Y", strtotime($data["login_date"])) : " ");
          $value[] = ($data["login_time"] != null && $data["login_time"] != "" ? date("H:i:s", strtotime($data["login_time"])) : " ");
          $value[] = ($data["logout_date"] != null && $data["logout_date"] != "" ? date("d-m-Y", strtotime($data["logout_date"])) : " ");
          $value[] = ($data["logout_time"] != null && $data["logout_time"] != "" ? date("H:i:s", strtotime($data["logout_time"])) : " ");

          $values[] = $value;
        }
      }

      return $values;
    }

    private function createInputView(){

    }

    private function generateSort(){
      $sorting_data[0] = "id"; $sorting_data[1] = "DESC";
      $sort[] = $sorting_data;
      return $sort;
    }

    private function generateFilter(){
      $filter = null;
      
      $filter["username"] = $this->input->get("username");

      return $filter;
    }

    private function setupMasterPage($menu_name = null, $title_name = null){
      $header = $menu_name;
      if($title_name != null){
        $header = $title_name;
      }

      $this->data["HeadMenu"] = "Admin";
      $this->data["Menu"] = $menu_name;
      $this->data["HeadBreadCrumb"] = "Admin";
      $this->data["Title"] = $title_name;
      // $this->data["Sub_Title"] = "tabs, accordions & navbars";
    }

    private function loader(){
      $this->load->model("M_UserLog");
    }
  }
?>
