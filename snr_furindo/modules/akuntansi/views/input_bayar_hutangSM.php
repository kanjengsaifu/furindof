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
	<h1>Pembayaran Hutang Usaha</h1>
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
						<input type="hidden" id="id_rekanan" value="<?php echo $lpb->provider_id; ?>" name="id_rekanan" >

            <div class="form-group">
            <label for="Nomor" class="col-sm-3 control-label">Jenis Transaksi :</label>
              <div class="col-sm-8">
                <select id="transaksi" onchange="Show_rekanan('')" class="form-control">
                  <option value="0">:: PILIH JENIS TRANSAKSI ::</option>
                  <option selected="selected" value="hutang">HUTANG / DEPOSIT</option>
                  <option value="umum">UMUM</option>
                </select>
              </div>
            </div>

						<div class="form-group" id="input_rekanan">
						<label for="kegiatan" class="col-sm-3 control-label">Dibayar ke :</label>
							<div class="col-sm-8" id="col-kontak">
								<div class="input-group">
                    <input type="text" readonly value="<?php echo $lpb->provider_name; ?>"  class="form-control" id="rekanan" name="rekanan" >                    
									    <span class="input-group-btn">
						       			<button type="button" id="btnCariRekanan" class="btn btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Cari</button>
						       		</span>
						       	</div>
							</div>							
						</div>

						<div class="form-group">
						<label for="Nomor" class="col-sm-3 control-label">Catatan :</label>
							<div class="col-sm-8">
								<input type="hidden" name="pembayaran" value="<?php echo $lpb->lpb_liquid_code; ?>"/>
								<textarea class="form-control" id="catatan" name="catatan">Pembayaran LPB <?php echo $lpb->lpb_liquid_code; ?></textarea>
							</div>
						</div>						
					</div>
          <div class="col-sm-6" style="padding-right: 68px;">
            <table width="100%">
              <tr>
                <th style="width:100%; text-align:center; font-size:50px;" class="btn-success">TOTAL DEPOSIT</th>
              </tr>
              <tr>
                <th height="120" style="width:100%; text-align:center; font-size:50px;" id="total_bayar" class="btn-success">Rp
                <?php 
                  $depo = $this->db->query("SELECT sum(nominal) as nominal from trx_jurnal where akun = '13001' AND provider_id = '".$lpb->provider_id."'")->row();
                  echo number_format($depo->nominal); 
                ?>.00          
               </th>
              </tr>
            </table>
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
            <?php 
              $nominal = $this->db->query("SELECT sum(nominal) as nominal from trx_jurnal where akun = '22001' AND (pembayaran = '".$lpb->lpb_liquid_code."' OR nobukti = '".$lpb->lpb_liquid_code."')")->row();
            ?>
              <tr id="tmbinput-0">
                <td><input type="text" readonly="readonly" value="22001" name="kode[]" id="kode-0" class="form-control autocomplate"></td>
                <td><input type="text" readonly="readonly" value="HUTANG USAHA" name="uraian[]" id="uraian-0" class="form-control"></td>
                <td><input type="text" value="<?php echo number_format($nominal->nominal) ?>" style="text-align:right;" name="nominal[]" id="nominal-0" onblur="calculates()" onkeyup="getnumeric(this)" class="form-control"></td>
                <td><input type="text" name="memo[]" id="memo-0" class="form-control"></td>
                <td style="text-align:center;">
                  <button type="button" onclick="deleterow(0)" id="delete-button-0" title="hapus data" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-minus-sign"></span></button>
                </td>
              </tr> 						
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
                      <input type="text" readonly="" value="KAS DITANGAN IDR" class="form-control" id="kasbank" name="kasbank">
                      <input type="hidden" id="id_kasbank" name="id_kasbank" value="3">
                      <input type="hidden" id="bank_code" name="bank_code" value="11102">
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
  calculates();
	var tglreg = "<?php echo date("d-m-Y")?>";
		$("#tanggal").val(tglreg);
		//$("#nomor").val("<?php echo $bkk ?>");
		getnobkk("<?php echo $bkk ?>");
    $(".date").datepicker({
      format : "dd-mm-yyyy",
      //startDate : new Date('<?php echo date('Y-m-d', strtotime("-".$_SESSION['Akses']." days"))?>'),
        //endDate : new Date('<?php echo date('Y-m-d', strtotime("+90 days"))?>'),
      autoclose : true,
    });
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

              { text: 'Nama', cellsAlign: 'left', align: 'center', dataField: 'nama', width : '60%'},              

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
				row += "<td><input type='text' style='text-align:right;'name='nominal[]' id='nominal-"+lengths+"' onblur='calculates()' onkeyup='getnumeric(this)' class='form-control'/></td>";
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
		$('#terbilang').val(terbilang(total)+" rupiah");
		
	}

	function simpanreg()
	{
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

	function terbilang(a){
  var bilangan = ['','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas'];

  // 1 - 11
      if(a < 12){
        var kalimat = bilangan[a];
      }
      // 12 - 19
      else if(a < 20){
        var kalimat = bilangan[a-10]+' Belas';
      }
      // 20 - 99
      else if(a < 100){
        var utama = a/10;
        var depan = parseInt(String(utama).substr(0,1));
        var belakang = a%10;
        var kalimat = bilangan[depan]+' Puluh '+bilangan[belakang];
      }
      // 100 - 199
      else if(a < 200){
        var kalimat = 'Seratus '+ terbilang(a - 100);
      }
      // 200 - 999
      else if(a < 1000){
        var utama = a/100;
        var depan = parseInt(String(utama).substr(0,1));
        var belakang = a%100;
        var kalimat = bilangan[depan] + ' Ratus '+ terbilang(belakang);
      }
      // 1,000 - 1,999
      else if(a < 2000){
        var kalimat = 'Seribu '+ terbilang(a - 1000);
      }
      // 2,000 - 9,999
      else if(a < 10000){
        var utama = a/1000;
        var depan = parseInt(String(utama).substr(0,1));
        var belakang = a%1000;
        var kalimat = bilangan[depan] + ' Ribu '+ terbilang(belakang);
      }
      // 10,000 - 99,999
      else if(a < 100000){
        var utama = a/100;
        var depan = parseInt(String(utama).substr(0,2));
        var belakang = a%1000;
        var kalimat = terbilang(depan) + ' Ribu '+ terbilang(belakang);
      }
      // 100,000 - 999,999
      else if(a < 1000000){
        var utama = a/1000;
        var depan = parseInt(String(utama).substr(0,3));
        var belakang = a%1000;
        var kalimat = terbilang(depan) + ' Ribu '+ terbilang(belakang);
      }
      // 1,000,000 -  99,999,999
      else if(a < 100000000){
        var utama = a/1000000;
        var depan = parseInt(String(utama).substr(0,4));
        var belakang = a%1000000;
        var kalimat = terbilang(depan) + ' Juta '+ terbilang(belakang);
      }
      else if(a < 1000000000){
        var utama = a/1000000;
        var depan = parseInt(String(utama).substr(0,4));
        var belakang = a%1000000;
        var kalimat = terbilang(depan) + ' Juta '+ terbilang(belakang);
      }
      else if(a < 10000000000){
        var utama = a/1000000000;
        var depan = parseInt(String(utama).substr(0,1));
        var belakang = a%1000000000;
        var kalimat = terbilang(depan) + ' Milyar '+ terbilang(belakang);
      }
      else if(a < 100000000000){
        var utama = a/1000000000;
        var depan = parseInt(String(utama).substr(0,2));
        var belakang = a%1000000000;
        var kalimat = terbilang(depan) + ' Milyar '+ terbilang(belakang);
      }
      else if(a < 1000000000000){
        var utama = a/1000000000;
        var depan = parseInt(String(utama).substr(0,3));
        var belakang = a%1000000000;
        var kalimat = terbilang(depan) + ' Milyar '+ terbilang(belakang);
      }
      else if(a < 10000000000000){
        var utama = a/10000000000;
        var depan = parseInt(String(utama).substr(0,1));
        var belakang = a%10000000000;
        var kalimat = terbilang(depan) + ' Triliun '+ terbilang(belakang);
      }
      else if(a < 100000000000000){
        var utama = a/1000000000000;
        var depan = parseInt(String(utama).substr(0,2));
        var belakang = a%1000000000000;
        var kalimat = terbilang(depan) + ' Triliun '+ terbilang(belakang);
      }

      else if(a < 1000000000000000){
        var utama = a/1000000000000;
        var depan = parseInt(String(utama).substr(0,3));
        var belakang = a%1000000000000;
        var kalimat = terbilang(depan) + ' Triliun '+ terbilang(belakang);
      }

      else if(a < 10000000000000000){
        var utama = a/1000000000000000;
        var depan = parseInt(String(utama).substr(0,1));
        var belakang = a%1000000000000000;
        var kalimat = terbilang(depan) + ' Kuadriliun '+ terbilang(belakang);
      }

      var pisah = kalimat.split(' ');
      var full = [];
      for(var i=0;i<pisah.length;i++){
       if(pisah[i] != ""){full.push(pisah[i]);}
      }
      return full.join(' ');
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