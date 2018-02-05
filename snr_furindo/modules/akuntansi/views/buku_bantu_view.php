<?php //echo "<pre>";print_r($order);"</pre>";exit();  ?>
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
<div class="content-header">        
	<h1>Buku Bantu Keuangan</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form>
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-7">
						<!-- <div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">REF NO :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="FR<?php echo date('mdy') ?>" required/>
							</div>
						</div> -->
						<div class="form-group">
						  <label class="control-label col-sm-3">Jenis Order:</label>
						  <div style="margin-top:5px;" class="col-sm-8">          
							<select id="kas" name="kas" class="selectpicker form-control" data-live-search="true">
								<option value="">--PILIH Jenis Akun--</option>
								<?php 
								$akun = $this->db->query("SELECT * from mst_kasbank where level = 1 order by kode_kasbank asc ");
								foreach ($akun->result() as $row ) {									
								?>
								<option value="<?php echo $row->kode_kasbank; ?>"><?php echo $row->kode_kasbank.' | '.$row->nama_kasbank; ?></option>
								<?php } ?>
							</select>
						  </div>
					  </div>					
					
					<div class="form-group">
                      <label for="rangetanggal" class="control-label col-sm-3">Range Tanggal:</label>
                      <div class="col-sm-8">          
                        <div class="input-group">
                          <input type="text" id="rangetanggal" read-only="readonyl" class="form-control pull-right">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                        </div>
                      </div> 
                  </div> 
                  <div class="form-group text-right">
                      <label for="btnCariBukuKas" class="control-label col-sm-3">&nbsp;</label>
                      <div class="col-sm-8">      
                         <!--<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak</button>  -->     
                        <button type="button" onclick="caridata()" class="btn btn-sm btn-primary"><span class='glyphicon glyphicon-search' aria-hidden='true'></span>&nbsp;Cari</button>
                      </div> <!-- <div class="col-sm-9">  -->
                  </div>
					
				</div>
			</div>
			
			<div class="seperator">
			
			<div class="header1">
				<h4>RINCIAN BUKU PEMBANTU</h4>
			</div>			
				<div class="table-responsive" style="width:90%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th class="btn-primary" style="width:10%; text-align:center; vertical-align: middle;">Tanggal</th>
								<th class="btn-primary" style="width:30%; text-align:center; vertical-align: middle;">Keterangan</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">No Bukti</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">Debet</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">Kredit</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">Saldo</th>								
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
							<?php //echo "<pre>";print_r($order);"</pre>";exit(); 
							
							?>
														
						</tbody>
						<tfoot>
						</tfoot>
					</table>					
			   </div>			
		</div>
		
		<div class="form-horizontal footer">
				<div class="row" id="addcol">
					<div class="col-sm-6">
						<!-- <button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Simpan Data</button> -->
						<!-- <button onclick="adddataprint('')" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span> Simpan Data dan Cetak</button>
						<button onclick="batal()" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> Batal</button> -->
					</div>
				</div>				
			</div>	
		</form>
	</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function () {
      $('.selectpicker').selectpicker('render');                
      resetForm();
      $('#rangetanggal').daterangepicker({
        'buttonClasses' : "btn btn-sm btn-primary",
        'opens'         : 'right',
        'applyClass'    : "btn btn-sm btn-primary",
        'cancelClass'   : "btn btn-sm btn-success" 
      },
      function(start, end, label){
      });  
});  

      

function resetForm()
  {
   
    
    document.getElementById('rangetanggal').readOnly = true; 

    //$('#btnCariBukuKas').click();

  }

function caridata()
	{
		var tgl = $("#rangetanggal").val().split("-");
		var target = "<?php echo site_url("akuntansi/GetDataBukuBantu")?>";
			data = {
				"kas" : $("#kas").val(),
				"awal" : tgl[0],
				"akhir" : tgl[1]
			};
		$.post(target, data, function(e){
			//$(".content-wrapper").html(e);
			//console.log(e);
			//return false;
			dataJson = $.parseJSON(e);
			fillGridDistData(dataJson);
		
		});
	}

	function fillGridDistData(record)
    {
        var table = document.getElementById('tabelContent');
              
        table.innerHTML = '';
        if (record.status==true){
	        for(i = 0; i<record.bantu.length; i++)
	        {
	            var Tanggal = record.bantu[i].tgl;
	                Keterangan = record.bantu[i].ket;
	                Nomor = record.bantu[i].nomor;
	                Debet = record.bantu[i].debet;
	                Kredit = record.bantu[i].kredit;
	                Saldo = record.bantu[i].saldo;
	                
	                
	            var row = table.insertRow();
	            
	            var ColTanggal = row.insertCell(0);
	            var ColKeterangan = row.insertCell(1);
	            var ColNomor = row.insertCell(2);	           
	            var ColDebet = row.insertCell(3);
	            var ColKredit = row.insertCell(4);
	            var ColSaldo = row.insertCell(5);
	            
	            ColTanggal.innerHTML = Tanggal;
	            ColKeterangan.innerHTML = Keterangan;
	            ColNomor.innerHTML = Nomor;
	            ColDebet.innerHTML = Debet;	            
	            ColKredit.innerHTML = Kredit;
	            ColSaldo.innerHTML = Saldo;
	        }
	    }
    }


</script>