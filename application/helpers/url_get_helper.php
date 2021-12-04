<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_get_url')){
	function is_get_url($data){
		$CI =& get_instance();
		$CI->load->model('common_model');

		// $link = base64_decode($data);
		$link = explode('/', base64_decode($data));

		$data = $CI->common_model->db_select_cond('nd_menu_detail','controller',$link[0]," AND page_link = '".$link[1]."' ");
		foreach ($data as $row) {
			$menu_id = $row->menu_id;
		}
		$result = $CI->common_model->db_select_cond('nd_menu','id', $menu_id,'');
		foreach ($result as $row) {
			$link[0] = $row->nama_id;
		}
		return $link; 
	}
}

if ( ! function_exists('get_color_toko')){
	function get_color_toko(){
		$CI =& get_instance();
		$CI->load->model('common_model');

		$colorToko = [];
		foreach ($CI->common_model->db_select("nd_toko") as $row) {
			if ($row->color_code == '') {
				$row->color_code = '#fff';
			}
			$colorToko[$row->id] = $row->color_code;
		}
		return $colorToko; 
	}
}


if ( ! function_exists('is_piutang_alert')){
	function is_piutang_alert(){
		$CI =& get_instance();
		$CI->load->model('common_model');
		
		$count = 0;
		$data = $CI->common_model->rekap_piutang_now();
		foreach ($data as $row) { 
			$now = time();
			$tgl = strtotime($row->tanggal);
			$datediff = $now - $tgl;
			$diff = floor($datediff / (60*60*24));
			
			if ($diff > $row->batas_piutang) {
				$count++;
			}
		}

		return $count;
	}
}

if ( ! function_exists('is_piutang_alert_barang')){
	function is_piutang_alert_barang(){
		$CI =& get_instance();
		$CI->load->model('common_model');
		
		$count = 0;
		$data_list = $CI->common_model->db_select('nd_customer_piutang_setting_khusus');
		foreach ($data_list as $row) {
			$data = $CI->common_model->rekap_piutang_by_barang_now($row->barang_id, $row->customer_id);
			foreach ($data as $row2) { 
				$now = time();
				$tgl = strtotime($row2->tanggal);
				$datediff = $now - $tgl;
				$diff = floor($datediff / (60*60*24));
				
				if ($diff > $row->batas_piutang) {
					$count++;
				}
			}
		}

		return $count;
	}
}

if ( ! function_exists('is_qty_general')){
	function is_qty_general($number){
		$CI =& get_instance();

		$result = number_format($number,'2',',','.');
		return str_replace(',00', '', $result);
	}
}

if ( ! function_exists('is_date_formatter')){
	function is_date_formatter($date){
		$CI =& get_instance();

		$result = implode('-', array_reverse(explode('/', $date)));		
		return $result;
	}
}

if ( ! function_exists('is_datetime_formatter')){
	function is_datetime_formatter($date){
		$CI =& get_instance();

		$tgl = explode('-', $date);
		$result = implode('-', array_reverse(explode('/', trim($tgl[0])))).' '.$tgl[1];		
		return $result;
	}
}

if ( ! function_exists('is_date_monthname')){
	function is_date_monthname($date){
		$CI =& get_instance();

		$tgl = implode('-', array_reverse(explode('/', $date)));		
		$result = date('F d, Y', strtotime($tgl));
		return $result;
	}
}

if ( ! function_exists('is_reverse_date_monthname')){
	function is_reverse_date_monthname($date){
		$CI =& get_instance();

		$result = date('Y-m-d', strtotime($date));
		return $result;
	}
}

if ( ! function_exists('is_reverse_date')){
	function is_reverse_date($date){
		$CI =& get_instance();

		$result = implode('/', array_reverse(explode('-', $date)));		
		return $result;
	}
}

if ( ! function_exists('is_reverse_datetime')){
	function is_reverse_datetime($date){
		$CI =& get_instance();

		$tgl = explode(' ', $date);
		$result = implode('/', array_reverse(explode('-', $tgl[0]))).' '.$tgl[1];		
		return $result;
	}
}

if ( ! function_exists('is_reverse_datetime2')){
	function is_reverse_datetime2($date){
		$CI =& get_instance();

		$tgl = explode(' ', $date);
		$result = implode('/', array_reverse(explode('-', $tgl[0]))).' - '.$tgl[1];		
		return $result;
	}
}

if ( ! function_exists('is_number_format4')){
	function is_number_format4($number){
		$CI =& get_instance();

		$result = number_format($number,'4','.',',');
		return $result;
	}
}

if ( ! function_exists('is_sj_formatter')){
	function is_sj_formatter($number, $date){
		$CI =& get_instance();

		$romani = array(
		'1' => 'I' ,
		'2' => 'II' ,
		'3' => 'III' ,
		'4' => 'IV' ,
		'5' => 'V' ,
		'6' => 'VI' ,
		'7' => 'VII' ,
		'8' => 'VIII' ,
		'9' => 'IX' ,
		'10' => 'X' ,
		'11' => 'XI' ,
		'12' => 'XII' ,
		 );

		$tgl = explode('-', $date);
		$tahun = date('Y',strtotime($date));
		if ($tgl[1] < 10) {
			$month = str_replace('0', '', $tgl[1]);
		}else{
			$month = $tgl[1];
		}
		return 'SJ/'.$number.'/'.$romani[$month].'/'.$tahun;
	}
}

if ( ! function_exists('is_seting_link')){
	function is_setting_link($string){
		
		$result = rtrim(base64_encode($string),'=');
		return $result;
	}
}

if ( ! function_exists('is_get_username')){
	function is_get_username($id){
		$CI =& get_instance();  
		
		$username = '';
		if ($id != '') {
			$result = $CI->common_model->db_select('nd_user where id='.$id);
			foreach ($result as $row) {
				$username = $row->username;
			}
		}
		return $username;
	}
}

if ( ! function_exists('is_number_write')){
	function is_number_write($angka){
		
		$length = strlen($angka);
										//k untuk penyebut, $l untuk awal
		$k = 1;

		$bilangan[1] = 'Satu ';$bilangan[2] = 'Dua ';$bilangan[3] = 'Tiga ';
		$bilangan[4] = 'Empat ';$bilangan[5] = 'Lima ';$bilangan[6] = 'Enam ';
		$bilangan[7] = 'Tujuh ';$bilangan[8] = 'Delapan ';$bilangan[9] = 'Sembilan ';
		$bilangan[10] = 'Sepuluh '; $bilangan[0] = ' ';

		
		$number = '';
		
		$mod = $length%3;
		$break = floor($length / 3);
		if ($mod != 0) {
			$number_list[0] = substr($angka, 0, $mod);
			for ($i=0; $i < $break ; $i++) { 
				$j=$i+1;
				$number_list[$j] = substr($angka, 3*$i+$mod, 3);
			}

			$number_list = array_reverse($number_list);

		}else{
			$number_list;
			for ($i=0; $i < $break ; $i++) { 
				$number_list[$i] = substr($angka, 3*$i, 3);
			}

			$number_list = array_reverse($number_list);
		}

		$count = count($number_list) - 1;
		foreach ($number_list as $key => $value) {
			if ($mod != 0 && $key == $count) {
				$add_hundred = '';
			}else{
				$hundred = substr($value, 0,1);
				$ratusan = (int)$hundred;
				if ($ratusan == 0) {
					$add_hundred = '';
				}elseif ($ratusan == 1 ) {
					$add_hundred = 'Seratus ';
				}else{
					$add_hundred = $bilangan[$hundred].'Ratus ';
				}
			}
				
			if ($mod != 0 && $key == $count) {
				$dozens = substr($value, 0,$mod);
			}else{
				$dozens = substr($value, 1,2);
			}

			$puluhan = (int)$dozens;
			if ($puluhan == 0) {
				$add_dozens = '';
			}elseif ($puluhan > 0 && $puluhan <= 10 ) {
				$add_dozens = $bilangan[$puluhan];
			}elseif ($puluhan == 11) { 
				$add_dozens = 'Sebelas '; 
			}elseif ($puluhan > 11 && $puluhan <= 19) {
				$add_dozens = $bilangan[substr($puluhan, 1,1)].'Belas ';
			}elseif ($puluhan >= 20) {
				$add_dozens = $bilangan[substr($puluhan, 0,1)].'Puluh ';
				$add_dozens .= $bilangan[substr($puluhan, 1,1)];
			}

			if ($key == 0) {
				$number = $add_hundred.$add_dozens.'Rupiah ';
			}elseif ($key == 1) {
				if ($add_hundred.$add_dozens != '') {
					$number = $add_hundred.$add_dozens.'Ribu '.$number;
				}
			}elseif ($key == 2) {
				$number = $add_hundred.$add_dozens.'Juta '.$number;
			}
		}
		return $number;
	}
}

if ( ! function_exists('get_note_order')){
	function get_note_order(){
		$CI =& get_instance();  

		$result = $CI->common_model->get_note_order();

		return $result->result();
	}
}

if ( ! function_exists('get_notifikasi_akunting')){
	function get_notifikasi_akunting(){
		$CI =& get_instance();  

		$result = $CI->common_model->get_notifikasi_akunting();

		return $result->result();
	}
}

if ( ! function_exists('get_note_order_row')){
	function get_note_order_row(){
		$CI =& get_instance();  

		$result = $CI->common_model->get_note_order_pending();

		return $result->num_rows();
	}
}

if ( ! function_exists('get_note_order_target')){
	function get_note_order_target(){
		$CI =& get_instance();  

		$result = $CI->common_model->get_note_order_target();

		return $result->result();
	}
}

if ( ! function_exists('get_note_order_reminder')){
	function get_note_order_reminder(){
		$CI =& get_instance();  

		$result = $CI->common_model->get_note_order_reminder();

		return $result->result();
		// return $result;
	}
}

if ( ! function_exists('get_piutang_warn')){
	function get_piutang_warn(){
		$CI =& get_instance();

		$result = $CI->common_model->get_piutang_warn();

		return $result;
		// return $result;
	}
}

if ( ! function_exists('get_hutang_warn')){
	function get_hutang_warn(){
		$CI =& get_instance();

		$result = $CI->common_model->get_hutang_warn();

		return $result;
		// return $result;
	}
}

if ( ! function_exists('get_jatuh_tempo')){
	function get_jatuh_tempo($customer_id){
		$CI =& get_instance();
		$get = $CI->common_model->db_select('nd_customer where id='.$customer_id);
		$tempo_kredit = 0;
		foreach ($get as $row) {
			$tempo_kredit = $row->tempo_kredit;
		}

		$tempo_kredit = ($tempo_kredit != 0 && $tempo_kredit != null ? $tempo_kredit : 60);
		return $tempo_kredit;
		// return $result;
	}
}