<div class="content-header">   
	<h1>Daftar Kelompok Swadaya Masyarakat</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak Excel</button>		
			</div>
	  		<div class="form-control" style="min-height:450px; width:100%">
				<div id="ajaxTreeGrid"></div>
			</div>
		</div> <!-- <div class="box-body"> -->
	  </div>
	</div> <!-- <div class="box box-warning"> -->
</div>
	
<script>
	$(document).ready(function () {
                     
    	$('#btnTambahBaru').click(function(e)
        {
			var loadhtml = "<?php echo site_url("admin/tambahKsm")?>";
			$(".content-wrapper").load(loadhtml);              
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
          var loadhtml = "<?php echo site_url("admin/CetakKsm")?>";
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
                  { name: "no",   type: "string" },
                  { name: "kode", 	type: "string" },
                  { name: "nama", 	type: "string" },
                  { name: "tanggal", 	type: "string" },
                  { name: "action", 	type: "string" }
             ],
            url : "admin/GetDaftarKsm",
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
            height: '440px',
            pageable : true,
            pageSize : 10,
            pagerPosition : 'bottom',
            filterMode: 'simple',
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'No', cellsAlign: 'center', align: 'center', dataField: 'idx', width : '10%'},
              { text: 'Kode', cellsAlign: 'center', align: 'center', dataField: 'kode', width : '10%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '30%'},
              { text: 'Tanggal', cellsAlign: 'center', align: 'center', dataField: 'tanggal', width : '15%'},              
              { text: 'Aksi', cellsAlign: 'center', align: 'center', dataField: 'action', width: '35%' }
            ]
        }).on('rowDoubleClick', function(event)
        {	          	
        	dialogFormEditShow();
	    });	
	}

	function deleteConfirmShow()
	{ 

	 	var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');
		var dataKaryawan = selection[0];
		
		var idx	 = dataKaryawan.idx;
		var nama = dataKaryawan.nama;
		
	   	isDelete = confirm('Yakin Karyawan '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/HapusKaryawan', {IDKaryawan : idx}, 'box-body');
	}

  function dialogFormEditShow(idx)

  {     
    var htmlOut = ajaxFillGridJSON('admin/editdataKsm', {idx : idx}); 
    
    $('.content-wrapper').html(htmlOut);
  }
            		
</script>

 