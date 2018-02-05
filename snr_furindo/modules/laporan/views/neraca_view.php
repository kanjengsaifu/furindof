<style>
	.seperator{
		border: 1px solid #ccc;
		padding: 10px 0px 10px 0px;
		margin:20px 0px 20px 0px;
		border-radius:3px;
	}
	.header1{
		text-align:center;
		border-bottom:1px solid #ccc;
		margin:0px 0px 10px 0px;
		font-size: 18px;
	}
	
	li.ui-menu-item{
		background:#fff;
		list-style-type:none;
		width:210px !important;
		margin:0px !important;
		left:0px !important;
		padding:5px;
		border-bottom:1px dashed #ccc;
	}
	
	li.ui-menu-item:hover{
		background:#ccc;
		cursor:pointer;
	}
	td{
		padding: 5px !important;
	}
</style>
<div class="content-header">        
	<h1>Laporan Neraca</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">			
			<div class="box-header">					

				<button type="button" class="btn btn-sm btn-primary" onclick="dialogFormPrint()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak Laporan</button>	

			</div>
						
			<div class="seperator">
			
			<div class="header1">
				<label><b><?php echo strtoupper('NERACA') ?></b></label><br>
				<label><b><?php $tgl = date('d F Y'); echo strtoupper('PERIODE : ');?></b><input id="tglNeraca" class="date" type="text" readonly value="<?php echo $setDate; ?>" style="padding-left:5px;background:#ddd;" onchange="getNeraca()"></label><br>				
			</div>			
			
			
				<div class="table-responsive" style="width:98%; font-size:14px; margin:0px auto;">
				<div class="col-sm-6">     
					<table id="tables" width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-bordered">
						
						<tr role="row">
							<td colspan="3" style="text-align:center; color:white; background: #605CA8;">AKTIVA</td>																					
						</tr>						 
						<!-- <tbody name="tabelContent" id="tabelContent"> -->
						<?php 
							$jml = 0;		
								
							$a=0; 
							foreach ($aktiva->result() as $kas) {
							$ajs = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas->kode_kasbank."' AND id_ajs_jurnal=".$idz."")->row();
							$ajsNilai=!isset($ajs->nominal)?0:$ajs->nominal;
							$aktif = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
								trx_jurnal.akun where status = 0 and level !=0 and (trx_jurnal.tgl BETWEEN '".$mulai."' AND '".$akhir."') and trx_jurnal.akun='".$kas->kode_kasbank."'")->row(); 
							$a++;
								$jml += $aktif->total+$ajsNilai; ?>
								
							<tr>
								<td style="text-align:center;"><?php echo $kas->kode_kasbank; ?></td>
								<td><?php echo $kas->nama_kasbank; ?></td>
								<td style="text-align:right;"><?php echo 'Rp '.number_format($aktif->total+$ajsNilai).'.00'; ?></td>								
							</tr>
						<?php } ?>											
							
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Jumlah</b></td>
								<td style="text-align:right;"><b><?php echo 'Rp '.number_format($jml).'.00'; ?></b></td>
							</tr>
							
							<tr>
								<td colspan="3"></td>
							</tr>							
						<!-- </tbody> -->						
					</table>					
			   </div>			
			<div class="col-sm-6">
				     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-bordered">
						
						
							<tr>
								<td colspan="3" style="text-align:center; color:white; background: #605CA8;">PASSIVA</td>								
							</tr>
							<tr>
								<td colspan="3" style="text-align:left; background: #A19DE2;">HUTANG</td>								
							</tr>
						<?php 
							$jml_pasiva= 0;	
							$jml_hutang =0;	
								
							$a=0; 
							foreach ($pasiva->result() as $kas1) { 
							$ajs = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas1->kode_kasbank."' AND id_ajs_jurnal=".$idz."")->row();
							$ajsNilai=!isset($ajs->nominal)?0:$ajs->nominal;
							$pasif = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
								trx_jurnal.akun where status = 1 and mst_kasbank.id_induk =38 and (trx_jurnal.tgl BETWEEN '".$mulai."' AND '".$akhir."') and trx_jurnal.akun='".$kas1->kode_kasbank."'")->row();
							$a++;
								$kas1->total = $pasif->total+$ajsNilai;
								if($kas1->total < 0){
									$kas1->total = $kas1->total*-1;
								}
								
								$jml_pasiva += $kas1->total;
								$jml_hutang += $kas1->total; ?>
								
							<tr>
								<td style="text-align:center;"><?php echo $kas1->kode_kasbank; ?></td>
								<td><?php echo $kas1->nama_kasbank; ?></td>
								<td style="text-align:right;"><?php  echo rp($kas1->total); ?></td>								
							</tr>
						<?php } ?>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Total Hutang</b></td>
								<td style="text-align:right;"><b><?php echo 'Rp '.number_format($jml_hutang).'.00'; ?></b></td>
							</tr>	

							<tr>
								<td colspan="3" style="text-align:left; background: #A19DE2;">EKUITAS</td>								
							</tr>
						<?php 
							$jml_ekuitas = 0;		
								
							$a=0; 
							foreach ($ekuitas->result() as $kas2) { 
							$ajs = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas2->kode_kasbank."' AND id_ajs_jurnal=".$idz."")->row();
							$ajsNilai=!isset($ajs->nominal)?0:$ajs->nominal;
							$ekuit = $this->db->query("SELECT kode_kasbank,nama_kasbank, sum(nominal) as total from mst_kasbank left join trx_jurnal on mst_kasbank.kode_kasbank =
								trx_jurnal.akun where status = 1 and mst_kasbank.id_induk =46 and (trx_jurnal.tgl BETWEEN '".$mulai."' AND '".$akhir."') and trx_jurnal.akun='".$kas2->kode_kasbank."'")->row();
							$a++;
								$kas2->total = $ekuit->total+$ajsNilai;
								if($kas2->total < 0){
									$kas2->total = $kas2->total*-1;
								}
								
								$jml_pasiva += $kas2->total;
								$jml_ekuitas += $kas2->total; ?>
							<tr>
								<td style="text-align:center;"><?php echo $kas2->kode_kasbank; ?></td>
								<td><?php echo $kas2->nama_kasbank; ?></td>
								<td style="text-align:right;"><?php echo 'Rp '.number_format($kas2->total).'.00'; ?></td>								
							</tr>
						<?php } ?>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Total Ekuitas</b></td>
								<td style="text-align:right;"><b><?php echo 'Rp '.number_format($jml_ekuitas).'.00'; ?></b></td>
							</tr>

							<?php 
								for ($i=0; $i < 18 ; $i++) { 									
							?>
								<tr>
									<td colspan="3" style="color:white;">1</td>
								</tr>
							<?php } ?>		
							
							<tr>
								<td style="text-align:center;"></td>
								<td>Laba tahun berjalan</td>								
								<td style="text-align:right;"><?php $laba = $debet->nominal+$kredit->nominal; echo 'Rp '.number_format($laba).'.00'; ?></td>	
														
							</tr>				
							
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Jumlah</b></td>
								<td style="text-align:right;"><b><?php echo 'Rp '.number_format($jml_pasiva+$laba).'.00'; ?></b></td>
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>							
						</tbody>						
					</table>					
			   </div>		

			</div>			
		</div>
	</div>
</div>
<script src="<?php echo base_url()?>assets/js/func.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
	$(".date").datepicker({
		format : "dd-mm-yyyy",		
		autoclose : true,
	});
});	
function dialogFormPrint()
	{
		//var htmlOut = ajaxFillGridJSON('transaksi/printbkk', {idx : idx}); 

		var htmlOut = "<?php echo site_url("laporan/printneraca")?>";
        
        window.open(htmlOut);   
    			   

	}
function getNeraca()
	{
		var idx = $('#tglNeraca').val();
		kodeTipeKaryawan = ajaxFillGridJSON('laporan/neraca', {tgl : idx});
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/editso', {IDBidang : idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}
	
</script>