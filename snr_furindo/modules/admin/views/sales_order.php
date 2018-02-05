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
	<h1>Input Sales Order</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(); return false;">
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">REF NO :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="FR<?php echo date('mdy') ?>" required/>
							</div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-3">Jenis Order:</label>
						  <div style="margin-top:5px;" class="col-sm-8">          
							<select id="categories" name="categories" class="form-control">
								<!-- <option value="">--PILIH Jenis Order--</option> -->
								<option value="sales">Sales</option>
								<option value="buffer">Buffer</option>
							</select>
						  </div>
					  </div>					
						
						<div class="form-group">
						<label for="kegiatan" class="col-sm-3 control-label">Customer :</label>
							<div class="col-sm-8" id="col-kontak">
								<div class="input-group">
                                    <input type="text" readonly  value="NOIR" class="form-control" id="customer" name="customer" >
                                    <input type="hidden" id="id_rekanan" value="1" name="id_customer" >
									<span class="input-group-btn">
						       			<button type="button" id="btnCariRekanan" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
						       		</span>
						       	</div>
							</div>							
						</div>

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Date Order :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly role="date" class="form-control date" id="tglreg" name="tglreg" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Date be Shipped :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly role="date" class="form-control date" id="tglship" name="tglship" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
					</div>
					
					
				</div>
			</div>
			
			<div class="seperator">
			
			<div class="header1">
				<h4>RINCIAN PRODUCT ORDER</h4>
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
								<input type="hidden" name="idproduk[]" value="<?php echo $value->product_id ?>">
								<td><input class="form-control" readonly value="<?php echo $value->product_code ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $value->product_name ?>"></td>
								<td><input name="price[]" class="form-control" readonly value="<?php echo $value->product_price_usd ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $value->product_cbm ?>"></td>
								<td><input name="qty[]" type="number" min="1" class="form-control" value="<?php echo $qty_order[$i] ?>" required/></td>
								<td><button type="button" id="btnCariPemasukan" title="Tambah data" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></button></td>
							</tr>
							<?php $no++; } ?>							
						</tbody>
						<tfoot>
						</tfoot>
					</table>					
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
			//startDate : new Date('<?php echo date('Y-m-d', strtotime("-".$_SESSION['Akses']." days"))?>'),
		   // endDate : new Date('<?php echo date('Y-m-d', strtotime("+90 days"))?>'),
			autoclose : true,
		});	
	});	

function simpanreg()
	{
		var target = "<?php echo site_url("admin/saveso")?>";
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
				loadhtml = "<?php echo site_url("admin/Sales")?>";
				alert("Data berhasil disimpan.");
				$(".content-wrapper").load(loadhtml);
			}
		
		});
	}
</script>