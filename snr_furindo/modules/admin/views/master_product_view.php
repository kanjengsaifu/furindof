<div class="content-header">   
	<h1>Daftar Product</h1>
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
	        <h4 class="modal-title" id="FormTambahData">Tambah Data Bom</h4>
	      </div>
	      <form id="formBaru" class="form-horizontal" onsubmit="simpanreg(); return false;">
	      <div class="modal-body">
	      	<div class="pesanBaru"></div>
	      		
	      			<div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Product Item COde</label>
					    <div class="col-sm-8">
				    	  	<input type="text" oninput="lookUpUsername(this.value)" placeholder="Product Code" name="code" id="code" class="form-control" required/> 
				    	  	<span id="error3" style="margin-top:4px; color: Red; display: none">* kode sudah ada</span>
                			<span id="error2"  style="margin-top:4px; color: green; display: none">* kode tersedia</span>	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Product Name</label>
					    <div class="col-sm-8">
				    	  	<input type="text" placeholder="Product Name" name="name" id="name" class="form-control" required/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Deafault Product COst</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Product Cost" name="cost" id="cost" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Default Product Price</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Price USD" name="price" id="price" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Default Product Cubic Meter</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Product CBM" name="cbm" id="cbm" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Product Weight</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Product Weight" name="weight" id="weight" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Product Bundle</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Product Bundle" name="bundle" id="bundle" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Biaya Labor</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Biaya Labor" name="labor" id="labor" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Biaya Overhead</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Biaya Overhead" name="overhead" id="overhead" class="form-control"/> 	
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
	        <h4 class="modal-title" id="FormUbahData">Ubah Data Bom</h4>
	      </div>
	      <form id="formUbah" class="form-horizontal" onsubmit="updatereg(); return false;">
	      <input type="hidden" name="idx" id="idx" class="form-control"/> 
	      <div class="modal-body">
	      	<div class="pesanBaru"></div>
	      		
	      			<div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Product Item COde</label>
					    <div class="col-sm-8">
				    	  	<input type="text" oninput="lookUpUsername(this.value)" placeholder="Product Code" name="code" id="codeubah" class="form-control" required/> 
				    	  	<span id="error0" style="margin-top:4px; color: Red; display: none">* kode sudah ada</span>
                			<span id="error1"  style="margin-top:4px; color: green; display: none">* kode tersedia</span>	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Product Name</label>
					    <div class="col-sm-8">
				    	  	<input type="text" placeholder="Product Name" name="name" id="nameubah" class="form-control" required/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Deafault Product COst</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Product Cost" name="cost" id="costubah" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Default Product Price</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Price USD" name="price" id="priceubah" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Default Product CBM</label>
					    <div class="col-sm-8">
				    	  	<input type="number" step="0.001" placeholder="Product CBM" name="cbm" id="cbmubah" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Product Weight</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Product Weight" name="weight" id="weightUbah" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Product Bundle</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Product Bundle" name="bundle" id="bundleubah" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Biaya Labor</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Biaya Labor" name="labor" id="laborubah" class="form-control"/> 	
					    </div>
				    </div>
				    <div class="form-group">
					    <label for="kodeKaryawan" class="col-sm-4 control-label">Biaya Overhead</label>
					    <div class="col-sm-8">
				    	  	<input type="number" placeholder="Biaya Overhead" name="overhead" id="overheadubah" class="form-control"/> 	
					    </div>
				    </div>
		          
	      </div>
	      <div class="modal-footer">
	        <button type="submit" id="tbh1" class="btn btn-primary">Tambah</button>
	        <button type="button" class="btn btn-warning" id="btnBatalUbah">Batal</button>
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

   		$('#btnBatalUbah').click( function(e){
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
                  { name: "idx", 		type: "string" },
                  { name: "kode", 		type: "string" },
                  { name: "foto", 		type: "string" },
                  { name: "nama", 		type: "string" },
                  { name: "harga", 		type: "string" },
                  { name: "cost", 		type: "string" },
                  { name: "cbm", 		type: "string" },
                  { name: "weight", 	type: "string" },
                  { name: "bundle", 	type: "string" },
                  { name: "labor", 		type: "string" },
                  { name: "overhead", 	type: "string" },                  
                  { name: "action", 	type: "string" }
             ],
            url : "admin/GetDaftarProduct",
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
            sortable: true,
            filterable: true,
            height: '600px',
            pageable : true,
            pageSize : 14,
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
              { text: 'Cost', cellsAlign: 'left', align: 'center', dataField: 'cost', width : '10%'},
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

		var	idx      		= data.idx,	
	 		kode 			= data.kode,	
	 		nama    		= data.nama,
	 		harga 			= data.harga,
	 		cost 			= data.cost,
	 		cbm 			= data.cbm,
	 		weight 			= data.weight,
	 		bundle 			= data.bundle,
	 		labor 			= data.labor,
	 		overhead		= data.overhead;

			$('#alertMessage').remove();
			$('#idx').val(idx);
		 	$('#codeubah').val(kode);
		 	$('#nameubah').val(nama);
		 	$('#priceubah').val(harga);
		 	$('#costubah').val(cost);
		 	$('#cbmubah').val(cbm);
	 		$('#weightUbah').val(weight);
	 		$('#bundleubah').val(bundle);	 		
	 		$('#laborubah').val(labor);
			$('#overheadubah').val(overhead);

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
		
	   	isDelete = confirm('Yakin Product '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/HapusProduct', {ID : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/Product'); 
	    //alert("Data berhasil disimpan.");
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

	function simpanreg()
	{
		var target = "<?php echo site_url("admin/saveproduct")?>";
			data = $("#formBaru").serialize();
		$.post(target, data, function(e){
			//$(".content-wrapper").html(e);
			//console.log(e);
			//return false;
			//tinymce.triggerSave();
			
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			
				var htmlOut = ajaxFillGridJSON('admin/Product'); 
	    		alert("Data berhasil disimpan.");
	   			$('.content-wrapper').html(htmlOut);
				// loadhtml = "<?php echo site_url("admin/Bom")?>";
				// alert("Data berhasil disimpan.");
				// $(".content-wrapper").load(loadhtml);		
	
		});
	}

	function updatereg()
	{
		var target = "<?php echo site_url("admin/updateproduct")?>";
			data = $("#formUbah").serialize();
		$.post(target, data, function(e){
			//$(".content-wrapper").html(e);
			//console.log(e);
			//return false;		
			
				var htmlOut = ajaxFillGridJSON('admin/Product'); 
	    		alert("Data berhasil disimpan.");
	   			$('.content-wrapper').html(htmlOut);
					
	
		});
	}

	function lookUpUsername(name){
    $.post( 
        '<?php echo base_url();?>admin/ajax_lookUpUsername',
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
            		
</script>

 