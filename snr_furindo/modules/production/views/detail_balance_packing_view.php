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
	<h1>Rincian Balance Packing</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<!-- <button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>	 -->	
			</div>
			<div class="row form-group">
				<label class="col-sm-8 control-label"></label>
				<div class="col-sm-4">
					<div class="input-group">
						<!-- <input type="text" id="caridata" oninput="loadGridData(2)" placeholder="Cari data product" value="" class="form-control" autofocus> 
						<div class="input-group-addon">
							<i class="fa fa-search"></i>
					  	</div> -->
					</div> 
	  			</div>
	  		</div>
	  		<!-- <div class="form-control" style="min-height:550px;"> -->
	  		<div class="" style="width:100%; margin:0px auto;"> 
				<table id="example2" class="table table-bordered table-striped table-responsive">
		            <thead style="">
		                <tr>            
		                    <th style="text-align:center; width:5%"> NO</th>
		                    <th style="text-align:center; width:10%"> REFF NO</th>
		                    <th style="text-align:center; width:10%"> Kode Packing</th>                    
		                    <th style="text-align:center; width:15%"> Kode Produk </th>
		                    <th style="text-align:center; width:33%"> Nama Produk </th>
		                    <th style="text-align:center; width:10%"> QTY </th>
		                    <th style="text-align:center; width:15%"> Harga </th>
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

 
	
<script>
	$(document).ready(function () {
        var asd = '<?php echo $so_id; ?>';
        var ask = '<?php echo $po_id; ?>';           
    	    
        loadGridData(asd,ask);

    });

    function loadGridData(lmt, ids){ 
    	var produk_id = $('#caridata').val();  
        ajaxDataGrid('<?php echo base_url()?>production/GetDetailBalancePacking', {IDBidang : lmt , IDX : ids}, 'ajaxTreeGrid');       
    }   

    function detailShow(idx, so)

	  {     
	    var htmlOut = ajaxFillGridJSON('admin/detailbomso', {idx : idx, so : so}); 
	    
	    $('.content-wrapper').html(htmlOut);
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
      });
    </script>

 