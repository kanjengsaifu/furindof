<style type="text/css">
	.form-control{
		margin: 2px;
	}
</style>
<div class="content-header">   
	<h1>Ajustment Akuntansi</h1>
</div>
<form id="addkso" onchange="simpanreg()">
<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<!-- <button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>	 -->	
			</div>
			<div class="col-sm-6">
				<div class="form-group">
				<label for="Nomor" class="col-sm-3 control-label">Tanggal :</label>
					<div class="col-sm-8">
					<input type="hidden" name="ajs[id]" value="<?php echo $ajs->id ?>">
					  <div class="input-group date" style="padding: 2px 0px 3px 2px;">
                        <input type="text" style="margin:0px;" readonly value="<?php echo date("d-m-Y", strtotime($ajs->tgl)) ?>" role="date" class="form-control date"  name="ajs[tgl]" >
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                      </div>
					</div>
				</div>
				<div class="form-group">
				<label for="Nomor" class="col-sm-3 control-label">Keterangan :</label>
					<div class="col-sm-8">
						<textarea class="form-control" name="ajs[keterangan]" ><?php echo $ajs->keterangan ?></textarea>						
					</div>
				</div>
				<div class="form-group">
				<label for="Nomor" class="col-sm-3 control-label">Status :</label>
					<div class="col-sm-8">
						<select class="form-control" name="ajs[status]" required>
							<option value="1">ACTIVE</option>
							<option <?php echo $ajs->status==0?"selected=selected":""; ?> value="0">NOT ACTIVE</option>
						</select>
					</div>
				</div>
	  		</div>
	  		<!-- <div class="form-control" style="min-height:550px;"> -->	  		
	  		<div class="" style="width:100%; margin:0px auto;"> 
				<table id="example2" class="table table-bordered table-striped table-responsive">
		            <thead style="">
		                <tr>            
		                    <th style="text-align:center; width:5%"> NO</th>
		                    <th style="text-align:center; width:10%"> Kode Akun</th>
		                    <th style="text-align:center; width:10%"> Nama Akun</th>                    
		                    <th style="text-align:center; width:15%"> Nominal Awal</th>
		                    <th style="text-align:center; width:16%"> Set Nominal</th>
		                    <th style="text-align:center; width:30%"> Keterangan </th>
		                    <th style="text-align:center; width:12%"> Selisih </th>		                    
		                </tr>
		            </thead>
		            <tbody id="ajaxTreeGrid">
		            <?php $i=1; foreach($akun->result() as $row): 
		            	$csr = $this->db->query("SELECT * from ajs_jurnal_detail t1 where t1.id_ajs_jurnal=".$ajs->id." and t1.akun = '".$row->akun."'")->row();
		            	$beban = $this->db->query("SELECT * from mst_pengeluaran where kode_pengeluaran ='".$row->akun."'")->row();
		            	$minus=1;
		            	if(isset($beban->level)){
		            		$minus=-1;
		            	}
		            ?>
		            	<tr>
		            		<input type="hidden" name="id[]" value="<?php echo $csr->id; ?>">
		            		<input type="hidden" name="akun[]" value="<?php echo $row->akun; ?>">
		            		<input type="hidden" name="uraian[]" value="<?php echo $row->uraian; ?>">
		            		<td><?php echo $i; ?></td>
		            		<td><?php echo $row->akun; ?></td>
		            		<td><?php echo $row->uraian; ?></td>
		            		<td><?php echo rp($row->amount*$minus); ?></td>
		            		<td><input id="num-<?php echo $i ?>" style="width:100%; text-align:right;padding:2px;" name="nominal[]" value="<?php echo number_format($csr->nominal*$minus); ?>" onkeyup="getnumeric(this)"></td>
		            		<td><input name="keterangan[]" style="width:100%;padding:2px;" value="<?php echo $csr->keterangan ?>"></td>
		            		<td id="xnum-<?php echo $i ?>" awal="<?php echo ($row->amount*$minus) ?>"><?php echo number_format(($row->amount*$minus)-($csr->nominal*$minus)) ?></td>
		            	</tr>
		            <?php $i++; endforeach; ?>                   
		            </tbody>
		        </table>
			</div>
			<div class="form-horizontal footer">
				<div class="row" id="addcol">
					<div class="col-sm-6">
						&nbsp;&nbsp;<button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Simpan Data</button>
						<!-- <button onclick="adddataprint('')" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span> Simpan Data dan Cetak</button>
						<button onclick="batal()" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> Batal</button> -->
					</div>
				</div>				
			</div>			
		</div> 
	  </div>	  
	</div> 
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
	$(".date").datepicker({
			format : "dd-mm-yyyy",
			//startDate : new Date('<?php echo date('Y-m-d', strtotime("-".$_SESSION['Akses']." days"))?>'),
		    //endDate : new Date('<?php echo date('Y-m-d', strtotime("+90 days"))?>'),
			autoclose : true,
		});	
});
	function simpanreg(){
		$("#addkso").attr('onsubmit','simpanregs(); return false;');
		return false;
	}
	function simpanregs()
	{
		var data = $("#addkso").serialize();

		var htmlOut = ajaxFillGridJSON('akuntansi/saveAjsAkun', data);	    		
	   	//$('.content-wrapper').html(htmlOut);
	   	//return false;
		//sendRequestForm('admin/updateso', data, 'box-body');
		var kodeTipeKaryawan = ajaxFillGridJSON('akuntansi/ajustmentAkun', {}); 
		alert("Data berhasil disimpan.");
		$('.content-wrapper').html(kodeTipeKaryawan);
		
	}
	function getnumeric(elem)
	{
		
		var getelem = $(elem).attr("id");
			getval = $("#"+getelem).val().replace(/,/ig, '');
			currancy = getval.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			asd = $('#x'+getelem).attr('awal');
			selisih = ""+(parseInt(asd)-parseInt(getval))+"";
			getval = $("#"+getelem).val(currancy);
			//$("#"+getelem).val(currancy);			
			selisih1 =selisih.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			$('#x'+getelem).html(selisih1);
			//calculates();
	}
</script>

<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": false
        });
      });
</script>
