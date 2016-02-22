<div class="content-header">   
	<h1>Daftar Sales Order</h1>
</div>

<!-- <div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" onclick="Addsales()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>		
			</div>
			<div class="row form-group">
				<label class="col-sm-8 control-label"></label>
				<div class="col-sm-4">
					<input type="text" id="caridata" oninput="loadGridData(2)" placeholder="Cari data product" value="" class="form-control" autofocus>  
	  			</div>
	  		</div>
	  		<div class="form-control" style="min-height:550px;">
	  			<div id="ajaxTreeGrid"></div>
				<table id="example2" class="table table-bordered table-striped">
		            <thead style="">
		                <tr>            
		                    <th style="text-align:center; width:5%"> SID</th>
		                    <th style="text-align:center; width:10%"> Ref No</th>
		                    <th style="text-align:center; width:10%"> Tanggal</th>                    
		                    <th style="text-align:center; width:10%"> Customer </th>
		                    <th style="text-align:center; width:40%"> Alamat </th>
		                    <th style="text-align:center; width:10%"> Categories </th>
		                    <th style="text-align:center; width:15%"> Action </th>
		                </tr>
		            </thead>
		            <tbody id="ajaxTreeGrid">                   
		            </tbody>
		        </table>
			</div>
		</div> 
	  </div>
	</div> 
</div> -->
<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" onclick="Addsales()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>		
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
		
	   	isDelete = confirm('Yakin SO '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/HapusSales', {ID : idx}, 'box-body');
	  	kodeTipeKaryawan = ajaxFillGridJSON('admin/Sales'); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}
    function Addsales()

	  {     
	    //var htmlOut = ajaxFillGridJSON('admin/AddSales');
	    var loadhtml = "<?php echo site_url("admin/ImportSales")?>"; 
	    
	    $('.content-wrapper').load(loadhtml);
	  } 
	function dialogFormEditShow(idx)
	{
		//var IDBidang = $(objSource).val();
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		kodeTipeKaryawan = ajaxFillGridJSON('admin/editso', {IDBidang : idx}); 
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
                  { name: "date", 	type: "string" },
                  { name: "address", 	type: "string" },
                  { name: "status", 	type: "string" },
                  { name: "action", 	type: "string" }
             ],
            url : "admin/GetDaftarSales",
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
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'idx', width : '10%'},
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '10%'},
              // { text: 'Foto', cellsAlign: 'left', align: 'center', dataField: 'foto', width : '12%'},
              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '10%'},
              { text: 'Date', cellsAlign: 'left', align: 'center', dataField: 'date', width : '10%'},
              { text: 'Address', cellsAlign: 'left', align: 'center', dataField: 'address', width : '28%'},
              { text: 'Status', cellsAlign: 'left', align: 'center', dataField: 'status', width : '12%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '20%' }
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

 