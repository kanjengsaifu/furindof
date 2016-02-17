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
	<h1>Input BOM</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(<?php echo $product->product_id; ?>); return false;">
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group">
							<input type="hidden" name="idproduk" value="<?php echo $product->product_id; ?>">
							<label for="Nomor" class="col-sm-3 control-label">Product Code:</label>
							<div class="col-sm-8">
								<label for="Nomor" class="form-control"><?php echo $product->product_code; ?></label>
							</div>							
						</div>
						<div class="form-group">
							<label for="Nomor" class="col-sm-3 control-label">Product Name :</label>
							<div class="col-sm-8">
								<label for="Nomor" class="form-control"><?php echo $product->product_name; ?></label>
							</div>							
						</div>
						<div class="form-group">
							<label for="Nomor" class="col-sm-3 control-label">Price Product :</label>
							<div class="col-sm-8">
								<label for="Nomor" class="form-control"><?php echo $product->product_price_usd; ?></label>
							</div>							
						</div>					
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
								<td style="width:8%; "><button type="button" id="btnCariPemasukan" title="Tambah data" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
							<?php //echo "<pre>";print_r($order);"</pre>";exit(); 
							$no=1;
							foreach ($order as $key => $value) {							
							$i=$no-1;
							?>
							<tr>
								<td><?php echo $no ?></td>
								<input type="hidden" name="idmaterial[]" value="<?php echo $value->material_id ?>">
								<td><input class="form-control" readonly value="<?php echo $value->material_code ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $value->material_name ?>"></td>
								<td><input name="price[]" class="form-control" readonly value="<?php echo $value->material_price ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $value->material_cbm ?>"></td>
								<td><input name="qty[]" type="number" step="0.01" class="form-control" value="<?php echo $qty_order[$i] ?>" required/></td>
								<td><button type="button" id="btnCariPemasukan" title="Tambah data" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></td>
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
								<td style="width:8%; "><button type="button" id="btnCariPemasukan" title="Tambah data" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
							<?php //echo "<pre>";print_r($order);"</pre>";exit(); 
							$no=1;
							foreach ($order_liquid as $key => $values) {							
							$i=$no-1;
							?>
							<tr>
								<td><?php echo $no ?></td>
								<input type="hidden" name="idmaterial_ld[]" value="<?php echo $values->material_id ?>">
								<td><input class="form-control" readonly value="<?php echo $values->material_code ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $values->material_name ?>"></td>
								<td><input name="price_ld[]" class="form-control" readonly value="<?php echo $values->material_price ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $values->material_cbm ?>"></td>
								<td><input name="qty_ld[]" type="number" step="0.01" class="form-control" value="<?php echo $qty_order_liquid[$i] ?>" required/></td>
								<td><button type="button" id="btnCariPemasukan" title="Tambah data" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></td>
							</tr>
							<?php $no++; } ?>							
						</tbody>
						<tfoot>
							
						</tfoot>
					</table>					
			   </div>					
		</div>
		<div class="form-horizontal footer">
				<div class="row" id="addcol">
					<div class="col-sm-6">
						<button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Simpan Data</button>
						<!-- <button onclick="adddataprint('')" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-print"></span> Simpan Data dan Cetak</button>
						<button onclick="batal()" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-minus-sign"></span> Batal</button> -->
					</div>
				</div>				
			</div>	
		</form>
	</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
		var tglreg = "<?php echo date("d-m-Y")?>";
		$("#tglreg").val(tglreg);
		$("#tglship").val(tglreg);		

		$(".date").datepicker({
			format : "dd-mm-yyyy",
			autoclose : true
		});	
	});	

function simpanreg(idx)
	{
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
</script>