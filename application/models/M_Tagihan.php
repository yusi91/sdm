<?php
  class M_Tagihan extends ICT_Model{
    public function __construct(){
      parent::__construct();
      $this->table = "W55RS05";
      $this->full_table = $this->scheme.".".$this->table;
    }

    private $table;
    private $full_table;

    //PUBLIC SECTION

    public function getF4311($po_numb){
      $table = $this->scheme.".F4311";
      $data_value["PDDOCO"] = $po_numb;
      $data_value["PDDCTO"] = "O8";
      $data_value["PDKCOO"] = "10201";
      $this->db->where($data_value);
      $query = $this->db->get($table);
      $result = $query->row_array();
// PDDSC1
      return $result;
    }
    
    public function getPreviousPONumber(){
      $table = $this->scheme.".F4311";
      $CARS = $_SESSION["userinfo"]["TKAN8"];
      $prev_number = "-";
      $this->db->select_max("PDDOCO");
      $this->db->where("PDAN8", $CARS);
      $query = $this->db->get($table);
      $result = $query->result_array();

      if($result != null && count($result) > 0 && $result[0]["PDDOCO"] != NULL){
        $prev_number = "10201-O8-".$result[0]["PDDOCO"];
      }
      
      return $prev_number;
    }

    public function prosesInputPO($list_do, $description){
      try {
        //get default data for insert to F55DO003, F55DO004, F4311, F4301
        $default_value = $this->setDefaultValue();
        //SETUP default value for each field on F55DO003 table, ex: 0 if field type is number, " " if field type is string
        $defaultF55DO003 = $this->getTableDefaultValue($this->scheme.".F55DO003");

        //initialize sum of qty, price, price per unit
        $total_qty = 0;
        $total_price = 0;
        $unit_list_price = 0;

        $temp_uom = "";
        //do insert to F55DO003
        foreach ($list_do as $do_numb) {
          $do = array("RSKCOO" => $do_numb[0], "RSDCTO" => $do_numb[1], "RSDOCO" => $do_numb[2]);
          $data_do = $this->getTagihanSingle($do);
          $this->insertF55DO003($default_value, $data_do, $defaultF55DO003);

          //calculate sum of qty and price
          $total_qty += $data_do["RSUORG"];
          $total_price += $data_do["RSTCST"];

          $temp_uom = $data_do["RSUOM"];
        }

        //calculate price per unit 
        $unit_list_price = $total_price/$total_qty;

        $total_data["unit_list_price"] = $unit_list_price ;
        $total_data["total_price"] = $total_price;
        $total_data["total_qty"] = $total_qty;

        $uom = "Z5";
        $flag02 = "Z";
        if($temp_uom == "KG"){
          $uom = "KG";
          $flag02 = "C";
        }

        //do insert to F55DO004, F4311 and F4301
        $this->insertF55DO004($total_data, $default_value, $description, $uom, $flag02);
        $this->insertF4311($total_data, $default_value, $description, $uom);
        $this->insertF4301($total_data, $default_value, $description, $uom);
        $this->updateFlagF55DO004($default_value);

        if ($this->db->trans_status() === FALSE){$this->db->trans_rollback();}
        else{$this->db->trans_commit();}       

      } catch (Exception $e) {
        $this->session->set_flashdata($e);
      }
    }

    public function getTagihans($filter = null, $sort = null){
      //get list of data expeditur using active record
      //code of getAllData method/function can be seen in ICT_Model.php

      $where = $this->generateWhere($filter);
      $where[] = array("EQUAL","RSCARS", $_SESSION["userinfo"]["TKAN8"] );

      $join = $this->generateJoinTable();
      $result = parent::getAllData($this->full_table, null, $where, $sort, $join);

      // $this->checkInput($this->db->last_query());
      // die();

      if($result != null && count($result) > 0){
        $result_gregorian = null;
        foreach ($result as $data) {
          $gregorian = parent::julianToGregorian($data["RSTRDJ"]);
          $data["RSTRDJ_GREGORIAN"] = $gregorian;
          $result_gregorian[] = $data;
        }
        return $result_gregorian;
      }
      return $result;
    }

    public function getTagihanSingle($filter = null){
      $where = $this->generateWhere($filter);
      $join = $this->generateJoinTable();
      
      $result = parent::getAllData($this->full_table, null, $where, null, $join);

      // $this->checkInput($this->db->last_query());die();
      if($result != null && count($result) > 0){
        $result_gregorian = null;
        foreach ($result as $data) {
          $gregorian = parent::julianToGregorian($data["RSTRDJ"]);
          $data["RSTRDJ_GREGORIAN"] = $gregorian;
          $result_gregorian[] = $data;
        }
        return $result_gregorian[0];
      }

      return $result;
    }

    public function getTagihan($do){
      $where_id["id"] = $id;
      return parent::getData($this->table, $where_id);
    }

    public function getF55DO005($CARS){
      $table = ".F55DO005";
      $table_full = $this->scheme.$table;
      $where = array("WOAN8" => $CARS);
      $query = $this->db->get_where($table_full, $where);

      return $query->row_array();
    }

    //PRIVATE SECTION
    private function getTableDefaultValue($table){
      $head_info = $this->getHeadColumn($table);
      $value_header = null;
      foreach ($head_info as $head_data) {
        $value = null;
        if($head_data->type == "NCHAR" || $head_data->type == "NVARCHAR" || $head_data->type == "NVARCHAR2"){
          $value = " ";
        }
        else if($head_data->type == "NUMBER"){
          $value = 0;
        }
        $value_header[$head_data->name] = $value;
      }

      return $value_header;
    }

    private function updateFlagF55DO004($default_value){
      $table = $this->scheme.".F55DO004";

      $where["DPDOCO"] = $default_value["NEXT_NUMBER_HEADER"];
      $where["DPDCTO"] = $default_value["type_header"];
      $where["DPKCOO"] = $default_value["co_header"];
      $value["DPFLAG01"] = "1";

      $this->db->where($where);
      $this->db->update($table, $where);
    }

    private function insertF4301($total_data, $default_value, $description, $uom){
      $table = $this->scheme.".F4301";
      $data_value = $this->getTableDefaultValue($table);

      $data_value["PHDOCO"] = $default_value["NEXT_NUMBER_HEADER"];
      $data_value["PHDCTO"] = $default_value["type_header"];
      $data_value["PHKCOO"] = $default_value["co_header"];
      $data_value["PHSFXO"] = $default_value["SFXO"];
      $data_value["PHMCU"] = "10201";
      $data_value["PHRCTO"] = "O8";
      $data_value["PHAN8"] = $default_value["CARS"];
      $data_value["PHSHAN"] = $default_value["SHAN"];
      $data_value["PHDRQJ"] = $default_value["DATENOW_JULIAN"];
      $data_value["PHTRDJ"] = $default_value["DATENOW_JULIAN"];
      $data_value["PHPDDJ"] = $default_value["PDDJ"];
      $data_value["PHOPDJ"] = $default_value["PDDJ"];
      $data_value["PHRMK"] = $description;
      $data_value["PHDESC"] = $description;
      $data_value["PHANBY"] = $default_value["ANBY"];
      $data_value["PHANCR"] = $default_value["ANCR"];
      $data_value["PHFUF1"] = $default_value["FUF1"];
      $data_value["PHOTOT"] = $total_data["total_price"] / 100;
      $data_value["PHAVCH"] = $default_value["AVCH"];
      $data_value["PHCRRM"] = $default_value["CRRM"];
      $data_value["PHCRCD"] = $default_value["CRCD"];
      $data_value["PHORBY"] = $default_value["USER"];
      $data_value["PHUSER"] = $default_value["USER"];
      $data_value["PHPID"] = $default_value["JOBN"];
      $data_value["PHJOBN"] = $default_value["JOBN"];
      $data_value["PHUPMJ"] = $default_value["DATENOW_JULIAN"];

      $data_value["PHFUF2"] = "Y";
      $data_value["PHPROM"] = "1";

      $this->db->insert($table, $data_value);
    }

    private function insertF4311($total_data, $default_value, $description, $uom){
      $table = $this->scheme.".F4311";
      $data_value = $this->getTableDefaultValue($table);

      $data_value["PDDOCO"] = $default_value["NEXT_NUMBER_HEADER"];
      $data_value["PDDCTO"] = $default_value["type_header"];
      $data_value["PDKCOO"] = $default_value["co_header"];
      $data_value["PDSFXO"] = $default_value["SFXO"];
      $data_value["PDLNID"] = $default_value["LNID"];
      $data_value["PDMCU"] = $default_value["MCU"];
      $data_value["PDCO"] = $default_value["CO"];
      $data_value["PDRCTO"] = $default_value["RCTO"];
      $data_value["PDAN8"] = $default_value["CARS"];
      $data_value["PDSHAN"] = $default_value["SHAN"];
      $data_value["PDDRQJ"] = $default_value["DATENOW_JULIAN"];
      $data_value["PDTRDJ"] = $default_value["DATENOW_JULIAN"];
      $data_value["PDPDDJ"] = $default_value["PDDJ"];
      $data_value["PDOPDJ"] = $default_value["PDDJ"];
      $data_value["PDDGL"] = $default_value["DATENOW_JULIAN"];
      $data_value["PDPN"] = $default_value["period_number"];
      $data_value["PDDSC1"] = $description;
      $data_value["PDLNTY"] = $default_value["LNTY"];
      $data_value["PDNXTR"] = $default_value["NXTR"];
      $data_value["PDLTTR"] = $default_value["LTTR"];
      $data_value["PDUOM"] = $default_value["UOM"];
      $data_value["PDUORG"] = $total_data["total_qty"];
      $data_value["PDUOPN"] = $total_data["total_qty"];
      $data_value["PDPRRC"] = $total_data["unit_list_price"];
      $data_value["PDAEXP"] = $total_data["total_price"] ;
      $data_value["PDAOPN"] = $total_data["total_price"] / 100;
      $data_value["PDANBY"] = $default_value["ANBY"];
      $data_value["PDANCR"] = $default_value["ANCR"];
      $data_value["PDUOM1"] = $default_value["UOM"];
      $data_value["PDPQOR"] = $total_data["total_qty"];
      $data_value["PDUOM2"] = $default_value["UOM"];
      $data_value["PDSQOR"] = $total_data["total_qty"];
      $data_value["PDUOM3"] = $default_value["UOM"];
      $data_value["PDGLC"] = $default_value["GLC"];
      $data_value["PDCTRY"] = $default_value["century"];
      $data_value["PDFY"] = $default_value["fiscal_year"];
      $data_value["PDSTTS"] = $default_value["STTS"];
      //$data_value["PDFUF1"] = $default_value["FUF1"];
      $data_value["PDFUF2"] = $default_value["FUF2"];
      $data_value["PDLT"] = $default_value["LT"];
      $data_value["PDANI"] = ($default_value["F55DO005"] != NULL?  $default_value["F55DO005"]["WOANI"]: "");
      $data_value["PDAID"] = ($default_value["F55DO005"] != NULL?  $default_value["F55DO005"]["WOAID"]: "");
      $data_value["PDOMCU"] = $default_value["OMCU"];
      $data_value["PDOBJ"] = ($default_value["F55DO005"] != NULL?  $default_value["F55DO005"]["WOOBJ"]: "");
      $data_value["PDSBLT"] = $default_value["SBLT"];
      $data_value["PDSBL"] = $default_value["SBL_FULL"];
      $data_value["PDCRCD"] = $default_value["CRCD"];

      $data_value["PDBALU"] = "N";
      $data_value["PDTX"] = "Y";
      $data_value["PDRATT"] = "F";
      $data_value["PDPROM"] = "1";
      $data_value["PDAVCH"] = "N";
      $data_value["PDUNCD"] = "N";
      $data_value["PDCHDT"] = "OP";
      $data_value["PDMOADJ"] = "0";

      $data_value["PDTORG"] = $default_value["USER"];
      $data_value["PDUSER"] = $default_value["USER"];
      // $data_value["PDPID"] = $default_value["JOBN"];
      $data_value["PDJOBN"] = $default_value["JOBN"];
      $data_value["PDUPMJ"] = $default_value["DATENOW_JULIAN"];
      $data_value["PDTDAY"] = $default_value["time"];
      $data_value["PDDLEJ"] = $default_value["DATENOW_JULIAN"];

      $this->db->insert($table, $data_value);
    }

    private function insertF55DO004($total_data, $default_value, $description, $uom, $flag02){
      $table = $this->scheme.".F55DO004";
      $data_value = $this->getTableDefaultValue($table);

      $data_value["DPDOCO"] = $default_value["NEXT_NUMBER_HEADER"];
      $data_value["DPDCTO"] = $default_value["type_header"];
      $data_value["DPKCOO"] = $default_value["co_header"];
      $data_value["DPLPRC"] = $total_data["unit_list_price"];
      $data_value["DPTCST"] = $total_data["total_price"];
      $data_value["DPAN01"] = $total_data["total_qty"] * 100;
      $data_value["DPPN"] = $default_value["period_number"];
      $data_value["DPDESC"] = $description;
      $data_value["DPUOM"] = $uom;
      $data_value["DPFLAG01"] = "1";
      $data_value["DPFLAG02"] = $flag02;
      $data_value["DPTORG"] = $default_value["USER"];
      $data_value["DPJOBN"] = $default_value["JOBN"];
      $data_value["DPUSER"] = $default_value["USER"];
      $data_value["DPPID"] = $default_value["JOBN"];
      $data_value["DPUPMT"] = $default_value["time"];
      $data_value["DPUPMJ"] = $default_value["DATENOW_JULIAN"];

      $this->db->insert($table, $data_value);
    }
    private function insertF55DO003($default_value, $data_do, $data_value){
        $table = $this->scheme.".F55DO003";
        $next_number = $this->getNextNumber($default_value["co_next"], $default_value["type_next"], $default_value["century"], $default_value["fiscal_year"] );
        $full_next_number = (1000000 * $default_value["fiscal_year"]) + $next_number;

        $data_value["DODOCO"] = $data_do["RSDOCO"];
        $data_value["DODCTO"] = $data_do["RSDCTO"];
        $data_value["DOKCOO"] = $data_do["RSKCOO"];
        $data_value["DOSRP1"] = $default_value["SALES_CATALOG_SECTION"];
        $data_value["DOTCST"] = $data_do["RSTCST"];
        $data_value["DOLPRC"] = ($data_do["RSLPRC"]);
        $data_value["DOLITM"] = $data_do["RSLITM"];
        $data_value["DOUOM"] = $data_do["RSUOM"];
        $data_value["DOCARS"] = $default_value["CARS"];
        $data_value["DOAN01"] = ($data_do["RSUORG"] * 100);
        $data_value["DODOC"] = $default_value["NEXT_NUMBER_HEADER"];
        $data_value["DODCT"] = $default_value["type_header"];
        $data_value["DOKCO"] = $default_value["co_header"];
        $data_value["DOODOC"] = $full_next_number;
        $data_value["DOIR01"] = $data_do["RSIR01"];
        $data_value["DOPN"] = $default_value["period_number"];
        $data_value["DOTRDJ"] = $data_do["RSTRDJ"];
        $data_value["DOLTTR"] = $default_value["LTTR"];
        $data_value["DONXTR"] = $default_value["NXTR"];
        $data_value["DOFLAG01"] = 1;
        // $data_value["DOLNID"] = $data_do["RSLNID"];
        $data_value["DOTORG"] = $default_value["USER"];
        $data_value["DOJOBN"] = $default_value["JOBN"];
        $data_value["DOUSER"] = $default_value["USER"];
        $data_value["DOPID"] = $default_value["JOBN"];
        $data_value["DOUPMJ"] = $default_value["DATENOW_JULIAN"];
        $data_value["DOUPMT"] = $default_value["time"];

        $this->db->insert($table, $data_value);
    }

    public function setDefaultValue(){
      $month = date("n");
      $year = date("Y");

      //TIME
      $default_value["period_number"] = $month;
      $default_value["century"] = substr($year, 0,2);
      $default_value["fiscal_year"] = substr($year, 2,2);
      $default_value["time"] = (int)date("His");

      //COMPANY & TYPE NEXT NUMBER DETAIL
      $default_value["co_next"] = "00000";
      $default_value["type_next"] = "FM";

      //COMPANY & TYPE NEXT NUMBER HEADER
      $default_value["co_header"] = "10201";
      $default_value["type_header"] = "O8";

      //KET OP
      $default_value["LNTY"] = "J";
      $default_value["LTTR"] = "280";
      $default_value["NXTR"] = "400";
      $default_value["UOM"] = "EA";

      //DEFAULT
      $default_value["SFXO"] = "000";
      $default_value["SHAN"] = 10201;
      $default_value["MCU"] = "       10201";
      $default_value["ANBY"] = 3022;
      $default_value["ANCR"] = 2010;
      $default_value["FUF1"] = "Y";
      $default_value["CRCD"] = "IDR";
      $default_value["CRRM"] = "D";
      $default_value["AVCH"] = "N";
      $default_value["PDDJ"] = (int)$this->gregoriantoJulian(date('Y-m-d', strtotime(' + 31 days')));
      $default_value["LNID"] = 1000;
      $default_value["GLC"] = "N240";
      $default_value["STTS"] = " ";
      $default_value["FUF1_1"] = " ";
      $default_value["FUF2"] = " ";
      $default_value["DLT"] = " ";
      $default_value["LT"] = " ";
      $default_value["OMCU"] = "       10201";
      $default_value["RCTO"] = "O4";
      $default_value["UOM"] = "EA";
      $default_value["SBLT"] = "R";
      $default_value["BALU"] = " ";
      $default_value["RATT"] = " ";
      $default_value["CO"] = " ";

      //AUDIT INFORMATION
      $default_value["DATENOW_JULIAN"] = (int)$this->gregoriantoJulian(date('Y-m-d'));
      $default_value["USER"] = $_SESSION["userinfo"]["TKUSER"];
      $default_value["CARS"] = (int)$_SESSION["userinfo"]["TKAN8"];
      $default_value["PROGRAM_NAME"] = "TDS_NEW";
      $default_value["JOBN"] = "MUSI";

      //TAMBAHAN
      $default_value["SALES_CATALOG_SECTION"] = 2;

      $default_value["F55DO005"]  = $this->getF55DO005($default_value["CARS"]);
      $sbl = "";
      if($default_value["F55DO005"] != NULL){
        $counter_length = 8 - strlen(trim($default_value["F55DO005"]["WOSBL"])) ;
        for($i = 0; $i < $counter_length; $i++){
          $sbl .= "0";
        }
        $sbl .= trim($default_value["F55DO005"]["WOSBL"]);
      }
      $default_value["SBL_FULL"] = (string)$sbl;      

      //NEXT NUMBER HEADER
      $next_number_header = (int)$this->getNextNumber($default_value["co_header"], $default_value["type_header"], $default_value["century"], $default_value["fiscal_year"] );
      $full_next_number_header = ($default_value["fiscal_year"] * 1000000) + $next_number_header;
      $default_value["NEXT_NUMBER_HEADER"] = $full_next_number_header;

      return $default_value;
    }

    private function getNextNumber($co_code, $type_code, $century, $fiscal_year){
      $table = ".F00021";
      $table_full = $this->scheme_ctl.$table;
      $where = array("NLKCO" => $co_code,
        "NLDCT" => $type_code,
        "NLCTRY" => $century,
        "NLFY" => $fiscal_year,
        );
      $query = $this->db->get_where($table_full, $where);
      $result = $query->row_array();
      $next_number = $result["NLN001"];
      $this->updateNextNumber($co_code, $type_code, $century, $fiscal_year, $next_number);

      return $next_number;
    }

    private function updateNextNumber($co_code, $type_code, $century, $fiscal_year, $current_number){
      $table = ".F00021";
      $table_full = $this->scheme_ctl.$table;
      $where = array("NLKCO" => $co_code,
        "NLDCT" => $type_code,
        "NLCTRY" => $century,
        "NLFY" => $fiscal_year,
        );
      $value = array("NLN001" => ($current_number + 1));
      $this->db->where($where);
      $this->db->update($table_full, $value);
    }

    private function generateJoinTable(){
      $F55DO003 = "
        (
          SELECT A.* FROM ".$this->scheme.".F55DO003 A
          INNER JOIN 
          (
              SELECT MAX(DODOC) AS DODOC , DODOCO,DODCTO,DOKCOO
              FROM ".$this->scheme.".F55DO003
              GROUP BY DODOCO,DODCTO,DOKCOO
              ORDER BY DODOCO
          ) B
          ON A.DODOC = B.DODOC AND A.DODOCO = B.DODOCO AND A.DODCTO = B.DODCTO AND A.DOKCOO = B.DOKCOO
        )
      ";

      $JOIN_SHAN = "
        (SELECT ABAN8 AS SHAN_CODE, ABALPH AS SHAN_DESC FROM ".$this->scheme.".F0101)
      ";

      $JOIN_EMCU = "
        (SELECT ABAN8 AS EMCU_CODE, ABALPH AS EMCU_DESC FROM ".$this->scheme.".F0101)
      ";

      $join[] = array("join_table"=> $F55DO003, "join_on" => "RSDOCO = DODOCO AND RSDCTO = DODCTO AND RSKCOO = DOKCOO  ","join_heading"=>"left" );
      $join[] = array("join_table"=> $this->scheme.".F4311", "join_on" => "DODOC=PDDOCO AND DODCT=PDDCTO AND DOKCO=PDKCOO ","join_heading"=>"left" );
      $join[] = array("join_table"=> $JOIN_SHAN, "join_on" => "RSSHAN = SHAN_CODE","join_heading"=>"left" );
      $join[] = array("join_table"=> $JOIN_EMCU, "join_on" => "RSEMCU = EMCU_CODE","join_heading"=>"left" );

      return $join;
    }

    private function generateWhere($filter){
      $where = null;
      // array(0 => "SPECIFICATION", 1 = > "FIELD", 2 => "VALUE"))
      if(isset($filter["RSTRDJ_FROM"]) && $filter["RSTRDJ_FROM"] != ""){
        $julian = $this->gregoriantoJulian($filter["RSTRDJ_FROM"]);
        $where[] = array("GREATER_OR_EQUAL","RSTRDJ", (int)$julian);  
      }
      if(isset($filter["RSTRDJ_TO"]) && $filter["RSTRDJ_TO"] != ""){
        $julian = $this->gregoriantoJulian($filter["RSTRDJ_TO"]);
        $where[] = array("LESS_OR_EQUAL","RSTRDJ", (int)$julian);  
      }
      if(isset($filter["RSKCOO"]) && $filter["RSKCOO"] != ""){
        $where[] = array("EQUAL","RSKCOO", $filter["RSKCOO"] );  
      }
      if(isset($filter["JenisSemen"]) && $filter["JenisSemen"] != ""){
        $RSUOM = "";
        if($filter["JenisSemen"] == "z"){
          $RSUOM = array("Z5","Z4");  
        } 
        else{
          $RSUOM = array("KG");
        }

        $where[] = array("IN","RSUOM", $RSUOM );  
      }

      if(isset($filter["RSKCOO"]) && $filter["RSKCOO"] != ""){
        $where[] = array("EQUAL","RSKCOO", $filter["RSKCOO"]);  
      }
      if(isset($filter["RSDCTO"]) && $filter["RSDCTO"] != ""){
        $where[] = array("EQUAL","RSDCTO", $filter["RSDCTO"]);  
      }
      if(isset($filter["RSDOCO"]) && $filter["RSDOCO"] != ""){
        $where[] = array("EQUAL","RSDOCO", $filter["RSDOCO"]);  
      }

      return $where;
    }

    private function generateWherePO($filter){
      $where = " WHERE 1 = 1 ";
      // array(0 => "SPECIFICATION", 1 = > "FIELD", 2 => "VALUE"))
      if($filter["RSTRDJ_FROM"] != ""){
        $julian = $this->gregoriantoJulian($filter["RSTRDJ_FROM"]);
        $where .= " AND RSTRDJ >= ".(int)$julian;
      }
      if($filter["RSTRDJ_TO"] != ""){
        $julian = $this->gregoriantoJulian($filter["RSTRDJ_TO"]);
        $where .= " AND RSTRDJ <= ".(int)$julian;
      }
      if($filter["RSKCOO"] != ""){
        $where .= " AND RSKCOO = ".$filter["RSKCOO"];
      }
      if($filter["JenisSemen"] != ""){
        $RSUOM = "";
        if($filter["JenisSemen"] == "z"){
          $where .= " AND RSUOM in ('Z5','Z4') ";
        } 
        else{
          $where .= " AND RSUOM in ('KG') ";
        }
      }
      
      return $where;
    }


  }
?>
