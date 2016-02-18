<div class="content-header">   
	<h1>Rincian Sales Order</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				<button type="button" class="btn btn-sm btn-primary" id="btnTambahBaru"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;Tambah Baru</button>
				<button type="button" class="btn btn-sm btn-primary" id="btnCetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>&nbsp;Cetak PDF</button>		
			</div>
			<div class="row form-group">
				<label class="col-sm-8 control-label"></label>
				<div class="col-sm-4">
					<div class="input-group">
						<input type="text" id="caridata" oninput="loadGridData(2)" placeholder="Cari data product" value="" class="form-control" autofocus> 
						<div class="input-group-addon">
							<i class="fa fa-search"></i>
					  	</div>
					</div> 
	  			</div>
	  		</div>
	  		<div class="form-control" style="min-height:550px;">
				<table id="example2" class="table table-bordered table-striped">
		            <thead style="">
		                <tr>            
		                    <th style="text-align:center; width:5%"> NO</th>
		                    <th style="text-align:center; width:20%"> Kode Product</th>
		                    <th style="text-align:center; width:30%"> Nama Product</th>                    
		                    <th style="text-align:center; width:15%"> Status </th>
		                    <th style="text-align:center; width:10%"> Harga </th>
		                    <th style="text-align:center; width:10%"> QTY </th>
		                    <th style="text-align:center; width:8%"> Action </th>
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
                     
    	    
        loadGridData('<?php echo $so_id; ?>');

    });

    function loadGridData(lmt){ 
		var produk_id = $('#caridata').val();  
        ajaxDataGrid('<?php echo base_url()?>admin/GetDetailSO', {idx : lmt}, 'ajaxTreeGrid');       
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
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false
        });
      });
    </script>

 