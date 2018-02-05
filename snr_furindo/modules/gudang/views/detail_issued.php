<div class="content-header">   
	<h1>Detail Issued Suport Material</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<!-- <button type="button" class="btn btn-sm btn-primary" onclick="Add_raw()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>	 -->	
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
		
	   	isDelete = confirm('Yakin ISSUED '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('gudang/HapusIssued', {ID : idx}, 'box-body');
	  	kodeTipeKaryawan = ajaxFillGridJSON('gudang/issued'); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}
    function Add_raw()

	  {     
	    //var htmlOut = ajaxFillGridJSON('admin/AddSales');
	    var loadhtml = "<?php echo site_url("gudang/tambah_issued")?>"; 
	    
	    $('.content-wrapper').load(loadhtml);
	  } 
	function dialogFormEditShow(idx)
	{
		//var IDBidang = $(objSource).val();
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		kodeTipeKaryawan = ajaxFillGridJSON('gudang/edit_issue', {IDBidang : idx}); 
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
                  { name: "kode", 	type: "string" },
                  { name: "nama", 	type: "string" },
                  { name: "date", 	type: "date" },
                  { name: "divisi", 	type: "string" },
                  { name: "note",   type: "string" },
                  { name: "sales",  type: "string" },
                  { name: "qty",  type: "number" }
                  
             ],
            url : "gudang/GetDetailIssued",
            id  : "idx"
         };

        var dataAdapter = new $.jqx.dataAdapter(source, {
            loadComplete: function () {		
            }
        });

        // create jqxDataTable.
        $("#ajaxTreeGrid").jqxGrid(
        {
            source: dataAdapter,
            pagerButtonsCount: 10,
            altRows: true,
            sortable: true,
            filterable: true,
            columnsResize: true,
            height: '600px',
            pageable : true,
            pageSize : 1000,
            showfilterrow: true,            
            showstatusbar: true,
            statusbarheight: 30,
            groupable: true,
            filterMode: 'excel',
            showaggregates: true,
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'idx', width : '6%', pinned: true},
              { text: 'Kode', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'kode', width : '10%', pinned: true},
              { text: 'Nama', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'nama', width : '25%'},
              { text: 'Date', cellsAlign: 'center', filtertype: 'range', align: 'center', dataField: 'date', cellsformat: 'd', width : '10%'},
              { text: 'Divisi', cellsAlign: 'center', align: 'center', dataField: 'divisi', filtertype: 'checkedlist', width : '8%'},
              { text: 'Sales Reff', cellsAlign: 'center', filtertype: 'checkedlist', align: 'center', dataField: 'sales', width : '10%'},
              { text: 'Qty', cellsAlign: 'center', align: 'center', dataField: 'qty', aggregates: ['sum'], width : '7%'},
              { text: 'Keterangan', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'note', width : '30%'}
              // { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '10  %' }
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

 