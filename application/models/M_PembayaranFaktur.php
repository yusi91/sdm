<?php 
	class M_PembayaranFaktur extends ICT_Model{
		public function __construct(){
			parent::__construct();
			$this->table = "f03b14_3bln";
		}

		public $table;

		//public section
		public function getAllDataPembayaranFaktur($filter, $sort){
		    $where = $this->generateWhereTable($filter);
		    $result = null;
		    // $select_field = "rzpyid,rzcknu,rzrc5,rzkco,rzdct,rzdoc,rzan8,rzsfx,rzdmtj,rzdgj,rzpaap,rzddj,rzidgj,rzan8_kode,rzan8_nama, rpryin, rpag, rpaap";
		    $select_field = "rzpyid,rzcknu,rzrc5,rzkco,rzdct,rzdoc,rzan8,rzsfx,rzdmtj,rzdgj,rzpaap,rzddj,rzidgj,rzan8_kode,rzan8_nama";
		    //join section
		    $join_rzan8 = "(SELECT kode AS rzan8_kode, nama AS rzan8_nama FROM address_book) join_rzan8";
		    $join[] = array("join_table"=> $join_rzan8, "join_on" => "rzan8 = rzan8_kode","join_heading"=>"left" );
		    // $join[] = array("join_table"=> "F03B11_3bln", "join_on" => "rzkco = rpkco AND rzdct = rpdct AND rzdoc = rpdoc ","join_heading"=>"left" );
		    
		    //END join section
		    $result = parent::getAllData($this->table, $select_field , $where, $sort, $join);
		    return $result;
		}

		public function getHeaderInvoice($filter){
			//where section----------------------------------------
			$where[] = array("EQUAL","rpkco", (int)$filter["rpkco"]);  
			$where[] = array("EQUAL","rpdct", $filter["rpdct"]);  
			$where[] = array("EQUAL","rpdoc", (int)$filter["rpdoc"]);  

			$join_rpan8 = "(SELECT kode AS rpan8_kode, nama AS rpan8_nama FROM address_book) join_rpan8";
		    $join[] = array("join_table"=> $join_rpan8, "join_on" => "rpan8 = rpan8_kode","join_heading"=>"left" );
		    $join[] = array("join_table"=> "f0116", "join_on" => "rpan8 = alan8","join_heading"=>"left" );

		    $result_db = parent::getAllData("F03B11_3bln", null , $where, null, $join);
		    return $result_db[0];
		}

		public function getF03B11_3bln($filter, $all_field = false){
			$select_field = "rpdoc, rpdct, rpkco, rpsfx, rpan8, rpdivj, rpag, rpaap, rpddj, rpryin, last_update ";
			if($all_field){
				$select_field = null;
			}

			$result = null;
			//where section----------------------------------------
			$where[] = array("EQUAL","rpkco", (int)$filter["rpkco"]);  
			$where[] = array("EQUAL","rpdct", $filter["rpdct"]);  
			$where[] = array("EQUAL","rpdoc", (int)$filter["rpdoc"]);  
			// $where[] = array("EQUAL","rpan8", $filter["rpan8"]);  
			//-----------------------------------------------------
			//join section-----------------------------------------------------------------------------------------------
			$join_rpan8 = "(SELECT kode AS rpan8_kode, nama AS rpan8_nama FROM address_book) join_rpan8";
		    $join[] = array("join_table"=> $join_rpan8, "join_on" => "rpan8 = rpan8_kode","join_heading"=>"left" );
		    //-----------------------------------------------------------------------------------------------------------
		    $result_db = parent::getAllData("F03B11_3bln", $select_field , $where, null, $join);

		    //binding data for JSON format
		    //------initialize variable------------
		    $result_json["no_faktur"] = "-";
		    $result_json["line_no"] = "-";
		    $result_json["jenis_bayar"] = "-";
		    $result_json["tanggal_faktur"] = "-";
		    $result_json["jatuh_tempo"] = "-";
		    $result_json["nilai_faktur"] = "0";
		    $result_json["nilai_open"] = "0";
		    $result_json["last_update"] = "0";
		    //-------------------------------------
		    //--------set value from DB if has value----------------
		    if($result_db != null && count($result_db) > 0){
		    	//list di CDS lama cuma 3,5,9
				$list_jenis_bayar["3"] = "Tunai";
				$list_jenis_bayar["5"] = "DF";
				$list_jenis_bayar["9"] = "Kredit";
				//list jenis bayar di cds yang baru
				$list_jenis_bayar["1"] = "Transfer";
				$list_jenis_bayar["2"] = "Tunai Berjangka";
				$list_jenis_bayar["6"] = "Askredag";

				if($result_db[0]["rpdoc"] != null && trim($result_db[0]["rpdoc"]) != ""){
					$result_json["no_faktur"] = trim($result_db[0]["rpkco"])."-".trim($result_db[0]["rpdct"])."-".trim($result_db[0]["rpdoc"]);
				}
				if($result_db[0]["rpsfx"] != null && trim($result_db[0]["rpsfx"]) != ""){
					$result_json["line_no"] = trim($result_db[0]["rpsfx"]);
				}
				if($result_db[0]["rpryin"] != null && trim($result_db[0]["rpryin"]) != "" && array_key_exists ( trim($result_db[0]["rpryin"]) , $list_jenis_bayar )){
					$result_json["jenis_bayar"] =  $list_jenis_bayar[trim($result_db[0]["rpryin"])];
				}
				if($result_db[0]["rpdivj"] != null && trim($result_db[0]["rpdivj"]) != ""){
					$result_json["tanggal_faktur"] = date("d-m-Y", strtotime($result_db[0]["rpdivj"]));
				}
				if($result_db[0]["rpddj"] != null && trim($result_db[0]["rpddj"]) != ""){
					$result_json["jatuh_tempo"] = date("d-m-Y", strtotime($result_db[0]["rpddj"]));
				}
				if($result_db[0]["rpag"] != null){
					$result_json["nilai_faktur"] = $result_db[0]["rpag"];
				}
				if($result_db[0]["rpaap"] != null){
					$result_json["nilai_open"] = $result_db[0]["rpaap"];
				}
				if($result_db[0]["last_update"] != null && trim($result_db[0]["last_update"]) != ""){
					$result_json["last_update"] = date("d-m-Y", strtotime($result_db[0]["last_update"]));
				}
		    }
		    //------------------------------------------------------
		    
		    return $result_json;
		}


		// select lokasi, sddcto, sddoco, sdan8, sdshan, tanggal, jenis, kota, sdryin, penjualan, last_update,sduorg,sduom,sduprc,sdcars,sdir01,sdsrp1  from realisasi_spj04_a_3bln where sdan8 = '$kode' and sddct = '$dct' and sddoc = '$doc' and sdkco = '$kco'
		public function getRealisasi_spj04_a_3bln($filter){
			$select_field = "lokasi, sddcto, sddoco, sdan8, sdshan, tanggal, jenis, kota, sdryin, penjualan, last_update,sduorg,sduom,sduprc,sdcars,sdir01,sdsrp1,sdan8_nama,kota_nama, sdshan_nama, sdcars_nama ";
			$result = null;
			//where section----------------------------------------
			$where[] = array("EQUAL","sdkco", (int)$filter["sdkco"]);  
			$where[] = array("EQUAL","sddct", $filter["sddct"]);  
			$where[] = array("EQUAL","sddoc", (int)$filter["sddoc"]); 
			//-----------------------------------------------------
			//join section-----------------------------------------------------------------------------------------------
			$join_sdan8 = "(SELECT kode AS sdan8_kode, nama AS sdan8_nama FROM address_book) join_sdan8";
		    $join[] = array("join_table"=> $join_sdan8, "join_on" => "sdan8 = sdan8_kode","join_heading"=>"left" );

		    $join_kota = "(SELECT kode AS kota_kode, nama AS kota_nama FROM address_book) join_kota";
		    $join[] = array("join_table"=> $join_kota, "join_on" => "kota = kota_kode","join_heading"=>"left" );

		    $join_sdshan = "(SELECT kode AS sdshan_kode, nama AS sdshan_nama FROM address_book) join_sdshan";
		    $join[] = array("join_table"=> $join_sdshan, "join_on" => "sdshan = sdshan_kode","join_heading"=>"left" );

		    $join_sdcars = "(SELECT kode AS sdcars_kode, nama AS sdcars_nama FROM address_book) join_sdcars";
		    $join[] = array("join_table"=> $join_sdcars, "join_on" => "sdcars = sdcars_kode","join_heading"=>"left" );
		    //-----------------------------------------------------------------------------------------------------------
		    $result_db = parent::getAllData("realisasi_spj04_a_3bln", $select_field , $where, null, $join);

		    //binding data for JSON format
		    //--------set value from DB if has value----------------
		    if($result_db != null && count($result_db) > 0){
		    	//list jenis bayar
		    	//list di CDS lama cuma 3,5,9
				$list_jenis_bayar["3"] = "Tunai";
				$list_jenis_bayar["5"] = "DF";
				$list_jenis_bayar["9"] = "Kredit";
				//list jenis bayar di cds yang baru
				$list_jenis_bayar["1"] = "Transfer";
				$list_jenis_bayar["2"] = "Tunai Berjangka";
				$list_jenis_bayar["6"] = "Askredag";
				//----------------------------------------------
				//list jenis angkut
				$list_jenis_angkut["S4"] = "Franco";
				$list_jenis_angkut["SO"] = "AS";
				//----------------------------------------------
				//list satuan
				$list_satuan["Z5"] = "Zak 50 Kg";
				$list_satuan["Z4"] = "Zak 40 Kg";
				$list_satuan["TN"] = "TON";
				$list_satuan["KG"] = "KG";

		    	$list_result = null;
		    	foreach ($result_db as $key => $value) {
		    		$ket = "Pending";
		    		if($value["sdsrp1"] == 2){
		    			$ket = "Release";
		    		}

		    		$value_result["no_spj"] = ($value["sddoco"] != null && trim($value["sddoco"]) != ""? trim($value["lokasi"])."-".trim($value["sddcto"])."-".trim($value["sddoco"]):"-");
				    $value_result["tujuan"] = ($value["sdshan"] != null && trim($value["sdshan"]) != ""? trim($value["sdshan_nama"]):"-");
				    $value_result["tgl_spj"] = ($value["tanggal"] != null && trim($value["tanggal"]) != ""? date("d-m-Y", strtotime($value["tanggal"])):"-");
				    $value_result["kota_tujuan"] = ($value["kota"] != null && trim($value["kota"]) != ""? trim($value["kota_nama"]):"-");
				    $value_result["bayar"] = ($value["sdryin"] != null && trim($value["sdryin"] ) != "" && array_key_exists ( $value["sdryin"]  , $list_jenis_bayar )? $list_jenis_bayar[trim($value["sdryin"])] :"-");
				    $value_result["kuantiti"] = ($value["sduorg"] != null && trim($value["sduorg"]) != ""? trim($value["sduorg"]):0);
				    $value_result["satuan"] = ($value["sduom"] != null && trim($value["sduom"] ) != "" && array_key_exists ( $value["sduom"]  , $list_satuan )? $list_satuan[trim($value["sduom"])] :"-");
				    $value_result["harga_satuan"] = ($value["sduprc"] != null && trim($value["sduprc"]) != ""? number_format($value["sduprc"],2) : number_format(0,2) );;
				    $value_result["harga_tebus"] = ($value["penjualan"] != null && trim($value["penjualan"]) != ""? number_format($value["penjualan"],2) : number_format(0,2) );;
				    $value_result["angkut"] = ($value["sddcto"] != null && trim($value["sddcto"]) != ""  && array_key_exists ( trim($value["sddcto"])  , $list_jenis_angkut )? $list_jenis_angkut[trim($value["sddcto"])] :"-");
				    $value_result["nopol"] = ($value["sdir01"] != null && trim($value["sdir01"]) != ""? trim($value["sdir01"]):"-");
				    $value_result["ekspeditur"] =  ($value["sdcars"] != null && trim($value["sdcars"]) != ""? trim($value["sdcars_nama"]):"-");
				    $value_result["ket"] = $ket;

				    $list_result[] = $value_result;
		    	}
		    }
		    //------------------------------------------------------
		    return $list_result;
		}

		public function getDataInvoice($filter){
			//Find List DO by Invoice Number!!!
			$list_data = $this->getHargaRealisasi_spj04_a_3bln_ByInvoice($filter);
			$calculated_data = $this->calculatePrice($list_data);

			return $calculated_data;
		}  

		//private section
		private function calculatePrice($list_data){
			$result =  null;

			//list jenis semen------------------------------------------------
			//OPC
			$list_jenis_semen['550'] = "SEMEN BUNGKUS OPC(50 KG)";
			$list_jenis_semen['540'] = "SEMEN BUNGKUS OPC(40 KG)";
			$list_jenis_semen['530'] = "SEMEN OPC CURAH";
			$list_jenis_semen['580'] = "SEMEN OPC BIG BAG";
			//PCC
			$list_jenis_semen['551'] = "SEMEN BUNGKUS PCC(50 KG)";
			$list_jenis_semen['541'] = "SEMEN BUNGKUS PCC(40 KG)";
			$list_jenis_semen['531'] = "SEMEN PCC CURAH";
			$list_jenis_semen['581'] = "SEMEN PCC BIG BAG";
			//----------------------------------------------------------------

			if($list_data != null){
				foreach ($list_data as $key => $value) {
					$data = $value;
					$jenis_semen_desc = "-";
					if(array_key_exists($value["jenis"], $list_jenis_semen)){
						$jenis_semen_desc = $list_jenis_semen[$value["jenis"]] ;
					}
					$data["jenis_semen_desc"] = $jenis_semen_desc;

					$total_aexp = $value["penjualan"] / 1.1025;
					$ppn = $total_aexp * 0.1;
					$pph = $ppn * 0.025;
					$harga_pabrik = $value["penjualan"] - $ppn - $pph - $value["ongkos_angkut"] - $value["biaya_susun"];
					$data["harga_pabrik"] = $harga_pabrik;
					$data["ppn"] = $ppn;
					$data["pph"] = $pph;

					$result[] = $data;
				}
			}
			return $result;
		}

		private function getHargaRealisasi_spj04_a_3bln_ByInvoice($filter){
			$table = "realisasi_spj04_a_3bln";

			//select section
			$select = "
			sum(ongkos_angkut) as ongkos_angkut, 
			sum(penjualan) as penjualan,
			(sum(ecaexp) / 100) as biaya_susun,
			jenis
			 ";
			//where section
			$where[] = array("EQUAL","sdkco", (int)$filter["sdkco"]);  
			$where[] = array("EQUAL","sddct", $filter["sddct"]);  
			$where[] = array("EQUAL","sddoc", (int)$filter["sddoc"]); 
			//join section
		    $join[] = array("join_table"=> "f5842013", "join_on" => " lokasi = eckcoo AND sddcto = ecdcto AND sddoco = ecdoco ","join_heading"=>"left" );
		    //sort section
		    $sort[] = array("jenis","ASC");
		    //group by section
		    $group_by = array("jenis");

			$result_db = parent::getAllData($table, $select , $where, $sort, $join, $group_by);
			return $result_db;
		}

		private function generateWhereTable($filter){
	      $where = null;
	      if(isset($filter["rzan8"]) && $filter["rzan8"] != ""){
	        $where[] = array("EQUAL","rzan8", $filter["rzan8"]);  
	      }
	      if(isset($filter["rzdmtj_from"]) && $filter["rzdmtj_from"] != ""){
	      	$rzdmtj_from = date("Y-m-d",strtotime( $filter["rzdmtj_from"]));
	        $where[] = array("GREATER_OR_EQUAL","rzdmtj", $rzdmtj_from);  
	      }
	      if(isset($filter["rzdmtj_to"]) && $filter["rzdmtj_to"] != ""){
	      	$rzdmtj_to = date("Y-m-d",strtotime( $filter["rzdmtj_to"]));
	        $where[] = array("LESS_OR_EQUAL","rzdmtj", $rzdmtj_to);  
	      }
	      return $where;
	    }
	}
?>