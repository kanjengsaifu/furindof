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
	<h1>Detail Hutang / Deposit</h1>
</section>
<div class="content">       
	
	<div class="box box-primary">		
		  	<div class="box-body">
		  		<div class="box-header">
							
				</div>
		  		<div class="form-control" style="min-height:645px;">
					<div id="ajaxTreeGridDetail"></div>
				</div>
			</div>
		</div>


<div class="modal hide" id="dialogFormBaru" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">
	 <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="FormTambahData">Bayar Hutang</h4>
	      </div>
	      <form id="formBaru" class="form-horizontal" onsubmit="simpanreg(); return false;">
	      <div class="modal-body">
	      	<div class="pesanBaru"></div>     		
  			
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Nama Suplier / Vendor</label>
			    <div class="col-sm-8">
		    	  	<input type="text" placeholder="Material Name" name="name" id="vendor" class="form-control" required/>
		    	  	<input type="hidden" name="name" id="vendor_id"> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Bayar Dari </label>
			    <div class="col-sm-8">
			       	<select name="akun" class="form-control">
			       		<option value=''>:: Pilih JENIS PEMBAYARAN ::</option>
			       		<option value='11001'>PETTY CASH</option>
			       		<option value='13001'>UANG MUKA KE SUPPLIER</option>
			       	</select>
			    </div>
		    </div>		    
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Nominal</label>
			    <div class="col-sm-8">
		    	  	<input type="text" onkeyup='getnumeric(this)' placeholder="Nominal IDR" name="usd" id="usd" class="form-control" required/> 	
			    </div>
		    </div>		    		          
	      </div>
	      <div class="modal-footer">
	        <button type="submit" id="tbh" class="btn btn-primary">Tambah</button>
	        <button type="button" class="btn btn-warning" id="btnBatalTambahKaryawan">Batal</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
</div>

<div class="modal hide" id="dialogFormDeposit" tabindex="1" role="dialog" aria-labelledby="FormTambahData" aria-hidden="true">
	 <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="FormTambahData">Tambah Deposit</h4>
	      </div>
	      <form id="formDeposit" class="form-horizontal" onsubmit="simpanregdeposit(); return false;">
	      <div class="modal-body">
	      	<div class="pesanBaru1"></div>     		
  			
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Nama Suplier / Vendor</label>
			    <div class="col-sm-8">
		    	  	<input type="text" placeholder="Material Name" name="name" id="vendor1" class="form-control" required/>
		    	  	<input type="hidden" name="name" id="vendor1_id"> 	
			    </div>
		    </div>
		    <div class="form-group">
			    <label for="jabatan" class="col-sm-4 control-label">Bayar Dari </label>
			    <div class="col-sm-8">
			       	<select name="uraian" class="form-control">
			       		<option value=''>:: Pilih JENIS PEMBAYARAN ::</option>
			       		<option value='11001'>PETTY CASH</option>
			       		<option value='11103'>BANK MANDIRI 9891 IDR</option>
			       	</select>
			    </div>
		    </div>
		    		    
		    <div class="form-group">
			    <label for="kodeKaryawan" class="col-sm-4 control-label">Nominal</label>
			    <div class="col-sm-8">
		    	  	<input type="text" onkeyup='getnumeric(this)' placeholder="Nominal IDR" name="idr" id="idr" class="form-control"/> 	
			    </div>
		    </div>		    		          
	      </div>
	      <div class="modal-footer">
	        <button type="submit" id="tbh" class="btn btn-primary">Tambah</button>
	        <button type="button" class="btn btn-warning" id="btnBatalDeposit">Batal</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
</div>

<script src="<?php echo base_url()?>assets/js/func.js" type="text/javascript"></script>

<script type="text/javascript">	
$(document).ready(function () {
	loadGridDataDetail();
	

	$('#btnBatalTambahKaryawan').click( function(e){
		e.preventDefault(); 
		$('#dialogFormBaru').attr('class', 'modal hide');
	});

	$('#btnBatalDeposit').click( function(e){
		e.preventDefault(); 
		$('#dialogFormDeposit').attr('class', 'modal hide');
	});
	

});

function tambahBaru(idm){
		var selection = $("#ajaxTreeGridHutang").jqxDataTable('getSelection');

		var data = selection[0];

		var	idx      	= data.idx,			
			kode 		= data.nomor,
			nama 		= data.uraian;
		$('#vendor').val(nama);
		$('#vendor_id').val(idm);
		$('#alertMessage').remove();
    	$('#dialogFormBaru').attr('class', 'modal show');               
    }

function vendor(idm){
		var selection = $("#ajaxTreeGridHutang").jqxDataTable('getSelection');

		var data = selection[0];

		var	idx      	= data.idx,			
			kode 		= data.nomor,
			nama 		= data.uraian;
		$('#vendor1').val(nama);
		$('#vendor1_id').val(idm);
		$('#alertMessage').remove();
    	$('#dialogFormDeposit').attr('class', 'modal show');               
    }

         

function loadGridDataDetail(){

	     var source =

         {		

             dataType: "json",

             dataFields: [

                  { name: "tgl", 	type: "date" },

                  { name: "uraian", 	type: "string" },

                  { name: "nominal", 	type: "number" },

                  { name: "nominal2", 	type: "number" }
                  
             ],

            url : "akuntansi/GetDaftarDetail",

            id  : "idx"

         };



        var dataAdapter = new $.jqx.dataAdapter(source, {

            loadComplete: function () {		

            }

        });



        // create jqxDataTable.

        $("#ajaxTreeGridDetail").jqxGrid(

        {

            source: dataAdapter,
            pagerButtonsCount: 10,
            altRows: true,
            sortable: true,
            filterable: true,
            columnsResize: true,
            height: '600px',
            pageable : true,
            pageSize : 1000,
            //groups: ['nama'],
            showfilterrow: true,            
            //pagerPosition : 'bottom',
            //groupsrenderer: groupsrenderer,
            //selectionmode: 'singlecell',
            //showstatusbar: True,
            //statusbarheight: 50,
            //editable: True,
            showstatusbar: true,
            statusbarheight: 30,
            groupable: true,
            filterMode: 'excel',
            showaggregates: true,
            theme: 'fresh',
            width: '100%',

            columns: [

              { text: 'Tanggal', cellsAlign: 'center', align: 'center', filtertype: 'range', dataField: 'tgl', cellsformat: 'd', width : '18%'},

              { text: 'Provider', cellsAlign: 'left', align: 'center', dataField: 'uraian', width : '42%'},

              { text: 'Deposit', cellsAlign: 'right', align: 'center', dataField: 'nominal2', aggregates: ['sum'], cellsformat: 'f', width : '20%'},

              { text: 'Hutang', cellsAlign: 'right', align: 'center', dataField: 'nominal', aggregates: ['sum'], cellsformat: 'f', width : '20%'}
              

            ]

        }).on('rowDoubleClick', function(event)

        {	          	

        	dialogFormEditShow();

	    });	

	}

	
	function simpanreg()
	{
		var target = "<?php echo site_url("akuntansi/tambah_hutang")?>";
			data = $("#formBaru").serialize();
		$.post(target, data, function(e){
			//console.log(e);
			//$(".content-wrapper").html(e);
			//return false;
			//tinymce.triggerSave();
			if(e!=1){
				$(".pesanBaru").append(e);
			}else{
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			
				loadhtml = "<?php echo site_url("akuntansi/Hutang")?>";
				alert("Data berhasil disimpan.");
				$(".content-wrapper").load(loadhtml);
			}
		
		});
	}

	function simpanregdeposit()
	{
		var target = "<?php echo site_url("akuntansi/tambah_deposit")?>";
			data = $("#formDeposit").serialize();
		$.post(target, data, function(e){
			//console.log(e);
			$(".content-wrapper").html(e);
			return false;
			//tinymce.triggerSave();
			if(e!=1){
				$(".pesanBaru").append(e);
			}else{
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			
				loadhtml = "<?php echo site_url("akuntansi/Hutang")?>";
				alert("Data berhasil disimpan.");
				$(".content-wrapper").load(loadhtml);
			}
		
		});
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

	function getnumericminus(elem)
	{
		
		var getelem = $(elem).attr("id");
			getval = $("#"+getelem).val().replace(/,/ig, '');
			currancy = getval.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			
			getval = $("#"+getelem).val(currancy);
			//$("#"+getelem).val(currancy);
			
			//calculates();
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

	function getnobkk(param)
	{
		
		getNum = param.split("-");
		Nums = parseInt(getNum[1]);
		Num  = eval(Nums) + 1;
		
		
		if(Num <= 9)
		{
			code = getNum[0]+"-"+"000"+Num;
		}
		else if(Num > 9 && Num <= 99)
		{
			code = getNum[0]+"-"+"00"+Num;
		}
		else if(Num > 99 && Num <= 999)
		{
			code = getNum[0]+"-"+"0"+Num;
		}
		else
		{
			code = getNum[0]+"-"+Num;
		}
		$("#nomor").val(code);
		return code;
	}

	function getnobukti(param)
	{
		
		getNum = param.split("-");
		Nums = parseInt(getNum[1]);
		Num  = eval(Nums) + 1;
		
		
		if(Num <= 9)
		{
			code = getNum[0]+"-"+"000"+Num;
		}
		else if(Num > 9 && Num <= 99)
		{
			code = getNum[0]+"-"+"00"+Num;
		}
		else if(Num > 99 && Num <= 999)
		{
			code = getNum[0]+"-"+"0"+Num;
		}
		else
		{
			code = getNum[0]+"-"+Num;
		}
		$("#nomor2").val(code);
		return code;
	}	
		
</script>