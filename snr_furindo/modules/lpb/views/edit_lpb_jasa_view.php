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
	<h1>Edit LPB Jasa</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkso" onsubmit="simpanreg(); return false;">
			<input type="hidden" id="soid" name="lpb_id" value="<?php echo $LPB->lpb_id; ?>" required/>
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">NO Invoice :</label>
							<div class="col-sm-8">
								<input class="form-control" id="nomor" name="nomor" value="<?php echo $LPB->lpb_code; ?>" required/>
							</div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-3">Kode Shipment:</label>
						  <div class="col-sm-8" id="col-kontak">
							<div class="input-group">
                                <input type="text" readonly  value="<?php echo $LPB->shipment_code ?>" class="form-control" id="Sales" name="sales" >
                                <input type="hidden" id="id_sales" value="<?php echo $LPB->shipment_id ?>" name="id_sales" >
								<span class="input-group-btn">
					       			<button type="button" id="btnCariSO" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
					       		</span>
					       	</div>
						</div>	
					  </div>					
						

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">LPB Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="<?php echo date("d-m-Y", strtotime($LPB->lpb_date)); ?>" role="date" class="form-control date" id="tgllpb" name="tgllpb" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Nota Date :</label>
							<div class="col-sm-8">
								<div class="input-group date">
                                    <input type="text" readonly value="<?php echo date("d-m-Y", strtotime($LPB->nota_date)); ?>" role="date" class="form-control date" id="tglreg" name="tglreg" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                                  </div>
							</div>
						</div>
						
					</div>

					<div class="col-sm-6">						
						<!--<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Nama Toko :</label>
							<div class="col-sm-8">
								<input type="text" value="<?php echo $LPB->toko; ?>" name="toko" class="form-control" id="toko" >								
							</div>
						</div>-->
						<div class="form-group">
						<label for="kegiatan" class="col-sm-3 control-label">Jasa Vendor :</label>
							<div class="col-sm-8" id="col-kontak">
								<div class="input-group">
                                    <input type="text" readonly value="<?php echo $LPB->provider_name; ?>" class="form-control" id="vendor" name="vendor" >
                                    <input type="hidden" id="id_rekanan" value="<?php echo $LPB->provider_id ?>" name="id_customer" >
                                   
									<span class="input-group-btn">
						       			<button type="button" id="btnCariRekanan" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
						       		</span>
						       	</div>
							</div>							
						</div>

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label"></label>
							<div class="col-sm-8">
								<div class="input-group">
                                    <input oninput='getnumericid(this)' onblur='calculates()' type="hidden" value="0" name="biaya" class="form-control" id="biaya" >
                                  </div>
							</div>
						</div>
						
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Nomor Nota :</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="note"><?php echo $LPB->lpb_nota; ?></textarea>
							</div>
						</div>
					</div>
						
					
				</div>
			</div>
			
			<div class="seperator">
			
			<div class="header1">
				<h4>RINCIAN INVOICE</h4>
			</div>			
				<div class="table-responsive" style="width:99%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th class="btn-primary" style="width:4%; text-align:center; vertical-align: middle;">No</th>
								<th class="btn-primary" style="width:30%; text-align:center; vertical-align: middle;">Material Name</th>
								<th class="btn-primary" style="width:18%; text-align:center; vertical-align: middle;">Price</th>
								<th class="btn-primary" style="width:14%; text-align:center; vertical-align: middle;">Qty</th>
								<th class="btn-primary" style="width:36%; text-align:center; vertical-align: middle;">Description</th>
								<td style="width:8%; "><button type="button" onclick="addProduct()" title="Tambah by SO" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">
						<?php
							$no=0; 
							foreach ($LPBDet->result() as $row) {
							$ttl = $row->lpb_detail_qty*$row->lpb_detail_price;								
						?>
						<tr id='tmbinput-<?php echo $no; ?>'><input type='hidden' value='<?php echo $row->lpb_detail_id ?>' name='iddetail[]'/>
						<td><?php $no1 = $no+1; echo $no1 ?><input type='hidden' value='<?php echo $ttl ?>' id='ttl-<?php echo $no; ?>' name='ttl_harga[]'/></td>
						<td><input type='text' value='<?php echo $row->material_name ?>' name='material[]' style='text-align:left;' id='nmproduct-<?php echo $no; ?>'class='form-control'/></td>
						<td><input type='text' value='<?php echo $row->lpb_detail_price ?>' name='nominal[]' id='nominal-<?php echo $no; ?>' atm='nominal-<?php echo $no; ?>' onblur='calculates()' oninput='getnumeric(this)' class='form-control'/></td>
						<td><input type='number' min='1' step='0.01' value='<?php echo $row->lpb_detail_qty ?>' name='qty[]' id='qty-<?php echo $no; ?>' oninput='getnumeric(this)' atm='nominal-<?php echo $no; ?>' class='form-control autocomplate'/></td>
						<td><input type='text' value='<?php echo $row->lpb_detail_desc ?>' name='desc[]' id='desc-<?php echo $no; ?>' class='form-control autocomplate'/></td>
						<td style='text-align:center;'><button type='button' onclick='deleterow(<?php echo $no; ?>)' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>
						</tr>
						<?php $no++; } ?>								
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
									<input style="font-size:24px; color:blue; backgraound-color:green;" class="form-control" readonly id="total" name="total" value=""/>
								</div>
							</div>
						</div>
					</div>
				</div>	

				
		
			<div class="form-horizontal footer">
				<div class="row" id="addcol">
					<div class="col-sm-6">
						&nbsp;&nbsp;<button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Simpan Data</button>						
					</div>
				</div>				
			</div>		
		</div>
		</form>
	</div>
</div>
</div>
<div class="modal fade" id="myModalSales">
  <div class="modal-dialog">
    <div class="modal-content">
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
    </div>
  </div>
</div>
<div class="modal fade" id="myModalRekanan">
  <div class="modal-dialog">
    <div class="modal-content" style="width:760px">
      <div class="modal-header">
        <button type="button" class="close Rekanan" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Vendor</h4>
      </div>
      <div class="modal-body">
      	<input type="hidden" id="caridatarekanan" oninput="loadGridDataRekanan1()" placeholder="Cari data product" value="" class="form-control" autofocus>        
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
            <tbody id="tableGridDataRekananJasa">                   
            </tbody>
        </table>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->  
</div><!-- /.modal -->

<script type="text/javascript">
$(document).ready(function(){
		calculates();
		loadGridDataSO();	
		loadGridDataRekananJasa();
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

	    	document.getElementById("caridata").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	
	    });

	    $('#btnCariRekanan').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalRekanan').attr('class', 'modal show');  

	    	document.getElementById("caridatarekanan").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	    	
	    });

	    $('#btnCariSO').click(function(e)

	    {

			e.preventDefault(); 		

	    	$('#alertMessage').remove();

	    	$('#myModalSales').attr('class', 'modal show');  

	    	document.getElementById("caridatasales").focus();
	    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
	   
	    });
	});

function addProduct()
	{ 
		
	 	var idbutton = "delete-button-"+$("#tabelContent tr").length;
			lengths = $("#tabelContent tr").length;
			num = lengths +1;
			kbt = 0;
			//console.log(kbt);
			//stock = 0;
			//beli = 0;
			//name = nama.replace(/_/g, " ");
			
			var row = "<tr id='tmbinput-"+lengths+"'><input type='hidden' value='0' name='iddetail[]'/>";
				row += "<td>"+num+"<input type='hidden' value='"+kbt+"' id='ttl-"+lengths+"' name='ttl_harga[]'/></td>";
				row += "<td><input type='text' value='' name='material[]' style='text-align:left;' id='nmproduct-"+lengths+"'class='form-control'/></td>";
				row += "<td><input type='text' value='' name='nominal[]' id='nominal-"+lengths+"' atm='nominal-"+lengths+"' onblur='calculates()' oninput='getnumeric(this)' class='form-control'/></td>";
				row += "<td><input type='number' min='1' step='0.01' value='0' name='qty[]' id='qty-"+lengths+"' oninput='getnumeric(this)' atm='nominal-"+lengths+"' class='form-control autocomplate'/></td>";
				row += "<td><input type='text' name='desc[]' id='desc-"+lengths+"' class='form-control autocomplate'/></td>";
				row += "<td style='text-align:center;'><button type='button' onclick='deleterow("+lengths+")' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>";
				row += "</tr>";
				//$("#tabelContent").after(row);
		
		$("#tabelContent").append(row);
		calculates();

	  	
	}
	function loadGridDataRekananJasa(){ 
		var produk_id = $('#caridatarekanan').val();

        ajaxDataGrid('<?php echo base_url()?>lpb/addTableRekananJasa', {idx : produk_id}, 'tableGridDataRekananJasa'); 
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

	function addSales(idx, nama)
	{ 
	 	$('#Sales').val(nama);
	 	$('#id_sales').val(idx);
	 	$('#myModalSales').attr('class', 'modal hide'); 
	 	loadGridData();
	 	loadGridDataLiquid();
	 		  	
	}
	

	function deleterow(obj)
	{
			
		isDelete = confirm("Apakah Yakin menghapus data ini ?");
			if(isDelete)
			{	
				$('#tmbinput-'+obj).remove();
			}
		calculates();
		
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
	function loadGridDataSO(){ 
		var produk_id = $('#caridatasales').val();  
        ajaxDataGrid('<?php echo base_url()?>suport/addTableSales', {idx : produk_id}, 'tableGridDataSales'); 
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


function simpanreg()
	{
		var idx = $('#soid').val();
			data = $("#addkso").serialize();

		var htmlOut = ajaxFillGridJSON('lpb/updateLPBJasa', data);	    		
	   	//$('.content-wrapper').html(htmlOut);
	   	//return false;
		//sendRequestForm('admin/updateso', data, 'box-body');
		var kodeTipeKaryawan = ajaxFillGridJSON('lpb/lpb_jasa', {IDBidang : idx}); 
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

function getnomor(param)
	{
		
		getNum = param.split("/");
		Nums = parseInt(getNum[0]);
		Num  = eval(Nums) + 1;
		
		
		if(Num <= 9)
		{
			code = "000"+Num+"/"+getNum[1]+"/"+getNum[2];
		}
		else if(Num > 9 && Num <= 99)
		{
			code = "00"+Num+"/"+getNum[1]+"/"+getNum[2];
		}
		else if(Num > 99 && Num <= 999)
		{
			code = "0"+Num+"/"+getNum[1]+"/"+getNum[2];
		}
		else
		{
			code = Num+"/"+getNum[1]+"/"+getNum[2];
		}
		$("#nomor").val(code);
		return code;
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