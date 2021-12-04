<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css'); ?>"/>
<?php echo link_tag('assets/global/plugins/bootstrap-datepicker/css/datepicker3.css'); ?>

<div class="page-content">
	<div class='container'>

	
		<div class="row margin-top-10">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption caption-md">
							<i class="icon-bar-chart theme-font hide"></i>
							<span class="caption-subject theme-font bold uppercase"><?=$breadcrumb_small;?></span>
						</div>
					</div>
					<div class="portlet-body">
						<form>
							Per Tanggal : <input readonly name='tanggal' class='date-picker' style='max-width:150px;' value="<?=is_reverse_date($tanggal)?>">
							<button class='btn btn-xs btn-default'><i class='fa fa-search'></i></button>
						</form>
						<hr/>
						<table class="table table-hover table-striped table-bordered" id="general_table">
							<thead>
								<tr>									
									<th scope="col">
										Nama Customer
									</th>
									<th scope="col">
										Piutang
									</th>
									<th scope="col">
										Actions
									</th>
								</tr>
							</thead>
							<tbody>
								<?
								$total = 0;
								foreach ($piutang_list as $row) { 
									$total += $row->sisa_piutang;?>
									<tr>
										<td>
											<?=$row->nama_customer;?>
										</td>
										<td>
											<?=number_format($row->sisa_piutang,'0',',','.');?>
										</td>
										<td>
											<!-- <a href="<?=base_url().rtrim(base64_encode('finance/piutang_list_detail'),'=').'/?customer_id='.$row->customer_id;?>" class="btn btn-xs blue"><i class='fa fa-search'></i></a> -->
											<a href="<?=base_url().rtrim(base64_encode('finance/piutang_payment_form'),'=').'/?customer_id='.$row->customer_id;?>&toko_id=<?=$row->toko_id;?>&tanggal_start=<?=$row->tanggal_start;?>&tanggal_end=<?=$row->tanggal_end;?>" class="btn btn-xs blue"> Lihat / Pelunasan</a>
											
										</td>
									</tr>
								<?}?>
							</tbody>
						</table>
						<hr/>
						<table class='table'>
							<tr style='font-size:1.3em'>
								<td>TOTAL</td>
								<td>
									<?=number_format($total,'0',',','.');?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>			
</div>

<script src="<?php echo base_url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets_noondev/js/table-advanced.js'); ?>"></script>

<script>
jQuery(document).ready(function() {

	// dataTableTrue();

	TableAdvanced.init();

	// oTable = $('#general_table').DataTable();
	// oTable.state.clear();
	// oTable.destroy();

	$('.btn-save').click(function(){
		if ($('#form_add_data [name=tanggal]').val() != '' && $('#form_add_data [name=amount]').val() != '' ) {
			$('#form_add_data').submit();
		}else{
			alert('Tanggal dan Jumlah harus diisi');
		}
	});

});
</script>
