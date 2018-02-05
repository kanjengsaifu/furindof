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
	<h1>Tambah Shipment</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(); return false;">
			<input type="hidden" id="soid" name="so_id" value="" required/>
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">NO Shipment :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="" required/>
							</div>
						</div>
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Shipment Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="" role="date" class="form-control date" id="tglreg" name="tglreg" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Shipment Loading :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="" role="date" class="form-control date" id="loading" name="loading" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Currency :</label>
							<div class="col-sm-8">
								<div class="input-group">
                                    <input type="text" value="" role="date" class="form-control" id="Currency" name="Currency" >
                                    <span class="input-group-addon">&nbsp;$&nbsp;</span> 
                                  </div>
							</div>
						</div>						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Note :</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="note"></textarea>
							</div>
						</div>
						
					</div>

					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Container Code :</label>
							<div class="col-sm-8">
								<input class="form-control" id="Container" name="Container" value="" required/>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Driver :</label>
							<div class="col-sm-8">
								<input class="form-control" id="Driver" name="Driver" value="" required/>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Truck Code :</label>
							<div class="col-sm-8">
								<input class="form-control" id="Truck" name="Truck" value="" required/>
							</div>
						</div>
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Seal Code :</label>
							<div class="col-sm-8">
								<input class="form-control" id="Seal" name="Seal" value="" required/>
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
								<th class="btn-primary" style="width:14%; text-align:center; vertical-align: middle;">Code</th>								
								<th class="btn-primary" style="width:27%; text-align:center; vertical-align: middle;">Product Name</th>
								<th class="btn-primary" style="width:6%; text-align:center; vertical-align: middle;">CBM</th>
								<th class="btn-primary" style="width:6%; text-align:center; vertical-align: middle;">Weight</th>								
								<th class="btn-primary" style="width:11%; text-align:center; vertical-align: middle;">Price</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">QTY</th>
								<th class="btn-primary" style="width:6%; text-align:center; vertical-align: middle;">Volume</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">TTL (KG)</th>
								<th class="btn-primary" style="width:12%; text-align:center; vertical-align: middle;">TTL Price</th>
								<td style="width:4%; "><button type="button" id="btnCari" title="Tambah data" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></button></td>								
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
														
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
    <div class="modal-content" style="width:800px">
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
                    <th class="sorting" tabindex='1' style="text-align:center; width:10%"> SO REFF </th>
                    <th class="sorting" tabindex='2' style="text-align:center; width:12%"> Kode </th>
                    <th class="sorting" tabindex='3' style="text-align:center; width:43%"> Nama </th>
                    <th class="sorting" tabindex='4' style="text-align:center; width:13%"> Sisa Order </th>
                    <th class="sorting" tabindex='5' style="text-align:center; width:13%"> Tersedia </th>
                    <th class="sorting" tabindex='6' style="text-align:center; width:14%"> Terjual </th> 
                    <th class="hidden" tabindex='7' style="text-align:center; width:10%"> Qty </th>
                    <th class="hidden" tabindex='8' style="text-align:center; width:10%"> Qty </th> 
                    <th class="hidden" tabindex='9' style="text-align:center; width:10%"> Qty </th> 
                    <th class="hidden" tabindex='10' style="text-align:center; width:10%"> Qty </th> 
                    <th class="hidden" tabindex='11' style="text-align:center; width:10%"> Qty </th> 
                    <th class="hidden" tabindex='12' style="text-align:center; width:10%"> Qty </th> 
                    <th class="hidden" tabindex='13' style="text-align:center; width:10%"> Qty </th> 
                    <th class="sorting" tabindex='14' style="text-align:center; width:10%"> Action </th>
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
		loadGridData();
		var tglreg = "<?php echo date("d-m-Y")?>";
		$("#tglreg").val(tglreg);
		$("#loading").val(tglreg);		

		$(".date").datepicker({
			format : "dd-mm-yyyy",
			//startDate : new Date('<?php echo date('Y-m-d', strtotime("-".$_SESSION['Akses']." days"))?>'),
		    //endDate : new Date('<?php echo date('Y-m-d', strtotime("+90 days"))?>'),
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
        ajaxDataGrid('<?php echo base_url()?>production/addTablematerial', '', 'tableGridData');
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
		
	 	var Id 		= $(objReference).parent().parent().find('td:eq(0)').html();
		var kode 	= $(objReference).parent().parent().find('td:eq(2)').html();
		var name 	= $(objReference).parent().parent().find('td:eq(3)').html();
		var qty 	= $(objReference).parent().parent().find('td:eq(5)').html();
		var price 	= $(objReference).parent().parent().find('td:eq(7)').html();
		var IDproduct 	= $(objReference).parent().parent().find('td:eq(8)').html();
		var cmb 	= $(objReference).parent().parent().find('td:eq(9)').html();
		var kg 	= $(objReference).parent().parent().find('td:eq(10)').html();
		var bdl 	= $(objReference).parent().parent().find('td:eq(11)').html();
		var count 	= $(objReference).parent().parent().find('td:eq(12)').html();
		var pack 	= $(objReference).parent().parent().find('td:eq(12)').html();
		if(qty <= 0){
			alert('Belum ada product di packing !');
			return false;
		}
	 	//return false;	
	  	//console.log($("#tabelContent tr").length);
		//return false;
		var idbutton = "delete-button-"+$("#tabelContent tr").length;
			lengths = $("#tabelContent tr").length;
			harga = price.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			num = lengths +1;
			volume = cmb * qty;
			wg = kg *qty;
			ph = harga * qty;
			//name = nama.replace(/_/g, " ");
			
			var row  = "<tr id='tmbinput-"+lengths+"'>";
				row += "<td>"+num+"<input type='hidden' value='"+Id+"' name='id_material[]'/><input type='hidden' value='"+IDproduct+"' name='id_product[]'/></td>";
				row += "<td><input type='text' readonly value='"+kode+"' style='text-align:left;' id='codeproduct-"+lengths+"'class='form-control'/></td>";				
				row += "<td><input type='text' readonly value='"+name+"' style='text-align:left;' id='nmproduct-"+lengths+"'class='form-control'/></td>";
				row += "<td><input type='text' readonly value='"+cmb+"' style='text-align:left;' name='cmb[]' id=cmbproduct-"+lengths+" class='form-control'/></td>";
				row += "<td><input type='text' readonly value='"+kg+"' style='text-align:left;' name='kg[]' id='kgproduct-"+lengths+"'class='form-control'/></td>";
				row += "<td><input type='text' readonly value='"+harga+"' style='text-align:left;' name='price[]' id='prproduct-"+lengths+"'class='form-control'/></td>";
				row += "<td><input type='text' min='1' max='' value='"+qty+"' name='qty[]' class='form-control'/></td><input type='hidden' value='"+bdl+"' name='bdl[]'/>";
				row += "<td><input type='text' readonly value='"+volume+"' name='volume[]' class='form-control'/></td>";
				row += "<td><input type='text' readonly value='"+wg+"' name='weight[]' class='form-control'/></td>";
				row += "<td><input type='text' readonly value='"+ph+"' name='usd[]' class='form-control'/></td><input type='hidden' value='"+pack+"' name='pack[]' class='form-control'/>";
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
		var name = nama.replace('FR', 'ISS');
	 	$('#Sales').val(nama);
	 	$('#nomor').val(name);
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

		var htmlOut = ajaxFillGridJSON('production/saveShipment', data);	    		
	   	//$('.content-wrapper').html(htmlOut);
	   	//return false;
		//sendRequestForm('admin/updateso', data, 'box-body');
		var kodeTipeKaryawan = ajaxFillGridJSON('production/shipment'); 
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