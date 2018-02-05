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
	<h1>Edit Packing</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(); return false;">
			<input type="hidden" id="soid" name="so_id" value="<?php echo $pack->packing_id ?>" required/>
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">NO Packing :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="<?php echo $pack->packing_code ?>" required/>
							</div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-3">NO Reff:</label>
						  <div class="col-sm-8" id="col-kontak">
							<div class="input-group">
                                <input type="text" readonly  value="<?php echo $pack->sales_order_ref_no ?>" class="form-control" id="Sales" name="sales" >
                                <input type="hidden" id="id_sales" value="<?php echo $pack->sales_order_id ?>" name="id_sales" >
								<span class="input-group-btn">
					       			<button type="button" id="btnCariSO" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
					       		</span>
					       	</div>
						</div>	
					  </div>	
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Packing Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="" role="date" class="form-control date" id="tglreg" name="tglreg" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Note :</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="note"><?php echo $pack->packing_note ?></textarea>
							</div>
						</div>						
					</div>
					<div class="col-sm-6">					
						
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
								<th class="btn-primary" style="width:5%; text-align:center; vertical-align: middle;">No</th>
								<th class="btn-primary" style="width:12%; text-align:center; vertical-align: middle;">Kode</th>								
								<th class="btn-primary" style="width:27%; text-align:center; vertical-align: middle;">Material Name</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">Stock</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">Terpenuhi</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">QTY</th>								
								<th class="btn-primary" style="width:28%; text-align:center; vertical-align: middle;">Description</th>
								<td style="width:4%; "><button type="button" id="btnCari" title="Tambah data" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
								
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
						<?php 
							$no = 1;
							$cek1 = $this->db->query("SELECT * from trx_packing_detail inner join mst_product on mst_product.product_id = trx_packing_detail.product_id
								inner join mst_material on mst_material.material_id = trx_packing_detail.material_id inner join trx_packing on trx_packing.packing_id =
								trx_packing_detail.packing_id where trx_packing.packing_id = '".$pack->packing_id."'");
							foreach ($cek1->result() as $row) {
							$idx = $row->sales_order_id;
			                $idm = $row->product_id;
			                $idp = $row->material_id;
			                $sales = $this->db->query("SELECT * from trx_sales_order_detail where sales_order_id = '".$idx."' and product_id = '".$idm."'")->row();
			                $cek = $this->db->query("SELECT sum(packing_detail_qty) as packing_detail_qty from trx_packing_detail inner join trx_packing on trx_packing_detail.packing_id =  trx_packing.packing_id where sales_order_id = '".$idx."' AND product_id = '".$idm."'")->row();
			                $inv = $this->db->query("SELECT inventory_jumlah_nominal, sum(inventory_stock_qty) as stok_qty from trx_inventory where material_id = '".$idp."' AND inventory_categories = 'stock'")->row();
			                $order = ($sales->sales_order_detail_qty+$row->packing_detail_qty)-$cek->packing_detail_qty;
			                $datang = $cek->packing_detail_qty-$row->packing_detail_qty;
			                $code = "'".$row->material_code."'";
			                $stock = $inv->stok_qty+$row->packing_detail_qty;							
						?>
						<tr id='tmbinput-<?php echo $no ?>'><input type='hidden' value='<?php echo $row->packing_detail_id ?>' name='id_det[]'/>
							<td><?php echo $no ?><input type='hidden' value='<?php echo $row->material_id ?>' name='id_material[]'/><input type='hidden' value='<?php echo $row->product_id ?>' name='id_product[]'/></td>				
							<td><input type='text' readonly value='<?php echo $row->product_code ?>' style='text-align:left;' class='form-control'/></td>
							<td><input type='text' readonly value='<?php echo $row->product_name ?>' style='text-align:left;' id='nmproduct-<?php echo $no ?>'class='form-control'/></td>
							<td><input type='text' readonly value='<?php echo $stock ?>' class='form-control'/></td><input type='hidden' value='<?php echo $row->packing_nominal ?>' name='nominal[]'/>
							<td><input type='number' readonly value='<?php echo $datang ?>' class='form-control autocomplate'/></td>
							<td><input type='number' min='1' max='<?php echo $order ?>' value='<?php echo $row->packing_detail_qty ?>' name='qty[]' id='qty-<?php echo $no ?>' class='form-control autocomplate'/></td>			
							<td><input type='text' value='<?php echo $row->packing_detail_note ?>' name='desc[]' id='desc-<?php echo $no ?>' class='form-control autocomplate'/></td>
							<td style='text-align:center;'><button type='button' onclick='deleterow(<?php echo $no ?>)' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>							
						</tr>
						<?php 
							$no++;
						}
						?>								
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
    <div class="modal-content" style="width:950px">
      <div class="modal-header">
        <button type="button" class="close Count" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Product</h4>
      </div>
      <div class="modal-body">
      	<!-- <input type="hidden" id="caridata" oninput="loadGridData1()" placeholder="Cari data product" value="" class="form-control" autofocus> -->        
		<table id="example3" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th class="sorting" tabindex='0' style="text-align:center; width:7%"> No</th>
                    <th class="sorting" tabindex='1' style="text-align:center; width:14%"> Kode Produk </th>
                    <th class="sorting" tabindex='2' style="text-align:center; width:12%"> Kode Material </th>
                    <th class="sorting" tabindex='3' style="text-align:center; width:35%"> Nama </th>
                    <th class="sorting" tabindex='4' style="text-align:center; width:8%"> Stock </th> 
                    <th class="sorting" tabindex='5' style="text-align:center; width:8%"> Order </th> 
                    <th class="sorting" tabindex='6' style="text-align:center; width:8%"> Packing </th> 
                    <th class="hidden" tabindex='7' style="text-align:center; width:9%"> Qty </th>
                    <th class="hidden" tabindex='8' style="text-align:center; width:9%"> Qty </th>
                    <th class="hidden" tabindex='9' style="text-align:center; width:9%"> Qty </th>                    
                    <th class="sorting" tabindex='10' style="text-align:center; width:8%"> Action </th>
                </tr>
            </thead>
            <tbody id="tableGridData">                   
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
                    <th class="sorting" tabindex='4' style="text-align:center; width:13%"> Terbeli </th>
                    <th class="sorting" tabindex='5' style="text-align:center; width:14%"> Kebutuhan </th> 
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

<script type="text/javascript">
$(document).ready(function(){
		
		//loadGridDataLiquid();
		var tglreg = "<?php echo date("d-m-Y", strtotime($pack->packing_date))?>";
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
	    	$('#example3').dataTable().fnDestroy();
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
	    	loadGridData(); 

	    	//document.getElementById("caridata").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	
	    });

	    $('#btnCariLiquid').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalLiquid').attr('class', 'modal show'); 
	    	
	    });

	    $('#btnCariRekanan').click(function(e)

	    {

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
		var idso = $('#id_sales').val();		 
        ajaxDataGrid('<?php echo base_url()?>production/addpacking', {idx : produk_id, ids : idso}, 'tableGridData');
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
        ajaxDataGrid('<?php echo base_url()?>suport/addTableSo_Liquid', {idx : produk_id, ids : idso}, 'tableGridDataLiquid');
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
        ajaxDataGrid('<?php echo base_url()?>raw/addTableSo_det1', {idx : produk_id, ids : idso}, 'tableGridData');
             
    }

function loadGridDataSO(){ 
		var produk_id = $('#caridatasales').val();  
        ajaxDataGrid('<?php echo base_url()?>gudang/addTableSales', {idx : produk_id}, 'tableGridDataSales');       
    }	



function addRekanan(idx, nama, code, phone, address)
	{ 
		var name = nama.replace(/_/ig, ' ');
		var telp = phone.replace(/_/ig, ' ');
	 	$('#vendor').val(name);
	 	$('#id_rekanan').val(idx);
	 	$('#myModalRekanan').attr('class', 'modal hide');
	 	$('#nomor').val(code);
	 	$('#phone').val(telp);
	 	$('#address').val(address); 
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	return false;	
	  	sendRequestForm('admin/insertDetailSo', {IDSo : so_id, IDproduct : idx, price : nama}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/editso', {IDBidang : so_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

function addProduct(objReference, idx)
	{ 
		if(idx == 0){
			alert('tidak ada stock untuk di packing !');
			return false;
		}
	 	var Id 		= $(objReference).parent().parent().find('td:eq(0)').html();
		var kode 	= $(objReference).parent().parent().find('td:eq(1)').html();
		var name 	= $(objReference).parent().parent().find('td:eq(3)').html();
		var stock 	= $(objReference).parent().parent().find('td:eq(4)').html();
		var qty 	= $(objReference).parent().parent().find('td:eq(5)').html();
		var datang 	= $(objReference).parent().parent().find('td:eq(6)').html();
		var price 	= $(objReference).parent().parent().find('td:eq(7)').html();
		var IDproduct 	= $(objReference).parent().parent().find('td:eq(8)').html();
		var count 	= $(objReference).parent().parent().find('td:eq(9)').html();
		
	 	//return false;	
	  	console.log($("#tabelContent tr").length);
		//return false;
		var idbutton = "delete-button-"+$("#tabelContent tr").length;
			lengths = $("#tabelContent tr").length;
			harga = price.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			num = lengths +1;
			max = 0;
			//name = nama.replace(/_/g, " ");
		if(stock <= qty){
			max = stock;
		} else {
			max = qty;
		}
			
			var row  = "<tr id='tmbinput-"+lengths+"'>";
				row += "<td>"+num+"<input type='hidden' value='"+Id+"' name='id_material[]'/><input type='hidden' value='"+IDproduct+"' name='id_product[]'/></td>";				
				row += "<td><input type='text' readonly value='"+kode+"' style='text-align:left;' class='form-control'/></td>";
				row += "<td><input type='text' readonly value='"+name+"' style='text-align:left;' id='nmproduct-"+lengths+"'class='form-control'/></td>";
				row += "<td><input type='text' readonly value='"+stock+"' class='form-control'/></td><input type='hidden' value='"+price+"' name='nominal[]''/>";
				row += "<td><input type='number' readonly value='"+datang+"' class='form-control autocomplate'/></td>";
				row += "<td><input type='number' min='1' max='"+qty+"' value='"+qty+"' name='qty[]' id='qty-"+lengths+"' class='form-control autocomplate'/></td>";				
				row += "<td><input type='text' name='desc[]' id='desc-"+lengths+"' class='form-control autocomplate'/></td>";
				row += "<td style='text-align:center;'><button type='button' onclick='deleterow("+lengths+")' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>";
				row += "</tr>";
				//$("#tabelContent").after(row);
		
		$("#tabelContent").append(row);
		//$('#example3').dataTable().fnDestroy();
		$('#hd'+count).prop('disabled', true);
		//$('#myModal').attr('class', 'modal hide'); 

	  	
	}

	function deleterow(obj)
	{
			
		isDelete = confirm("Apakah Yakin menghapus data ini ?");
			if(isDelete)
			{	
				$('#tmbinput-'+obj).remove();
			}
		//calculates();
		
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
		$('#example3').dataTable().fnDestroy();
		var name = nama.replace('FR', 'PCK');
	 	$('#Sales').val(nama);
	 	$('#nomor').val(name);
	 	$('#id_sales').val(idx);
	 	$('#myModalSales').attr('class', 'modal hide');
	 	loadGridData();
	 		  	
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

		var htmlOut = ajaxFillGridJSON('production/updatepacking', data);	    		
	   	//$('.content-wrapper').html(htmlOut);
	   	//return false;
		//sendRequestForm('admin/updateso', data, 'box-body');
		var kodeTipeKaryawan = ajaxFillGridJSON('production/packing', {IDBidang : idx}); 
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