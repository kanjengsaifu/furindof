<style> 
#red {
    
    background-color: red;
    position: relative;
    -webkit-animation-name: example;
    -webkit-animation-duration: 4s;
    -webkit-animation-iteration-count: 3;
    animation-name: example;
    animation-duration: 2s;
    animation-iteration-count: 300;
}

@-webkit-keyframes example {
    0%   {background-color: red;}
    25%  {background-color: yellow;}
    50%  {background-color: red;}
    75%  {background-color: yellow;}
    100% {background-color: red;}
}

 @keyframes example {
    0%   {background-color: red;}
    25%  {background-color: yellow;}
    50%  {background-color: red;}
    75%  {background-color: yellow;}
    100% {background-color: red;}
}
</style>
<div class="content-header">   
	<h1>Detail Pembayaran</h1>
</div>

<div class="content">
	<div class="box box-warning">
	  	<div class="box-body">
	  		<div class="box-header">
				
			</div>
			<div class="row form-group">
				<label class="col-sm-8 control-label"></label>
				<div class="col-sm-4">
					<div class="input-group">
						
					</div> 
	  			</div>
	  		</div>
	  		<!-- <div class="form-control" style="min-height:550px;"> -->
	  		<div class="" style="width:100%; margin:0px auto;"> 
				<table id="example2" class="table table-bordered table-striped table-responsive">
		            <thead style="">
		                <tr>            
		                    <th style="text-align:center; width:5%"> NO</th>
		                    <th style="text-align:center; width:10%"> Tanggal </th>
		                    <th style="text-align:center; width:20%"> Kode LPB</th>
		                    <th style="text-align:center; width:15%"> Nama Provider</th>                    
		                    <th style="text-align:center; width:25%"> Alamat </th>
		                    <th style="text-align:center; width:15%"> Nominal </th>
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
		if(lmt == 200){
			//alert('ok');
			ajaxDataGrid('<?php echo base_url()?>akuntansi/GetDetailPembayaran1', {idx : lmt}, 'ajaxTreeGrid');
		}else{  
        	ajaxDataGrid('<?php echo base_url()?>akuntansi/GetDetailPembayaran', {idx : lmt}, 'ajaxTreeGrid');
        }       
    }   

    function detailShow(idx, so)

	  {     
	    var htmlOut = ajaxFillGridJSON('admin/detailbomso', {idx : idx, so : so}); 
	    
	    $('.content-wrapper').html(htmlOut);
	  }

	function bayar(idx)
		{ 
			var htmlOut = ajaxFillGridJSON('akuntansi/BayarHutang', {idx : idx}); 
			//loadhtml = "<?php echo site_url("akuntansi/BayarHutang")?>";				
			$(".content-wrapper").html(htmlOut);
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

 