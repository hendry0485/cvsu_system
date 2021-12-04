<script>

function print_surat_jalan_noharga(printer_name){
	

	<?
	$i = 1; $baris_print = 0;
	$baris_idx = 16;
	$count = count($penjualan_print);

	foreach ($data_penjualan_detail_group as $row) {

		$nama_warna = explode('??', $row->nama_warna);
		$data_qty = explode('??', $row->data_qty);
		$qty = explode('??', $row->qty);
		$jumlah_roll = explode('??', $row->jumlah_roll);
		$roll_qty = explode('??', $row->roll_qty);
		
		$data_all = explode('=??=', $row->data_all);

		foreach ($nama_warna as $key => $value) {
			$total = 0;
			$total_roll = 0;

			$qty_c = array();

			$qty_detail = explode(' ', $data_qty[$key]);
			$roll_detail = explode(',', $roll_qty[$key]);
			
			$j = 0; 
			foreach ($qty_detail as $key2 => $value2) {
				if ($roll_detail[$key2] == 0) {
					$roll_detail[$key2] = 1;
				}
				
				for ($l=0; $l < $roll_detail[$key2] ; $l++) { 
					$qty_c[$j] = number_format($qty_detail[$key2],'2','.',',');
					$j++;
				}
			}

			asort($qty_c);

			$qty_c = array_values($qty_c);
			$baris = ceil($jml_angka/10);
			
			for ($m=0; $m < $baris ; $m++) { 
		   		$baris_idx++;
			}
			$baris_idx++;
		}
	}

	$baris_total = $baris_idx + $count;

		if ($baris_idx > 20 ) { ?>

			var data = ['\x1B' + '\x40'+          // init
			   	'\x1B' + '\x21' + '\x39'+ // em mode on
			   	<?="'".sprintf('%-20.18s','SURAT JALAN')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%44.27s', 'BANDUNG, '.$tanggal_print)."'";?> + '\x0A'+

			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-35.35s', strtoupper($nama_toko) )."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%42.40s', 'Kepada Yth,')."'";?> + '\x0A'+

			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-35.35s', strtoupper($alamat_toko))."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%42.42s', strtoupper($nama_keterangan) )."'";?> + '\x0A'+


			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-31.31s', 'TELP:'.$telepon)."'";?>+
			   	'\x1B' + '\x21' + '\x15'+ //spacing
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?$alamat1 = substr(strtoupper(trim($alamat_keterangan)), 0,47);?>
			   	<?$alamat2 = substr(strtoupper(trim($alamat_keterangan)), 47);?>
			   	<?="'".sprintf('%47.47s', $alamat1)."'";?> + '\x0A'+

			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-35.35s', ($fax != '' ? 'FAX:'.$fax : ''))."'";?>+
			   	'\x1B' + '\x21' + '\x15'+ //spacing
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%42.42s',$alamat2 )."'";?> + '\x0A'+

		   		'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-30.30s', 'NPWP : '.$npwp)."'";?>+
			   	'\x1B' + '\x21' + '\x15'+ //spacing
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%47.47s', strtoupper($kota))."'";?> + '\x0A'+



			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
			   	
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-47.47s', ($po_number != '' ? "PO/Ket : ".$po_number : '') )."'";?>+
			   	'\x1B' + '\x21' + '\x15'+ //spacing
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%30.30s', 'INVOICE NO : '.$no_faktur_lengkap)."'";?> + '\x0A'+


			   	//==============================================================================
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-6.6s', 'Jumlah ')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-6.6s', 'Satuan ')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-4.4s', 'Roll ')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-27.27s', 'Nama Barang ')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-8.8s', 'Harga ')."'";?>+'\x0A'+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
				

			   	//==============================================================================
			   	<?
			   	$total = 0; $total_roll = 0; $idx = 0;
			   	foreach ($penjualan_print as $row) {
			   		$total += $row->qty * 0;
			   		$total_roll += $row->jumlah_roll;?>
			   			'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%6.6s', is_qty_general($row->qty))."'";?>+
					   	'\x1B' + '\x21' + '\x15'+
					   	'\x09'+
					   	'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%6.6s', $row->nama_satuan)."'";?>+
					   	'\x1B' + '\x21' + '\x15'+
					   	'\x09'+
					   	'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%4.4s', $row->jumlah_roll)."'";?>+
					   	'\x1B' + '\x21' + '\x15'+
					   	'\x09'+
					   	'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%-27.27s', $row->nama_barang)."'";?>+
					   	'\x1B' + '\x21' + '\x15'+
					   	'\x09'+
					   	'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%-8.8s', ' ' )."'";?>+
					   	'\x1B' + '\x21' + '\x15'+
					   	'\x09'+
					   	'\x1B' + '\x21' + '\x18'+ // em mode on
					   	'\x0A'+
			   	<?$idx++;}?>
			   	<?for ($i = $idx; $i < 10; $i++) {?>
			   		'\x0A'+
			   	<?};?>
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
				
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%12.12s', 'TOTAL ROLL')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%4.4s', $total_roll)."'";?>+
			   	'\x0A'+

			   	//==============================================================================

			   	'\x0A'+
			   	'\x0A'+
			   	'\x0A'+
			   	'\x0A'+
			   	'\x0A'+
			   	'\x0A'+
			   	'\x1B' + '\x21' + '\x19'+ // em mode on
			   	<?="'".sprintf('%-18.14s %-5.5s %-15.15s %-15.15s ', 'Tanda Terima', '', 'Checker', 'Hormat Kami')."'";?> + 
			   	'\x0A'+
			   	'\x0A'+
			   	'\x0A'+

			   	//=========================================detail=========================================================

			   	//==============================================================================
			   	'\x1B' + '\x21' + '\x10'+ // em mode on
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
			   	

			   	'\x1B' + '\x21' + '\x14'+ // em mode on
			   	<?="'".sprintf('%-15.15s', 'Spec ')."'";?>+ '\x09'+
			   	<?="'".sprintf('%-15.15s', 'Warna ')."'";?>+ '\x09'+
			   	<?="'".sprintf('%-2.2s', '|')."'";?>+
			   	<?="'".sprintf('%-4.4s', 'Roll ')."'";?>+ '\x09'+
			   	<?="'".sprintf('%-9.9s', 'Total ')."'";?>+ '\x09'+
			   	<?="'".sprintf('%-1.1s', '|')."'";?>+
			   	<?="'".sprintf('%-1.1s %-40.40s','', 'Detail ')."'";?>+
				'\x0A'+

			   	'\x1B' + '\x21' + '\x10'+ // em mode on
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
				

			   	//==============================================================================
			   	<?

				$i = 1; $baris_print = 3;
				foreach ($data_penjualan_detail_group as $row) {

					$nama_warna = explode('??', $row->nama_warna);
					$data_qty = explode('??', $row->data_qty);
					$qty = explode('??', $row->qty);
					$jumlah_roll = explode('??', $row->jumlah_roll);
					$roll_qty = explode('??', $row->roll_qty);
					
					$data_all = explode('=??=', $row->data_all);

					

					$total = 0;

					foreach ($nama_warna as $key => $value) {
						$total_roll = 0;

						$qty_c = array();

						$qty_detail = explode(' ', $data_qty[$key]);
						$roll_detail = explode(',', $roll_qty[$key]);
						$qty_roll_data = explode('??', $data_all[$key]);
						
						$j = 0; 
						foreach ($qty_detail as $key2 => $value2) {
							$total_roll += $roll_detail[$key2];

							if ($roll_detail[$key2] == 0) {
								$roll_detail[$key2] = 1;
							}
							
							for ($l=0; $l < $roll_detail[$key2] ; $l++) { 
								$total += $qty_detail[$key2];
								$qty_c[$j] = number_format($qty_detail[$key2],'2','.',',');
								$j++;
							}
						}

						// print_r($qty_detail);echo '<br/>';
						// print_r($roll_detail);echo '<hr/>';
						asort($qty_c);

						$jml_angka = count($qty_c);
						// print_r($qty_c);
						$qty_c = array_values($qty_c);
						$jml_angka;
						$baris = ceil($jml_angka/10);
						for ($m=0; $m < $baris ; $m++) { 
							if ($m == 0) {
								$nama_barang = $row->nama_barang;
								$nama_warna_print = $value;
							}else{
								$nama_barang = '';
								$nama_warna_print = '';
							}


						}?>

						<?for ($m=0; $m < $baris ; $m++) { 
							if ($m == 0) {
								$nama_barang = $row->nama_barang;
								$nama_warna_print = $value;
								$qty_total = is_qty_general($total);
								$roll_total = $total_roll;

								$total_show = number_format($total,2,',','.');
								$total_roll_show = $total_roll;
							}else{
								$nama_barang = '';
								$nama_warna_print = '';
								$total_show = '';
								$total_roll_show = '';
							}
							?>
							'\x1B' + '\x21' + '\x14'+ // em mode on
						   	<?="'".sprintf('%-15.15s', $nama_barang)."'";?>+ '\x09'+
						   	<?="'".sprintf('%-15.15s', $nama_warna_print)."'";?>+ '\x09'+
						   	<?="'".sprintf('%-2.2s', '|')."'";?>+
						   	<?="'".sprintf('%3.3s', $total_roll_show)."'";?>+ '\x09'+
						   	<?="'".sprintf('%9.9s', $total_show)."'";?>+ '\x09'+
						   	<?="'".sprintf('%-1.1s', '|')."'";?>+

						   		<?for ($n=0; $n < 10; $n++) { 
						   			$k = 10 * $m + $n;
						   			?>
									<?="'".sprintf('%6.6s', (isset($qty_c[$k]) ? is_qty_general($qty_c[$k]) : '' ) )."'";?>+ '\x09'+
						   		<?}?>

						   	'\x0A'+
						<?
						$baris_print++;
						
						if ( $baris_print % 34 == 0 && $baris_print > 0) {?>
							'\x0A'+
							'\x0A'+
							'\x0A'+
						<?};
						}			
					}

					?>
					'\x1B' + '\x21' + '\x10'+ // em mode on
				   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
				   	<?
						$baris_print++;

						if ( $baris_print % 34 == 0  && $baris_print > 0) {?>
							'\x0A'+
							'\x0A'+
							'\x0A'+
						<?};
				   	?>
					
				<?}?>
			   	
				'\x1B' + '\x69',          // cut paper
			   	'\x10' + '\x14' + '\x01' + '\x00' + '\x05',  // Generate Pulse to kick-out cash drawer**
			                                                // **for legacy drawer cable CD-005A.  Research before using.
			                                                // see also http://keyhut.com/popopen4.htm
		    ];

		<?}else{?>
			var data = ['\x1B' + '\x40'+          // init
			   	'\x1B' + '\x21' + '\x39'+ // em mode on
			   	<?="'".sprintf('%-20.18s','SURAT JALAN')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%44.27s', 'BANDUNG, '.$tanggal_print)."'";?> + '\x0A'+

			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-35.35s', strtoupper($nama_toko) )."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%42.40s', 'Kepada Yth,')."'";?> + '\x0A'+

			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-35.35s', strtoupper($alamat_toko))."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%42.42s', strtoupper($nama_keterangan) )."'";?> + '\x0A'+


			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-31.31s', 'TELP:'.$telepon)."'";?>+
			   	'\x1B' + '\x21' + '\x15'+ //spacing
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?$alamat1 = substr(strtoupper(trim($alamat_keterangan)), 0,47);?>
			   	<?$alamat2 = substr(strtoupper(trim($alamat_keterangan)), 47);?>
			   	<?="'".sprintf('%47.47s', $alamat1)."'";?> + '\x0A'+

			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-35.35s', ($fax != '' ? 'FAX:'.$fax : ''))."'";?>+
			   	'\x1B' + '\x21' + '\x15'+ //spacing
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%42.42s',$alamat2 )."'";?> + '\x0A'+

		   		'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-30.30s', 'NPWP : '.$npwp)."'";?>+
			   	'\x1B' + '\x21' + '\x15'+ //spacing
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%47.47s', strtoupper($kota))."'";?> + '\x0A'+



			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
			   	
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-30.30s', ($po_number != '' ? $po_number : '') )."'";?>+
			   	'\x1B' + '\x21' + '\x15'+ //spacing
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%47.47s', 'SURAT JALAN : '.$no_surat_jalan)."'";?> + '\x0A'+


			   	//==============================================================================
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-6.6s', 'Jumlah ')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-6.6s', 'Satuan ')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-4.4s', 'Roll ')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-27.27s', 'Nama Barang ')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x0A'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
				

			   	//==============================================================================
			   	<?
			   	$total = 0; $total_roll = 0; $idx = 0;
			   	foreach ($penjualan_print as $row) {
			   		$total += $row->qty * 0;
			   		$total_roll += $row->jumlah_roll;?>
			   			'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%6.6s', is_qty_general($row->qty))."'";?>+
					   	'\x1B' + '\x21' + '\x15'+
					   	'\x09'+
					   	'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%6.6s', $row->nama_satuan)."'";?>+
					   	'\x1B' + '\x21' + '\x15'+
					   	'\x09'+
					   	'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%4.4s', $row->jumlah_roll)."'";?>+
					   	'\x1B' + '\x21' + '\x15'+
					   	'\x09'+
					   	'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%-27.27s', $row->nama_barang)."'";?>+
					   	'\x1B' + '\x21' + '\x15'+
					   	'\x09'+
					   	'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%-8.8s', ' ')."'";?>+
					   	'\x1B' + '\x21' + '\x15'+
					   	'\x09'+
					   	'\x1B' + '\x21' + '\x18'+ // em mode on
					   	<?="'".sprintf('%13.13s', ' ')."'";?> + '\x0A'+
			   	<?$idx++;}?>
			   	<?for ($i = $idx; $i < 3; $i++) {?>
			   		'\x0A'+
			   	<?};?>
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
				
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%12.12s', 'TOTAL ROLL')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%4.4s', $total_roll)."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x09'+
			   	'\x1B' + '\x21' + '\x18'+ // em mode on
			   	<?="'".sprintf('%-27.27s', '')."'";?>+
			   	'\x1B' + '\x21' + '\x15'+
			   	'\x0A'+
			   	'\x0A'+
			   	'\x0A'+
			   

			   	//=========================================detail=========================================================

			   	//==============================================================================
			   	'\x1B' + '\x21' + '\x10'+ // em mode on
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
			   	

			   	'\x1B' + '\x21' + '\x14'+ // em mode on
			   	<?="'".sprintf('%-15.15s', 'Spec ')."'";?>+ '\x09'+
			   	<?="'".sprintf('%-15.15s', 'Warna ')."'";?>+ '\x09'+
			   	<?="'".sprintf('%-2.2s', '|')."'";?>+
			   	<?="'".sprintf('%-4.4s', 'Roll ')."'";?>+ '\x09'+
			   	<?="'".sprintf('%-9.9s', 'Total ')."'";?>+ '\x09'+
			   	<?="'".sprintf('%-1.1s', '|')."'";?>+
			   	<?="'".sprintf('%-1.1s %-40.40s','', 'Detail ')."'";?>+
				'\x0A'+

			   	'\x1B' + '\x21' + '\x10'+ // em mode on
			   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
				

			   	//==============================================================================
			   	<?

				$i = 1; $baris_print = 3;
				foreach ($data_penjualan_detail_group as $row) {

					$nama_warna = explode('??', $row->nama_warna);
					$data_qty = explode('??', $row->data_qty);
					$qty = explode('??', $row->qty);
					$jumlah_roll = explode('??', $row->jumlah_roll);
					$roll_qty = explode('??', $row->roll_qty);
					
					$data_all = explode('=??=', $row->data_all);

					

					$total = 0;
					$total_roll = 0;

					foreach ($nama_warna as $key => $value) {

						$qty_c = array();

						$qty_detail = explode(' ', $data_qty[$key]);
						$roll_detail = explode(',', $roll_qty[$key]);
						$qty_roll_data = explode('??', $data_all[$key]);
						
						$j = 0; 
						foreach ($qty_detail as $key2 => $value2) {
							$total_roll += $roll_detail[$key2];

							if ($roll_detail[$key2] == 0) {
								$roll_detail[$key2] = 1;
							}
							
							for ($l=0; $l < $roll_detail[$key2] ; $l++) { 
								$total += $qty_detail[$key2];
								$qty_c[$j] = number_format($qty_detail[$key2],'2','.',',');
								$j++;
							}
						}

						// print_r($qty_detail);echo '<br/>';
						// print_r($roll_detail);echo '<hr/>';
						asort($qty_c);

						$jml_angka = count($qty_c);
						// print_r($qty_c);
						$qty_c = array_values($qty_c);
						$jml_angka;
						$baris = ceil($jml_angka/10);
						for ($m=0; $m < $baris ; $m++) { 
							if ($m == 0) {
								$nama_barang = $row->nama_barang;
								$nama_warna_print = $value;
							}else{
								$nama_barang = '';
								$nama_warna_print = '';
							}


						}?>

						<?for ($m=0; $m < $baris ; $m++) { 
							if ($m == 0) {
								$nama_barang = $row->nama_barang;
								$nama_warna_print = $value;
								$qty_total = is_qty_general($total);
								$roll_total = $total_roll;

								$total_show = number_format($total,2,',','.');
								$total_roll_show = $total_roll;
							}else{
								$nama_barang = '';
								$nama_warna_print = '';
								$total_show = '';
								$total_roll_show = '';
							}
							?>
							'\x1B' + '\x21' + '\x14'+ // em mode on
						   	<?="'".sprintf('%-15.15s', $nama_barang)."'";?>+ '\x09'+
						   	<?="'".sprintf('%-15.15s', $nama_warna_print)."'";?>+ '\x09'+
						   	<?="'".sprintf('%-2.2s', '|')."'";?>+
						   	<?="'".sprintf('%3.3s', $total_roll_show)."'";?>+ '\x09'+
						   	<?="'".sprintf('%9.9s', $total_show)."'";?>+ '\x09'+
						   	<?="'".sprintf('%-1.1s', '|')."'";?>+

						   		<?for ($n=0; $n < 10; $n++) { 
						   			$k = 10 * $m + $n;
						   			?>
									<?="'".sprintf('%6.6s', (isset($qty_c[$k]) ? is_qty_general($qty_c[$k]) : '' ) )."'";?>+ '\x09'+
						   		<?}?>

						   	'\x0A'+
						<?
						}			
					}

					?>
					'\x1B' + '\x21' + '\x10'+ // em mode on
				   	<?="'".sprintf("%${'garis1'}80s", '')."'";?>+ '\x0A'+
					
				<?}?>
				'\x0A'+
			   	'\x0A'+
				<?echo "'".sprintf('%-1.0s %-12.12s %-5.4s %-12.12s %-5.5s %-15.15s ', '','Tanda Terima', '', 'Checker','','Hormat Kami')."'";?>+
			   	
			   	'\x0A'+
			   	'\x0A'+
				
				'\x1B' + '\x69',          // cut paper
			   	'\x10' + '\x14' + '\x01' + '\x00' + '\x05',  // Generate Pulse to kick-out cash drawer**
			                                                // **for legacy drawer cable CD-005A.  Research before using.
			                                                // see also http://keyhut.com/popopen4.htm
		    ];
		<?};
	?>

	console.log('<?=$baris_idx?>');
	console.log(data);

	webprint.printRaw(data, printer_name);
	
}

</script>