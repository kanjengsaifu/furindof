<?php
  ob_start();
?>
<page footer="page" style="color:#03011F; font-weight: bold;">

    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0; border-color: #03011F;}
.tg td{font-family:courier, sans-serif;font-size:12px;padding:5px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; border-color: #03011F;}
.tg th{font-family:courier, sans-serif;font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; border-color: #03011F;}
.tg .tg-s6z2{text-align:center}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-yw4l{text-align:right;vertical-align:top}
</style>
<?php 
  $data1 = $this->db->query("SELECT * from trx_surat_jalan inner join mst_provider on trx_surat_jalan.provider_id = mst_provider.provider_id where surat_jalan_id = '".$lpb."'")->row();
?>

<table class="tg" width="100%">
      <col style="width: 5">
      <col style="width: 60">
      <col style="width: 220">
      <col style="width: 80">
      <col style="width: 100">
   <tr> 
   <th colspan="1" style="border-style:none; font-size:11px; padding-top:-10px;">
      <img src="<?php echo base_url().'/assets/images/logo11.png'?>" alt="Logo SNR"/>
    </th>   
    <th colspan="2" style="border-style:none; font-size:11px; height:-10px; font-weight: bold;">
      <label style="font-family:courier; font-size:20px; "><b>C.V. SNR EKSPOR FURINDO</b></label><br>
      <label style="font-family:courier; font-size:11px; "><b>Manufacture & Export Funiture</b></label><br>
      <label style="font-family:courier; font-size:11px; ">JL. RING ROAD SELATAN, TLAJUK/WOJO RT.7/RW.11</label><br>
      <label style="font-family:courier; font-size:11px; ">BANGUN HARJO, SEWON, BANTUL, YOGYAKARTA</label><br>
      <label style="font-family:courier; font-size:11px; ">TEL/FAX: +62-274-3057199</label>
    </th>
    <th colspan="2" style="border-style:none; font-size:11px; padding-left:50px; font-weight: bold;">
      <label style="font-family:courier; font-size:11px; "> Yogyakarta, <?php  $tgl=date('d F Y', strtotime($data1->surat_jalan_date)); echo $tgl; ?></label><br>
      <label style="font-family:courier; font-size:11px; "> Dikirim Dari : <?php echo $data1->provider_name; ?></label><br>
      <label style="font-family:courier; font-size:11px; "> Kepada : <?php echo $data1->provider_contact_person; ?></label><br>
      <label style="font-family:courier; font-size:11px; "> Diangkut Melalui : <?php echo $data1->surat_jalan_diangkut_melalui; ?></label><br>
      <label style="font-family:courier; font-size:11px; "> No. Kendaraan : <?php echo $data1->surat_jalan_nomor_kendaraan; ?></label>
    </th>
  </tr>   
  <tr>
      <td colspan="5" style="border-style:none;border-bottom:0px solid black; text-align:center; font-size:16px;">
        <b>SURAT JALAN</b>
      </td>
  </tr> 

  <tr>
      <td colspan="3" style="border-style:none;border-bottom:1px solid #03011F; font-size:11px;">
       NOMOR : <?php echo $data1->surat_jalan_code; ?>
      </td>
      <td colspan="2" style="border-style:none;border-bottom:1px solid #03011F; font-size:11px;">
        
      </td>
  </tr> 
      
  <tr>
    <th class="tg-s6z2">No</th>
    <th class="tg-s6z2">Kode</th>
    <th class="tg-s6z2">Nama Barang</th>    
    <th class="tg-baqh">Jumlah</th>
    <th class="tg-baqh">Keterangan</th>
  </tr>
  <?php 
      $data = $this->db->query("SELECT * from trx_surat_jalan_detail inner join mst_material on trx_surat_jalan_detail.material_id = mst_material.material_id where surat_jalan_id = '".$lpb."'");
      $i=1;
      $ttl=0;
      $jml=0;
      $price=0;
      foreach ($data->result() as $row) {
       
      
  ?>
  <tr>
    <td class="tg-s6z2"><?php echo $i; ?></td>
    <td class="tg-031e"><?php echo $row->material_code; ?></td>
    <td class="tg-031e"><?php echo $row->material_name; ?></td>
    <td class="tg-s6z2"><?php $ttl = $row->surat_jalan_detail_qty; echo $ttl;?></td>
    <td class="tg-031e"><?php $price += $ttl; echo $row->surat_jalan_detail_note ?></td>
  </tr>  
  <?php $i++; }?>
  <tr>
    <td colspan="3" style="text-align:right;"><b>TOTAL</b></td>
    <td style="text-align:center;"><?php echo $price;  ?></td>    
    <td style="text-align:left;"></td>    
  </tr>
    
</table>
<p style="font-family:courier; font-size:12px;"></p>

<label style="font-family:courier; font-size:12px; ">Diterima Oleh,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Satpam,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Logistik,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Diketahui,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Pengemudi,</label>
<br><br><br><br><br>
<label style="font-family:courier; font-size:12px; ">
   (.............)
   &nbsp;&nbsp;&nbsp;      
   (.............)
   &nbsp;&nbsp;&nbsp;   
   (.............)
   &nbsp;&nbsp;&nbsp;&nbsp;   
   (.............)
   &nbsp;&nbsp;&nbsp;&nbsp;   
   (.............)
  </label>  
</page>
<?php

  $content = ob_get_clean();

  // conversion HTML => PDF
  require_once APPPATH.'third_party/html2pdf_v4.03/html2pdf.class.php'; // arahkan ke folder html2pdf
  
  try
  {
    $html2pdf = new HTML2PDF('P','A4','fr', false, 'ISO-8859-15',array(15, 10, 0, 5)); //setting ukuran kertas dan margin pada dokumen anda
    //$html2pdf->setModeDebug();
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('Laporan_Perjenis.pdf');
  }
  catch(HTML2PDF_exception $e) { echo $e; } 

?>