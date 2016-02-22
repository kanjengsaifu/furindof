<div class="content-header">   
	<h1>Daftar Suplier</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>		
			</div>
			<div class="row form-group">
				<label class="col-sm-8 control-label"></label>
				<div class="col-sm-4">
					<div class="input-group">
						<input type="text" id="caridata" oninput="loadGridData(2)" placeholder="Cari data product" value="" class="form-control" autofocus> 
						<div class="input-group-addon">
							<i class="fa fa-search"></i>
					  	</div>
					</div> 
	  			</div>
	  		</div>
	  		<div class="form-control" style="min-height:550px;">
				<table id="example2" class="table table-bordered table-striped">
		            <thead style="">
		                <tr>            
		                    <th style="text-align:center; width:5%"> SID</th>
		                    <th style="text-align:center; width:10%"> Kode Suplier</th>
		                    <th style="text-align:center; width:17%"> Nama Suplier</th>                    
		                    <th style="text-align:center; width:30%"> Alamat </th>
		                    <th style="text-align:center; width:10%"> Telepon </th>
		                    <th style="text-align:center; width:17%"> Email </th>
		                    <th style="text-align:center; width:10%"> Action </th>
		                </tr>
		            </thead>
		            <tbody id="ajaxTreeGrid">                   
		            </tbody>
		        </table>
			</div>
		</div> 
	  </div>
	</div> 
</div>

<div class="modal hide" id="dialogFormBaru" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">

	 <div class="modal-dialog" style="min-width:70%">

	    <div class="modal-content">

	      <div class="modal-header">

	        <h4 class="modal-title" id="FormTambahData">Tambah Data Suplier</h4>

	      </div>

	      <form id="formBaru" class="form-horizontal" onsubmit="simpanreg(); return false;">

	      <div class="modal-body">

	      	<div class="pesanBaru"></div>	      		

	      			<div class="row">

	      				<div class="col-sm-6">

							<div class="form-group">

							    <label for="kode" class="col-sm-3 control-label">Categories</label>

							    <div class="col-sm-9">							    	

							    	<input type="hidden" id="tipe" name="tipe" value="2"/>

							    	<input type="text" readonly class="form-control" value="SUPLIER"/>

							    </div>

						    </div>
						    
			      			<div class="form-group">

							    <label for="kode" class="col-sm-3 control-label">Kode</label>

							    <div class="col-sm-9">

							       	<input id="kode" name="kode" value="" type="text" class="form-control" required/>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="nama" class="col-sm-3 control-label">Nama</label>

							    <div class="col-sm-9">

							       	<input id="nama" name="nama" value="" type="text" class="form-control" required/>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="pic" class="col-sm-3 control-label">PIC</label>

							    <div class="col-sm-9">

							       	<input id="pic" name="pic" value="" type="text" class="form-control" required/>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="pic" class="col-sm-3 control-label">KODE POS</label>

							    <div class="col-sm-9">

							       	<input id="pos" name="pos" value="" type="text" class="form-control" />

							    </div>

						    </div>

						     <div class="form-group">

							    <label for="alamat" class="col-sm-3 control-label">Alamat</label>

							    <div class="col-sm-9">

							       	<textarea id="alamat" name="alamat" class="form-control"></textarea>

							    </div>

						    </div>						    

	      				</div> <!-- <div class="col-sm-6"> -->



	      				<div class="col-sm-6">

	      					<div class="form-group">

							    <label for="notelp" class="col-sm-3 control-label">Kota</label>

							    <div class="col-sm-9">

							       	<input id="city" name="city" value="" type="text" class="form-control" />

							    </div>

						    </div>

	      					 <div class="form-group">

							    <label for="notelp" class="col-sm-3 control-label">No Telp 1</label>

							    <div class="col-sm-9">

							       	<input id="notelp1" name="notelp1" value="" type="text" class="form-control" />

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="notelp" class="col-sm-3 control-label">No Telp 2</label>

							    <div class="col-sm-9">

							       	<input id="notelp2" name="notelp2" value="" type="text" class="form-control" />

							    </div>

						    </div>
						    

	      					  <div class="form-group">

							    <label for="email" class="col-sm-3 control-label">Email</label>

							    <div class="col-sm-9">

							       	<input id="email" name="email" value="" type="text" class="form-control"/>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="kodepos" class="col-sm-3 control-label">Fax</label>

							    <div class="col-sm-9">

							       	<input id="fax" name="fax" value="" type="text" class="form-control" />

							    </div>

						    </div>						    

						    <div class="form-group">

							    <label for="deskripsi" class="col-sm-3 control-label">Deskripsi</label>

							    <div class="col-sm-9">

							       	<textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>

							    </div>

						    </div>

	      				</div><!-- <div class="col-sm-6"> -->

	      			</div>		        

		      </div>

		      <div class="modal-footer">

		        <button type="submit" class="btn btn-sm btn-primary">Tambah</button>

		        <button type="button" class="btn btn-sm btn-primary" id="btnBatalTambahKontak">Batal</button>

		      </div>

	      </form>  

	    </div>

	  </div>

	</div> <!-- end modal -->

 
	
<script>
	$(document).ready(function () {

		$('#btnTambahBaru').click( function(e){

 			e.preventDefault(); 
			//$('#dialogFormBaru').attr('class', 'modal close');
			$('#dialogFormBaru').attr('class', 'modal show');

	    });

	    $('#btnBatalTambahKontak').click( function(e){

    		e.preventDefault(); 

    		$('#dialogFormBaru').attr('class', 'modal close');    		

   		}); 
                     
    	    
        loadGridData(1);

    });

    function loadGridData(lmt){ 
		var produk_id = $('#caridata').val();  
        ajaxDataGrid('<?php echo base_url()?>admin/getDataSuplier', {idx : produk_id, limit : lmt}, 'ajaxTreeGrid');       
    }

    function simpanreg()
	{
		var target = "<?php echo site_url("admin/saveprovider")?>";
			data = $("#formBaru").serialize();
		$.post(target, data, function(e){
			//$(".content-wrapper").html(e);
			//console.log(e);
			//return false;
			//tinymce.triggerSave();
			
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			
				var htmlOut = ajaxFillGridJSON('admin/Suplier'); 
	    		alert("Data berhasil disimpan.");
	   			$('.content-wrapper').html(htmlOut);
				// loadhtml = "<?php echo site_url("admin/Bom")?>";
				// alert("Data berhasil disimpan.");
				// $(".content-wrapper").load(loadhtml);		
	
		});
	} 

	function deleteConfirmShow(idx)
	{ 
	 			
	   	isDelete = confirm('Yakin data Suplier akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/HapusProvider', {ID : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/Suplier'); 	    
	   	$('.content-wrapper').html(htmlOut);
	}   
            		
</script>

<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false
        });
      });
    </script>

 