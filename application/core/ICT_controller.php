<?php
  class ICT_Controller extends CI_Controller{
    public function __construct(){
      parent::__construct();
      $this->isLogin();
    }
    public $err_message;

    public function checkInput($input){
        echo "<pre>";
        var_dump($input);
        die();
    }

    public function validateAllInput($input){
    	// NOTES:
    	// index 0 of input = RULE (required, maxsize, etc)
    	// index 1 of input = FIELD
    	// index 2 of input = VALUE
    	// index 3,4,5,... of input = FLAG for another validation

    	$no_error = true;

    	if($input != null && count($input) > 0){
    		foreach ($input as $field) {
    			if(strtoupper($field[0]) == "REQUIRED"){
    				$this->validateRequired($field[1], $field[2]);
    			}
                if(strtoupper($field[0]) == "EMPTYLIST"){
                    $this->listMustMoreThan1($field[1], $field[2]);
                }
    		}

    		if($this->err_message != null && count($this->err_message) > 0){
    			$this->session->set_flashdata("err_msg", $this->err_message);
    			$no_error = false;
    		}
    	}

    	return $no_error;
    }

    public function generateExcel($title,$fields,$datas){ 
      //title parameter must be string value 
      //fields parameter must be array value
      //datas parameter must be array on array value

      $this->load->library("ExcelPrint");

      //membuat objek
      $objPHPExcel = new PHPExcel();
      // Nama Field Baris Pertama

      $col = 0;
      foreach ($fields as $field)
      {
          $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
          $col++;
      }

      // Mengambil Data
      $row = 2;
      $no_row = 1;

      if($datas != null & count($datas) > 0){
        foreach ($datas as $data) {
            $col_data = 0;
            foreach ($data as $data_val) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col_data++, $row, $data_val);
            }
            $row++;
          }
      }
      $objPHPExcel->setActiveSheetIndex(0);

      //Set Title
      $objPHPExcel->getActiveSheet()->setTitle($title);

      //Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

      //Header
      header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
      header("Cache-Control: no-store, no-cache, must-revalidate");
      header("Cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

      //Nama File
      header('Content-Disposition: attachment;filename="'+$title+'.xlsx"');

      //Download
      $objWriter->save("php://output");
    }

    private function validateRequired($field_label, $value){
    	if($value == ""){
    		$this->err_message[] = "Field <strong>".$field_label."</strong> is Required";
    	}
    }

    private function listMustMoreThan1($field_label, $value){
        if(count($value)  <= 0){
            $this->err_message[] = "<strong>".$field_label."</strong> must more than 1";
        }
    }

    private function isLogin(){
        if(!isset($_SESSION["userinfo"]) || $_SESSION["userinfo"] == null){
            return redirect(base_url());
        }
    }


    public function julianToGregorian($julian)
    {
        $data['isposted'] = true;
        
        // $julian=$this->input->post('julian');
        $julian2 = $julian + 1900000;
        $year = substr($julian2,0,4);
        $totmonth = substr($julian2,4,3);

        $listmonth=[31,28,31,30,31,30,31,31,30,31,30,31];

        if($year%4==0)
        {
            $listmonth[1]=29;
        }
        $month=0;
        $day=0;
        for($i=0;$i<12;$i++)
        {
            $month++;
            
            if($totmonth - $listmonth[$i] <= 0)
            {
                $day=(int)$totmonth;
                break;
            }
            $totmonth = $totmonth-$listmonth[$i];
        }
            $data['year']=$year;
            $data['month']=$month;
            $data['day']=$day;
            $data['full_date'] = $day."-".$month."-".$year;
            
            return $data;
    }


    public function gregoriantoJulian($gregorian)
    {
        $date=date('d',strtotime($gregorian));
        $month=date('m',strtotime($gregorian));
        $year=date('Y',strtotime($gregorian));
        
        $julian =($year*1000) - 1900000;
        $day=mktime(0,0,0,$month,$date,$year);
        $day2=date("z",$day);
        $julian= $julian + $day2;
        $julian2=$julian+1;

        $data['julian']=$julian2;

        return $data;
    }

    public function generatePDFbyString($html, $title_name, $use_watermark = false, $use_page_number = false){
      $this->load->library("Pdf2");
      $mpdf=new mPDF('c');
      $mpdf->AddPage("portrait");

      if($use_watermark){
        $img_file = "assets/img/LOGO_SEMEN_BATURAJA.png";
        $mpdf->SetWatermarkImage($img_file);
        $mpdf->showWatermarkImage = true;
        $mpdf->watermarkImageAlpha = 0.07;
      }
      if($use_page_number){
        $mpdf->setFooter('{PAGENO}');  
      }

      $mpdf->WriteHTML($html);
      $mpdf->Output($title_name.".pdf","D");
    }

  }
	
?>
