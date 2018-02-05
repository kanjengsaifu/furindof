<div class="content-header">   
	<h1>Daftar Surat Jalan</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" onclick="Add_raw()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<!-- <button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>	 -->	
			</div>
	  		<div class="form-control" style="min-height:610px;">
				<div id="ajaxTreeGrid"></div>
			</div>
		</div> 
	  </div>
	</div> 
</div>

 
	
<script>
	$(document).ready(function () {
                     
    	    
        loadGridData();

    });
    
	
	function deleteConfirmShow(ids)
	{ 

	 	var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');
		var dataKaryawan = selection[0];
		
		var idx	 = dataKaryawan.idx;
		var nama = dataKaryawan.kode;
		
	   	isDelete = confirm('Yakin Surat Jalan '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('suport/HapusSuratJalan', {ID : idx}, 'box-body');
	  	kodeTipeKaryawan = ajaxFillGridJSON('suport/surat_jalan'); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}
    function Add_raw()

	  {     
	    //var htmlOut = ajaxFillGridJSON('admin/AddSales');
	    var loadhtml = "<?php echo site_url("suport/tambah_sj")?>"; 
	    
	    $('.content-wrapper').load(loadhtml);
	  } 
	function dialogFormEditShow(idx)
	{
		//var IDBidang = $(objSource).val();
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		kodeTipeKaryawan = ajaxFillGridJSON('suport/edit_sj', {IDBidang : idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}

	function printShow(idx)
	{
		var htmlOut = "<?php echo site_url("suport/printSJ")?>/"+idx;
        
    window.open(htmlOut);  

	}

	function loadGridData(){
	     var source =
         {		
             dataType: "json",
             dataFields: [
                  { name: "idx", 	type: "string" },
                  { name: "kode", 	type: "string" },
                  { name: "nama", 	type: "string" },
                  { name: "date", 	type: "string" },
                  { name: "address", 	type: "string" },
                  { name: "phone", 	type: "string" },
                  { name: "action", 	type: "string" }
             ],
            url : "suport/GetDaftarSj",
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
            columnsResize: true,
            height: '600px',
            pageable : true,
            pageSize : 14,
            pagerPosition : 'bottom',
            filterMode: 'simple',
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'idx', width : '5%'},
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '10%'},
              // { text: 'Foto', cellsAlign: 'left', align: 'center', dataField: 'foto', width : '12%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '26%'},
              { text: 'Date', cellsAlign: 'left', align: 'center', dataField: 'date', width : '8%'},
              { text: 'Address', cellsAlign: 'left', align: 'center', dataField: 'address', width : '24%'},
              { text: 'Phone', cellsAlign: 'left', align: 'center', dataField: 'phone', width : '10%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '18  %' }
            ]
        }).on('rowDoubleClick', function(event)
        {	  
        	//var idx = dataAdapter['idx'];         	
        	dialogFormEditShow(idx);
	    });	
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

 