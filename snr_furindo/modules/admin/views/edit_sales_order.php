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
	<h1>Edit Sales Order</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(); return false;">
			<input type="hidden" id="soid" name="so_id" value="<?php echo $order->sales_order_id ?>" required/>
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">REF NO :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="<?php echo $order->sales_order_ref_no ?>" required/>
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
                                    <input type="text" readonly value="<?php echo $order->sales_order_date ?>" role="date" class="form-control date" id="tglreg" name="tglreg" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Date be Shipped :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly role="date" value="<?php echo $order->sales_order_shipped_date ?>" class="form-control date" id="tglship" name="tglship" >
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
								<td style="width:8%; "><button type="button" id="btnCari" title="Tambah data" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
							<?php //echo "<pre>";print_r($order);"</pre>";exit(); 
							$no=1;
							foreach ($detail->result() as $key => $value) {							
							$i=$no-1;
							?>
							<tr>
								<td><?php echo $no ?></td>
								<input type="hidden" name="idproduk[]" value="<?php echo $value->product_id ?>">
								<input type="hidden" name="iddetail[]" value="<?php echo $value->sales_order_detail_id ?>">
								<td><input class="form-control" readonly value="<?php echo $value->product_code ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $value->product_name ?>"></td>
								<td><input name="price[]" class="form-control" readonly value="<?php echo $value->product_price_usd ?>"></td>
								<td><input class="form-control" readonly value="<?php echo $value->product_cbm ?>"></td>
								<td><input name="qty[]" type="number" min="1" class="form-control" value="<?php echo $value->sales_order_detail_qty ?>" required/></td>
								<td><button type="button" title="Tambah data" onclick="deletedata(<?php echo $value->sales_order_detail_id ?>)" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td>
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

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close Count" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
      	<input type="text" id="caridata" oninput="loadGridData()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example4" class="table table-bordered table-striped">
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

<script type="text/javascript">
$(document).ready(function(){
		var tglreg = "<?php echo date("d-m-Y")?>";
		$("#tglreg").val(tglreg);
		$("#tglship").val(tglreg);		

		$(".date").datepicker({
			format : "dd-mm-yyyy",
			startDate : new Date('<?php echo date('Y-m-d', strtotime("-".$_SESSION['Akses']." days"))?>'),
		    endDate : new Date('<?php echo date('Y-m-d', strtotime("+90 days"))?>'),
			autoclose : true,
		});		
		$('.Count').click(function(e)
	    {
	    	$('#myModal').attr('class', 'modal hide'); 
	    });
		$('#btnCari').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModal').attr('class', 'modal show');  

	    	document.getElementById("caridata").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	loadGridData();
	    });
	});

function loadGridData(){ 
		var produk_id = $('#caridata').val();  
        ajaxDataGrid('<?php echo base_url()?>admin/addTableProduct2', {idx : produk_id}, 'tableGridData');       
    }	

function addProduct(idx, usd)
	{ 
	 	var so_id = $('#soid').val();
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	//return false;	
	  	sendRequestForm('admin/insertDetailSo', {IDSo : so_id, IDproduct : idx, price : usd}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/editso', {IDBidang : so_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

function deletedata(idx)
	{ 
	 	var produk_id = $('#soid').val();
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	//return false;				
	   	isDelete = confirm('Yakin data akan dihapus ?');
	  	if (isDelete) sendRequestForm('admin/habusdataSo', {ID : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/editso', {IDBidang : produk_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

function simpanreg()
	{
		var idx = $('#soid').val();
			data = $("#addkso").serialize();
		sendRequestForm('admin/updateso', data, 'box-body');
		var kodeTipeKaryawan = ajaxFillGridJSON('admin/editso', {IDBidang : idx}); 
		alert("Data berhasil disimpan.");
		$('.content-wrapper').html(kodeTipeKaryawan);		
	}

</script>