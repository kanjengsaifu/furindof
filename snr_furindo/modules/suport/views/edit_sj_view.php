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
	<h1>Tambah Surat Jalan</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(); return false;">
			<input type="hidden" id="soid" name="so_id" value="<?php echo $pjr->surat_jalan_id; ?>" required/>
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">NO Surat Jalan :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="<?php echo $pjr->surat_jalan_code; ?>" required/>
							</div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-3">Vendor:</label>
						  <div class="col-sm-8" id="col-kontak">
							<div class="input-group">
                                <input type="text" readonly  value="<?php echo $pjr->provider_name; ?>" class="form-control" id="vendor" >
                                <input type="hidden" id="id_rekanan" value="<?php echo $pjr->provider_id; ?>" name="id_rekanan" >
								<span class="input-group-btn">
					       			<button type="button" id="btnCariRekanan" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
					       		</span>
					       	</div>
						</div>	
					  </div>

					  <div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Dikirim Dari :</label>
							<div class="col-sm-8">
								<input class="form-control" id="" name="kirim" value="CV. SNR" required/>
							</div>
						</div>					
												
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Surat Jalan Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="<?php echo date("d-m-Y", strtotime($pjr->surat_jalan_date)); ?>" role="date" class="form-control date" id="tglreg" name="tglreg" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
					</div>

					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Diangkut melalui :</label>
							<div class="col-sm-8">
								<input class="form-control" id="" name="kendaraan" value="<?php echo $pjr->surat_jalan_diangkut_melalui; ?>" required/>
							</div>
						</div>

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Nomor Kendaraan :</label>
							<div class="col-sm-8">
								<input class="form-control" id="" name="napol" value="<?php echo $pjr->surat_jalan_nomor_kendaraan; ?>" required/>
							</div>
						</div>

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Note :</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="note"></textarea>
							</div>
						</div>						
					</div>
				</div>
			</div>
			
			<div class="seperator">
			
			<div class="header1">
				<h4>RINCIAN PENGIRIMAN BARANG</h4>
			</div>			
				<div class="table-responsive" style="width:99%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th class="btn-primary" style="width:5%; text-align:center; vertical-align: middle;">No</th>
								<th class="btn-primary" style="width:14%; text-align:center; vertical-align: middle;">Code</th>
								<th class="btn-primary" style="width:29%; text-align:center; vertical-align: middle;">Material Name</th>
								<th class="btn-primary" style="width:8%; text-align:center; vertical-align: middle;">Kebutuhan</th>
								<th class="btn-primary" style="width:10%; text-align:center; vertical-align: middle;">QTY</th>
								<th class="btn-primary" style="width:34%; text-align:center; vertical-align: middle;">Description</th>
								<td style="width:8%; "><button type="button" id="btnCari" title="Tambah data" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
						<?php 
						$no=0;
						foreach ($detail->result() as $row) {
						?>
							<tr id='tmbinput-<?php echo $no; ?>'><input type='hidden' value='<?php echo $row->surat_jalan_detail_id; ?>' name='iddetail[]'/>
								<td><?php echo $no+1; ?><input type='hidden' value='<?php echo $row->material_id; ?>' name='id_material[]'/><input type='hidden' value='' name='id_product[]'/></td>
								<td><input type='text' readonly='readonly' value='<?php echo $row->material_code; ?>' id='uraian-<?php echo $no; ?>' class='form-control'/></td>
								<td><input type='text' readonly value='<?php echo $row->material_name; ?>' style='text-align:left;' id='nmproduct-<?php echo $no; ?>'class='form-control'/></td>
								<td><input type='text' readonly value='<?php echo $row->surat_jalan_detail_qty; ?>' class='form-control'/></td><input type='hidden' value='<?php echo $row->material_price; ?>' name='nominal[]'/>
								<td><input type='number' min='1' max='' value='<?php echo $row->surat_jalan_detail_qty; ?>' name='qty[]' id='qty-<?php echo $no; ?>' class='form-control autocomplate'/></td>
								<td><input type='text' name='desc[]' value='<?php echo $row->surat_jalan_detail_note; ?>' id='desc-<?php echo $no; ?>' class='form-control autocomplate'/></td>
								<td style='text-align:center;'><button type='button' onclick='deletedata(<?php echo $row->surat_jalan_detail_id; ?>)' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>
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
                    <th class="sorting" tabindex='3' style="text-align:center; width:14%"> Kebutuhan </th>                    
                    <th class="sorting" tabindex='4' style="text-align:center; width:10%"> Terkirim </th> 
                    <th class="hidden" tabindex='5' style="text-align:center; width:10%"> Qty </th>
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

<div class="modal fade" id="myModalRekanan">
  <div class="modal-dialog">
    <div class="modal-content" style="width:760px">
      <div class="modal-header">
        <button type="button" class="close Rekanan" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Vendor</h4>
      </div>
      <div class="modal-body">
      	<!-- <input type="text" id="caridatarekanan" oninput="loadGridDataRekanan1()" placeholder="Cari data product" value="" class="form-control" autofocus>  -->       
		<table id="example4" class="table table-bordered table-striped">
            <thead style="">
                <tr>            
                    <th style="text-align:center; width:7%"> No</th>
                    <th style="text-align:center; width:13%"> REFF NO </th>
                    <th style="text-align:center; width:15%"> PO </th>
                    <th style="text-align:center; width:15%"> Kode </th>
                    <th style="text-align:center; width:30%"> Nama </th>
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

<script type="text/javascript">
$(document).ready(function(){
		var tglreg = "<?php echo date("d-m-Y")?>";
		//loadGridDataRekanan();
		loadGridData();
		//$("#tglreg").val(tglreg);
		//$("#tglship").val(tglreg);		

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
	    $('.Rekanan').click(function(e)
	    {
	    	
	    	//$('#example4').dataTable().fnDestroy();		
	    	
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

	    $('#btnCariRekanan').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalRekanan').attr('class', 'modal show');  

	    	//document.getElementById("caridatarekanan").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	//loadGridDataRekanan();
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
		//var produk_id = $('#caridata').val();
		var idso = $('#id_rekanan').val();		 
        ajaxDataGrid('<?php echo base_url()?>suport/addTableProduct', {idx : idso}, 'tableGridData');
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

function loadGridDataRekanan(){ 
		var produk_id = $('#caridatarekanan').val();

        ajaxDataGrid('<?php echo base_url()?>suport/addTableRekanan2', {idx : produk_id}, 'tableGridDataRekanan'); 
        $('#example4').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false,
          "bDestroy": true
        });       
    }	



function addRekanan(idx, nama, code)
	{ 
		var name = nama.replace(/_/ig, ' ');
		//var telp = phone.replace(/_/ig, ' ');
	 	$('#vendor').val(name);
	 	$('#id_rekanan').val(idx);
	 	$('#myModalRekanan').attr('class', 'modal hide');
	 	//$('#nomor').val(code);
	 	//$('#phone').val(telp);
	 	//$('#address').val(address); 
	 	//alert(produk_id);
	 	//$('.content-wrapper').html(produk_id);
	 	loadGridData();
	 	return false;	
	  	sendRequestForm('admin/insertDetailSo', {IDSo : so_id, IDproduct : idx, price : nama}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('admin/editso', {IDBidang : so_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

function addProduct(objReference)
	{ 
		// if(idx == 0){
		// 	alert('qty material telah teralokasikan !');
		// 	return false;
		// }
	 	var Id 		= $(objReference).parent().parent().find('td:eq(0)').html();
		var kode 	= $(objReference).parent().parent().find('td:eq(1)').html();
		var name 	= $(objReference).parent().parent().find('td:eq(2)').html();
		var qty 	= $(objReference).parent().parent().find('td:eq(3)').html();
		var kirim 	= $(objReference).parent().parent().find('td:eq(4)').html();
		var IDproduct 	= $(objReference).parent().parent().find('td:eq(5)').html();
		var price 	= $(objReference).parent().parent().find('td:eq(6)').html();
		var po 	= $(objReference).parent().parent().find('td:eq(7)').html();
		var count 	= $(objReference).parent().parent().find('td:eq(8)').html();
	 	//return false;	
	  	//console.log($("#tabelContent tr").length);
		//return false;
		var idbutton = "delete-button-"+$("#tabelContent tr").length;
			lengths = $("#tabelContent tr").length;
			//harga = price.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			num = lengths +1;
			//name = nama.replace(/_/g, " ");
			
			var row  = "<input type='hidden' value='0' name='iddetail[]'/>";
				row  = "<tr id='tmbinput-"+lengths+"'><input type='hidden' value='"+po+"' name='purchase[]''/>";
				row += "<td>"+num+"<input type='hidden' value='"+Id+"' name='id_material[]'/><input type='hidden' value='"+IDproduct+"' name='id_product[]'/></td>";
				row += "<td><input type='text' readonly='readonly' value='"+kode+"' id='uraian-"+lengths+"' class='form-control'/></td>";
				row += "<td><input type='text' readonly value='"+name+"' style='text-align:left;' id='nmproduct-"+lengths+"'class='form-control'/></td>";
				row += "<td><input type='text' readonly value='"+qty+"' class='form-control'/></td><input type='hidden' value='"+price+"' name='nominal[]''/>";
				row += "<td><input type='number' min='1' max='"+qty+"' value='' name='qty[]' id='qty-"+lengths+"' class='form-control autocomplate'/></td>";
				row += "<td><input type='text' name='desc[]' id='desc-"+lengths+"' class='form-control autocomplate'/></td>";
				row += "<td style='text-align:center;'><button type='button' onclick='deleterow("+lengths+")' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>";
				row += "</tr>";
				//$("#tabelContent").after(row);
		
		$("#tabelContent").append(row);
		$('#hd'+count).prop('disabled', true);
		//$('#example3').dataTable().fnDestroy();
		$('#myModal').attr('class', 'modal hide'); 

	  	
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
	  	if (isDelete) sendRequestForm('suport/habusdataSJ', {ID : idx}, 'box-body');
	  	var htmlOut = ajaxFillGridJSON('suport/edit_sj', {IDBidang : produk_id});	    		
	   	$('.content-wrapper').html(htmlOut);
	}

function simpanreg()
	{
		var idx = $('#soid').val();
			data = $("#addkso").serialize();

		var htmlOut = ajaxFillGridJSON('suport/saveSuratJalan', data);	    		
	   	//$('.content-wrapper').html(htmlOut);
	   	//return false;
		//sendRequestForm('admin/updateso', data, 'box-body');
		var kodeTipeKaryawan = ajaxFillGridJSON('suport/surat_jalan', {IDBidang : idx}); 
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