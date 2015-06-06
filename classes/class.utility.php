<?php

class utility {
	
    	static function pr($a) {
       		echo '<pre>';
       	 	print_r($a);
        	echo '</pre>';
    	}

	static function is_admin() {

		if( isset($_SESSION["PrivilegeTASH"]) && $_SESSION["PrivilegeTASH"] != 1) {
			die('You have access here');
		}
	}

	static function check_authentication() {

		if( isset($_SESSION["AccessTASH"]) && $_SESSION["AccessTASH"] == "yes") {
	    	} else {
			die('<p>You have no access here</p>');
	    	}
    	}

	static function create_token() {

		$cstrong = '!#87146APIlky@!*(&$2^*jniIhhln$6561P';
		for ($i = 1; $i <= 3; $i++) {
			$bytes = openssl_random_pseudo_bytes($i, $cstrong);
		       	$random_no = bin2hex($bytes);
		}
		return $random_no;
	}

    	static function vd($a) {
       		 echo '<pre>';
      	  	var_dump($a);
       		echo '</pre>';
    	}
    
    	static function is_post() {

		if( isset($_SERVER['REQUEST_METHOD']) && 
       			trim($_SERVER['REQUEST_METHOD']) != '' &&  
               		trim($_SERVER['REQUEST_METHOD']) == 'POST') {
			return true;
		} else {
			return false;
		}
    	}
	static function stockout($rows) {

		$tokenh = md5($rows["id"].$_SESSION["tsa_gong"]);
		$hash = array(
			0 => $tokenh
		);
		
		foreach($rows as $field=>$value) {

			if( $field != 'id' && $field != 'registerdate' && $field != 'defectname' && 
				$field != 'statusname' && $field != 'regionname' && $field != 'model' && $field != 'clientname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_text' id=\"stockout_$hash[0]_$rows[id]_$rows[$field]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'registerdate') {
				echo '<td>';
				echo date('Y-m-d H:i:s', $rows["$field"]);
				echo '</td>';
			}
			else if($field == 'clientname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"listclient_stockout_client_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'model') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"stock_stockout_stock_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'defectname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"defect_stockout_defect_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'statusname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"status_stockout_status_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'regionname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"listregion_stockout_region_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
		}
	}
	static function stockin($rows) {

		$tokenh = md5($rows["id"].$_SESSION["tsa_gong"]);
		$hash = array(
			0 => $tokenh
		);
		
		foreach($rows as $field=>$value) {

			if( $field != 'id' && $field != 'registerdate' && $field != 'defectname' && 
				$field != 'statusname' && $field != 'companyname' && $field != 'regionname' && $field != 'model') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_text' id=\"stockin_$hash[0]_$rows[id]_$rows[$field]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'registerdate') {
				echo '<td>';
				echo date('Y-m-d H:i:s', $rows["$field"]);
				echo '</td>';
			}
			else if($field == 'model') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"stock_stockin_stock_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'defectname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"defect_stockin_defect_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'statusname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"status_stockin_status_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'companyname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"listcompany_stockin_company_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'regionname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"listregion_stockin_region_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
		}
	}
	static function client($rows) {

		$tokenh = md5($rows["id"].$_SESSION["tsa_gong"]);
		$hash = array(
			0 => $tokenh
			);
	
		foreach($rows as $field=>$value) {
			if( $field != 'id' && $field != 'registerdate' && $field != 'planname' && $field != 'typename' && $field != 'regionname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_text' id=\"listclient_$hash[0]_$rows[id]_$rows[$field]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'registerdate') {
				echo '<td>';
				echo date('Y-m-d H:i:s', $rows["$field"]);
				echo '</td>';
			}
			else if($field == 'planname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"plan_listclient_plan_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'typename') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"type_listclient_type_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
			else if($field == 'regionname') {
				echo "<td><div class=\"$rows[id]$field\">";
				echo $rows["$field"];
				echo "<a href='#' class='edit_drop' id=\"listregion_listclient_region_$rows[id]_$hash[0]_$field\" style='font-size: 2em;'>&#9998;</a>";
				echo '</div></td>';
			}
		}
	}
}
