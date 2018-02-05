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
	<h1>Input Bukti Kas Keluar</h1>
</section>
<div class="content">        
	<div class="box box-primary">
		<div class="box-body">
			<form id="addkasmasuk" onsubmit="simpanreg(); return false;">
			<div class="form-horizontal">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Nomor BKK :</label>
							<div class="col-sm-8">
								<input class="form-control" readonly id="nomor" name="nomor" value=""/>
							</div>
						</div>
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Tanggal :</label>
							<div class="col-sm-8">
								<div class="input-group date">
									  <input type="text" readonly role="date" class="form-control" id="tanggal" name="tanggal" >
									  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
									</div>
							</div>
						</div>
						<!-- <input type="hidden" class="form-control" value="Umum" id="rekanan" name="rekanan" > -->
						<input type="hidden" id="id_rekanan" value="0" name="id_rekanan" >

            <div class="form-group">
            <label for="Nomor" class="col-sm-3 control-label">Jenis Transaksi :</label>
              <div class="col-sm-8">
                <select id="transaksi" onchange="Show_rekanan('')" class="form-control">
                  <option value="0">:: PILIH JENIS TRANSAKSI ::</option>
                  <option value="hutang">HUTANG / DEPOSIT</option>
                  <option value="umum">UMUM</option>
                </select>
              </div>
            </div>

						<div class="form-group hide" id="input_rekanan">
						<label for="kegiatan" class="col-sm-3 control-label">Dibayar ke :</label>
							<div class="col-sm-8" id="col-kontak">
								<div class="input-group">
                    <input type="text" readonly  class="form-control" id="rekanan" name="rekanan" >                    
									    <span class="input-group-btn">
						       			<button type="button" id="btnCariRekanan" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
						       		</span>
						       	</div>
							</div>							
						</div>
            
						
						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Catatan :</label>
							<div class="col-sm-8">
								<input type="hidden" name="pembayaran" value=""/>
								<textarea class="form-control" id="catatan" name="catatan"></textarea>
							</div>
						</div>
						
					</div>
					
					
				</div>
			</div>
			
			<div class="seperator">
			
			<div class="header1">
				<h4>RINCIAN BUKTI KAS KELUAR</h4>
			</div>			
				<div class="table-responsive" style="width:97%; margin:0px auto;">     
					<table id="tables"  width="100%" cellspacing="0" aria-describedby="tabel transaksi" role="grid" class="table table-striped table-bordered">
						<thead>
							<tr role="row">
								<th class="btn-primary" style="width:15%; text-align:center; vertical-align: middle;">Kode</th>
								<th class="btn-primary" style="width:45%; text-align:center; vertical-align: middle;">Keterangan</th>
								<th class="btn-primary" style="width:20%; text-align:center; vertical-align: middle;">Nominal</th>
								<th class="btn-primary" style="width:20%; text-align:center; vertical-align: middle;">Memo</th>
								<td style="width:5%; "><button type="button" id="btnCariPemasukan" title="Tambah data" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
							</tr>
						 </thead>
						<tbody name="tabelContent" id="tabelContent">							
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
							<label for="Nomor" class="col-sm-3 col-sm-offset-1 control-label">Total :</label>
								<div class="col-sm-7">
									<input style="font-size:24px; color:blue; backgraound-color:green;" class="form-control" readonly id="total" name="total" value=""/>
								</div>
							</div>
							<div class="form-group">
							<label for="Nomor" class="col-sm-3 col-sm-offset-1 control-label">Bayar Dari :</label>
								<div class="col-sm-7">									
									<div class="input-group">
                                    <input type="text" readonly value="KAS DITANGAN IDR"   class="form-control" id="kasbank" name="kasbank">
                                    <input type="hidden" value="3" id="id_kasbank" name="id_kasbank" >
                                    <input type="hidden" value="11002" id="bank_code" name="bank_code" >
									<span class="input-group-btn">
						       			<button type="button" id="btnCariKasbank" class="btn btn-warning"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
						       		</span>	
								</div>																
							</div>
							
						</div>
					</div>
				</div>
			</div>
		
			<div class="form-horizontal footer">
				<div class="row" id="addcol">
					<div class="col-sm-6" style="padding-left: 30px;">
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

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content" style="width:750px;">
      <div class="modal-header">
        <button type="button" class="close Rekanan" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Rekanan</h4>
      </div>
      <div class="modal-body">        
			<div id="ajaxTreeGrid"></div>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="kasModal">
  <div class="modal-dialog">
    <div class="modal-content" style="width:750px;">
      <div class="modal-header">
        <button type="button" class="close Kasbank" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Kas Bank</h4>
      </div>
      <div class="modal-body">        
			<div id="ajaxKasbank"></div>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="pemasukanModal">
  <div class="modal-dialog">
    <div class="modal-content" style="width:750px;">
      <div class="modal-header">
        <button type="button" class="close Pemasukan" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Data Kas Bank</h4>
      </div>
      <div class="modal-body">        
			<div id="ajaxPemasukan"></div>		
      </div>      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo base_url()?>assets/js/func.js" type="text/javascript"></script>

<script type="text/javascript">	
$(document).ready(function () {
	//loadGridDataHutang();
  $(".date").datepicker({
      format : "dd-mm-yyyy",
       //startDate : new Date('<?php echo date('Y-m-d', strtotime("-".$_SESSION['Akses']." days"))?>'),
        //endDate : new Date('<?php echo date('Y-m-d', strtotime("+90 days"))?>'),
      autoclose : true,
    }); 
	var tglreg = "<?php echo date("d-m-Y")?>";
		$("#tanggal").val(tglreg);
		//$("#nomor").val("<?php echo $bkk ?>");
		getnobkk("<?php echo $bkk ?>");

	$('#btnCariRekanan').click(function(e)

    {

		e.preventDefault(); 		

    	$('#alertMessage').remove();

    	$('#myModal').attr('class', 'modal show');  

    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
    	loadGridData();
    });

    $('#btnCariKasbank').click(function(e)

    {

		e.preventDefault(); 		

    	$('#alertMessage').remove();

    	$('#kasModal').attr('class', 'modal show');  

    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
    	loadGridDataKas();
    });

    $('#btnCariPemasukan').click(function(e)

    {

		e.preventDefault(); 		

    	$('#alertMessage').remove();

    	$('#pemasukanModal').attr('class', 'modal show');  

    	//$('body').attr('class', 'skin-blue layout-boxed sidebar-collapse modal-open');              
    	loadGridDataPemasukan();
    });

	$('.Rekanan').click(function(e)
	{
		$('#myModal').attr('class', 'modal hide');  
	});

	$('.Kasbank').click(function(e)
	{
		$('#kasModal').attr('class', 'modal hide');  
	});

	$('.Pemasukan').click(function(e)
	{
		$('#pemasukanModal').attr('class', 'modal hide');  
	});
	

});

function Show_rekanan(){
  var asd = $('#transaksi').val();
  if (asd == 'umum') {
    $('#input_rekanan').attr('class','form-group hide');
  }else{
    $('#input_rekanan').attr('class','form-group show');
  }
  //alert(asd);
}

function loadGridDataHutang(){



	     var source =

         {		

             dataType: "json",

             dataFields: [

                  { name: "idx", 	type: "string" },

                  { name: "tgl", 	type: "string" },

                  { name: "nomor", 	type: "string" },

                  { name: "uraian", 	type: "string" },

                  { name: "nominal", 	type: "string" },

                  { name: "action", 	type: "string" }

             ],

            url : "transaksi/GetDaftarBkk",

            id  : "idx"

         };



        var dataAdapter = new $.jqx.dataAdapter(source, {

            loadComplete: function () {		

            }

        });



        // create jqxDataTable.

        $("#ajaxTreeGridHutang").jqxDataTable(

        {

            source: dataAdapter,

            pagerButtonsCount: 10,

            altRows: true,

            filterable: true,

            height: '400px',

            pageable : true,

            pageSize : 1000,

            pagerPosition : 'bottom',

            filterMode: 'simple',

            theme: 'fresh',

            width: '100%',

            columnsResize: true,

            columns: [

              { text: 'Tanggal', cellsAlign: 'center', align: 'center', dataField: 'tgl', width : '15%'},

              { text: 'Nomor', cellsAlign: 'center', align: 'center', dataField: 'nomor', width : '15%'},

              { text: 'Uraian', cellsAlign: 'left', align: 'center', dataField: 'uraian', width : '35%'},

              { text: 'Nominal', cellsAlign: 'right', align: 'center', dataField: 'nominal', width : '15%'},

              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '20%' }

            ]

        }).on('rowDoubleClick', function(event)

        {	          	

        	dialogFormEditShow();

	    });	

	}

function loadGridData(tipe){

		 

		 tipe = (tipe == null) ? '' : tipe;



	     var source =

         {		

             dataType: "json",

             dataFields: [

                  { name: "kode", 			type: "string" },

                  { name: "nama", 			type: "string" },                  

                  { name: "notelp", 		type: "string" },                  

                  { name: "action", 		type: "string" }

             ],

            url : "transaksi/GetKontak/"+tipe,

            id  : "idx"

         };



        var dataAdapter = new $.jqx.dataAdapter(source, {

            loadComplete: function () {		

            }

        });



        // create jqxDataTable.
        //console.log(e);
        $("#ajaxTreeGrid").jqxDataTable(

        {

            source: dataAdapter,

            pagerButtonsCount: 10,

            altRows: true,

            filterable: true,

            height: '440px',

            pageable : true,

            pageSize : 1000,

            pagerPosition : 'bottom',

            filterMode: 'simple',

            theme: 'fresh',

            width: '100%',

            columnsResize: true,

            columns: [

              { text: 'Kode', cellsAlign: 'center', align: 'center', dataField: 'kode', width : '20%'},

              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '40%'},              

              { text: 'No Telp', cellsAlign: 'left', align: 'center', dataField: 'notelp', width : '25%'},              

              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '15%' }

            ]

        }).on('rowDoubleClick', function(event)

        {	          	

        	dialogFormEditShow();

	    });	

	}

	function loadGridDataKas(){



	     var source =

         {		

             dataType: "json",

             dataFields: [

                  { name: "idx", 			type: "string" },
                  
                  { name: "kode", 			type: "string" },

                  { name: "nama", 			type: "string" },                  

                  { name: "action", 		type: "string" }

             ],

            url : "transaksi/GetDaftarKasBank",

            id  : "idx"

         };



        var dataAdapter = new $.jqx.dataAdapter(source, {

            loadComplete: function () {		

            }

        });



       	// create jqxDataTable.

        $("#ajaxKasbank").jqxDataTable(

        {

            source: dataAdapter,

            pagerButtonsCount: 10,

            altRows: true,

            filterable: true,

            height: '400px',

            pageable : true,

            pageSize : 1000,

            pagerPosition : 'bottom',

            filterMode: 'simple',

            theme: 'fresh',

            width: '100%',

            columnsResize: true,

            columns: [

              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '30%'},

              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '55%'},              

              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '15%' }

            ]

        });

	}

	function loadGridDataPemasukan(){



	     var source =

         {		

             dataType: "json",

             dataFields: [

                  { name: "idx", 			type: "string" },
                  
                  { name: "kode", 			type: "string" },

                  { name: "nama", 			type: "string" },                  

                  { name: "action", 		type: "string" }

             ],

            url : "transaksi/GetDaftarPengeluaran",

            id  : "idx"

         };



        var dataAdapter = new $.jqx.dataAdapter(source, {

            loadComplete: function () {		

            }

        });



       	// create jqxDataTable.

        $("#ajaxPemasukan").jqxDataTable(

        {

            source: dataAdapter,

            pagerButtonsCount: 10,

            altRows: true,

            filterable: true,

            height: '440px',

            pageable : true,

            pageSize : 1000,

            pagerPosition : 'bottom',

            filterMode: 'simple',

            theme: 'fresh',

            width: '100%',

            columnsResize: true,

            columns: [

              { text: 'Kode', cellsAlign: 'left', align: 'center', dataField: 'kode', width : '15%'},

              { text: 'Namas', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '60%'},              

              { text: '', cellsAlign: 'center', align: 'center', dataField: 'action', width: '25%' }

            ]

        });

	}

	function dialogFormPilih(nama, idx)
	{
		var name = nama.replace(/_/g, " ");
		$('#rekanan').val(name);
		$('#id_rekanan').val(idx);
		$('#myModal').attr('class', 'modal hide');
	}

	function pilihKasbank(nama, idx, bank)
	{
		var name = nama.replace(/_/g, " ");
		$('#kasbank').val(name);
		$('#id_kasbank').val(idx);
		$('#bank_code').val(bank);
		$('#kasModal').attr('class', 'modal hide');
	}
	
	function PilihPemasukan(kode, nama, idx)
	{
		console.log($("#tabelContent tr").length);
		//return false;
		var idbutton = "delete-button-"+$("#tabelContent tr").length;
			lengths = $("#tabelContent tr").length;
			name = nama.replace(/_/g, " ");
			
			var row  = "<tr id='tmbinput-"+lengths+"'>";
				row += "<td><input type='text' readonly='readonly' value='"+kode+"' name='kode[]' id='kode-"+lengths+"' class='form-control autocomplate'/></td>";
				row += "<td><input type='text' readonly='readonly' value='"+name+"' name='uraian[]' id='uraian-"+lengths+"' class='form-control'/></td>";
				row += "<td><input type='text' style='text-align:right;'name='nominal[]' id='nominal-"+lengths+"' onblur='calculates()' onkeyup='getnumeric(this)' class='form-control' required/></td>";
				row += "<td><input type='text' name='memo[]' id='memo-"+lengths+"' class='form-control'/></td>";
				row += "<td style='text-align:center;'><button type='button' onclick='deleterow("+lengths+")' id='"+idbutton+"' title='hapus data' class='btn btn-xs btn-danger'><span class='glyphicon glyphicon-minus-sign'></span></button></td>";
				row += "</tr>";
				//$("#tabelContent").after(row);
		
		$("#tabelContent").append(row);

		$('#pemasukanModal').attr('class', 'modal hide'); 
		
		//alert("oke");			
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

	function calculates()
	{
		var tag = $("input[name='nominal[]']");
			total = 0;
		
		
		$(tag).each(function(){
			total +=+ $(this).val().replace(/,/ig,"");
		});
		
		//for(i=1;i<=tag.length;i++)
		//{
			
			//total +=+ $("#nominal-"+i).val().replace(/,/ig,"");
			
		//}
		//var num = total.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
		$("#total").val(formatCurrency(total));
		//console.log(total);
		//CurrToString(total);
		$('#terbilang').val(Terbilang(total)+" rupiah");
		
	}

	function simpanreg()
	{
    var id = $('#kasbank').val();
    if(id == ''){
      alert('kasbank belum dipilih !!!');
      return false;
    }
    
		var target = "<?php echo site_url("transaksi/savebkk")?>";
			data = $("#addkasmasuk").serialize();
		$.post(target, data, function(e){
			//console.log(e);
			if(e!=1){
				$(".box-body").append(e);
			}else{
			//return false;
			//tinymce.triggerSave();
			
			//alert("Kode barang sudah digunakan , silahkan ganti yang lain !!!");
			alert("Data berhasil disimpan.");
			loadhtml = "<?php echo site_url("transaksi/Bkk")?>";
			
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
    tgl = "<?php echo date("y")?>";
		
		
		if(Num <= 9)
		{
			code = "BKK"+tgl+"-"+"000"+Num;
		}
		else if(Num > 9 && Num <= 99)
		{
			code = "BKK"+tgl+"-"+"00"+Num;
		}
		else if(Num > 99 && Num <= 999)
		{
			code = "BKK"+tgl+"-"+"0"+Num;
		}
		else
		{
			code = "BKK"+tgl+"-"+Num;
		}
		$("#nomor").val(code);
		return code;
	}	
		
</script>