<div class="content-header">   
	<h1>Daftar Shipment</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" onclick="Add_raw()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<!--<button type="button" class="btn btn-sm btn-success" onclick="imp()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Import Data</button>-->	
			</div>
	  		<div class="form-control" style="min-height:610px;">
				<div id="ajaxTreeGrid"></div>
			</div>
		</div> 
	  </div>
	</div> 
</div>

<div class="modal fade" id="curency">
  <div class="modal-dialog">
    <div class="modal-content" style="width:750px">
      <div class="modal-header">
        <button type="button" class="close Liquid" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Set Currency</h4>
      </div>
      <div class="modal-body">
        <input type="number" id="IDcurency" placeholder="Set Currency" value="" oninput="changePrint()" class="form-control" autofocus>
        <input type="hidden" id="IDship">
      </div>
      <div class="modal-footer">
          <a class="btn btn-primary" id="prinShip" disabled onclick="printShip()">PRINT SHIPMENT</a>
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
<script>
	$(document).ready(function () {                    
    	    
        loadGridData();
        $('.Liquid').click(function(e)
          {
            //$('#example7').dataTable().fnDestroy();
            $('#curency').attr('class', 'modal hide'); 
          });

    });
    
	
	function deleteConfirmShow(ids)
	{ 

	 	var selection = $("#ajaxTreeGrid").jqxDataTable('getSelection');
		var dataKaryawan = selection[0];
		
		var idx	 = dataKaryawan.idx;
		var nama = dataKaryawan.kode;
		
	   	isDelete = confirm('Yakin Shipment '+ nama +' akan dihapus ?');
	  	if (isDelete) sendRequestForm('production/HapusShipment', {ID : idx}, 'box-body');
	  	kodeTipeKaryawan = ajaxFillGridJSON('production/shipment'); 
		$('.content-wrapper').html(kodeTipeKaryawan);
	}
    function Add_raw()

	  {     
	    //var htmlOut = ajaxFillGridJSON('admin/AddSales');
	    var loadhtml = "<?php echo site_url("production/tambah_shipment")?>"; 
	    
	    $('.content-wrapper').load(loadhtml);
	  } 

    function imp()

    {     
      //var htmlOut = ajaxFillGridJSON('admin/AddSales');
      var loadhtml = "<?php echo site_url("production/import_shipment")?>"; 
      
      $('.content-wrapper').load(loadhtml);
    } 
	function dialogFormEditShow(idx)
	{
		//var IDBidang = $(objSource).val();
		//kodeTipeKaryawan = ajaxFillGridJSON('admin/DetailSO', {IDBidang : idx});
		kodeTipeKaryawan = ajaxFillGridJSON('production/edit_shipment', {IDBidang : idx}); 
		$('.content-wrapper').html(kodeTipeKaryawan);

	}

  function printShow(idx)
  {
    //var htmlOut = ajaxFillGridJSON('transaksi/printbkk', {idx : idx}); 

    var htmlOut = "<?php echo site_url("production/printship")?>/"+idx;
        
    window.open(htmlOut);   
             

  } 

  function printInv(idx)
  {
    $('#IDship').val(idx); 
    $('#curency').attr('class', 'modal show'); 
    
  }

  function printShip()
  {
    //var htmlOut = ajaxFillGridJSON('transaksi/printbkk', {idx : idx});
    var ids = $('#IDcurency').val();
        idx = $('#IDship').val(); 
    var htmlOut = "<?php echo site_url("production/printInv")?>/"+idx+"/"+ids;
    $('#curency').attr('class', 'modal hide');     
    window.open(htmlOut);
  }

  function changePrint(){
    var ids = $('#IDcurency').val();
    if(ids.trim()!=''){
      $('#prinShip').removeAttr('disabled');
    }else{
      $('#prinShip').attr('disabled','disabled');
    }
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
                  { name: "container", 	type: "string" },
                  { name: "date", 	type: "date" },
                  { name: "driver", 	type: "string" },
                  { name: "truck", 	type: "string" },
                  { name: "no",  type: "string" },
                  { name: "action", 	type: "string" }
             ],
            url : "production/GetDaftarShipment",
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
            groupable: true,
            showstatusbar: true,
            statusbarheight: 30,
            showaggregates: true,
            filterMode: 'simple',
            theme: 'fresh',
            width: '100%',
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'no', width : '5%'},
              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '13%'},
              // { text: 'Foto', cellsAlign: 'left', align: 'center', dataField: 'foto', width : '12%'},
              { text: 'Container', cellsAlign: 'left', align: 'center', dataField: 'container', width : '20%'},
              { text: 'Date', cellsAlign: 'center', align: 'center', dataField: 'date', filtertype: 'range', cellsformat: 'd', width : '13%'},
              { text: 'Driver', cellsAlign: 'center', align: 'center', dataField: 'driver', width : '10%'},
              { text: 'Truck', cellsAlign: 'center', align: 'center', dataField: 'truck', width : '12%'},
              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '27  %' }
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

 