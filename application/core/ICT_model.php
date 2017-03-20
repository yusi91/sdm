<?php
  class ICT_Model extends CI_Model{
    public function __construct(){
      parent::__construct();
      $this->scheme = "testing";
      $this->scheme_ctl = substr($this->scheme, 0, strlen($this->scheme) - 3)."CTL";
    }

    // PUBLIC SECTION
    public function checkInput($input){
        echo "<pre>";
        var_dump($input);
        die();
    }

    public $scheme;
    public $scheme_ctl;

    public function getHeadColumn($table){
      $field = $this->db->field_data($table);
      return $field;
    }

    public function getAllData($table, $selection = null, $filter = null, $sort = null, $joins = null, $group_by = null, $limit = null){
      //NOTES:
      //FORMAT $selection : "field_a, field_b, field_c,...."
      //FORMAT $filter : array(0 => array(0 => "SPECIFICATION", 1 = > "FIELD", 2 => "VALUE"))
      //FORMAT $sort : array(0 => array(0 => "FIELD", 1 = > "ASC / DESC"))
      //FORMAT $joins : array(0 => array("join_table" => "value", "join_on" => "value", "join_heading" => "value"))

      $select = "*";
      if($selection != null ){
        $select = $selection;
      }
      $this->db->select($select);
      $this->db->from($table);
      if($filter != null){
        $this->generateWhereFromFilter($filter);
      }
      if($sort != null){
        
        $this->generateSorting($sort);
      }
      if($joins != null){
        $this->generateJoin($joins);
      }
      if($group_by != null){
        $this->db->group_by($group_by);
      }
      if($limit != null ){
        $this->db->limit($limit);
      }
      
      $query = $this->db->get();
      return $query->result_array();
    }

    public function getData($table, $id){
      $query = $this->db->get_where($table, $id);
      return $query->row_array();
    }

    public function insertDataAutoIncrement($table, $input){
      $result = "";
      try {
        // $input = $this->setAuditInformation($input, 1); 

        $this->db->trans_begin(); 
        $this->db->insert($table, $input);
        $result = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE){$this->db->trans_rollback();}
        else{$this->db->trans_commit();}       

      } catch (Exception $e) {
        $this->session->set_flashdata($e);
      }

      return $result;
    }

    public function insertData($table, $input){
      $result = "";
      try {
        // $input = $this->setAuditInformation($input, 1); 

        $this->db->trans_begin(); 
        $this->db->insert($table, $input);

        if ($this->db->trans_status() === FALSE){$this->db->trans_rollback();}
        else{$this->db->trans_commit();}       

      } catch (Exception $e) {
        $this->session->set_flashdata($e);
      }

      return $result;
    }



    public function getQuery($table, $selection = null, $filter = null, $sort = null, $joins = null, $group_by = null, $limit = null){
      //NOTES:
      //FORMAT $selection : "field_a, field_b, field_c,...."
      //FORMAT $filter : array(0 => array(0 => "SPECIFICATION", 1 = > "FIELD", 2 => "VALUE"))
      //FORMAT $sort : array(0 => array(0 => "FIELD", 1 = > "ASC / DESC"))
      //FORMAT $joins : array(0 => array("join_table" => "value", "join_on" => "value", "join_heading" => "value"))

      $select = "*";
      if($selection != null ){
        $select = $selection;
      }
      $this->db->select($select);
      $this->db->from($table);
      if($filter != null){
        $this->generateWhereFromFilter($filter);
      }
      if($sort != null){
        
        $this->generateSorting($sort);
      }
      if($joins != null){
        $this->generateJoin($joins);
      }
      if($group_by != null){
        $this->db->group_by($group_by);
      }
      if($limit != null ){
        $this->db->limit($limit);
      }

      $this->checkInput($this->db->get_compiled_select());
      die();
    }

    public function update($table, $input, $where){
      try {
        // $input = $this->setAuditInformation($input, 2); 

        $this->db->trans_begin(); 
        $this->db->where($where);
        $this->db->update($table, $input); 

        if ($this->db->trans_status() === FALSE){$this->db->trans_rollback();}
        else{$this->db->trans_commit();} 

        return true;    
        
      } catch (Exception $e) {
        $this->session->set_flashdata($e);
        return false;
      }
    }

    public function delete($table, $where_id){
      try {
        $this->db->trans_begin(); 
        $this->db->where($where_id);
        $this->db->delete($table); 

        if ($this->db->trans_status() === FALSE){$this->db->trans_rollback();}
        else{$this->db->trans_commit();} 

        return true;    
        
      } catch (Exception $e) {
        $this->session->set_flashdata($e);
        return false;
      }
    }

    // PRIVATE SECTION
    private function generateJoin($joins){
      foreach ($joins as $value) {
        $this->db->join($value["join_table"], $value["join_on"], $value["join_heading"]);
      }
    }

    private function setAuditInformation($input, $audit_type){
      // NOTES:
      // type 1 = insert
      // type 2 = update

      // if($audit_type == 1){
      //   $input["torg"] = (isset($_SESSION["userinfo"]) && $_SESSION["userinfo"] != null ? $_SESSION["userinfo"]["id"] : "");
      //   $input["created_date"] = date("Y-m-d H:i:s");
      // }
      // else if($audit_type == 2){
      //   $input["user"] = (isset($_SESSION["userinfo"]) && $_SESSION["userinfo"] != null ? $_SESSION["userinfo"]["id"] : "");
      //   $input["updated_date"] = date("Y-m-d H:i:s");
      // }

      // return $input;

      return null;
    }

    private function generateWhereFromFilter($filters){
      foreach ($filters as $filter) {

        if($filter == null){continue;}

        if(strtoupper($filter[0]) == "LIKE"){
          $this->db->like($filter[1], $filter[2]);
          continue;
        }
        else if(strtoupper($filter[0]) == "EQUAL"){
          $this->db->where($filter[1], $filter[2]);
          continue;
        }
        else if(strtoupper($filter[0]) == "NOT_EQUAL"){
          $this->db->where($filter[1]." != ", $filter[2]);
          continue;
        }
        else if(strtoupper($filter[0]) == "LESS_OR_EQUAL"){
          $this->db->where($filter[1]." <= ", $filter[2]);
          continue;
        }
        else if(strtoupper($filter[0]) == "GREATER_OR_EQUAL"){
          $this->db->where($filter[1]." >= ", $filter[2]);
          continue;
        }
        else if(strtoupper($filter[0]) == "IN"){
          $this->db->where_in($filter[1], $filter[2]);
          continue;
        }
      }
    }

    private function generateSorting($sort){
      foreach ($sort as $data) {
        if($data == null){continue;}
        $this->db->order_by($data[0], $data[1]);
      }
    }



    public function julianToGregorian($julian){
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
            
            return $data['full_date'];
    }


    public function gregoriantoJulian($gregorian){
        $date=date('d',strtotime($gregorian));
        $month=date('m',strtotime($gregorian));
        $year=date('Y',strtotime($gregorian));
        
        $julian =($year*1000) - 1900000;
        $day=mktime(0,0,0,$month,$date,$year);
        $day2=date("z",$day);
        $julian= $julian + $day2;
        $julian2=$julian+1;


        return $julian2;
    }
  }
?>
