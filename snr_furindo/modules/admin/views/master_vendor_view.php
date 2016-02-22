<div class="content-header">   
	<h1>Daftar Vendor</h1>
</div>

<div class="content">
	<div class="box box-primary">
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
		                    <th class="sorting" tabindex='0' style="text-align:center; width:5%"> SID</th>
		                    <th class="sorting" tabindex='1' style="text-align:center; width:10%"> Kode Suplier</th>
		                    <th class="sorting" tabindex='2' style="text-align:center; width:16%"> Nama Suplier</th>                    
		                    <th class="sorting" tabindex='3' style="text-align:center; width:30%"> Alamat </th>
		                    <th class="sorting" tabindex='4' style="text-align:center; width:10%"> Telepon </th>
		                    <th class="sorting" tabindex='5' style="text-align:center; width:17%"> Email </th>
		                    <th class="hidden" tabindex='6' style="text-align:center; width:10%"> Telpon 2 </th>
		                    <th class="hidden" tabindex='7' style="text-align:center; width:10%"> Fax </th>
		                    <th class="hidden" tabindex='8' style="text-align:center; width:10%"> city </th>
		                    <th class="hidden" tabindex='9' style="text-align:center; width:10%"> Kode Pos </th>
		                    <th class="hidden" tabindex='10' style="text-align:center; width:10%"> PIC </th>
		                    <th class="hidden" tabindex='11' style="text-align:center; width:10%"> Descripsi </th>
		                    <th style="text-align:center; width:12%"> Action </th>
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

	        <h4 class="modal-title" id="FormTambahData">Tambah Data Vendor</h4>

	      </div>

	      <form id="formBaru" class="form-horizontal" onsubmit="simpanreg(); return false;">

	      <div class="modal-body">

	      	<div class="pesanBaru"></div>	      		

	      			<div class="row">

	      				<div class="col-sm-6">

							<div class="form-group">

							    <label for="kode" class="col-sm-3 control-label">Categories</label>

							    <div class="col-sm-9">							    	

							    	<input type="hidden" id="tipe" name="tipe" value="1"/>

							    	<input type="text" readonly class="form-control" value="Vendor"/>

							    </div>

						    </div>
						    
			      			<div class="form-group">

							    <label for="kode" class="col-sm-3 control-label">Kode</label>

							    <div class="col-sm-9">

							       	<input name="kode" value="" type="text" class="form-control" required/>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="nama" class="col-sm-3 control-label">Nama</label>

							    <div class="col-sm-9">

							       	<input name="nama" value="" type="text" class="form-control" required/>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="pic" class="col-sm-3 control-label">PIC</label>

							    <div class="col-sm-9">

							       	<input name="pic" value="" type="text" class="form-control" required/>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="pic" class="col-sm-3 control-label">KODE POS</label>

							    <div class="col-sm-9">

							       	<input name="pos" value="" type="text" class="form-control" />

							    </div>

						    </div>

						     <div class="form-group">

							    <label for="alamat" class="col-sm-3 control-label">Alamat</label>

							    <div class="col-sm-9">

							       	<textarea name="alamat" class="form-control"></textarea>

							    </div>

						    </div>						    

	      				</div> <!-- <div class="col-sm-6"> -->



	      				<div class="col-sm-6">

	      					<div class="form-group">

							    <label for="notelp" class="col-sm-3 control-label">Kota</label>

							    <div class="col-sm-9">

							       	<input name="city" value="" type="text" class="form-control" />

							    </div>

						    </div>

	      					 <div class="form-group">

							    <label for="notelp" class="col-sm-3 control-label">No Telp 1</label>

							    <div class="col-sm-9">

							       	<input name="notelp1" value="" type="text" class="form-control" />

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="notelp" class="col-sm-3 control-label">No Telp 2</label>

							    <div class="col-sm-9">

							       	<input name="notelp2" value="" type="text" class="form-control" />

							    </div>

						    </div>
						    

	      					  <div class="form-group">

							    <label for="email" class="col-sm-3 control-label">Email</label>

							    <div class="col-sm-9">

							       	<input name="email" value="" type="text" class="form-control"/>

							    </div>

						    </div>

						    <div class="form-group">

							    <label for="kodepos" class="col-sm-3 control-label">Fax</label>

							    <div class="col-sm-9">

							       	<input name="fax" value="" type="text" class="form-control" />

							    </div>

						    </div>						    

						    <div class="form-group">

							    <label for="deskripsi" class="col-sm-3 control-label">Deskripsi</label>

							    <div class="col-sm-9">

							       	<textarea name="deskripsi" class="form-control"></textarea>

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

	<div class="modal hide" id="dialogFormUbah" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">

	 <div class="modal-dialog" style="min-width:70%">

	    <div class="modal-content">

	      <div class="modal-header">

	        <h4 class="modal-title" id="FormUbahData">Ubah Data Vendor</h4>

	      </div>

	      <form id="formUbah" class="form-horizontal" onsubmit="updatereg(); return false;">

	      <div class="modal-body">

	      	<div class="pesanBaru"></div>	      		

	      			<div class="row">

	      				<div class="col-sm-6">

							<div class="form-group">

							    <label for="kode" class="col-sm-3 control-label">Categories</label>

							    <div class="col-sm-9">							    	
							    <input type="hidden" id="idubah" name="idubah" value=""/>
							    	<input type="hidden" id="tipe" name="tipe" value="1"/>

							    	<input type="text" readonly class="form-control" value="Vendor"/>

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

		        <button type="submit" class="btn btn-sm btn-primary">Update</button>

		        <button type="button" class="btn btn-sm btn-danger" id="btnBatalUbahKontak">Batal</button>

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

   		$('#btnBatalUbahKontak').click( function(e){

    		e.preventDefault(); 

    		$('#dialogFormUbah').attr('class', 'modal close');    		

   		}); 
                     
    	    
        loadGridData(1);

    });

    function loadGridData(lmt){ 
		var produk_id = $('#caridata').val();  
        ajaxDataGrid('<?php echo base_url()?>admin/getDataVendor', {idx : produk_id, limit : lmt}, 'ajaxTreeGrid');       
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
			
				var htmlOut = ajaxFillGridJSON('admin/Vendor'); 
	    		alert("Data berhasil disimpan.");
	   			$('.content-wrapper').html(htmlOut);
				// loadhtml = "<?php echo site_url("admin/Bom")?>";
				// alert("Data berhasil disimpan.");
				// $(".content-wrapper").load(loadhtml);		
	
		});
	}

	function updatereg()
	{
		var target = "<?php echo site_url("admin/updateprovider")?>";
			data = $("#formUbah").serialize();
		$.post(target, data, function(e){
			//$(".content-wrapper").html(e);
			//console.log(e);
			//return false;
			//tinymce.triggerSave();
			
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			
				var htmlOut = ajaxFillGridJSON('admin/Vendor'); 
	    		alert("Data berhasil disimpan.");
	   			$('.content-wrapper').html(htmlOut);
				// loadhtml = "<?php echo site_url("admin/Bom")?>";
				// alert("Data berhasil disimpan.");
				// $(".content-wrapper").load(loadhtml);		
	
		});
	} 

	function dialogFormEditShow(objReference)
	{
		var Id 		= $(objReference).parent().parent().find('td:eq(0)').html();
		var Kode 	= $(objReference).parent().parent().find('td:eq(1)').html();
		var Nama 	= $(objReference).parent().parent().find('td:eq(2)').html();
		var Alamat 	= $(objReference).parent().parent().find('td:eq(3)').html();
		var Telp1 	= $(objReference).parent().parent().find('td:eq(4)').html();
		var Email 	= $(objReference).parent().parent().find('td:eq(5)').html();
		var Telp2 	= $(objReference).parent().parent().find('td:eq(6)').html();
		var Fax 	= $(objReference).parent().parent().find('td:eq(7)').html();
		var City 	= $(objReference).parent().parent().find('td:eq(8)').html();
		var Pos 	= $(objReference).parent().parent().find('td:eq(9)').html();
		var PIC 	= $(objReference).parent().parent().find('td:eq(10)').html();
		var Desc 	= $(objReference).parent().parent().find('td:eq(11)').html();
		//alert(Id);
		//return false;
		$('#alertMessage').remove();
		$('#idubah').val(Id);
		$('#kode').val(Kode);
		$('#nama').val(Nama);
		$('#alamat').val(Alamat);
		$('#notelp1').val(Telp1);
		$('#notelp2').val(Telp2);
		$('#email').val(Email);
		$('#fax').val(Fax);
		$('#pos').val(Pos);
		$('#city').val(City);
		$('#pic').val(PIC);
		$('#deskripsi').val(Desc);

		
	
	    $('#dialogFormUbah').attr('class', 'modal show');
	    //$('body').attr('class', 'skin-green layout-boxed sidebar-collapse modal-open');
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

 