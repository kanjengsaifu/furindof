<?php $tgl = date("d-m-Y", strtotime($LPB->lpb_liquid_date)); ?>
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
	<h1>Edit LPB Suport Material</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(); return false;">
			<input type="hidden" id="soid" name="po_id" value="<?php echo $LPB->purchase_order_liquid_id ?>" required/>
			<input type="hidden" id="lpbid" name="lpb_id" value="<?php echo $LPB->lpb_liquid_id ?>" required/>
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">NO LPB :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="<?php echo $LPB->lpb_liquid_code ?>" required/>
							</div>
						</div>
						<!-- <div class="form-group">
						  <label class="control-label col-sm-3">NO PO:</label>
						  <div class="col-sm-8" id="col-kontak">
							<div class="input-group">
                                <input type="text" readonly  value="" class="form-control" id="Sales" name="sales" >
                                <input type="hidden" id="id_sales" value="" name="id_sales" >
								<span class="input-group-btn">
					       			<button type="button" id="btnCariSO" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
					       		</span>
					       	</div>
						</div>	
					  </div> -->					
						
						<div class="form-group">
						<label for="kegiatan" class="col-sm-3 control-label">Vendor :</label>
							<div class="col-sm-8" id="col-kontak">
								<div class="input-group">
                                    <input type="text" readonly  value="<?php echo $LPB->provider_name ?>" class="form-control" id="vendor" name="vendor" >
                                    <input type="hidden" id="id_rekanan" value="<?php echo $LPB->provider_id ?>" name="id_customer" >
									<span class="input-group-btn">
						       			<button type="button" id="btnCariRekanan" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
						       		</span>
						       	</div>
							</div>							
						</div>

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Nota Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="" role="date" class="form-control date" id="tglreg" name="tglreg" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
						<!-- <div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Delivery Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly role="date" value="" class="form-control date" id="tglship" name="tgldel" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div> -->
						
					</div>

					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Phone :</label>
							<div class="col-sm-8">
								<div class="input-group">
                                    <input type="text" readonly value="<?php echo $LPB->provider_phone ?>" role="date" class="form-control" id="phone" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> 
                                  </div>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Address :</label>
							<div class="col-sm-8">
								<div class="input-group">
                                    <input type="text" readonly value="<?php echo $LPB->provider_address ?>" role="date" class="form-control" id="address" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span> 
                                  </div>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Biaya Kirim :</label>
							<div class="col-sm-8">
								<div class="input-group">
                                    <input onkeyup='getnumericid(this)' onblur='calculates()' type="text" value="<?php echo number_format($LPB->lpb_liquid_biaya) ?>" name="biaya" class="form-control" id="biaya" >
                                    <span class="input-group-addon">Rp</span> 
                                  </div>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">No Nota :</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="note"><?php echo $LPB->lpb_liquid_note ?></textarea>
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
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">Order</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">Diterima</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">Terima</th>
								<th class="btn-primary" style="width:30%; text-align:center; vertical-align: middle;">Description</th>
								<td style="width:8%; "><button type="button" id="btnCari" title="Tambah by SO" class="btn btn-xs btn-success">SO</button></td>
								<td style="width:8%; "><button type="button" id="btnCariLiquid" title="Tambah Liquid" class="btn btn-xs btn-info">LQ</button></td>
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
						<?php
							$num =0; 
							foreach ($LPBDet->result() as $row) {
							$i = $num + 1;
							$inv = $this->db->query("SELECT sum(purchase_order_liquid_detail_qty) as stok_qty from trx_purchase_order_liquid_detail inner join trx_purchase_order_liquid on
								trx_purchase_order_liquid.purchase_order_liquid_id = trx_purchase_order_liquid_detail.purchase_order_liquid_id where provider_id = '".$LPB->provider_id."' AND material_id = '".$row->material_id."'");
							$cek = $this->db->query("SELECT sum(lpb_liquid_detail_qty) as lpb_liquid_detail_qty from trx_lpb_liquid_detail inner join trx_lpb_liquid on trx_lpb_liquid_detail.lpb_liquid_id = trx_lpb_liquid.lpb_liquid_id  where trx_lpb_liquid.provider_id = '".$LPB->provider_id."' AND material_id = '".$row->material_id."'")->row();
							$stock = round($inv->row()->stok_qty+0,2);
							$beli = round($cek->lpb_liquid_detail_qty,2)-round($row->lpb_liquid_detail_qty,2);
							$max = $stock-$beli;
							$kbt = $row->lpb_liquid_detail_price * $row->lpb_liquid_detail_qty;
							
						?>
							<input type='hidden' value='<?php echo $row->lpb_liquid_detail_id ?>' name='iddetail[]'/>
							<tr id='tmbinput-<?php echo $num ?>'>
							<td><?php echo $i ?><input type='hidden' value='<?php echo $row->material_id ?>' name='id_material[]'/><input type='hidden' value='' name='id_product[]'/></td>
							<td><input type='text' readonly='readonly' value='<?php echo $row->material_code ?>' id='uraian-<?php echo $num ?>' class='form-control'/></td>
							<td><input type='text' value='<?php echo $row->material_name ?>' style='text-align:left;' id='nmproduct-<?php echo $num ?>'class='form-control'/></td>							
							<td><input type='text' value='<?php echo number_format($row->lpb_liquid_detail_price) ?>' name='nominal[]' id='nominal-<?php echo $num ?>' atm='nominal-<?php echo $num ?>' onkeyup='getnumeric(this)' class='form-control'/></td>
							<td><input type='number' readonly value='<?php echo $stock ?>' class='form-control autocomplate'/></td><input type='hidden' value='<?php echo $row->purchase_order_liquid_id ?>' name='id_PO[]'/>
							<td><input type='number' readonly value='<?php echo $beli ?>' class='form-control autocomplate'/><input type='hidden' value='<?php echo $kbt ?>' id='ttl-<?php echo $num ?>' name='ttl_harga[]'/></td>
							<td><input type='number' min='1' step='0.01' value='<?php echo $row->lpb_liquid_detail_qty ?>' name='qty[]' id='qty-<?php echo $num ?>' onchange='getnumeric(this)' atm='nominal-<?php echo $num ?>' class='form-control autocomplate'/></td>
							<td><input type='text' name='desc[]' id='desc-<?php echo $num ?>' value='<?php echo $row->lpb_liquid_detail_note ?>' class='form-control autocomplate'/></td>
							<td style='text-align:center;'><button type='button' onclick='deleterow(<?php echo $row->lpb_liquid_detail_id ?>,<?php echo $row->inventory_id ?>)' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>
							<td colspan='1' style='text-align:center;'><button type='button' onclick='addinfo(<?php echo $row->lpb_liquid_detail_id ?>)' title='info data' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-info-sign'></span></button></td>
							</tr>
						
						<?php $num++; }	?>
														
						</tbody>
						<tfoot>
						</tfoot>
					</table>					
			   </div>	

			   <div class="form-horizontal">
					<div class="row">
						<div class="col-sm-7">
							<div class="form-group">
							<label for="Nomor" class="col-sm-3  control-label">Terbilang :</label>
								<div class="col-sm-9">
									<input class="form-control" style="font-family: cursive;" disabled="disabled" id="terbilang" name="terbilang" value=""/>
								</div>
							</div>
						</div>
						<div class="col-sm-5">
							<div class="form-group">
							<label for="Nomor" class="col-sm-3 col-sm-offset-1 control-label">Biaya LPB :</label>
								<div class="col-sm-7">
									<input style="font-size:24px; color:blue; backgraound-color:green;" atm='nominal-x' class="form-control" readonly id="total" name="total" value=""/>
								</div>
							</div>
						</div>
					</div>
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
    <div class="modal-content" style="width:760px">
      <div class="modal-header">
        <button type="button" class="close Count" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="caridata" oninput="loadGridData1()" placeholder="Cari data product" value="" class="form-control" autofocus>        
		<table id="example3" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th class="sorting" tabindex='0' style="text-align:center; width:7%"> No</th>
                    <th class="sorting" tabindex='1' style="text-align:center; width:15%"> PO </th>
                    <th class="sorting" tabindex='2' style="text-align:center; width:15%"> Kode </th>
                    <th class="sorting" tabindex='3' style="text-align:center; width:43%"> Nama </th>
                    <th class="sorting" tabindex='4' style="text-align:center; width:10%"> Qty </th> 
                    <th class="hidden" tabindex='5' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='6' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='7' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='8' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='9' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='10' style="text-align:center; width:10%"> Qty </th>                    
                    <th class="sorting" tabindex='11' style="text-align:center; width:10%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridData">                   
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
		loadGridData();
		calculates();
		var tglreg = "<?php echo $tgl ?>";
		$("#tglreg").val(tglreg);
		$("#tglship").val(tglreg);		

		$(".date").datepicker({
			format : "dd-mm-yyyy",
			autoclose : true
		});	
		$('.Count').click(function(e)
	    {
	    	$('#example3').dataTable().fnDestroy();
	    	$('#myModal').attr('class', 'modal hide'); 
	    });
	    $('.Rekanan').click(function(e)
	    {
	    	alert('Permintaan tidak diijinkan !');
	    	return false;
	    	
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

	    	document.getElementById("caridata").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	
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

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalSales').attr('class', 'modal show');  

	    	document.getElementById("caridatasales").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	loadGridDataSO();
	    });
	});

function loadGridData(){ 
		var produk_id = $('#caridata').val();
		var idso = $('#id_rekanan').val();
		//alert(idso);		 
        ajaxDataGrid('<?php echo base_url()?>lpb/addTableLiquid_det', {idx : produk_id, ids : idso}, 'tableGridData');
        $('#example3').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true,
          "bDestroy": true
        });       
    }

function loadGridData1(){ 
		var produk_id = $('#caridata').val();
		var idso = $('#id_sales').val();		 
        ajaxDataGrid('<?php echo base_url()?>raw/addTableSo_det1', {idx : produk_id, ids : idso}, 'tableGridData');
             
    }

function loadGridDataSO(){ 
		var produk_id = $('#caridatasales').val();  
        ajaxDataGrid('<?php echo base_url()?>lpb/addTablePO', {idx : produk_id}, 'tableGridDataSales');       
    }	

function loadGridDataRekanan(){ 
		var produk_id = $('#caridatarekanan').val();

        ajaxDataGrid('<?php echo base_url()?>lpb/addTableRekanan', {idx : produk_id}, 'tableGridDataRekanan'); 
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

        ajaxDataGrid('<?php echo base_url()?>raw/addTableRekanan1', {idx : produk_id}, 'tableGridDataRekanan'); 
               
    }	

function addRekanan(idx, nama, code, phone, address, poid)
	{ 
		var name = nama.replace(/_/ig, ' ');
		var telp = phone.replace(/_/ig, ' ');
	 	$('#vendor').val(name);
	 	$('#id_rekanan').val(idx);
	 	$('#myModalRekanan').attr('class', 'modal hide');
	 	$('#nomor').val(code);
	 	$('#phone').val(telp);
	 	$('#address').val(address); 
	 	$('#soid').val(poid); 
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	$('#example4').dataTable().fnDestroy();		 	
	}

function addProduct(objReference, idx)
	{ 
		if(idx == 0){
			alert('qty material telah teralokasikan !');
			return false;
		}
		var idpo = $('#lpbid').val();
	 	var Id 			= $(objReference).parent().parent().find('td:eq(0)').html();
		var kode 		= $(objReference).parent().parent().find('td:eq(2)').html();
		var name 		= $(objReference).parent().parent().find('td:eq(3)').html();
		var qty 		= $(objReference).parent().parent().find('td:eq(4)').html();
		var price 		= $(objReference).parent().parent().find('td:eq(5)').html();
		var IDproduct 	= $(objReference).parent().parent().find('td:eq(6)').html();
		var IDPO 		= $(objReference).parent().parent().find('td:eq(7)').html();
		var stock 		= $(objReference).parent().parent().find('td:eq(8)').html();
		var beli 		= $(objReference).parent().parent().find('td:eq(9)').html();
		
	 	var htmlOut = ajaxFillGridJSON('lpb/adddataSM', {lpb_id : idpo ,mat_id : Id ,prod_id : IDproduct ,price : price ,qty : qty, PO_ID : IDPO});
		$('#myModal').attr('class', 'modal hide');
		var htmlOut1 = ajaxFillGridJSON('lpb/edit_lpb_sm', {IDBidang : idpo});	    		
	   	$('.content-wrapper').html(htmlOut1); 

	  	
	}

	function deleterow(obj, idv)
	{		
		var idpo = $('#lpbid').val();
		//alert(idpo);
		//return false;
		isDelete = confirm('Yakin data akan dihapus ?');
	  	if (isDelete) sendRequestForm('lpb/habusdataSm', {ID : obj, IDV : idv}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('lpb/edit_lpb_sm', {IDBidang : idpo});	    		
	   	$('.content-wrapper').html(htmlOut);
		
	}

	function getnumericid(elem)
	{
		
		var getelem = $(elem).attr("id");
			getval = $("#"+getelem).val().replace(/,/ig, '');
			currancy = getval.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			
			getval = $("#"+getelem).val(currancy);
			//$("#"+getelem).val(currancy);
			
			calculates();
	}

	function getnumeric(elem)
	{
		
		var getelem = $(elem).attr("atm");
			getval = $("#"+getelem).val().replace(/,/ig, '');
			currancy = getval.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			//console.log(getval);
			
			ilmen = getelem.replace(/nominal-/ig, 'qty-');
			price = getelem.replace(/nominal-/ig, 'ttl-');
			getilm = $("#"+ilmen).val().replace(/,/ig, '');
			jml = getval*getilm;
			$("#"+price).val(jml)
			//console.log(getilm);
			getval = $("#"+getelem).val(currancy);
			calculates();
	}

	function calculates()
	{
		var tag = $("input[name='ttl_harga[]']");
			
			total = 0;
			total2 = 0;
			grand_total = 0;			
			biaya = $("#biaya").val().replace(/,/ig,"");
		
		
		$(tag).each(function(){
			total +=+ $(this).val().replace(/,/ig,"");
		});		
		
		grand_total = total+parseInt(biaya);
		
		//$("#total").val(grand_total);
		xx = grand_total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		//console.log(xx);
		$("#total").val(xx);
		
		$('#terbilang').val(Terbilang(grand_total)+" rupiah");
		
	}

function addSales(idx, nama)
	{ 
	 	$('#Sales').val(nama);
	 	$('#id_sales').val(idx);
	 	$('#myModalSales').attr('class', 'modal hide'); 
	 		  	
	}

function simpanreg()
	{
		var idx = $('#soid').val();
			data = $("#addkso").serialize();

		var htmlOut = ajaxFillGridJSON('lpb/updateLPBSM', data);	    		
	   	//$('.content-wrapper').html(htmlOut);
	   	//return false;
		//sendRequestForm('admin/updateso', data, 'box-body');
		var kodeTipeKaryawan = ajaxFillGridJSON('lpb/lpb_sm', {IDBidang : idx}); 
		alert("Data berhasil disimpan.");
		$('.content-wrapper').html(kodeTipeKaryawan);
		
	}
function Terbilang(x)
		{
		  var ambil = new Array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		  if (x < 12){
		  	return " "+ambil[x];
		  	}			
		  else if (x < 20){
		  	var nilai = x-10;
		  		awal = Terbilang(nilai);
		  	return awal+" belas";
		  	}			
		  else if (x < 100){
		  	var nilai1 = x/10;
		  		nilai = parseInt(nilai1);
		  		sisa = x%10;
		  		//$(".content-wrapper").html(nilai);
			return Terbilang(nilai)+" puluh "+Terbilang(sisa);
			}	
		  else if (x < 200){
			var nilai = x-100;
		  	return "seratus "+Terbilang(nilai);
		  	}	
		  else if (x < 1000){
			var nilai1 = x/100;
				nilai = parseInt(nilai1);
		  		sisa = x%100;
			return Terbilang(nilai)+" ratus "+Terbilang(sisa);
			}
		  else if (x < 2000){
			var nilai = x-1000;
		  	return "seribu "+Terbilang(nilai);
		  	}
		  else if (x < 1000000){
			var nilai1 = x/1000;
				nilai = parseInt(nilai1);
		  		sisa1 = x%1000;
		  		//$(".content-wrapper").html(sisa);
			return Terbilang(nilai)+" ribu "+Terbilang(sisa1);
			}
		  else if (x < 1000000000){
			var nilai1 = x/1000000;
				nilai = parseInt(nilai1);
		  		sisa = x%1000000;
		  	return Terbilang(nilai)+" juta "+Terbilang(sisa);
		  	}
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