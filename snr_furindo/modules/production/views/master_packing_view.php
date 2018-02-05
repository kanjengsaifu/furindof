<div class="content-header">   
	<h1>Daftar Packing Product</h1>
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
		
	   	isDelete = confirm('Yakin Packing '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('production/HapusPacking', {ID : idx}, 'box-body');
	  	kodeTipeKaryawan = ajaxFillGridJSON('production/packing'); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}
    function Add_raw()

	  {     
	    //var htmlOut = ajaxFillGridJSON('admin/AddSales');
	    var loadhtml = "<?php echo site_url("production/tambah_packing")?>"; 
	    
	    $('.content-wrapper').load(loadhtml);
	  } 
    
	function dialogFormEditShow(idx)
	{
		//var IDBidang = $(objSource).val();
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		kodeTipeKaryawan = ajaxFillGridJSON('production/edit_packing', {IDBidang : idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}

	function detailShow(idx)
	{
		//var IDBidang = $(objSource).val();
		kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/editso', {IDBidang : idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}

	function loadGridData(){
	     var source =
         {		
             dataType: "json",
             dataFields: [
                  { name: "idx", 	type: "string" },
                  { name: "so", 	type: "string" },
                  { name: "kode", 	type: "string" },
                  { name: "date", 	type: "string" },
                  { name: "note", 	type: "string" },
                  { name: "status", 	type: "string" },
                  { name: "action", 	type: "string" }
             ],
            url : "production/GetDaftarPacking",
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
              { text: 'REF NO', cellsAlign: 'left', align: 'center', dataField: 'so', width : '13%'},
              // { text: 'Foto', cellsAlign: 'left', align: 'center', dataField: 'foto', width : '12%'},
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '10%'},
              { text: 'Date', cellsAlign: 'center', align: 'center', dataField: 'date', width : '13%'},
              { text: 'Status', cellsAlign: 'center', align: 'center', dataField: 'status', width : '10%'},
              { text: 'Deskripsi', cellsAlign: 'center', align: 'center', dataField: 'note', width : '29%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '20  %' }
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

 