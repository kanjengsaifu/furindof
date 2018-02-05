<div class="content-header">   
	<h1>Detail LPB Sample</h1>
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

	function loadGridData(){
	     var source =
         {		
             dataType: "json",
             dataFields: [
                  { name: "idx", 	type: "string" },
                  { name: "code", 	type: "string" },
                  { name: "nama", 	type: "string" },
                  { name: "tgl", 	type: "date" },
                  { name: "mt_name", 	type: "string" },
                  { name: "price", 	type: "string" },
                  { name: "order",  type: "number" },
                  { name: "po",  type: "string" },
                  { name: "qty",  type: "number" },
                  { name: "nominal",  type: "number" },
                  { name: "nota",  type: "string" },
                  { name: "lpb",  type: "string" },
                  { name: "cbm",  type: "number" },
                  { name: "weight",  type: "number" },
                  { name: "action", 	type: "string" }
             ],
            url : "sample/GetDaftarLpbSample",
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
            //groups: ['nama'],
            showfilterrow: true,            
            //pagerPosition : 'bottom',
            //groupsrenderer: groupsrenderer,
            //selectionmode: 'singlecell',
            //showstatusbar: True,
            //statusbarheight: 50,
            //editable: True,
            showstatusbar: true,
            statusbarheight: 30,
            groupable: true,
            filterMode: 'excel',
            showaggregates: true,
            theme: 'fresh',
            width: '100%',
            // groupsRenderer: function(value, rowData, level)
            //     {
            //         return "Supplier Name: " + value;
            //     },
            columns: [
              { text: 'PID', cellsAlign: 'center', align: 'center', dataField: 'idx', width : '5%', pinned: true},
              { text: 'Suplier', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'nama', width : '13%', pinned: true},
              { text: 'PO', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'po', width : '8%'},
              { text: 'Code', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'code', width : '8%'},
              { text: 'Name', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'mt_name', width : '22%'},
              { text: 'Date', cellsAlign: 'left', filtertype: 'range', align: 'center', dataField: 'tgl', cellsformat: 'd', width : '8%'},
              { text: 'Order', cellsAlign: 'left', align: 'center', dataField: 'order', aggregates: ['sum'], width : '8%'},
              { text: 'Datang', cellsAlign: 'left', align: 'center', dataField: 'qty', aggregates: ['sum'], width : '8%'},
              { text: 'Price @', cellsAlign: 'right', align: 'center', dataField: 'price', width : '10%'},
              { text: 'Total', cellsAlign: 'right', align: 'center', dataField: 'nominal', aggregates: ['sum'], cellsformat: 'f', width : '10%'},
              { text: 'CBM', cellsAlign: 'right', align: 'center', dataField: 'cbm', aggregates: ['sum'], cellsformat: 'f', width : '10%'},
              { text: 'Total CBM', cellsAlign: 'right', align: 'center', dataField: 'weight', aggregates: ['sum'], cellsformat: 'f', width : '10%'},
              { text: 'NO LPB', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'lpb', width : '15%'},
              { text: 'NO Nota', cellsAlign: 'left', filtertype: 'checkedlist', align: 'center', dataField: 'nota', width : '10%'}
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

 