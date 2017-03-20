<?php
  class M_LihatData extends ICT_Model{
    public function __construct(){
      parent::__construct();
      $this->table = "W55RS05";
      $this->full_table = $this->scheme.".".$this->table;
    }

    private $table;
    private $full_table;

    //PUBLIC SECTION
    public function getW55RS05($filter = null, $sort = null){
      //get list of data expeditur using active record
      //code of getAllData method/function can be seen in ICT_Model.php

      $where = $this->generateWhere($filter);
      $where[] = array("EQUAL","RSCARS", $_SESSION["userinfo"]["TKAN8"] );

      $JOIN_SHAN = "(SELECT ABAN8 AS SHAN_CODE, ABALPH AS SHAN_DESC FROM ".$this->scheme.".F0101)";
      $JOIN_EMCU = "(SELECT ABAN8 AS EMCU_CODE, ABALPH AS EMCU_DESC FROM ".$this->scheme.".F0101)";
      $join[] = array("join_table"=> $JOIN_SHAN, "join_on" => "RSSHAN = SHAN_CODE","join_heading"=>"left" );
      $join[] = array("join_table"=> $JOIN_EMCU, "join_on" => "RSEMCU = EMCU_CODE","join_heading"=>"left" );

      $result = parent::getAllData($this->full_table, null, $where, $sort, $join);
      
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

    public function getListTagihan($filter = null, $sort = null){
      //get list of data expeditur using active record
      //code of getAllData method/function can be seen in ICT_Model.php
      $table = $this->scheme.".F4311";

      $where = $this->generateWhere($filter);
      $DPFLAG02 = array("Z","C");
      $where[] = array("EQUAL","PDAN8", $_SESSION["userinfo"]["TKAN8"] );
      $where[] = array("IN","DPFLAG02", $DPFLAG02 );

       $F43121 = "
        (
          SELECT A.* FROM ".$this->scheme.".F43121 A
          INNER JOIN 
          (
              SELECT MAX(PRTRDJ) AS PRTRDJ, MAX(PRTDAY) AS PRTDAY , PRDOCO, PRDCTO, PRKCOO
              FROM ".$this->scheme.".F43121
              GROUP BY PRDOCO, PRDCTO, PRKCOO
              ORDER BY PRDOCO
          ) B
          ON A.PRDOCO = B.PRDOCO 
          AND A.PRDCTO = B.PRDCTO 
          AND A.PRKCOO = B.PRKCOO 
          AND A.PRTRDJ = B.PRTRDJ
          AND A.PRTDAY = B.PRTDAY
        )
      ";

      $join[] = array("join_table"=> $this->scheme.".F55DO004", "join_on" => "PDDOCO = DPDOCO AND PDDCTO = DPDCTO AND PDKCOO = DPKCOO","join_heading"=>"left" );
      $join[] = array("join_table"=> $F43121, "join_on" => "PRDOCO = DPDOCO AND PRDCTO = DPDCTO AND PRKCOO = DPKCOO","join_heading"=>"left" );
      $result = parent::getAllData($table, null, $where, $sort, $join);

      // $this->checkInput($this->db->last_query());
      // die();

      if($result != null && count($result) > 0){
        $result_gregorian = null;
        foreach ($result as $data) {
          $gregorian = parent::julianToGregorian($data["PDTRDJ"]);
          $data["PDTRDJ_GREGORIAN"] = $gregorian;
          $result_gregorian[] = $data;
        }
        return $result_gregorian;
      }
      return $result;
    }

    public function getListDObyPO($splited_po_number){
      //get list of data expeditur using active record
      //code of getAllData method/function can be seen in ICT_Model.php
      $list_semen["550"] = "Zak OPC 50 Kg";
      $list_semen["551"] = "Zak PCC 50 Kg";
      $list_semen["540"] = "Zak PCC 40 Kg";
      $list_semen["580"] = "Big Bag OPC";
      $list_semen["581"] = "Big Bag PCC";
      $list_semen["530"] = "Curah OPC";
      $list_semen["531"] = "Curah PCC";

      $where[] = array("EQUAL","DODOC", $splited_po_number[2]);
      $where[] = array("EQUAL","DODCT", $splited_po_number[1]);
      $where[] = array("EQUAL","DOKCO", $splited_po_number[0]);

      $JOIN_SHAN = "
        (SELECT ABAN8 AS SHAN_CODE, ABALPH AS SHAN_DESC FROM ".$this->scheme.".F0101)
      ";

      $JOIN_EMCU = "
        (SELECT ABAN8 AS EMCU_CODE, ABALPH AS EMCU_DESC FROM ".$this->scheme.".F0101)
      ";

      $join[] = array("join_table"=> $this->scheme.".F55DO003", "join_on" => "RSDOCO = DODOCO AND RSDCTO = DODCTO AND RSKCOO = DOKCOO  ","join_heading"=>"inner" );
      // $join[] = array("join_table"=> $this->scheme.".F0101", "join_on" => "RSAN8 = ABAN8","join_heading"=>"left" );
      $join[] = array("join_table"=> $JOIN_SHAN, "join_on" => "RSSHAN = SHAN_CODE","join_heading"=>"left" );
      $join[] = array("join_table"=> $JOIN_EMCU, "join_on" => "RSEMCU = EMCU_CODE","join_heading"=>"left" );
      $sort[] = array("RSDOCO","ASC");

      $result = parent::getAllData($this->full_table, null, $where, $sort, $join);

      if($result != null && count($result) > 0){
        $result_gregorian = null;
        foreach ($result as $data) {
          $gregorian = parent::julianToGregorian($data["RSTRDJ"]);
          $data["RSTRDJ_GREGORIAN"] = $gregorian;
          $data["RSLITM_DESC"] = $list_semen["".trim($data["RSLITM"])];
          $result_gregorian[] = $data;
        }
        return $result_gregorian;
      }
      return $result;
    }

    //PRIVATE SECTION
    private function generateJoinTable(){
      $join[] = array("join_table"=> $this->scheme.".F55DO003", "join_on" => "RSDOCO = DODOCO AND RSDCTO = DODCTO AND RSKCOO = DOKCOO  ","join_heading"=>"inner" );
      $join[] = array("join_table"=> $this->scheme.".F4311", "join_on" => "DODOC=PDDOCO AND DODCT=PDDCTO AND DOKCO=PDKCOO ","join_heading"=>"left" );

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
      if(isset($filter["PDTRDJ_FROM"]) && $filter["PDTRDJ_FROM"] != ""){
        $julian = $this->gregoriantoJulian($filter["PDTRDJ_FROM"]);
        $where[] = array("GREATER_OR_EQUAL","PDTRDJ", (int)$julian);  
      }
      if(isset($filter["PDTRDJ_TO"]) && $filter["PDTRDJ_TO"] != ""){
        $julian = $this->gregoriantoJulian($filter["PDTRDJ_TO"]);
        $where[] = array("LESS_OR_EQUAL","PDTRDJ", (int)$julian);  
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
  }
?>
