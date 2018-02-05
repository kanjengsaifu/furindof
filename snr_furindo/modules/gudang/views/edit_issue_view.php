<?php $tgl = date("d-m-Y", strtotime($ISS->row()->issued_date)) ?>
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
	<h1>Tambah Issued Material</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(); return false;">
			<input type="hidden" id="soid" name="so_id" value="<?php echo $ISS->row()->issued_id ?>" required/>
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">NO ISSUED :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="<?php echo $ISS->row()->issued_code ?>" required/>
							</div>
						</div>
						<!-- <div class="form-group">
						  <label class="control-label col-sm-3">NO Reff :</label>
						  <div class="col-sm-8" id="col-kontak">
							<div class="input-group">
                                <input type="text" readonly  value="<?php echo $ISS->row()->sales_order_ref_no ?>" class="form-control" id="Sales" name="sales" >
                                <input type="hidden" id="id_sales" value="<?php echo $ISS->row()->sales_order_id ?>" name="id_sales" >
								<span class="input-group-btn">
					       			<button type="button" id="btnCariSO" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
					       		</span>
					       	</div>
						</div>	
					  </div>	 -->				
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Issued Date :</label>
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
								<textarea class="form-control" name="note"><?php echo $ISS->row()->issued_note ?></textarea>
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
								<th class="btn-primary" style="width:25%; text-align:center; vertical-align: middle;">Material Name</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">Stock</th>
								<th class="btn-primary" style="width:10%; text-align:center; vertical-align: middle;">QTY</th>
								<th class="btn-primary" style="width:10%; text-align:center; vertical-align: middle;">Divisi</th>
								<th class="btn-primary" style="width:10%; text-align:center; vertical-align: middle;">Reff No</th>
								<th class="btn-primary" style="width:23%; text-align:center; vertical-align: middle;">Description</th>
								<td style="width:4%; "><button type="button" id="btnCari" title="Tambah data" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
								<td style="width:4%; "><button type="button" id="btnCariLiquid" title="Tambah Liquid" class="btn btn-xs btn-info">LQ</button></td>
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
						<?php  
							$no = 0;							
							foreach ($ISS->result() as $row) {
							$inv = $this->db->query("SELECT sum(inventory_stock_qty) as stok_qty, inventory_jumlah_nominal from trx_inventory where material_id = '".$row->material_id."' AND inventory_categories = 'stock'")->row();	
							$stock = $inv->stok_qty + $row->issued_detail_qty;
							$pjg = $no+1;
						?>
							<input type='hidden' value='<?php echo $row->issued_detail_id ?>' name='iddetail[]'/>
							<tr id='tmbinput-<?php echo $no ?>'>
								<td><?php echo $pjg ?><input type='hidden' value='<?php echo $row->material_id ?>' name='id_material[]'/><input type='hidden' value='<?php echo $row->material_id ?>' name='id_product[]'/></td>				
								<td><input type='text' readonly value='<?php echo $row->material_name ?>' style='text-align:left;' id='nmproduct-<?php echo $no ?>'class='form-control'/></td>
								<td><input type='text' readonly value='<?php echo $stock ?>' class='form-control'/></td><input type='hidden' value='<?php echo $inv->inventory_jumlah_nominal ?>' name='nominal[]'/>
								<td><input type='number' min='' step='0.01' max='' value='<?php echo $row->issued_detail_qty ?>' name='qty[]' id='qty-<?php echo $no ?>' class='form-control autocomplate'/></td>
								<td><select name='categories[]' class='form-control'><option value=''>:: Pilih DIVISI ::</option>
								<?php 
									$divisi = $this->db->query("SELECT * from mst_divisi");
									foreach ($divisi->result() as $dev) {
										if($row->divisi_id == $dev->divisi_id){
											echo '<option selected=selected value="'.$dev->divisi_id.'">'.$dev->divisi_code.'</option>';
										} else {
											echo '<option value="'.$dev->divisi_id.'">'.$dev->divisi_code.'</option>';
										}
									}
								?>
								</select></td>
								<td><input type='button' value="<?php echo $row->sales_order_ref_no ?>" readonly id='reff-<?php echo $no ?>' onclick='CariSO(<?php echo $no ?>)' class='form-control'/></td><input type='hidden' value="<?php echo $row->sales_order_id ?>" name='reff[]' id='id_sales-<?php echo $no ?>'/>
								<td><input type='text' name='desc[]' value="<?php echo $row->issued_detail_note ?>" id='desc-<?php echo $no ?>' class='form-control autocomplate'/></td>
								<td style='text-align:center;'><button type='button' onclick='deleterow("<?php echo $row->issued_detail_id ?>","<?php echo $row->inventory_id ?>")' id='' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>
								<td colspan='1' style='text-align:center;'><button type='button' onclick='addinfo()' title='info data' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-info-sign'></span></button></td>
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
                    <th class="hidden" tabindex='4' style="text-align:center; width:13%"> Terbeli </th>
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

<div class="modal fade" id="myModalSales">
  <div class="modal-dialog">
    <div class="modal-content" style="width:750px">
      <div class="modal-header">
        <button type="button" class="close Sales" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Sales Order</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="caridatasales" oninput="loadGridDataSales()" placeholder="Cari data product" value="" class="form-control" autofocus>        
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
		loadGridData();
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
	    	$('#example5').dataTable().fnDestroy();
	    	$('#myModalSales').attr('class', 'modal hide'); 
	    });
		$('#btnCari').click(function(e)

	    {

			e.preventDefault();
			
	    	$('#alertMessage').remove();

	    	$('#myModal').attr('class', 'modal show');  

	    	document.getElementById("caridata").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	
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
        ajaxDataGrid('<?php echo base_url()?>gudang/addTableSo_Liquid', {idx : produk_id, ids : idso}, 'tableGridData');
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

function loadGridDataSO(ids){ 
		var produk_id = $('#caridatasales').val();  
        ajaxDataGrid('<?php echo base_url()?>gudang/addTableSales', {idx : produk_id, PO : ids}, 'tableGridDataSales'); 
        $('#example5').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": true,
          "bDestroy": true
        });       
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
		// if(idx == 0){
		// 	alert('qty material telah teralokasikan !');
		// 	return false;
		// }
	 	var Id 		= $(objReference).parent().parent().find('td:eq(0)').html();
		var kode 	= $(objReference).parent().parent().find('td:eq(1)').html();
		var name 	= $(objReference).parent().parent().find('td:eq(2)').html();
		var qty 	= $(objReference).parent().parent().find('td:eq(3)').html();
		var price 	= $(objReference).parent().parent().find('td:eq(4)').html();
		var IDproduct 	= $(objReference).parent().parent().find('td:eq(5)').html();
		var count 	= $(objReference).parent().parent().find('td:eq(8)').html();
		
	 	//return false;	
	  	//console.log($("#tabelContent tr").length);
		//return false;
		var idbutton = "delete-button-"+$("#tabelContent tr").length;
			lengths = $("#tabelContent tr").length;
			harga = price.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			num = lengths +1;
			//name = nama.replace(/_/g, " ");
			
			var row  = "<tr id='tmbinput-"+lengths+"'>";
				row += "<td>"+num+"<input type='hidden' value='"+Id+"' name='id_material[]'/><input type='hidden' value='0' name='iddetail[]'/></td>";				
				row += "<td><input type='text' readonly value='"+name+"' style='text-align:left;' id='nmproduct-"+lengths+"'class='form-control'/></td>";
				row += "<td><input type='text' readonly value='"+qty+"' class='form-control' required/></td><input type='hidden' value='"+price+"' name='nominal[]'/>";
				row += "<td><input type='number' min='' step='0.01' max='' value='' name='qty[]' id='qty-"+lengths+"' class='form-control' required/></td>";
				row += "<td><select name='categories[]' class='form-control'><option value=''>:: Pilih DIVISI ::</option>";
				row += "<option value='1'>JOK</option><option value='2'>GLZ</option><option value='3'>WHT</option><option value='4'>GRY</option>";
				row += "<option value='6'>PCK</option><option value='7'>COM</option><option value='8'>WJO</option><option value='9'>ASY</option><option value='10'>VEN</option><option value='11'>ACC</option></select></td>";
				row += "<td><input type='button' readonly id='reff-"+lengths+"' onclick='CariSO("+lengths+")' class='form-control'/><input type='hidden' name='reff[]' id='id_sales-"+lengths+"'/></td>";
				row += "<td><input type='text' name='desc[]' id='desc-"+lengths+"' class='form-control'/></td>";
				row += "<td style='text-align:center;'><button type='button' onclick='deleterow("+lengths+")' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>";
				row += "<td colspan='1' style='text-align:center;'><button type='button' onclick='addinfo("+Id+","+IDproduct+")' title='info data' class='btn btn-xs btn-primary'><span class='glyphicon glyphicon-info-sign'></span></button></td>";
				row += "</tr>";
				//$("#tabelContent").after(row);
		
		$("#tabelContent").append(row);
		//$('#example3').dataTable().fnDestroy();
		$('#hd'+count).prop('disabled', true);
		//$('#myModal').attr('class', 'modal hide'); 

	  	
	}

	function deleterow(obj, inv)
	{		
		var idv = $('#soid').val();
		//alert(idpo);
		//return false;
		isDelete = confirm('Yakin data akan dihapus ?');
	  	if (isDelete) sendRequestForm('gudang/habusdataissued', {ID : obj, IDV : inv}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('gudang/edit_issue', {IDBidang : idv});	    		
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

function addSales(idx, nama, ids)
	{ 
		var name = nama.replace('FR', 'FR');
	 	//$('#Sales').val(nama);
	 	$('#reff-'+ids).val(nama);
	 	$('#id_sales-'+ids).val(idx);
	 	$('#example5').dataTable().fnDestroy();
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

		var htmlOut = ajaxFillGridJSON('gudang/updateIssued', data);	    		
	   	//$('.content-wrapper').html(htmlOut);
	   	//return false;
		//sendRequestForm('admin/updateso', data, 'box-body');
		var kodeTipeKaryawan = ajaxFillGridJSON('gudang/issued', {IDBidang : idx}); 
		alert("Data berhasil disimpan.");
		$('.content-wrapper').html(kodeTipeKaryawan);
		
	}

	
	function CariSO(idx)
	{ 
		$('#myModalSales').attr('class', 'modal show');  

	    document.getElementById("caridatasales").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    loadGridDataSO(idx);
	 		  	
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