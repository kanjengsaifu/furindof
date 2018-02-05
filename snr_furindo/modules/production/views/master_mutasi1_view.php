<style> 
#red {
    
    background-color: red;
    position: relative;
    -webkit-animation-name: example; /* Chrome, Safari, Opera */
    -webkit-animation-duration: 4s; /* Chrome, Safari, Opera */
    -webkit-animation-iteration-count: 3; /* Chrome, Safari, Opera */
    animation-name: example;
    animation-duration: 2s;
    animation-iteration-count: 300;
}

/* Chrome, Safari, Opera */
@-webkit-keyframes example {
    0%   {background-color: red;}
    25%  {background-color: yellow;}
    50%  {background-color: red;}
    75%  {background-color: yellow;}
    100% {background-color: red;}
}

/* Standard syntax */
@keyframes example {
    0%   {background-color: red;}
    25%  {background-color: yellow;}
    50%  {background-color: red;}
    75%  {background-color: yellow;}
    100% {background-color: red;}
}
</style>
<div class="content-header">   
	<h1>Data Stock Barang</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
	  		<button type="button" class="btn btn-sm btn-primary" onclick="Add_raw()"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
			</div>
			<div class="" style="width:100%; margin:0px auto;"> 
				<table id="example2" class="table table-bordered table-striped table-responsive">
		            <thead style="">
		                <tr>            
		                    <th style="text-align:center; width:5%"> NO</th>
		                    <th style="text-align:center; width:20%"> Kode Product</th>
		                    <th style="text-align:center; width:36%"> Nama Product</th>                    
		                    <th style="text-align:center; width:11%"> QTY Stock </th>
		                    <th style="text-align:center; width:8%"> Qty NG </th>
		                    <th style="text-align:center; width:10%"> Qty Sample </th>
		                    <th style="text-align:center; width:8%"> Qty Total </th>
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

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content" style="width:760px">
      <div class="modal-header">
        <button type="button" class="close Rekanan" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
      	<!-- <input type="text" id="caridata" oninput="loadGridData()" placeholder="Cari data product" value="" class="form-control" autofocus>  -->       
		<table id="example3" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th style="text-align:center; width:7%"> No</th>
                    <th style="text-align:center; width:15%"> Kode </th>
                    <th style="text-align:center; width:53%"> Nama </th>
                    <th style="text-align:center; width:10%"> Price </th>                    
                    <th style="text-align:center; width:10%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridData1">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

 
	
<script>
	$(document).ready(function () {
                     
    	    
        loadGridData();
        loadGridData1();
        $('.Rekanan').click(function(e)
	    {
	    	$('#myModal').attr('class', 'modal hide'); 
	    });

    });

    function loadGridData(lmt){ 
		var produk_id = $('#caridata').val();  
        ajaxDataGrid('<?php echo base_url()?>production/GetDetailSO','', 'ajaxTreeGrid');       
    }   

    function detailShow(idx, so)

	  {     
	    var htmlOut = ajaxFillGridJSON('admin/detailbomso', {idx : idx, so : so}); 
	    
	    $('.content-wrapper').html(htmlOut);
	  } 
	function getnumeric(elem, awl)
	{		
		var getelem = $(elem).attr("atm");
			NG = getelem.replace(/nominal-/ig, 'ng-');
			total = getelem.replace(/nominal-/ig, 'ttl-');
			sample = getelem.replace(/nominal-/ig, 'sample-');
			stock = getelem.replace(/nominal-/ig, 'stock-');
			mat = getelem.replace(/nominal-/ig, 'mat-');
			qty_NG = parseInt($("#"+NG).val());
			qty_total = parseInt($("#"+total).val());
			qty_sample = parseInt($("#"+sample).val());			
			qty_mat = parseInt($("#"+mat).val());						
			saldo = qty_total-qty_sample-qty_NG;
			$("#"+stock).val(saldo);
			qty_stock = parseInt($("#"+stock).val());
			ttl2 = qty_sample+qty_NG+qty_stock;
			$("#"+total).val(ttl2);
			qty_saldo = saldo-awl;

			//alert(' NG : '+qty_NG+' total : '+qty_total+' sample : '+qty_sample+' stock : '+qty_stock+' mat : '+qty_mat);
			var htmlOut = ajaxFillGridJSON('production/editStockRaw', {imp_ng : qty_NG ,imp_total : qty_total ,imp_sample : qty_sample ,imp_stock : qty_saldo ,imp_mat : qty_mat});
			//$('.content-wrapper').html(htmlOut); 	
	}

	function getnumeric1(elem, awl)
	{		
		var getelem = $(elem).attr("atm");
			NG = getelem.replace(/nominal-/ig, 'ng-');
			total = getelem.replace(/nominal-/ig, 'ttl-');
			sample = getelem.replace(/nominal-/ig, 'sample-');
			stock = getelem.replace(/nominal-/ig, 'stock-');
			mat = getelem.replace(/nominal-/ig, 'mat-');
			qty_NG = parseInt($("#"+NG).val());
			qty_total = parseInt($("#"+total).val());
			qty_sample = parseInt($("#"+sample).val());
			qty_stock = parseInt($("#"+stock).val());
			qty_mat = parseInt($("#"+mat).val());
			ttl2 = qty_sample+qty_NG+qty_stock;
			$("#"+total).val(ttl2);
			saldo = qty_stock-awl;
			//alert(' NG : '+qty_NG+' total : '+qty_total+' sample : '+qty_sample+' stock : '+qty_stock+' mat : '+qty_mat);
			var htmlOut = ajaxFillGridJSON('production/editStockRaw1', {imp_ng : qty_NG ,imp_total : qty_total ,imp_sample : qty_sample ,imp_stock : saldo ,imp_mat : qty_mat});
			//$('.content-wrapper').html(htmlOut); 	
	}

	function Add_raw(){
		$('#myModal').attr('class', 'modal show');
	}

	function loadGridData1(){ 
		var produk_id = $('#caridata').val();  
        ajaxDataGrid('<?php echo base_url()?>production/addTableProduct', {idx : produk_id}, 'tableGridData1');       
    }

    function tambah_material(idx, code, nama, price){
    	var htmlOut = ajaxFillGridJSON('production/tambah_material', {mat_id : idx, mat_code : code, mat_name : nama, mat_price : price});
		$('#myModal').attr('class', 'modal hide');
		var htmlOut1 = ajaxFillGridJSON('production/Mutasi_raw');	    		
	   	$('.content-wrapper').html(htmlOut1); 
    }
            		
</script>

<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false
        });

        $('#example3').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false
        });
      });
    </script>

 