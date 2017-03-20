<?php
  class LihatData extends ICT_Controller{
    public function __construct(){
      parent::__construct();
      $this->setupMasterPage();
      $this->loader();
      $this->load->model("M_LihatData");
    }
    //PUBLIC PROPERTY
    public $data;

    //PUBLIC FUNCTION SECTION
    public function SPJ(){
      $this->setupMasterPage("SPJ");
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
          if($this->validateFilterMonth($filter, "RS")){
            $this->data["list_of_data"] = $this->M_LihatData->getW55RS05($filter, $sort);
          }
        }
        else{
          $err_msg = array('Jarak Tanggal Tidak Bisa Lebih dari 3 Bulan');
          $this->session->set_flashdata('err_msg',$err_msg);
          $this->data["err_msg"] = $this->session->flashdata('err_msg');
        }
      }

      //Setup Input View
      // $this->createInputView();
      //END Setup Input View

      $this->data["Container"] = $this->load->view("LihatData/SPJ",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function ListTagihan(){
      $this->setupMasterPage("ListTagihan", "List Tagihan");
      // BEGIN GET DATA
      $filter = $this->generateFilterTagihan();
      $this->data["filter"] = $filter;
      $sort = $this->generateSortIndexTagihan();
      $this->data["list_of_data"] = null;
      // END GET DATA

      //if button "CARI" clicked, then do search data
      if($this->input->post("btnSearch") == "Cari"){
        //validate filter, cannot search data if filter range is greater than 3 month
        $diff_month = $this->diffInMonths(date_create($filter["PDTRDJ_FROM"]) , date_create($filter["PDTRDJ_TO"]) );
        if($diff_month <= 3){   
          if($this->validateFilterMonthListTagihan($filter,"PD")){
           $this->data["list_of_data"] = $this->M_LihatData->getListTagihan($filter, $sort);
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
      //END Setup Input View

      $this->data["Container"] = $this->load->view("LihatData/ListTagihan",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function getJSONDObyPO(){
      $po_number = $this->input->get("po_number");
      $splited_po_number = explode("-", $po_number);
      $list_of_do = $this->M_LihatData->getListDObyPO($splited_po_number);

      echo json_encode($list_of_do);
    }

    public function printTES(){
        $this->load->library("Pdf2");
        $mpdf=new mPDF('c');
        $mpdf->AddPage("landscape");
        // $img_file = base_url()."assets/img/LOGO_SEMEN_BATURAJA.png";
        // $mpdf->SetWatermarkImage($img_file);
        $mpdf->showWatermarkImage = true;
        $mpdf->watermarkImageAlpha = 0.07;
        $mpdf->setFooter('{PAGENO}');
        $mpdf->WriteHTML("dsadsa");

        $mpdf->Output($title_name.".pdf","D");
    }

    public function PrintListDO(){
      $po_number = $this->input->get("po_number");
      $po_date = $this->input->get("po_date");
      

      $this->data["po_number"] = $po_number;
      $this->data["po_date"] = $po_date;

      $splited_po_number = explode("-", $po_number);

      $this->load->model("M_Tagihan");
      $data_po = $this->M_Tagihan->getF4311($splited_po_number[2]);
      $this->data["po_data"] = $data_po;

      $this->data["list_of_data"] = $this->M_LihatData->getListDObyPO($splited_po_number);
// $this->load->view("LihatData/PrintListDO",$this->data);

      // ob_start();
      // $this->load->view("LihatData/PrintListDO",$this->data);
      // $html = ob_get_contents();
      // ob_end_clean();

      $html = $this->generatePrintPage($po_number, $po_date, $this->data["po_data"], $this->data["list_of_data"]);

      $this->getPdf_MPDF($html,"List DO ".$po_number);
    }

    //PRIVATE FUNCTION SECTION
    //
    private function validateFilterMonth($filter,$prefix){
      $no_error = true;
      $split_RSTRDJ_FROM = explode("-", $filter[$prefix."TRDJ_FROM"]);
      $split_RSTRDJ_TO = explode("-", $filter[$prefix."TRDJ_TO"]);
      $err_msg = null;

      if($split_RSTRDJ_FROM[1] != $split_RSTRDJ_TO[1] || $split_RSTRDJ_FROM[2] != $split_RSTRDJ_TO[2]){
        $no_error = false;
        $err_msg[] = "Jarak Tanggal Data Harus Dalam Periode yang Sama.";
      }

      if(strtotime($filter[$prefix."TRDJ_FROM"]) < strtotime("01-02-2017") ){
        $no_error = false;
        $err_msg[] = "Data Terakhir yang Dapat Diakses Adalah Tanggal 01-02-2017.";  
      }

      if(strtotime($filter[$prefix."TRDJ_FROM"]) > strtotime($filter[$prefix."TRDJ_TO"])){
        $no_error = false;
        $err_msg[] = "Filter Tanggal 'Dari' Tidak Boleh Lebih Besar dari Filter Tanggal 'Sampai'.";   
      }

      $this->data["err_msg"] = $err_msg;
      return $no_error;
    }

    private function validateFilterMonthListTagihan($filter,$prefix){
      $no_error = true;
      $split_RSTRDJ_FROM = explode("-", $filter[$prefix."TRDJ_FROM"]);
      $split_RSTRDJ_TO = explode("-", $filter[$prefix."TRDJ_TO"]);
      $err_msg = null;

      if($split_RSTRDJ_FROM[1] != $split_RSTRDJ_TO[1] || $split_RSTRDJ_FROM[2] != $split_RSTRDJ_TO[2]){
        $no_error = false;
        $err_msg[] = "Jarak Tanggal Data Harus Dalam Periode yang Sama.";
      }

      if(strtotime($filter[$prefix."TRDJ_FROM"]) < strtotime("01-02-2017") ){
        $no_error = false;
        $err_msg[] = "Data Terakhir yang Dapat Diakses Adalah Tanggal 01-02-2017.";  
      }

      if(strtotime($filter[$prefix."TRDJ_FROM"]) > strtotime($filter[$prefix."TRDJ_TO"])){
        $no_error = false;
        $err_msg[] = "Filter Tanggal 'Dari' Tidak Boleh Lebih Besar dari Filter Tanggal 'Sampai'.";   
      }

      $this->data["err_msg"] = $err_msg;
      return $no_error;
    }

    private function getPdf($html, $title_name){
      $this->load->library("Pdf");
      // create new PDF document
      $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
      // set font
      $pdf->AddPage();
      

      $img_file = base_url()."assets/img/LOGO_SEMEN_BATURAJA.png";
      $pdf->SetAlpha(0.2);
      $pdf->Image($img_file, 0, 0, 0, 0, '', '', 'M', false, 300, 'C', false, false, 0);
       $pdf->SetAlpha(1);
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->lastPage();
      $pdf->Output($title_name, 'I');
    }

    private function getPdf_MPDF($html, $title_name){
// echo base_url()."assets/img/LOGO_SEMEN_BATURAJA.png";
// die();
      $this->load->library("Pdf2");
      $mpdf=new mPDF('c');
      $mpdf->AddPage("landscape");
      $img_file = "assets/img/LOGO_SEMEN_BATURAJA.png";
      $mpdf->SetWatermarkImage($img_file);
      $mpdf->showWatermarkImage = true;
      $mpdf->watermarkImageAlpha = 0.07;
      $mpdf->setFooter('{PAGENO}');
      $mpdf->WriteHTML($html);

      $mpdf->Output($title_name.".pdf","D");
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

    private function generateSortIndexTagihan(){
      $sorting_data[0] = "PDDOCO"; $sorting_data[1] = "DESC";

      $sort[] = $sorting_data;
      return $sort;
    }

    private function generateFilter(){
      $filter["RSTRDJ_FROM"] = ($this->input->post("RSTRDJ_FROM") != null && $this->input->post("RSTRDJ_FROM") != ""? $this->input->post("RSTRDJ_FROM") : date("1-m-Y"));
      $filter["RSTRDJ_TO"] = ($this->input->post("RSTRDJ_TO") != null && $this->input->post("RSTRDJ_TO") != ""? $this->input->post("RSTRDJ_TO") : date("d-m-Y"));
      return $filter;
    }

    private function generateFilterTagihan(){
      $filter["PDTRDJ_FROM"] = ($this->input->post("PDTRDJ_FROM") != null && $this->input->post("PDTRDJ_FROM") != ""? $this->input->post("PDTRDJ_FROM") : date("1-m-Y"));
      $filter["PDTRDJ_TO"] = ($this->input->post("PDTRDJ_TO") != null && $this->input->post("PDTRDJ_TO") != ""? $this->input->post("PDTRDJ_TO") : date("d-m-Y"));
      return $filter;
    }

    private function setupMasterPage($menu_name = null, $title_name = null){
      $header = $menu_name;
      if($title_name != null){
        $header = $title_name;
      }

      $this->data["HeadMenu"] = "LihatData";
      $this->data["Menu"] = ($menu_name != null? $menu_name :"");
      $this->data["HeadBreadCrumb"] = "Data";
      $this->data["Title"] = ($header != null? "Data ".$header:"");
      // $this->data["Sub_Title"] = "tabs, accordions & navbars";
    }

    private function generatePrintPage($po_number, $po_date, $po_data, $list_of_data){
      $page = '
        <html>
<!-- BEGIN HEAD -->

  <head>
      <meta charset="utf-8" />
      <title>Transportation Dashboard System (TDS)</title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1" name="viewport" />
      <meta content="" name="description" />
      <meta content="" name="author" />
    </head>
  <!-- END HEAD -->

  <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
    <style type="text/css">
      table tr td, table tr th{
        padding: 10,10,10,10 !important;
      }
    </style>
    <div style="width: 100%; text-align: center">
      <H2>DAFTAR DO EXPEDITUR  DARI PO <span style="color: #4B77BE" >  </span> </H2>
    </div>
    <div>
      <table style="font-weight: bold">
        <tr>
          <td>Nama Ekspeditur</td>
          <td>:</td>
          <td>'.  $_SESSION["userinfo"]["TKALPH"].'</td>
        </tr>
        <tr>
          <td>Nomor Tagihan</td>
          <td>:</td>
          <td>'.  $po_number.'</td>
        </tr>
        <tr>
          <td>Tanggal Tagihan</td>
          <td>:</td>
          <td>'.  date("d-m-Y", strtotime($po_date)) .'</td>
        </tr>
        <tr>
          <td>Deskripsi</td>
          <td>:</td>
          <td>'.  (isset($po_data) && $po_data != null ?$po_data["PDDSC1"]:"" ) .'</td>
        </tr>

      </table>
    </div>
    <br><br>
  <table class="table table-striped table-bordered table-hover order-column " id="data_list" cellpadding="30"  >
      <thead>
          <tr>
              <th class="center" width="5%">No</th>
              <th class="center">Nomor DO</th>
              <th class="center">Tanggal</th>
              <th class="center">Wilayah</th>
              <th class="center">Toko</th>
              <th class="center">Plat Nomor</th>
              <th class="center">Supir</th>
              <th class="center">Jenis Semen</th>
              <th class="center">Quantity</th>
              <th class="center">Tarif OA</th>
              <th class="center">Sub Total</th>
          </tr>
      </thead>
      <tbody>';

        $rownum = 1;
        $row_input = 0;
        $format_currency_counter = 0;
        $list_currency = 0;
        $list_semen["550"] = "Zak OPC 50 Kg";
        $list_semen["551"] = "Zak PCC 50 Kg";
        $list_semen["540"] = "Zak PCC 40 Kg";
        $list_semen["580"] = "Big Bag OPC";
        $list_semen["581"] = "Big Bag PCC";
        $list_semen["530"] = "Curah OPC";
        $list_semen["531"] = "Curah PCC";

        $tot_qty = 0;
        $tot_price = 0;

        if($list_of_data != null && count($list_of_data) > 0){
          foreach ($list_of_data as $data) {
            $tot_qty += $data["RSUORG"];
            $tot_price += $data["RSTCST"] / 10000;
            $page .= '
              <tr>
                <td class="center"  width="5%"> '.  $rownum++ .'</td>
                <td class="center">'.  ($data["RSDOCO"] != null && $data["RSDOCO"] != "" ? $data["RSKCOO"]."-".$data["RSDCTO"]."-".$data["RSDOCO"] : "&nbsp;").'</td>
                <td class="center">'.  ($data["RSTRDJ"] != null && $data["RSTRDJ"] != "" ? $data["RSTRDJ_GREGORIAN"]: "&nbsp;").'</td>
                <td class="center">'.  ($data["EMCU_DESC"] != null && $data["EMCU_DESC"] != "" ? $data["EMCU_DESC"]: "&nbsp;").'</td>
                <td class="center">'.  ($data["SHAN_DESC"] != null && $data["SHAN_DESC"] != "" ? $data["SHAN_DESC"]: "&nbsp;").'</td>
                <td class="center">'.  ($data["RSIR01"] != null && $data["RSIR01"] != "" ? $data["RSIR01"]: "&nbsp;").'</td>
                <td class="center">'.  ($data["RSIR02"] != null && $data["RSIR02"] != "" ? $data["RSIR02"]: "&nbsp;").'</td>
                <td class="center">'.  ($data["RSLITM"] != null && $data["RSLITM"] != "" ? $list_semen["".trim($data["RSLITM"])] : "&nbsp;").'</td>
                <td style="text-align: center">'.  ($data["RSUORG"] != null && $data["RSUORG"] != "" ? $data["RSUORG"] : "&nbsp;").'</td>
                <td class="" style="text-align: center;">Rp.'.  ($data["RSLPRC"] != null && $data["RSLPRC"] != "" ?  number_format( $data["RSLPRC"] / 10000,2)  : "&nbsp;").'</td>
                <td class="" style="text-align: center">Rp.'.  ($data["RSTCST"] != null && $data["RSTCST"] != "" ?  number_format( $data["RSTCST"] / 10000,2) : "&nbsp;").'</td>
              </tr>
            ';
          }
        }
        
        $page .= '
                  <tr>
                    <td colspan="11" style="border-bottom: dashed 0.5 !important;  " ></td>
                  </tr>
                  <tr >
                    <td colspan="8"  style="text-align: right;"><span style="font-weight: bold;">Total :</span> </td>
                    <td class="center"><span style="font-weight: bold;white-space: nowrap !important;">'.  $tot_qty.'</span></td>
                    <td class="center"><span style="font-weight: bold;white-space: nowrap !important;">Rp.'.  number_format(($tot_price / $tot_qty), 2) .'</span></td>
                    <td class="center"><span style="font-weight: bold;white-space: nowrap !important;">Rp.'.  number_format($tot_price, 2).'</span></td>
                  </tr>
                  </tbody>
              </table>

              <br><br>

              <table style="width: 100%">
                <tr style="width: 100%">
                  <td style="text-align: center">Pihak ke-1<br><br><br><br></td>
                  <td style="text-align: center">Pihak ke-2<br><br><br><br></td>
                </tr>
                <tr style="width: 100%">
                  <td style="text-align: center">(..................................)</td>
                  <td style="text-align: center">(..................................)</td>
                </tr>
              </table>
              </body>
            </html>
      ';
      return $page;
    }

    private function loader(){
      $this->load->model("M_LihatData");
    }
  }
?>
