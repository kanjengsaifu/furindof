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
</style>
<?php
	$mulai = date("Y-m-d", strtotime($start));
	$akhir = date("Y-m-d", strtotime($end));
	$IDajs = $this->db->query("SELECT * from ajs_jurnal where status = 1 AND (tgl BETWEEN '".$mulai."' AND '".$akhir."') order by tgl DESC")->row();
	$idz=0;
	if(isset($IDajs->id)){
		$idz = $IDajs->id;
		$mulai = date("Y-m-d", strtotime('+1 days',strtotime($IDajs->tgl)));
	}
 ?>
<div class="content-header">        
	<h1>Laporan Laba Rugi</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">			
			<div class="box-header">					

				<!-- <button type="button" class="btn btn-sm btn-primary" onclick="dialogFormPrint()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak Laporan</button> -->		

			</div>
						
			<div class="seperator">
			
			<div class="header1">
				<label><b><?php echo strtoupper('LAPORAN LABA RUGI') ?></b></label><br>
				<label><b>TANGGAL :</b><input id="start" class="date" type="text" readonly value="<?php echo $start; ?>" style="padding-left:5px;background:#ddd;width:110px"> s/d <input id="end" class="date" type="text" readonly value="<?php echo $end; ?>" style="padding-left:5px;background:#ddd;width:110px"> <span onclick="getLaba()" class="btn btn-success" style="margin-bottom:3px"><a style="color:#fff" class="fa fa-search"></a></span></label><br>				
			</div>			
			
			<form id="addkasmasuk">
				<div class="table-responsive" style="width:90%; font-size:16px; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-bordered">
						
						<tr role="row">
							<td colspan="3" style="text-align:left; background: #999;">PENDAPATAN</td>																					
						</tr>						 
						<tbody name="tabelContent" id="tabelContent">
							<?php 
								//if ($kas->row()->jenis == 'um') {
								$ttl_masuk=0;
								$ttl_keluar=0;
								$ttl_keluar1=0;
								$ttl_keluar2=0;
								$ttl_keluar3=0;
								$labarugi=0;
								$nominal=0;
								$kas = $this->db->query("SELECT * from mst_pemasukan");
								$a=0; foreach ($kas->result() as $kas1) { 
								$pend = $this->db->query("SELECT akun, trx_jurnal.uraian, sum(nominal) as nominal, jenis from trx_jurnal where akun = '".$kas1->kode_pemasukan."' AND (tgl BETWEEN '".$mulai."' AND '".$akhir."') AND (akun in (select kode_pemasukan from mst_pemasukan) 
									or akun in (select kode_pengeluaran from mst_pengeluaran)) group by akun");
								$ajs = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas1->kode_pemasukan."' AND id_ajs_jurnal=".$idz."")->row();
								$ajsNilai=!isset($ajs->nominal)?0:$ajs->nominal;
								$a++;
								if($pend->num_rows() > 0){
									$nominal = $pend->row()->nominal+$ajsNilai;
								} else{
									$nominal=$ajsNilai;
								}

								if ($kas1->jenis_pemasukan == '1') {								
								?>
								<tr>
									<td style="text-align:center;"><?php echo $kas1->kode_pemasukan; ?></td>
									<td><?php echo $kas1->nama_pemasukan; ?></td>
									<td style="text-align:right;"><?php $ttl_masuk += $nominal; echo rp($nominal); ?></td>								
								</tr>
							<?php } } ?>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Total Pemasukan</b></td>
								<td style="text-align:right;"><b><?php echo rp($ttl_masuk); ?></b></td>
							</tr>
							<tr>
								<td colspan="3" style="text-align:left; background: #999;">HARGA POKOK</td>								
							</tr>
							<?php 
								$nominal=0;
								$kas2 = $this->db->query("SELECT * from mst_pengeluaran");
								$a=0; foreach ($kas2->result_array() as $kas) { 
								$pokok = $this->db->query("SELECT akun, trx_jurnal.uraian, sum(nominal) as nominal, jenis from trx_jurnal where akun = '".$kas['kode_pengeluaran']."' AND (tgl BETWEEN '".$mulai."' AND '".$akhir."') AND (akun in (select kode_pemasukan from mst_pemasukan) 
									or akun in (select kode_pengeluaran from mst_pengeluaran)) group by akun");
								$ajs1 = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas['kode_pengeluaran']."' AND id_ajs_jurnal=".$idz."")->row();
								$ajsNilai1=!isset($ajs1->nominal)?0:$ajs1->nominal;
								$a++;
								if($pokok->num_rows() != 0){
									$nominal = ($pokok->row()->nominal+$ajsNilai1)*-1;
								} else{
									$nominal=$ajsNilai1*-1;
								}
								if($kas['kode_pengeluaran']=="52002"||$kas['kode_pengeluaran']=="52001")
									$nominal = $nominal*-1;

								if ($kas['jenis_pengeluaran'] == '1') {
							?>
								<tr>
									<td style="text-align:center;"><?php echo $kas['kode_pengeluaran']; ?></td>
									<td><?php echo $kas['nama_pengeluaran']; ?></td>
									<td style="text-align:right;"><?php $ttl_keluar += $nominal; echo rp($nominal); ?></td>								
								</tr>
							<?php } } ?>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>TOTAL HARGA POKOK</b></td>
								<td style="text-align:right;"><b><?php echo rp($ttl_keluar); ?></b></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>PROFIT MARGIN</b></td>
								<td style="text-align:right;"><b><?php echo 'Rp '.number_format($ttl_masuk-$ttl_keluar).'.00'; ?></b></td>
							</tr>
							<tr>
								<td colspan="3" style="text-align:left; background: #999;">BEBAN OPERASIONAL</td>								
							</tr>
							<?php 
								$nominal=0;
								$kas3 = $this->db->query("SELECT * from mst_pengeluaran");
								$a=0; foreach ($kas3->result_array() as $kas3) { 
								$a++;
								$beban = $this->db->query("SELECT akun, trx_jurnal.uraian, sum(nominal) as nominal, jenis from trx_jurnal where akun = '".$kas3['kode_pengeluaran']."' AND (tgl BETWEEN '".$mulai."' AND '".$akhir."') AND (akun in (select kode_pemasukan from mst_pemasukan) 
									or akun in (select kode_pengeluaran from mst_pengeluaran)) group by akun");
								$ajs2 = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas3['kode_pengeluaran']."' AND id_ajs_jurnal=".$idz."")->row();
								$ajsNilai2=!isset($ajs2->nominal)?0:$ajs2->nominal;
								if($beban->num_rows() > 0){
									$nominal = ($beban->row()->nominal+$ajsNilai2)*-1;
								} else{
									$nominal=$ajsNilai2*-1;
								}

								if ($kas3['jenis_pengeluaran'] == '2') {
							?>
								<tr>
									<td style="text-align:center;"><?php echo $kas3['kode_pengeluaran']; ?></td>
									<td><?php echo $kas3['nama_pengeluaran']; ?></td>
									<td style="text-align:right;"><?php $ttl_keluar1 += $nominal; echo rp($nominal); ?></td>								
								</tr>
							<?php } } ?>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Total Beban Operasional</b></td>
								<td style="text-align:right;"><b><?php echo rp($ttl_keluar1); ?></b></td>
							</tr>

							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Pendapatan Operasional</b></td>
								<td style="text-align:right;"><b><?php echo 'Rp '.number_format($ttl_masuk-$ttl_keluar-$ttl_keluar1).'.00'; ?></b></td>
							</tr>
							<tr>
								<td colspan="3" style="text-align:left; background: #999;">LAIN-LAIN</td>								
							</tr>
							<?php 
								$nominal=0;
								$kas5 = $this->db->query("SELECT * from mst_pemasukan");
								$a=0; foreach ($kas5->result_array() as $kas5) { 
								$a++;
								$lain = $this->db->query("SELECT akun, trx_jurnal.uraian, sum(nominal) as nominal, jenis from trx_jurnal where akun = '".$kas5['kode_pemasukan']."' AND (tgl BETWEEN '".$mulai."' AND '".$akhir."') AND (akun in (select kode_pemasukan from mst_pemasukan) 
									or akun in (select kode_pengeluaran from mst_pengeluaran)) group by akun");
								$ajs5 = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas5['kode_pemasukan']."' AND id_ajs_jurnal=".$idz."")->row();
								$ajsNilai5=!isset($ajs5->nominal)?0:$ajs5->nominal;
								if($lain->num_rows() > 0){
									$nominal = $lain->row()->nominal+$ajsNilai5;
								} else{
									$nominal=$ajsNilai5;
								}

								if ($kas5['jenis_pemasukan'] == '2') {
							?>
								<tr>
									<td style="text-align:center;"><?php echo $kas5['kode_pemasukan']; ?></td>
									<td><?php echo $kas5['nama_pemasukan']; ?></td>
									<td style="text-align:right;"><?php $ttl_keluar2 += $nominal; echo rp($nominal); ?></td>								
								</tr>
							<?php } } ?>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Total Pendapatan Lain</b></td>
								<td style="text-align:right;"><b><?php echo rp($ttl_keluar2); ?></b></td>
							</tr>
							<?php 
								$nominal=0;
								$kas4 = $this->db->query("SELECT * from mst_pengeluaran");
								$a=0; foreach ($kas4->result_array() as $kas4) { 
								$a++;
								$lain2 = $this->db->query("SELECT akun, trx_jurnal.uraian, sum(nominal) as nominal, jenis from trx_jurnal where akun = '".$kas4['kode_pengeluaran']."' AND (tgl BETWEEN '".$mulai."' AND '".$akhir."') AND (akun in (select kode_pemasukan from mst_pemasukan) 
									or akun in (select kode_pengeluaran from mst_pengeluaran)) group by akun");
								$ajs4 = $this->db->query("SELECT * from ajs_jurnal_detail where akun ='".$kas4['kode_pengeluaran']."' AND id_ajs_jurnal=".$idz."")->row();
								$ajsNilai4=!isset($ajs4->nominal)?0:$ajs4->nominal;
								if($lain2->num_rows() > 0){
									$nominal = ($lain2->row()->nominal+$ajsNilai4)*-1;
								} else{
									$nominal=$ajsNilai4*-1;
								}

								if ($kas4['jenis_pengeluaran'] == '3') {
							?>
								<tr>
									<td style="text-align:center;"><?php echo $kas4['kode_pengeluaran']; ?></td>
									<td><?php echo $kas4['nama_pengeluaran']; ?></td>
									<td style="text-align:right;"><?php $ttl_keluar3 += $nominal; echo rp($nominal); ?></td>								
								</tr>
							<?php } } ?>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Total Beban Lain</b></td>
								<td style="text-align:right;"><b><?php echo rp($ttl_keluar3); ?></b></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="1" style="text-align:left;"><b>Total Beban/Pendapatan Lain</b></td>
								<td style="text-align:right;"><b><?php echo 'Rp '.number_format($ttl_keluar2-$ttl_keluar3).'.00'; ?></b></td>
							</tr>
							<tr>
								<td colspan="3"></td>
							</tr>
							<tr style="background: #AAA;">
								<td></td>								
								<?php 
									$sub = $ttl_masuk-$ttl_keluar-$ttl_keluar1;
									$sub2= $ttl_keluar2-$ttl_keluar3;
									$labarugi = $sub+$sub2;
								?>
								<td colspan="1" style="text-align:left;"><b>PENDAPATAN BERSIR SEBELUM PAJAK</b></td>
								<td style="text-align:right;"><b><?php echo 'Rp '.number_format($labarugi).'.00'; ?></b></td>
								
							</tr>
						</tbody>						
					</table>					
			   </div>
			</form>				
			</div>			
		</div>
	</div>
</div>
<script src="<?php echo base_url()?>assets/js/func.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
	//$('#loading').hide();
	$(".date").datepicker({
		format : "dd-mm-yyyy",		
		autoclose : true,
	});
});	
function dialogFormPrint()

	{
		//var htmlOut = ajaxFillGridJSON('transaksi/printbkk', {idx : idx}); 

		var htmlOut = "<?php echo site_url("laporan/printlabarugi")?>";
        
        window.open(htmlOut);
	}
function getLaba(){
	var idx = $('#start').val();
		ids = $('#end').val();		
		kodeTipeKaryawan = ajaxFillGridJSON('laporan/rugilaba', {start : idx,end : ids});
		$('.content-wrapper').html(kodeTipeKaryawan);	
	
}
</script>