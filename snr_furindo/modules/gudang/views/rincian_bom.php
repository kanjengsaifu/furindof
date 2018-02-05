<?php //echo "<pre>";print_r($product);"</pre>";exit();  ?>
<style>
	.seperator{
		border: 1px solid #ccc;
		padding: 10px 0px 10px 0px;
		margin:20px 0px 20px 0px;
		border-radius:3px;
	}
	.header1{
		text-align:center;
		border-bottom:1px solid #ccc;
		margin:0px 0px 10px 0px;
	}
	
	li.ui-menu-item{
		background:#fff;
		list-style-type:none;
		width:210px !important;
		margin:0px !important;
		left:0px !important;
		padding:5px;
		border-bottom:1px dashed #ccc;
	}
	
	li.ui-menu-item:hover{
		background:#ccc;
		cursor:pointer;
	}
</style>
<div class="content-header">        
	<h1>Rincian Kebutuhan Suport Material</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(<?php echo $product->product_id; ?>); return false;">
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group">
							<input type="hidden" id="idproduk" name="idproduk" value="<?php echo $product->product_id; ?>">
							<label for="Nomor" class="col-sm-3 control-label">Product Code:</label>
							<div class="col-sm-8">								
								<!-- <label for="Nomor" class="form-control"><?php echo $product->product_code; ?></label> -->
								<input readonly type="text" id="product_code" value="<?php echo $product->product_code; ?>" class="form-control">								
							</div>							
						</div>
						<div class="form-group">
							<label for="Nomor" class="col-sm-3 control-label">Product Name :</label>
							<div class="col-sm-8">
								<input readonly type="text" id="product_name"  value="<?php echo $product->product_name; ?>" class="form-control">
								<!-- <label for="Nomor" class="form-control"><?php echo $product->product_name; ?></label> -->
							</div>							
						</div>
						<!-- <div class="form-group">
							<label for="Nomor" class="col-sm-3 control-label">Price Product :</label>
							<div class="col-sm-8">
								<input readonly type="text" id="product_price"  value="<?php echo $product->product_price_usd; ?>" class="form-control">
							</div>							
						</div> -->					
				</div>
			</div>
			
			<div class="seperator">
			
			<div class="header1">
				<h4>RINCIAN BOM COUNTABLE</h4>
			</div>			
				<div class="table-responsive" style="width:90%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">No</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">Code</th>
								<th class="btn-primary" style="width:34%; text-align:center; vertical-align: middle;">Product Name</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">Price</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">CBM</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">QTY</th>
								<!-- <td style="width:8%; bacgraund-color: white;"><button type="button" id="btnCariCount" title="Tambah data" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></button></td> -->
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
							<?php //echo "<pre>";print_r($order);"</pre>";exit(); 
							$no=1;
							foreach ($order->result() as $value) {							
							$i=$no-1;
							?>
							<tr>
								<td><?php echo $no ?></td>
								<input type="hidden" name="idmaterial[]" value="<?php echo $value->material_id ?>">
								<td><input class="form-control" readonly value="<?php echo $value->material_code ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $value->material_name ?>"></td>
								<td><input name="price[]" class="form-control" readonly value="<?php echo $value->material_price ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $value->material_cbm ?>"></td>
								<td><input name="qty[]" readonly type="number" step="0.01" min="1" class="form-control" value="<?php echo $value->qty ?>" required/></td>
								<!-- <td><button type="button" onclick="deletedata(<?php echo $value->bom_id ?>)" title="Tambah data" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td> -->
							</tr>
							<?php $no++; } ?>							
						</tbody>
						<tfoot>
						</tfoot>
					</table>					
			   </div>			
		</div>

		<div class="seperator">
			
			<div class="header1">
				<h4>RINCIAN BOM UNCOUNTABLE</h4>
			</div>			
				<div class="table-responsive" style="width:90%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">No</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">Code</th>
								<th class="btn-primary" style="width:34%; text-align:center; vertical-align: middle;">Product Name</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">Price</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">CBM</th>
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">QTY</th>
								<!-- <td style="width:8%; "><button type="button" id="btnCariLiquid" title="Tambah data" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></button></td> -->
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
							<?php //echo "<pre>";print_r($order);"</pre>";exit(); 
							$no=1;
							foreach ($order_liquid->result() as $values) {							
							$i=$no-1;
							?>
							<tr>
								<td><?php echo $no ?></td>
								<input type="hidden" name="idmaterial_ld[]" value="<?php echo $values->material_id ?>">
								<td><input class="form-control" readonly value="<?php echo $values->material_code ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $values->material_name ?>"></td>
								<td><input name="price_ld[]" class="form-control" readonly value="<?php echo $values->material_price ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $values->material_cbm ?>"></td>
								<td><input name="qty_ld[]" readonly type="number" step="0.01" class="form-control" value="<?php echo $values->qty ?>" required/></td>
								<!-- <td><button type="button" onclick="deletedata2(<?php echo $values->bom_liquid_id ?>)" title="Tambah data" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td> -->
							</tr>
							<?php $no++; } ?>							
						</tbody>
						<tfoot>
							<!-- <button type="button" onclick="deletedata3(<?php echo $product->product_id; ?>)" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> Hapus semua</button> -->
						</tfoot>
					</table>					
			   </div>					
		</div>
		<div class="form-horizontal footer">
				<div class="row" id="addcol">
					<div class="col-sm-6">
						<!-- <button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Simpan Data</button> -->
						<!-- <button onclick="adddataprint('')" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span> Simpan Data dan Cetak</button>
						<button onclick="batal()" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> Batal</button> -->
					</div>
				</div>				
			</div>	
		</form>
	</div>
</div>
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close Rekanan" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
      	<input type="text" id="caridata" oninput="loadGridData()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example2" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th style="text-align:center; width:7%"> No</th>
                    <th style="text-align:center; width:15%"> Kode </th>
                    <th style="text-align:center; width:53%"> Nama </th>
                    <th style="text-align:center; width:10%"> Price </th>                    
                    <th style="text-align:center; width:10%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridData">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModalCount">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close Count" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
      	<input type="text" id="caridataCount" oninput="loadGridDataCount()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example4" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th style="text-align:center; width:7%"> No</th>
                    <th style="text-align:center; width:15%"> Kode </th>
                    <th style="text-align:center; width:53%"> Nama </th>                    
                    <th style="text-align:center; width:10%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridDataCount">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModalLiquid">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close Liquid" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
      	<input type="text" id="caridataLiquid" oninput="loadGridDataLiquid()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example3" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th style="text-align:center; width:7%"> No</th>
                    <th style="text-align:center; width:15%"> Kode </th>
                    <th style="text-align:center; width:53%"> Nama </th>                    
                    <th style="text-align:center; width:10%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridDataLiquid">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$(document).ready(function(){
		var tglreg = "<?php echo date("d-m-Y")?>";
		$("#tglreg").val(tglreg);
		$("#tglship").val(tglreg);		

		$(".date").datepicker({
			format : "dd-mm-yyyy",
			autoclose : true
		});	

		$('.Rekanan').click(function(e)
	    {
	    	$('#myModal').attr('class', 'modal hide'); 
	    });
	    $('.Count').click(function(e)
	    {
	    	$('#myModalCount').attr('class', 'modal hide'); 
	    });
	    $('.Liquid').click(function(e)
	    {
	    	$('#myModalLiquid').attr('class', 'modal hide'); 
	    });

		$('#btnCariProduct').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModal').attr('class', 'modal show');  

	    	document.getElementById("caridata").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	loadGridData();
	    });
	    $('#btnCariCount').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalCount').attr('class', 'modal show');  

	    	document.getElementById("caridataCount").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	loadGridDataCount();
	    });
	    $('#btnCariLiquid').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalLiquid').attr('class', 'modal show');  

	    	document.getElementById("caridataLiquid").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	loadGridDataLiquid();
	    });
	});	

function simpanreg(ids)
	{
		var idx = $('#idproduk').val();
		var target = "<?php echo site_url("admin/savebom")?>";
			data = $("#addkso").serialize();
		$.post(target, data, function(e){
			//$(".content-wrapper").html(e);
			//console.log(e);
			//return false;
			//tinymce.triggerSave();
			
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			if(e==1){
				alert("REFF NO sudah dipakai, Silahkan ganti yang lain !!!");
			} else{
				var htmlOut = ajaxFillGridJSON('admin/detailbom', {idx : idx}); 
	    		alert("Data berhasil disimpan.");
	   			$('.content-wrapper').html(htmlOut);
				// loadhtml = "<?php echo site_url("admin/Bom")?>";
				// alert("Data berhasil disimpan.");
				// $(".content-wrapper").load(loadhtml);
			}
		
		});
	}

	function deletedata(idx)
	{ 
	 	var produk_id = $('#idproduk').val();
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	//return false;				
	   	isDelete = confirm('Yakin data akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/habusdatabom', {IDbom : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/detailbom', {idx : produk_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

	function deletedata2(idx)
	{ 
	 	var produk_id = $('#idproduk').val();
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	//return false;				
	   	isDelete = confirm('Yakin data akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/habusdatabomliquid', {IDbom : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/detailbom', {idx : produk_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

	function deletedata3(idx)
	{ 
	 	var produk_id = $('#idproduk').val();
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	//return false;				
	   	isDelete = confirm('Yakin data akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/habusallbomliquid', {IDbom : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/detailbom', {idx : produk_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

	function addCount(idx)
	{ 
	 	var produk_id = $('#idproduk').val();
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	//return false;	
	  	sendRequestForm('admin/tambahCount', {IDproduct : produk_id, IDmaterial : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/detailbom', {idx : produk_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

	function addLiquid(idx)
	{ 
	 	var produk_id = $('#idproduk').val();
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	//return false;	
	  	sendRequestForm('admin/tambahLiquid', {IDproduct : produk_id, IDmaterial : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/detailbom', {idx : produk_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

	function loadGridData(){ 
		var produk_id = $('#caridata').val();  
        ajaxDataGrid('<?php echo base_url()?>admin/addTableProduct', {idx : produk_id}, 'tableGridData');       
    }

    function loadGridDataCount(){ 
		var produk_id = $('#caridataCount').val();  
        ajaxDataGrid('<?php echo base_url()?>admin/addTableMaterial', {idx : produk_id}, 'tableGridDataCount');       
    }

    function loadGridDataLiquid(){ 
		var produk_id = $('#caridataLiquid').val();  
        ajaxDataGrid('<?php echo base_url()?>admin/addTableLiquid', {idx : produk_id}, 'tableGridDataLiquid');       
    }

    function dialogFormEditShow(idx, kode, nama, price)
	{ 
		

		 	$('#idproduk').val(idx);
		 	$('#product_code').val(kode);
	 		$('#product_name').val(nama);
	 		$('#product_price').val(price);
	 		
			$('#myModal').attr('class', 'modal hide');

	}
</script>

<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": false,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": false
        });
      });
    </script>