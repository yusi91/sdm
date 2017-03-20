<?php
  class Saldo extends ICT_Controller{
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
      $this->data["filter"] = $filter;
      $sort = $this->generateSort();
      $this->data["list_of_data"] = null;
      // END GET DATA

      //if button "CARI" clicked, then do search data
      if($this->input->post("btnSearch") == "Cari"){
        $this->data["list_of_data"] = $this->M_Saldo->getAllDataSaldo($filter, $sort);
      }

      $this->createInputView();
      $this->data["Container"] = $this->load->view("Saldo/index",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function ExportExcel(){ 
      $list_site[10201] = "[10201] Palembang";
      $list_site[10202] = "[10202] Baturaja";
      $list_site[10203] = "[10203] Panjang";
      
      $this->load->library("ExcelPrint");

      // BEGIN GET DATA
      $filter = $this->generateFilter();
      $sort = $this->generateSort();
      $datas = null;
      // END GET DATA
      $datas = $this->M_Saldo->getAllDataSaldo($filter, $sort);

      //membuat objek
      $objPHPExcel = new PHPExcel();

      // Nama Field Baris Pertama
      $fields = array("No","Site","Distributor","Jenis Bayar","Plafon","Deposit","Faktur Open","Order Open","Sisa Saldo");
      $col = 0;
      foreach ($fields as $field)
      {
          $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
          $col++;
      }

      // Mengambil Data
      $row = 2;
      $no_row = 1;
      foreach ($datas as $data) {
        $plafon = $data["plafon"];
        $deposit = $data["deposit"];
        $faktur_open = $data["faktur_open"];
        $order_open = $data["order_open"];
        $sisa_saldo = $data["sisa_saldo"];

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $no_row++);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $list_site[$data["site"]] );
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, "[".$data["sdan8"]."] ".$data["nama_dist"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, "[".$data["ryin"]."] ".$data["jenis_bayar"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $plafon);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $deposit);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $faktur_open);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $order_open );
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $sisa_saldo);
        $row++;
      }
      
      $objPHPExcel->setActiveSheetIndex(0);

      //Set Title
      $objPHPExcel->getActiveSheet()->setTitle('Saldo');

      //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

      //Header
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

      //Nama File
      header('Content-Disposition: attachment;filename="Saldo.xlsx"');

      //Download
      $objWriter->save("php://output");
    }

    //PRIVATE FUNCTION SECTION
    //
    private function createInputView(){
      $this->generateComboSite();
    }

    private function generateComboSite(){
      $values[] = array("id"=>"", "name"=>"Semua");
      $values[] = array("id"=>"10201", "name"=>"Palembang");
      $values[] = array("id"=>"10202", "name"=>"Baturaja");
      $values[] = array("id"=>"10203", "name"=>"Panjang");
      
      $this->data["ComboSite"] = $values;
    }

    private function generateSort(){
      $sorting_data[0] = "sdan8"; $sorting_data[1] = "ASC";
      $sort[] = $sorting_data;
      $sorting_data[0] = "ryin"; $sorting_data[1] = "ASC";
      $sort[] = $sorting_data;
      return $sort;
    }

    private function generateFilter(){
      $filter["site"] = $this->input->post("site");
      $filter["sdan8"] = $_SESSION["userinfo"]["an8"];
      return $filter;
    }

    private function setupMasterPage($menu_name = null, $title_name = null){
      $header = $menu_name;
      if($title_name != null){
        $header = $title_name;
      }

      $this->data["HeadMenu"] = "Data";
      $this->data["Menu"] = "Saldo";
      $this->data["HeadBreadCrumb"] = "Saldo";
      $this->data["Title"] = "Saldo";
      // $this->data["Sub_Title"] = "tabs, accordions & navbars";
    }

    private function loader(){
      $this->load->model("M_Saldo");
    }
  }
?>
