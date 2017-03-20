<?php
  class PembayaranFaktur extends ICT_Controller{
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
        if(!$this->validateMonth($filter)){
          $this->data["list_of_data"] = $this->M_PembayaranFaktur->getAllDataPembayaranFaktur($filter, $sort);
        }
      }

      $this->createInputView();
      $this->data["Container"] = $this->load->view("PembayaranFaktur/index",$this->data, true);
      $this->load->view("Shared/master",$this->data);
    }

    public function getJSONDetailFaktur(){
      $filter = null;
      $filter["rpdoc"] = $this->input->get("doc");
      $filter["rpdct"] = $this->input->get("dct");
      $filter["rpkco"] = $this->input->get("kco");
      $result = $this->M_PembayaranFaktur->getF03B11_3bln($filter);

      echo json_encode($result);
    }

    public function exportExcelInvoice(){
      $filter = null;
      $filter["rpdoc"] = $this->input->get("doc");
      $filter["rpdct"] = $this->input->get("dct");
      $filter["rpkco"] = $this->input->get("kco");
      $result_db = $this->M_PembayaranFaktur->getF03B11_3bln($filter);
      if($result_db != null && count($result_db) > 0){
        unset($result_db["last_update"]);
      }
      $result[] = $result_db;
      
      $title_excel = "Invoice";
      $fields = array("No Faktur","Line No","Jenis Bayar","Tanggal Faktur","Jatuh Tempo","Nilai Faktur","Nilai Open");

      parent::generateExcel($title_excel, $fields,$result);
    }

    public function getJSONDetailDObyFaktur(){
      $filter = null;
      $filter["sddoc"] = $this->input->get("doc");
      $filter["sddct"] = $this->input->get("dct");
      $filter["sdkco"] = $this->input->get("kco");
      $result = $this->M_PembayaranFaktur->getRealisasi_spj04_a_3bln($filter);

      echo json_encode($result);
    }

    public function exportExcelSPJ(){
      $filter = null;
      $filter["sddoc"] = $this->input->get("doc");
      $filter["sddct"] = $this->input->get("dct");
      $filter["sdkco"] = $this->input->get("kco");
      $result = $this->M_PembayaranFaktur->getRealisasi_spj04_a_3bln($filter);

      $title_excel = "DO_Invoice";
      $fields = array("No SPJ","Tujuan","Tgl SPJ","Kota Tujuan","Bayar","Kuantiti","Satuan","Harga Satuan" ,"Harga Tebus","Angkut","Nopol","Ekspeditur","Ket");

      parent::generateExcel($title_excel, $fields,$result);
    }

    public function ExportExcel(){ 
      $this->load->library("ExcelPrint");

      // BEGIN GET DATA
      $filter = $this->generateFilter();
      $sort = $this->generateSort();
      $datas = null;
      // END GET DATA
      $datas = $this->M_PembayaranFaktur->getAllDataPembayaranFaktur($filter, $sort);

      //membuat objek
      $objPHPExcel = new PHPExcel();
      // Nama Field Baris Pertama
      $fields = array("No","Distributor","Pay ID","No Setoran","Line ID","Tanggal Setoran","Pembayaran","No Faktur","Line No","Tanggal Faktur","Jatuh Tempo");
      // $fields = array("No","Distributor","Pay ID","No Setoran","Line ID","Tanggal Setoran","Pembayaran","No Faktur","Line No");

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
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $no_row++);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, "[".$data["rzan8_kode"]."] ".$data["rzan8_nama"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row,  $data["rzpyid"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $data["rzcknu"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $data["rzrc5"] );
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, date("d-m-Y", strtotime($data["rzdmtj"])));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $data["rzpaap"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row,  $data["rzkco"]."-". $data["rzdct"]."-".$data["rzdoc"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row,  $data["rzsfx"]);
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, date("d-m-Y", strtotime($data["rzidgj"])));
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, date("d-m-Y", strtotime($data["rzddj"])) );
        $row++;
      }
      
      $objPHPExcel->setActiveSheetIndex(0);

      //Set Title
      $objPHPExcel->getActiveSheet()->setTitle('PembayaranFaktur');

      //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

      //Header
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

      //Nama File
      header('Content-Disposition: attachment;filename="PembayaranFaktur.xlsx"');

      //Download
      $objWriter->save("php://output");
    }

    public function printInvoice(){
      //data invoice
      $filter["rpdoc"] = $this->input->get("doc");
      $filter["rpdct"] = $this->input->get("dct");
      $filter["rpkco"] = $this->input->get("kco");
      $data_invoice = $this->M_PembayaranFaktur->getHeaderInvoice($filter);

      //get data DO
      $filter = null;
      $filter["sddoc"] = $this->input->get("doc");
      $filter["sddct"] = $this->input->get("dct");
      $filter["sdkco"] = $this->input->get("kco");
      $data = $this->M_PembayaranFaktur->getDataInvoice($filter);

      $html = $this->generateStringPrintInvoice($data, $data_invoice);
      $title_pdf = "invoice";
      parent::generatePDFbyString($html, $title_pdf);
    }

    //PRIVATE FUNCTION SECTION
    //
    private function validateMonth($filter){
      $rzdmtj_from =  date("Y-m-d",strtotime( $filter["rzdmtj_from"])) ;
      $rzdmtj_to = date("Y-m-d",strtotime( $filter["rzdmtj_to"]) );
      $date_minus_3_month = date("Y-m-1",strtotime(" -3 month"));
      $is_error = false;
      if($rzdmtj_from < $date_minus_3_month || $rzdmtj_to < $date_minus_3_month){
        $err[] = "Data yang dapat diakses hanya data 3 bulan ke belakang.";
        $this->data["err_msg"] = $err;
        $is_error = true;
      }

      return $is_error;
    }

    private function createInputView(){
    }

    private function generateSort(){
      $sorting_data[0] = "rzan8"; $sorting_data[1] = "ASC";
      $sort[] = $sorting_data;
      $sorting_data[0] = "rzpyid"; $sorting_data[1] = "ASC";
      $sort[] = $sorting_data;
      $sorting_data[0] = "rzrc5"; $sorting_data[1] = "ASC";
      $sort[] = $sorting_data;
      return $sort;
    }

    private function generateFilter(){
      $filter["rzdmtj_from"] = ($this->input->post("rzdmtj_from") != null && $this->input->post("rzdmtj_from") != ""? $this->input->post("rzdmtj_from") : date("1-m-Y"));
      $filter["rzdmtj_to"] = ($this->input->post("rzdmtj_to") != null && $this->input->post("rzdmtj_to") != ""? $this->input->post("rzdmtj_to") : date("d-m-Y"));
      $filter["rzan8"] = $_SESSION["userinfo"]["an8"];

      return $filter;
    }

    private function setupMasterPage($menu_name = null, $title_name = null){
      $header = $menu_name;
      if($title_name != null){
        $header = $title_name;
      }

      $this->data["HeadMenu"] = "Data";
      $this->data["Menu"] = "PembayaranFaktur";
      $this->data["HeadBreadCrumb"] = "Pembayaran Faktur";
      $this->data["Title"] = "Pembayaran Faktur";
      // $this->data["Sub_Title"] = "tabs, accordions & navbars";
    }

    private function generateStringPrintInvoice($data, $data_invoice){
      $kddist = $data_invoice["RPAN8"];
      $nama_dist = $data_invoice["rpan8_nama"];
      $tgl_faktur = date("d-m-Y",strtotime( $data_invoice["RPDIVJ"]));
      $no_faktur_conc = $data_invoice["RPKCO"]." ".$data_invoice["RPDCT"]." ".$data_invoice["RPDOC"];
      $alamat = $data_invoice["aladd1"];
      $jatuh_tempo = date("d-m-Y",strtotime( $data_invoice["RPDDJ"]));
      $kota = $data_invoice["aladd2"];
      $masa_kredit = $data_invoice["RPPTC"];

      $harga_pabrik = 0;
      $oa = 0;
      $total_biaya_susun = 0;
      $ppn10 = 0;
      $pph22 = 0;
      $jumlah_keseluruhan = 0;

      $page = "
        <div align='left'>PT. SEMEN BATURAJA (PERSERO) Tbk</div>
        <div>A RD 5201-03</div>
            <table  width='100%'>
              <tr>
                <td colspan='3'><hr/><center>FAKTUR BARANG</center><hr/></td>
              </tr>
              <tr >
                <td align='left'>KEPADA</td>
                <td align='left'>NO FAKTUR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;".$no_faktur_conc.""."</td>
              </tr>
              <tr>
                <td align='left'>LANGGANAN&nbsp;&nbsp;:&nbsp;".$kddist. " " .$nama_dist."</td>
                <td align='left'>TGL.FAKTUR&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;".$tgl_faktur."</td>
              </tr>
              <tr>
                <td align='left'>ALAMAT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;".$alamat."</td>
                <td align='left'>JATUH TEMPO&nbsp;&nbsp;:&nbsp;".$jatuh_tempo."</td>
              </tr>
              <tr>
                <td align='left'>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$kota."
                </td>
                <td align='left'>
                  MASA KREDIT&nbsp;&nbsp;:&nbsp;".$masa_kredit."
                </td>
              </tr>
            </table>
            <br/>
            <table width='100%' >
              <tr align='center'>
                <td > NO <hr/> </td>
                <td> NAMA BARANG <hr/> </td>
                <td> JUMLAH HARGA</td> 
              </tr>
              <hr/>
      ";
      if($data != null && count($data) > 0){
        $row_num = 1;
        foreach ($data as $key => $value) {
          $page .= "
            <tr>
              <td>".$row_num++."</td>
              <td>".$value["jenis_semen_desc"]."</td>
              <td>".number_format($value["harga_pabrik"], 2) ."</td>
            </tr>
          ";
          $oa += $value["ongkos_angkut"];
          $jumlah_keseluruhan += $value["penjualan"];
          $ppn10 += $value["ppn"];
          $pph22 += $value["pph"];
          $harga_pabrik += $value["harga_pabrik"];
          $total_biaya_susun += $value["biaya_susun"];
        }
      }

      $page .= "</table> <br/> <hr/>";


      $page .= "
        <table width='100%' >
          <tr align='left'>
            <td>                    </td>
            <td style='white-space:nowrap;'><h5>Harga Pabrik</h5></td>
            <td ><h5>".number_format($harga_pabrik,2)."</h5></td>
          </tr>
          <tr>
            <td> </td>
            <td style='white-space:nowrap;'><h5>Ongkos Angkut</h5></td>
             <td ><h5>".number_format($oa,2)."</h5></td>
          </tr>
          <tr>
            <td></td>
            <td style='white-space:nowrap;'><h5>Biaya Susun</h5></td>
              <td ><h5>".number_format($total_biaya_susun,2)."</h5></td>
          </tr>
          <tr>
            <td></td>
            <td style='white-space:nowrap;'><h5>PPN 10%</h5></td>
             <td ><h5>".number_format($ppn10,2)."</h5></td>
          </tr>
          <tr>
            <td></td>
            <td style='white-space:nowrap;'><h5>PPH Pasal 22</h5></td>
             <td ><h5>".number_format($pph22,2)."</h5></td>
          </tr>
          <tr>
            <td></td>
            <td style='white-space:nowrap;'><h5>Dana Pemb. Daerah</h5></td>
             <td ></td>
          </tr>
          <tr>
            <td></td>
            <td style='white-space:nowrap;'><h5>PPN Dipungut Distributor</h5></td>
             <td ></td>
          </tr>
          <tr>
            <td></td>
            <td style='white-space:nowrap;'><strong>Jumlah Keseluruhan</strong></td>
             <td ><strong>".number_format($jumlah_keseluruhan,2)."</strong></td>
          </tr>
          <tr>
            <td colspan='3'> <hr/></td>
          </tr>
          <tr>
            <td style='white-space:nowrap;' ><H6>*Faktur ini dikeluarkan secara elektronik sehingga tidak memerlukan tanda tangan &nbsp;&nbsp;&nbsp;(CDS, ".date("d-m-Y").") </H6></td>
            <td></td>
          </tr>
        </table>
      ";


      return $page;
    }

    private function loader(){
      $this->load->model("M_PembayaranFaktur");
    }
  }
?>
