<div class="content-header">   
	<h1>Daftar Material</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>		
			</div>
	  		<div class="form-control" style="min-height:610px;">
				<div id="ajaxTreeGrid"></div>
			</div>
		</div> 
	  </div>
	</div> 
</div>

 <div class="modal hide" id="dialogFormBaru" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">
	 <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="FormTambahData">Tambah Data Material</h4>
	      </div>
	      <form id="formBaru" class="form-horizontal" onsubmit="simpanreg(); return false;">
	      <div class="modal-body">
	      	<div class="pesanBaru"></div>	      		
  			<div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Material Item COde</label>
			    <div class="col-sm-8">
		    	  	<input type="text" oninput="lookUpUsername(this.value)" placeholder="Material Code" name="code" id="code" class="form-control" required/> 
		    	  	<span id="error3" style="margin-top:4px; color: Red; display: none">* kode sudah ada</span>
        			<span id="error2"  style="margin-top:4px; color: green; display: none">* kode tersedia</span>	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Material Name</label>
			    <div class="col-sm-8">
		    	  	<input type="text" placeholder="Material Name" name="name" id="" class="form-control" required/> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Categories </label>
			    <div class="col-sm-8">
			       	<select name="categories" class="form-control">
			       		<option value=''>:: Pilih MATERIAL CATEGORIES ::</option>
			       		<?php  
			       			$CI = get_instance();
			       			$selectQuery =  $CI->db->query("SELECT * from tbl_material_categories ");
			       			$arrTipeKaryawan = $selectQuery->result_array();
			       			foreach ($arrTipeKaryawan as $row) {
			       				echo "<option value='".$row['material_categories_id']."'>".$row['material_categories_name']."</option>";
			       			}
			       		?>
			       	</select>
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Categories Group </label>
			    <div class="col-sm-8">
			       	<select name="Group" class="form-control">
			       		<option value=''>:: Pilih MATERIAL CATEGORIES GROUP::</option>
			       		<?php  
			       			$CI = get_instance();
			       			$selectQuery =  $CI->db->query("SELECT * from tbl_material_categories_group ");
			       			$arrTipeKaryawan = $selectQuery->result_array();
			       			foreach ($arrTipeKaryawan as $row) {
			       				echo "<option value='".$row['material_categories_group_id']."'>".$row['material_categories_group_name']."</option>";
			       			}
			       		?>
			       	</select>
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Satuan </label>
			    <div class="col-sm-8">
			       	<select name="Satuan" class="form-control">
			       		<option value=''>:: Pilih Satuan::</option>
			       		<?php  
			       			$CI = get_instance();
			       			$selectQuery =  $CI->db->query("SELECT * from tbl_unit ");
			       			$arrTipeKaryawan = $selectQuery->result_array();
			       			foreach ($arrTipeKaryawan as $row) {
			       				echo "<option value='".$row['unit_id']."'>".$row['unit_name']."</option>";
			       			}
			       		?>
			       	</select>
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Deafault Material Usd</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Material Price USD" name="usd" id="" class="form-control"/> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Default Material Price</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Price USD" name="price" id="" class="form-control"/> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Default Material CBM</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Material CBM" name="cbm" id="" class="form-control"/> 	
			    </div>
		    </div>				    
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Minimal Stock</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Minimal Stock" name="stock"  class="form-control"/> 	
			    </div>
		    </div>		          
	      </div>
	      <div class="modal-footer">
	        <button type="submit" id="tbh" class="btn btn-primary">Tambah</button>
	        <button type="button" class="btn btn-warning" id="btnBatalTambahKaryawan">Batal</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
</div>

 
<div class="modal hide" id="dialogFormUbah" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">
	 <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="FormUbahData">Ubah Data Material</h4>
	      </div>
	      <form id="formUbah" class="form-horizontal" onsubmit="updatereg(); return false;">
	      <input type="hidden" name="idx" id="idx" class="form-control"/> 
	      <div class="modal-body">
	      	<div class="pesanBaru"></div>	      		
  			<div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Material Item COde</label>
			    <div class="col-sm-8">
		    	  	<input type="text"  oninput="lookUpUsername2(this.value)" placeholder="Material Code" name="code" id="kode" class="form-control" required/> 
		    	  	<span id="erd2" style="margin-top:4px; color: Red; display: none">* kode sudah ada</span>
        			<span id="erd3"  style="margin-top:4px; color: green; display: none">* kode tersedia</span>	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Material Name</label>
			    <div class="col-sm-8">
		    	  	<input type="text" placeholder="Material Name" name="name" id="name" class="form-control" required/> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Categories </label>
			    <div class="col-sm-8">
			       	<select name="categories" class="form-control">
			       		<option value=''>:: Pilih MATERIAL CATEGORIES ::</option>
			       		<?php  
			       			$CI = get_instance();
			       			$selectQuery =  $CI->db->query("SELECT * from tbl_material_categories ");
			       			$arrTipeKaryawan = $selectQuery->result_array();
			       			foreach ($arrTipeKaryawan as $row) {
			       				echo "<option id='categories-".$row['material_categories_id']."' value='".$row['material_categories_id']."'>".$row['material_categories_name']."</option>";
			       			}
			       		?>
			       	</select>
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Categories Group </label>
			    <div class="col-sm-8">
			       	<select name="Group" class="form-control">
			       		<option value=''>:: Pilih MATERIAL CATEGORIES GROUP::</option>
			       		<?php  
			       			$CI = get_instance();
			       			$selectQuery =  $CI->db->query("SELECT * from tbl_material_categories_group ");
			       			$arrTipeKaryawan = $selectQuery->result_array();
			       			$i=1;
			       			foreach ($arrTipeKaryawan as $row) {
			       				echo "<option id='gr-".$row['material_categories_group_id']."' value='".$row['material_categories_group_id']."'>".$row['material_categories_group_name']."</option>";
			       			$i++; } 
			       		?>
			       	</select>
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Satuan </label>
			    <div class="col-sm-8">
			       	<select name="Satuan" class="form-control">
			       		<option value=''>:: Pilih Satuan::</option>
			       		<?php  
			       			$CI = get_instance();
			       			$selectQuery =  $CI->db->query("SELECT * from tbl_unit ");
			       			$arrTipeKaryawan = $selectQuery->result_array();
			       			foreach ($arrTipeKaryawan as $row) {
			       				echo "<option id='unit-".$row['unit_id']."' value='".$row['unit_id']."'>".$row['unit_name']."</option>";
			       			}
			       		?>
			       	</select>
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Deafault Material Usd</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Material Price USD" name="usd" id="usd" class="form-control"/> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Default Material Price</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Price USD" name="price" id="price" class="form-control"/> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Default Material CBM</label>
			    <div class="col-sm-8">
		    	  	<input type="number" step="0.001" placeholder="Material CBM" name="cbm" id="cbm" class="form-control"/> 	
			    </div>
		    </div>				    
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Minimal Stock</label>
			    <div class="col-sm-8">
		    	  	<input type="number" placeholder="Minimal Stock" name="stock" id="stock" class="form-control"/> 	
			    </div>
		    </div>		          
	      </div>
	      <div class="modal-footer">
	        <button type="submit" id="tbh" class="btn btn-primary">Tambah</button>
	        <button type="button" class="btn btn-warning" id="btnBatalUbahKaryawan">Batal</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
</div>
 
	
<script>
	$(document).ready(function () {
                     
    	$('#btnTambahBaru').click(function(e)
        {
			e.preventDefault(); 
			resetForm();
	    	$('#alertMessage').remove();
	    	$('#dialogFormBaru').attr('class', 'modal show');               
        });

        $('#btnBatalTambahKaryawan').click( function(e){
    		e.preventDefault(); 
    		$('#dialogFormBaru').attr('class', 'modal hide');
   		});        

   		$('#btnBatalUbahKaryawan').click( function(e){
	    	e.preventDefault(); 
	    	$('#alertMessage').remove();
	    	$('#dialogFormUbah').attr('class', 'modal hide');
	    });

   		$('#btnTambahKaryawan').click( function(e){
 			e.preventDefault();
	       	sendRequestForm($('#formBaru').attr('action'), $('#formBaru').serialize(), 'pesanBaru');
	    });
 	
	    $('#btnUbahKaryawan').click( function(e){
 			e.preventDefault(); 
	       	sendRequestForm($('#formUbah').attr('action'), $('#formUbah').serialize(), 'pesanUbah'); 
	    });

	    $('#btnCari').click( function(e){
 			e.preventDefault(); 
	       	ajaxDataGrid($('#formCari').attr('action'),  $('#formCari').serialize(), 'ajaxTreeGrid'); 
	    });

	    $('#btnCetak').click(function(e)
	      {   
	        var loadhtml = "<?php echo site_url("admin/CetakKaryawan")?>";
	        window.open(loadhtml);

	      });

	    
        loadGridData();

    });

    function resetForm()
	{
		$('#kodeBidang, #kodeKaryawan, #kodeBidangUbah, #kodeKaryawanUbah').html('');
		$('input[type="text"], input[type="password"], select').val('');
		$('textarea').val('');
		$('input:first').focus();

		loadGridData();
	}

	function loadGridData(){
	     var source =
         {		
             dataType: "json",
             dataFields: [
                  { name: "idx", 	type: "string" },
                  { name: "kode", 	type: "string" },
                  { name: "cbm", 	type: "string" },
                  { name: "nama", 	type: "string" },
                  { name: "harga", 	type: "string" },
                  { name: "usd", 	type: "string" },
                  { name: "provider", 	type: "string" },
                  { name: "unit", 	type: "string" },
                  { name: "stock", 	type: "string" },
                  { name: "group", 	type: "string" }, 
                  { name: "categories",	type: "string" },                                   
                  { name: "action", 	type: "string" }
             ],
            url : "admin/GetDaftarMaterial",
            id  : "idx"
         };

        var dataAdapter = new $.jqx.dataAdapter(source, {
            loadComplete: function () {		
            }
        });

        // create jqxDataTable.
        $("#ajaxTreeGrid").jqxDataTable(
        {
            source: dataAdapter,
            pagerButtonsCount: 10,
            altRows: true,
            filterable: true,
            height: '600px',
            pageable : true,
            pageSize : 15,
            pagerPosition : 'bottom',
            filterMode: 'simple',
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'idx', width : '10%'},
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '15%'},
              // { text: 'Foto', cellsAlign: 'left', align: 'center', dataField: 'foto', width : '12%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '40%'},
              { text: 'Harga', cellsAlign: 'left', align: 'center', dataField: 'harga', width : '15%'},
              { text: 'Provider', cellsAlign: 'left', align: 'center', dataField: 'provider', width : '12%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '10%' }
            ]
        }).on('rowDoubleClick', function(event)
        {	          	
        	dialogFormEditShow();
	    });	
	}

	function dialogFormEditShow()
	{ 
		var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');

		var data = selection[0];

		var	idx      	= data.idx,			
			kode 		= data.kode,
			nama 		= data.nama,
	 		cbm 		= data.cbm,	
	 		harga    	= data.harga,
	 		usd 		= data.usd,
	 		provider 	= data.provider,
	 		unit 		= data.unit,
	 		group 		= data.group,
	 		categories 	= data.categories,
	 		stock 		= data.stock;

			$('#alertMessage').remove();
			$('#idx').val(idx);
		 	$('#kode').val(kode);
		 	$('#name').val(nama);
		 	$('#cbm').val(cbm);
		 	$('#price').val(harga);
		 	$('#usd').val(usd);
	 		$('#provider').val(provider);
	 		$('#unit-'+unit).attr('selected','selected');	 		
	 		$('#gr-'+group).attr('selected','selected');
	 		$('#categories-'+categories).attr('selected','selected');
			$('#stock').val(stock);

			$('#dialogFormUbah').attr('class', 'modal show');

	}

	function dialogFormUbahClose()
	{
		 $('#dialogFormUbah').attr('class', 'modal close');	
	}

	function dialogFormBaruClose()
	{
		 $('#dialogFormBaru').attr('class', 'modal close');	
	}

	function deleteConfirmShow()
	{ 

	 	var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');
		var dataKaryawan = selection[0];
		
		var idx	 = dataKaryawan.idx;
		var nama = dataKaryawan.nama;
		
	   	isDelete = confirm('Yakin Material '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/HapusMaterial', {ID : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/Material'); 	    
	   	$('.content-wrapper').html(htmlOut);
	}


	function fillKodeDivisi(objSource, objReference)
	{
		
		var IDBidang = $(objSource).val();
		kodeTipeKaryawan = ajaxFillGridJSON('admin/GetKodeBidangAJax', {IDBidang : IDBidang}); 
		$(objReference).html(kodeTipeKaryawan);
	}

	function fillKodeDivisi(objSource, objReference)
	{
		
		var IDDivisi = $(objSource).val();
		kodeTipeKaryawan = ajaxFillGridJSON('admin/GetKodeDivisiAJax', {IDDivisi : IDDivisi}); 
		$(objReference).html(kodeTipeKaryawan);
	}

	function lookUpUsername(name)
	{
		var idx = 0;
	    $.post( 
	        '<?php echo base_url();?>admin/ajax_lookUpMaterial',
	         { code: name },
	         function(response) {  
	            if (response == 1) {
	                //alert('username ok');
	                  document.getElementById("error2").style.display = "inline";
	                  document.getElementById("error3").style.display = "none";
	                $('#tbh').prop('disabled', false);
	            } else {
	                document.getElementById("error2").style.display = "none";
	                document.getElementById("error3").style.display = "inline";
	                $('#tbh').prop('disabled', true);
	            }
	         }  
	    );
	}

	function lookUpUsername(name)
	{
		var idx = $('#idx').val();
	    $.post( 
	        '<?php echo base_url();?>admin/ajax_lookUpMaterial',
	         { kode: name, Idx : idx },
	         function(response) {  
	            if (response == 1) {
	                //alert('username ok');
	                  document.getElementById("error2").style.display = "inline";
	                  document.getElementById("error3").style.display = "none";
	                $('#tbh').prop('disabled', false);
	            } else {
	                document.getElementById("error2").style.display = "none";
	                document.getElementById("error3").style.display = "inline";
	                $('#tbh').prop('disabled', true);
	            }
	         }  
	    );
	}

	function simpanreg()
	{
		var target = "<?php echo site_url("admin/savematerial")?>";
			data = $("#formBaru").serialize();
		$.post(target, data, function(e){
			//$(".content-wrapper").html(e);
			//console.log(e);
			//return false;
			//tinymce.triggerSave();
			
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			
				var htmlOut = ajaxFillGridJSON('admin/Material'); 
	    		alert("Data berhasil disimpan.");
	   			$('.content-wrapper').html(htmlOut);
				// loadhtml = "<?php echo site_url("admin/Bom")?>";
				// alert("Data berhasil disimpan.");
				// $(".content-wrapper").load(loadhtml);		
	
		});
	}

	function updatereg()
	{
		var target = "<?php echo site_url("admin/updatematerial")?>";
			data = $("#formUbah").serialize();
		$.post(target, data, function(e){
			//$(".content-wrapper").html(e);
			//console.log(e);
			//return false;		
			
				var htmlOut = ajaxFillGridJSON('admin/Material'); 
	    		alert("Data berhasil disimpan.");
	   			$('.content-wrapper').html(htmlOut);
					
	
		});
	}
            		
</script>

 