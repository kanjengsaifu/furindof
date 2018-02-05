<?php $tgl = date("d-m-Y", strtotime($PO->purchase_order_liquid_date)); ?>
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
	<h1>Edit PO Suport Material</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(); return false;">
			<input type="hidden" id="po_id" name="po_id" value="<?php echo $PO->purchase_order_liquid_id ?>" required/>
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">NO PO :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="<?php echo $PO->purchase_order_liquid_code ?>" required/>
							</div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-3">NO Reff:</label>
						  <div class="col-sm-8" id="col-kontak">
							<div class="input-group">
                                <input type="text" readonly  value="<?php echo $PO->sales_order_ref_no ?>" class="form-control" id="Sales" name="sales" >
                                <input type="hidden" id="id_sales" value="<?php echo $PO->sales_order_id ?>" name="id_sales" >
								<span class="input-group-btn">
					       			<button type="button" id="btnCariSO" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
					       		</span>
					       	</div>
						</div>	
					  </div>					
						
						<div class="form-group">
						<label for="kegiatan" class="col-sm-3 control-label">Vendor :</label>
							<div class="col-sm-8" id="col-kontak">
								<div class="input-group">
                                    <input type="text" readonly  value="<?php echo $PO->provider_name ?>" class="form-control" id="vendor" name="vendor" >
                                    <input type="hidden" id="id_rekanan" value="<?php echo $PO->provider_id ?>" name="id_customer" >
									<span class="input-group-btn">
						       			<button type="button" id="btnCariRekanan" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
						       		</span>
						       	</div>
							</div>							
						</div>

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">PO Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="" role="date" class="form-control date" id="tglreg" name="tglreg" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Delivery Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly role="date" value="" class="form-control date" id="tglship" name="tgldel" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
					</div>

					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Phone :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="<?php echo $PO->provider_phone ?>" role="date" class="form-control date" id="phone" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
                                  </div>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Address :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="<?php echo $PO->provider_city ?>" role="date" class="form-control date" id="address" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span> 
                                  </div>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Note :</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="note"><?php echo $PO->purchase_order_liquid_note ?></textarea>
							</div>
						</div>
					</div>
						
					
				</div>
			</div>
			
			<div class="seperator">
			
			<div class="header1">
				<h4>RINCIAN PRODUCT ORDER</h4>
			</div>			
				<div class="table-responsive" style="width:99%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th class="btn-primary" style="width:4%; text-align:center; vertical-align: middle;">No</th>
								<th class="btn-primary" style="width:10%; text-align:center; vertical-align: middle;">Code</th>
								<th class="btn-primary" style="width:24%; text-align:center; vertical-align: middle;">Material Name</th>
								<th class="btn-primary" style="width:10%; text-align:center; vertical-align: middle;">Price</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">Stock</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">Terbeli</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">Beli</th>
								<th class="btn-primary" style="width:30%; text-align:center; vertical-align: middle;">Description</th>
								<td style="width:8%; "><button type="button" id="btnCari" title="Tambah by SO" class="btn btn-xs btn-success">SO</button></td>
								<td style="width:8%; "><button type="button" id="btnCariLiquid" title="Tambah Liquid" class="btn btn-xs btn-info">LQ</button></td></tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
						<?php
							$num =0; 
							$stock = 0;
							foreach ($PODet->result() as $row) {
							$i = $num + 1;
							$inv = $this->db->query("SELECT sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$row->material_id."' AND inventory_categories = 'stock'");
							$cek = $this->db->query("SELECT sum(purchase_order_liquid_detail_qty) as purchase_order_liquid_detail_qty from trx_purchase_order_liquid_detail inner join trx_purchase_order_liquid on trx_purchase_order_liquid_detail.purchase_order_liquid_id = trx_purchase_order_liquid.purchase_order_liquid_id  where sales_order_id = '".$PO->sales_order_id."' AND material_id = '".$row->material_id."'")->row();
							$stock = $inv->row()->stok_qty+0;
							$beli = $cek->purchase_order_liquid_detail_qty-$row->purchase_order_liquid_detail_qty;
												
						?>
							<input type='hidden' value='<?php echo $row->purchase_order_liquid_detail_id ?>' name='iddetail[]'/>
							<tr id='tmbinput-<?php echo $num ?>'>
							<td><?php echo $i ?><input type='hidden' value='<?php echo $row->material_id ?>' name='id_material[]'/><input type='hidden' value='<?php echo $row->material_id ?>' name='id_product[]'/></td>
							<td><input type='text' readonly='readonly' value='<?php echo $row->material_code ?>' id='uraian-<?php echo $num ?>' class='form-control'/></td>
							<td><input type='text' value='<?php echo $row->material_name ?>' style='text-align:left;' id='nmproduct-<?php echo $num ?>'class='form-control'/></td>
							<td><input type='text' value='<?php echo number_format($row->purchase_order_liquid_detail_price) ?>' name='nominal[]' id='nominal-<?php echo $num ?>' onkeyup='getnumeric(this)' class='form-control'/></td>
							<td><input type='number' readonly value='<?php echo $stock ?>' class='form-control autocomplate'/></td>
							<td><input type='number' readonly value='<?php echo $beli ?>' class='form-control autocomplate'/></td>
							<td><input type='number' step='0.01' min='1' value='<?php echo $row->purchase_order_liquid_detail_qty ?>' name='qty[]' id='qty-<?php echo $num ?>' class='form-control autocomplate'/></td>
							<td><input type='text' name='desc[]' id='desc-<?php echo $num ?>' value='<?php echo $row->purchase_order_liquid_detail_desc ?>' class='form-control autocomplate'/></td>
							<td style='text-align:center;'><button type='button' onclick='deleterow(<?php echo $row->purchase_order_liquid_detail_id ?>)' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>
							<td style='text-align:center;'><button type='button' onclick='addinfo()' title='info data' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-info-sign'></span></button></td>
							</tr>
						
						<?php $num++; }	?>
														
						</tbody>
						<tfoot>
						</tfoot>
					</table>					
			   </div>	
				
		
			<div class="form-horizontal footer">
				<div class="row" id="addcol">
					<div class="col-sm-6">
						&nbsp;&nbsp;<button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Simpan Data</button>
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
    <div class="modal-content" style="width:750px">
      <div class="modal-header">
        <button type="button" class="close Count" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="caridata" oninput="loadGridData1()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example3" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th class="hidden" tabindex='0' style="text-align:center; width:7%"> No</th>
                    <th class="sorting" tabindex='1' style="text-align:center; width:15%"> Kode </th>
                    <th class="sorting" tabindex='2' style="text-align:center; width:53%"> Nama </th>
                    <th class="sorting" tabindex='3' style="text-align:center; width:10%"> Stock </th>
                    <th class="sorting" tabindex='4' style="text-align:center; width:13%"> Terbeli </th>
                    <th class="sorting" tabindex='5' style="text-align:center; width:14%"> Kebutuhan </th> 
                    <th class="hidden" tabindex='6' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='7' style="text-align:center; width:10%"> Qty </th> 
                    <th class="hidden" tabindex='8' style="text-align:center; width:10%"> Qty </th> 
                    <th class="sorting" tabindex='9' style="text-align:center; width:10%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridData">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModalLiquid">
  <div class="modal-dialog">
    <div class="modal-content" style="width:750px">
      <div class="modal-header">
        <button type="button" class="close Liquid" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="caridataliquid" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example7" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th class="hidden" tabindex='0' style="text-align:center; width:7%"> No</th>
                    <th class="sorting" tabindex='1' style="text-align:center; width:15%"> Kode </th>
                    <th class="sorting" tabindex='2' style="text-align:center; width:53%"> Nama </th>
                    <th class="sorting" tabindex='3' style="text-align:center; width:10%"> Stock </th>
                    <th class="sorting" tabindex='5' style="text-align:center; width:14%"> Kebutuhan </th>
                    <th class="sorting" tabindex='4' style="text-align:center; width:13%"> Terbeli </th>                     
                    <th class="hidden" tabindex='6' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='7' style="text-align:center; width:10%"> Qty </th> 
                    <th class="hidden" tabindex='8' style="text-align:center; width:10%"> Qty </th> 
                    <th class="sorting" tabindex='9' style="text-align:center; width:10%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridDataLiquid">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="myModalRekanan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close Rekanan" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Vendor</h4>
      </div>
      <div class="modal-body">
      	<input type="text" id="caridatarekanan" oninput="loadGridDataRekanan1()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example4" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th style="text-align:center; width:7%"> No</th>
                    <th style="text-align:center; width:15%"> Kode </th>
                    <th style="text-align:center; width:58%"> Nama </th>
                    <!-- <th style="text-align:center; width:13%"> Telp </th>  -->                   
                    <th style="text-align:center; width:15%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridDataRekanan">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->  
</div><!-- /.modal -->

<div class="modal fade" id="myModalSales">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close Sales" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Sales Order</h4>
      </div>
      <div class="modal-body">
      	<input type="text" id="caridatasales" oninput="loadGridDataSales()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example5" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th style="text-align:center; width:7%"> No</th>
                    <th style="text-align:center; width:15%"> Kode </th>
                    <th style="text-align:center; width:58%"> Nama </th>
                    <!-- <th style="text-align:center; width:13%"> Telp </th>  -->                   
                    <th style="text-align:center; width:15%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridDataSales">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$(document).ready(function(){
		loadGridDataLiquid();
		loadGridData();		
		var tglreg = "<?php echo date("d-m-Y", strtotime($PO->purchase_order_liquid_date))?>";
		var tgl = "<?php echo date("d-m-Y", strtotime($PO->purchase_order_liquid_delivery_date))?>";
		$("#tglreg").val(tglreg);
		$("#tglship").val(tgl);		

		$(".date").datepicker({
			format : "dd-mm-yyyy",
			startDate : new Date('<?php echo date('Y-m-d', strtotime("-".$_SESSION['Akses']." days"))?>'),
		    endDate : new Date('<?php echo date('Y-m-d', strtotime("+90 days"))?>'),
			autoclose : true,
		});			
		$('.Count').click(function(e)
	    {
	    	//$('#example3').dataTable().fnDestroy();
	    	$('#myModal').attr('class', 'modal hide'); 
	    });
	    $('.Liquid').click(function(e)
	    {
	    	//$('#example7').dataTable().fnDestroy();
	    	$('#myModalLiquid').attr('class', 'modal hide'); 
	    });
	    $('.Rekanan').click(function(e)
	    {
	    	
	    	$('#example4').dataTable().fnDestroy();		
	    	
	    	$('#myModalRekanan').attr('class', 'modal hide'); 
	    });
	    $('.Sales').click(function(e)
	    {
	    	$('#myModalSales').attr('class', 'modal hide'); 
	    });
		$('#btnCari').click(function(e)

	    {

			e.preventDefault();
			var idso = $('#id_sales').val();
			if(idso == ''){
				alert('Pilih Sales Order terlebih dahulu !');
				return false;
			}  


	    	$('#alertMessage').remove();

	    	$('#myModal').attr('class', 'modal show');  

	    	//document.getElementById("caridata").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	//loadGridData();
	    });

	    $('#btnCariLiquid').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalLiquid').attr('class', 'modal show');  

	    	
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	//loadGridDataLiquid();
	    	//document.getElementById("example7").focus();
	    });

	    $('#btnCariRekanan').click(function(e)

	    {
	    	alert('Permintaan tidak diijinkan !');
	    	return false;
			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalRekanan').attr('class', 'modal show');  

	    	document.getElementById("caridatarekanan").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	loadGridDataRekanan();
	    });

	    $('#btnCariSO').click(function(e)

	    {
	    	alert('Permintaan tidak diijinkan !');
	    	return false;
			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalSales').attr('class', 'modal show');  

	    	document.getElementById("caridatasales").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	loadGridDataSO();
	    });
	});

function loadGridData(){ 
		var idpo = $('#po_id').val();
		var produk_id = $('#caridata').val();
		var idso = $('#id_sales').val();		 
        ajaxDataGrid('<?php echo base_url()?>suport/addTableSo_det', {idx : produk_id, ids : idso, idp : idpo}, 'tableGridData');
        $('#example3').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false,
          "bDestroy": true
        });       
    }

function loadGridDataLiquid(){ 
		var produk_id = $('#caridataliquid').val();
		var idso = $('#id_sales').val();		 
        ajaxDataGrid('<?php echo base_url()?>suport/addTableSo_Liquid_byso', {idx : produk_id, ids : idso}, 'tableGridDataLiquid');
        $('#example7').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": true,
          "bDestroy": true
        });    
        //document.getElementById("example7").focus();   
    }

function loadGridData1(){ 
		var produk_id = $('#caridata').val();
		var idso = $('#id_sales').val();		 
        ajaxDataGrid('<?php echo base_url()?>suport/addTableSo_det1', {idx : produk_id, ids : idso}, 'tableGridData');
             
    }

function loadGridDataSO(){ 
		var produk_id = $('#caridatasales').val();  
        ajaxDataGrid('<?php echo base_url()?>suport/addTableSales', {idx : produk_id}, 'tableGridDataSales');       
    }	

function loadGridDataRekanan(){ 
		var produk_id = $('#caridatarekanan').val();

        ajaxDataGrid('<?php echo base_url()?>suport/addTableRekanan', {idx : produk_id}, 'tableGridDataRekanan'); 
        $('#example4').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false,
          "bDestroy": true
        });       
    }

function loadGridDataRekanan1(){ 
		var produk_id = $('#caridatarekanan').val();

        ajaxDataGrid('<?php echo base_url()?>suport/addTableRekanan1', {idx : produk_id}, 'tableGridDataRekanan'); 
               
    }	

function addRekanan(idx, nama, code, phone, address)
	{ 
		var name = nama.replace(/_/ig, ' ');
		var telp = phone.replace(/_/ig, ' ');
		var alamat = address.replace(/_/ig, ' ');
	 	$('#vendor').val(name);
	 	$('#id_rekanan').val(idx);
	 	$('#myModalRekanan').attr('class', 'modal hide');
	 	$('#nomor').val(code);
	 	$('#phone').val(telp);
	 	$('#address').val(alamat); 
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	return false;	
	  	sendRequestForm('admin/insertDetailSo', {IDSo : so_id, IDproduct : idx, price : nama}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/editso', {IDBidang : so_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

function addProduct(objReference, idx)
	{ 
		var idpo = $('#po_id').val();
		// if(idx == 0){
		// 	alert('qty material telah teralokasikan !');
		// 	return false;
		// }
		var Id 		= $(objReference).parent().parent().find('td:eq(0)').html();
		var kode 	= $(objReference).parent().parent().find('td:eq(1)').html();
		var name 	= $(objReference).parent().parent().find('td:eq(2)').html();
		var stock 	= $(objReference).parent().parent().find('td:eq(3)').html();
		var beli 	= $(objReference).parent().parent().find('td:eq(5)').html();
		var qty 	= $(objReference).parent().parent().find('td:eq(4)').html();
		var price 	= $(objReference).parent().parent().find('td:eq(6)').html();
		var IDproduct 	= $(objReference).parent().parent().find('td:eq(7)').html();		
		var count 	= $(objReference).parent().parent().find('td:eq(8)').html();
		
	 	var htmlOut = ajaxFillGridJSON('suport/adddataSm', {po_id : idpo ,mat_id : Id ,prod_id : IDproduct ,price : price ,qty : qty});
		$('#myModal').attr('class', 'modal hide');
		var htmlOut1 = ajaxFillGridJSON('suport/edit_po_sm', {IDBidang : idpo});	    		
	   	$('.content-wrapper').html(htmlOut1); 

	  	
	}

	function deleterow(obj)
	{		
		var idpo = $('#po_id').val();
		//alert(idpo);
		//return false;
		isDelete = confirm('Yakin data akan dihapus ?');
	  	if (isDelete) sendRequestForm('suport/habusdataSm', {ID : obj}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('suport/edit_po_sm', {IDBidang : idpo});	    		
	   	$('.content-wrapper').html(htmlOut);
		
	}

	function getnumeric(elem)
	{
		
		var getelem = $(elem).attr("id");
			getval = $("#"+getelem).val().replace(/,/ig, '');
			currancy = getval.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			
			getval = $("#"+getelem).val(currancy);
			//$("#"+getelem).val(currancy);
			
			//calculates();
	}

function addSales(idx, nama)
	{ 
	 	$('#Sales').val(nama);
	 	$('#id_sales').val(idx);
	 	$('#myModalSales').attr('class', 'modal hide'); 
	 		  	
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

		var htmlOut = ajaxFillGridJSON('suport/saveEditProductPo', data);	    		
	   	//$('.content-wrapper').html(htmlOut);
	   	//return false;
		//sendRequestForm('admin/updateso', data, 'box-body');
		var kodeTipeKaryawan = ajaxFillGridJSON('suport/po_sm', {IDBidang : idx}); 
		alert("Data berhasil disimpan.");
		$('.content-wrapper').html(kodeTipeKaryawan);
		
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