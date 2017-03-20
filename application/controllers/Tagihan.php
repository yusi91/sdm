<?php
  class Tagihan extends ICT_Controller{
    public function __construct(){
      parent::__construct();
      $this->setupMasterPage();
      $this->loader();
      // $this->validateRekening();
    }
    //PUBLIC PROPERTY
    public $data;

    //PUBLIC FUNCTION SECTION
    public function Franco(){
      $this->setupMasterPage("Franco");
      // BEGIN GET DATA
      $filter = $this->generateFilter();
      $this->data["filter"] = $filter;
      $sort = $this->generateSortIndex();
      $this->data["list_of_data"] = null;
      // END GET DATA

      //if button "CARI" clicked, then do search data
      if($this->input->post("btnSearch") == "Cari"){
        //validate filter, cannot search data if filter range is greater than 3 month
        $diff_month = $this->diffInMonths(date_create($filter["RSTRDJ_FROM"]) , date_create($filter["RSTRDJ_TO"]) );
        if($diff_month <= 3){   
          if($this->validateFilterMonth($filter)){
            $filter["RSDCTO"] = "S4";
            $this->data["list_of_data"] = $this->M_Tagihan->getTagihans($filter, $sort);
          }
        }
        else{
          $err_msg = array('Jarak Tanggal Tidak Bisa Lebih dari 3 Bulan');
          $this->session->set_flashdata('err_msg',$err_msg);
          $this->data["err_msg"] = $this->session->flashdata('err_msg');
        }
      }

      //Setup Input View
      $this->createInputView();
      $this->data["prev_number"] = $this->M_Tagihan->getPreviousPONumber();
      //END Setup Input View

      $this->data["Container"] = $this->load->view("Tagihan/Franco",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function Intransit(){
      $this->setupMasterPage("Intransit");
      // BEGIN GET DATA
      $filter = $this->generateFilter();
      $this->data["filter"] = $filter;
      $sort = $this->generateSortIndex();
      $this->data["list_of_data"] = null;
      // END GET DATA

      //if button "CARI" clicked, then do search data
      if($this->input->post("btnSearch") == "Cari"){
        //validate filter, cannot search data if filter range is greater than 3 month
        $diff_month = $this->diffInMonths(date_create($filter["RSTRDJ_FROM"]) , date_create($filter["RSTRDJ_TO"]) );
        if($diff_month <= 3){   
          if($this->validateFilterMonth($filter)){
            $filter["RSDCTO"] = "ST";
            $this->data["list_of_data"] = $this->M_Tagihan->getTagihans($filter, $sort);
          }
        }
        else{
          $err_msg = array('Jarak Tanggal Tidak Bisa Lebih dari 3 Bulan');
          $this->session->set_flashdata('err_msg',$err_msg);
          $this->data["err_msg"] = $this->session->flashdata('err_msg');
        }
      }

      //Setup Input View
      $this->createInputView();
      $this->data["prev_number"] = $this->M_Tagihan->getPreviousPONumber();
      //END Setup Input View

      $this->data["Container"] = $this->load->view("Tagihan/Intransit",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function inputTagihan(){
      $list_do_numb = $this->input->post("do_numb");
      $description = $this->input->post("deskripsi");
      $url_from = $this->input->post("url_from");

      $splitted_do_numb = null;
      foreach ($list_do_numb as $do_numb) {
        $splitted_do_numb[] = explode("-", $do_numb);
      }

      $this->M_Tagihan->prosesInputPO($splitted_do_numb, $description);
      $prev_number = $this->M_Tagihan->getPreviousPONumber();
      return redirect(base_url()."Tagihan/finishTagihan?from=".$url_from."&po_number=".$prev_number);
    }

    public function finishTagihan(){
      $this->data["from"] = $this->input->get("from");
      $this->data["po_number"] = $this->input->get("po_number");
      $this->data["Container"] = $this->load->view("Tagihan/Finish",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function getJsonTagihan(){
      $do_numb = $this->input->get("do_number");
      $split_do_numb = explode("-",$do_numb);
      $filter["RSKCOO"] = $split_do_numb[0];
      $filter["RSDCTO"] = $split_do_numb[1];
      $filter["RSDOCO"] = $split_do_numb[2];
      $result = $this->M_Tagihan->getTagihanSingle($filter);

      echo json_encode($result);
    }

    //PRIVATE FUNCTION SECTION
    //
    private function validateFilterMonth($filter){
      $no_error = true;
      $split_RSTRDJ_FROM = explode("-", $filter["RSTRDJ_FROM"]);
      $split_RSTRDJ_TO = explode("-", $filter["RSTRDJ_TO"]);
      $err_msg = null;

      if($split_RSTRDJ_FROM[1] != $split_RSTRDJ_TO[1] || $split_RSTRDJ_FROM[2] != $split_RSTRDJ_TO[2]){
        $no_error = false;
        $err_msg[] = "Jarak Tanggal Data Harus Dalam Periode yang Sama.";
      }

      if(strtotime($filter["RSTRDJ_FROM"]) < strtotime("01-02-2017") ){
        $no_error = false;
        $err_msg[] = "Data Terakhir yang Dapat Diakses Adalah Tanggal 01-02-2017.";  
      }

      if(strtotime($filter["RSTRDJ_FROM"]) > strtotime($filter["RSTRDJ_TO"])){
        $no_error = false;
        $err_msg[] = "Filter Tanggal 'Dari' Tidak Boleh Lebih Besar dari Filter Tanggal 'Sampai'.";   
      }

      $this->data["err_msg"] = $err_msg;
      return $no_error;
    }

    private function validateRekening(){
      $rek = $this->M_Tagihan->getF55DO005($_SESSION["userinfo"]["TKAN8"]);
      if($rek == null){
        return redirect(base_url()."Home/Rekening");
      }
    }

    private  function diffInMonths(DateTime $date1, DateTime $date2){
      $diff =  $date1->diff($date2);
      $months = $diff->y * 12 + $diff->m + $diff->d / 30;
      
      return (int) round($months);
    }

    private function createInputView(){
      $this->generateComboSite();
      $this->generateComboJenisSemen();
    }

    private function generateComboJenisSemen(){
      $values[] = array("id"=>"z", "name"=>"Zak");
      $values[] = array("id"=>"kg", "name"=>"Curah");
      
      $this->data["ComboJenisSemen"] = $values;
    }

    private function generateComboSite(){
      $values[] = array("id"=>"10201", "name"=>"Palembang");
      $values[] = array("id"=>"10202", "name"=>"Baturaja");
      $values[] = array("id"=>"10203", "name"=>"Panjang");
      
      $this->data["ComboRSKCOO"] = $values;
    }

    private function generateSortIndex(){
      $sorting_data[0] = "RSDOCO"; $sorting_data[1] = "DESC";

      $sort[] = $sorting_data;
      return $sort;
    }

    private function generateFilter(){
      $filter["RSTRDJ_FROM"] = ($this->input->post("RSTRDJ_FROM") != null && $this->input->post("RSTRDJ_FROM") != ""? $this->input->post("RSTRDJ_FROM") : date("1-m-Y"));
      $filter["RSTRDJ_TO"] = ($this->input->post("RSTRDJ_TO") != null && $this->input->post("RSTRDJ_TO") != ""? $this->input->post("RSTRDJ_TO") : date("d-m-Y"));
      $filter["RSKCOO"] = $this->input->post("RSKCOO");
      $filter["JenisSemen"] = $this->input->post("JenisSemen");
      // $this->checkInput($filter);
      return $filter;
    }

    private function setupMasterPage($menu_name = null){
      $this->data["HeadMenu"] = "Tagihan";
      $this->data["Menu"] = ($menu_name != null?$menu_name:"");
      $this->data["HeadBreadCrumb"] = "Tagihan";
      $this->data["Title"] = ($menu_name != null?$menu_name:"");
      // $this->data["Sub_Title"] = "tabs, accordions & navbars";
    }

    private function loader(){
      $this->load->model("M_Tagihan");
    }
  }
?>
