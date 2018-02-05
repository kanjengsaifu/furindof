<?php
  ob_start();
?>
<page footer="page">

    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:courier, sans-serif;font-size:12px;padding:5px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:courier, sans-serif;font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; }
.tg .tg-s6z2{text-align:center}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-yw4l{text-align:right;vertical-align:top}
</style>
<?php 
  $data1 = $this->db->query("SELECT * from trx_lpb_sample inner join mst_provider on trx_lpb_sample.provider_id = mst_provider.provider_id where lpb_id = '".$lpb."'")->row();
?>

<table class="tg" width="100%">
      
      <col style="width: 5">
      <col style="width: 60">
      <col style="width: 100">
      <col style="width: 0">
      <col style="width: 100">
      <col style="width: 100">
      <col style="width: 60">     

   
   <tr> 
   <th colspan="1" style="border-style:none; font-size:11px; height:-10px;">
      <img src="<?php echo base_url().'/assets/images/logo11.png'?>" alt="Logo Bakti Husada"/>
    </th>   
    <th colspan="3" style="border-style:none; font-size:11px; height:-10px;">
      <label style="font-family:courier; font-size:11px; ">C.V. SNR EKSPOR FURINDO</label><br>
      <label style="font-family:courier; font-size:11px; ">JL. RING ROAD SELATAN, TLAJUK/WOJO RT.7/RW.11</label><br>
      <label style="font-family:courier; font-size:11px; ">BANGUN HARJO, SEWON, BANTUL, YOGYAKARTA</label><br>
      <label style="font-family:courier; font-size:11px; ">TEL/FAX: +62-274-3057199</label>
    </th>
    <th colspan="3" style="border-style:none; font-size:11px; padding-left:50px">
      <label style="font-family:courier; font-size:11px; "> Terima Dari : <?php echo $data1->provider_name; ?></label><br>
      <label style="font-family:courier; font-size:11px; "> Attn : <?php echo $data1->provider_contact_person; ?></label><br>
      <label style="font-family:courier; font-size:11px; "> Alamat : <?php echo $data1->provider_address ?></label>
    </th>
  </tr>   
  <tr>
      <td colspan="7" style="border-style:none;border-bottom:0px solid black; text-align:center; font-size:16px;">
        <b>GOOD RECEIVING REPORT</b>
      </td>
  </tr> 

  <tr>
      <td colspan="5" style="border-style:none;border-bottom:1px solid black; font-size:11px;">
       NOMOR : <?php echo $data1->lpb_code; ?>
      </td>
      <td colspan="2" style="border-style:none;border-bottom:1px solid black; font-size:11px;">
       SURAT JALAN NO : 
      </td>
  </tr> 
      
  <tr>
    <th class="tg-s6z2">No</th>
    <th class="tg-s6z2">Code</th>
    <th class="tg-s6z2">Description</th>
    <th class="tg-baqh">QTY</th>
    <th class="tg-baqh">Harga @</th>
    <th class="tg-baqh">Total</th>
    <th class="tg-baqh">Note</th>
  </tr>
  <?php 
      $data = $this->db->query("SELECT * from trx_lpb_sample_detail inner join mst_material on trx_lpb_sample_detail.material_id = mst_material.material_id where lpb_id = '".$lpb."'");
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
    <td class="tg-031e"><?php $jml += $row->lpb_detail_qty; echo $row->lpb_detail_qty; ?></td>
    <td class="tg-031e"><?php echo rp($row->lpb_detail_price); ?></td>
    <td class="tg-031e"><?php $ttl = $row->lpb_detail_qty*$row->lpb_detail_price; echo rp($ttl);?></td>
    <td class="tg-yw4l"><?php $price += $ttl; echo $row->lpb_detail_note ?></td>
  </tr>  
  <?php $i++; }?>
  <tr>
    <td colspan="3" style="text-align:right;"><b>TOTAL</b></td>
    <td style="text-align:center;"><?php echo $jml;  ?></td>
    <td></td>
    <td style="text-align:left;"><?php echo rp($price); ?></td>
    <td></td>
  </tr>
  <tr>  
      <td style="border-style:none;"></td>    
      <td colspan="2" style="font-family:courier; border-style:none; border-bottom:0px solid black; text-align:left; font-size:12px;">
        <!-- <b>Terbilang : <?php echo $terbilang; ?></b> -->
        <b>TOTAL </b>
      </td>
      <td colspan="4" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>: <?php echo rp($price); ?></b>
      </td>
  </tr>
  <tr>   
      <td style="border-style:none;"></td>    
      <td colspan="2" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>Biaya Kirim </b>
      </td>
      <td colspan="4" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>: <?php echo rp($data1->lpb_biaya); ?></b>
      </td>
  </tr>
  <tr> 
      <td style="border-style:none;"></td>    
      <td colspan="2" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>Jumlah yang Harus Dibayar </b>
      </td>
      <td colspan="4" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>: <?php $bby = $data1->lpb_biaya + $price; echo rp($bby); ?></b>
      </td>
  </tr> 
  <tr>  
      <td colspan="7" style="font-family:courier; border-style:none; border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>Terbilang : <?php echo $terbilang; ?></b>        
      </td>      
  </tr>
</table>
<p style="font-family:courier; font-size:12px;">BANTUL, <?php  $tgl=date('d F Y', strtotime($data1->lpb_date)); echo $tgl; ?></p>

<label style="font-family:courier; font-size:12px; ">Prepared By,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Checked By,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:12px; ">Approved By,</label>
<br><br><br><br><br>
<label style="font-family:courier; font-size:12px; ">
   (&nbsp;&nbsp;&nbsp;Ucik
   &nbsp;&nbsp;&nbsp;)
   &nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;   
   (&nbsp;&nbsp;&nbsp;&nbsp;Lyna
   &nbsp;&nbsp;&nbsp;&nbsp;)
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
  (&nbsp;&nbsp;Enny F Orah&nbsp;&nbsp;) 
  </label>  
</page>

<page footer="page">

    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:courier, sans-serif;font-size:12px;padding:5px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:courier, sans-serif;font-size:12px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; }
.tg .tg-s6z2{text-align:center}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-yw4l{text-align:right;vertical-align:top}
</style>
<?php 
  //$data1 = $this->db->query("SELECT * from trx_lpb inner join mst_provider on trx_lpb.provider_id = mst_provider.provider_id where lpb_id = '".$lpb."'")->row();
?>

<table class="tg" width="100%">
      
      <col style="width: 5">
      <col style="width: 60">
      <col style="width: 140">
      <col style="width: 20">
      <col style="width: 30">
      <col style="width: 30">
      <col style="width: 120">     

   
   <tr> 
   <th colspan="1" style="border-style:none; font-size:11px; height:-10px;">
      <img src="<?php echo base_url().'/assets/images/logo11.png'?>" alt="Logo Bakti Husada"/>
    </th>   
    <th colspan="3" style="border-style:none; font-size:11px; height:-10px;">
      <label style="font-family:courier; font-size:11px; ">C.V. SNR EKSPOR FURINDO</label><br>
      <label style="font-family:courier; font-size:11px; ">JL. RING ROAD SELATAN, TLAJUK/WOJO RT.7/RW.11</label><br>
      <label style="font-family:courier; font-size:11px; ">BANGUN HARJO, SEWON, BANTUL, YOGYAKARTA</label><br>
      <label style="font-family:courier; font-size:11px; ">TEL/FAX: +62-274-3057199</label>
    </th>
    <th colspan="3" style="border-style:none; font-size:11px; padding-left:50px">
      <label style="font-family:courier; font-size:11px; ">Terima Dari : <?php echo $data1->provider_name; ?></label><br>
      <label style="font-family:courier; font-size:11px; ">Attn : <?php echo $data1->provider_contact_person; ?></label><br>
      <label style="font-family:courier; font-size:11px; ">Alamat : <?php echo $data1->provider_address ?></label>
    </th>
  </tr>   
  <tr>
      <td colspan="7" style="border-style:none;border-bottom:0px solid black; text-align:center; font-size:16px;">
        <b>QC CHECKING REPORT</b>
      </td>
  </tr> 

  <tr>
      <td colspan="5" style="border-style:none;border-bottom:1px solid black; font-size:11px;">
       NOMOR : <?php echo $data1->lpb_code; ?>
      </td>
      <td colspan="2" style="border-style:none;border-bottom:1px solid black; font-size:11px;">
       SURAT JALAN NO : 
      </td>
  </tr> 
      
  <tr>
    <th class="tg-s6z2">No</th>
    <th class="tg-s6z2">Code</th>
    <th class="tg-s6z2">Description</th>
    <th class="tg-baqh">Datang</th>
    <th class="tg-baqh">Diterima</th>
    <th class="tg-baqh">Ditolak</th>
    <th class="tg-baqh">Note</th>
  </tr>
  <?php 
      $data2 = $this->db->query("SELECT * from trx_lpb_sample_detail inner join mst_product on trx_lpb_sample_detail.product_id = mst_product.product_id where lpb_id = '".$lpb."'");
      $i=1;
      $ttl=0;
      $jml=0;
      $tolak=0;
      $ssl=0;
      foreach ($data2->result() as $row) {
       
      
  ?>
  <tr>
    <td class="tg-s6z2"><?php echo $i; ?></td>
    <td class="tg-031e"><?php echo $row->product_code; ?></td>
    <td class="tg-031e"><?php echo $row->product_name; ?></td>
    <td class="tg-s6z2"><?php $jml += $row->lpb_detail_qty; echo $row->lpb_detail_datang; ?></td>
    <td class="tg-s6z2"><?php $ttl += $row->lpb_detail_datang; echo $row->lpb_detail_qty; ?></td>
    <td class="tg-s6z2"><?php $tolak = $row->lpb_detail_datang - $row->lpb_detail_qty; echo $tolak;?></td>
    <td class="tg-yw4l"><?php $ssl +=$tolak; echo $row->lpb_detail_note ?></td>
  </tr>  
  <?php $i++; }?>
  <tr>
    <td colspan="3" style="text-align:right;"><b>TOTAL</b></td>
    <td style="text-align:center;"><?php echo $ttl;  ?></td>
    <td style="text-align:center;"><?php echo $jml;  ?></td>
    <td style="text-align:center;"><?php echo $ssl;  ?></td>
    <td></td>
  </tr>
  <tr>      
      <td colspan="7" style="border-style:none;border-bottom:0px solid black; text-align:left; font-size:14px;">
        <!-- <b>Terbilang : <?php echo $terbilang; ?></b> -->
      </td>
  </tr> 
</table>
<p style="font-family:courier; font-size:12px;">BANTUL, <?php  $tgl=date('d F Y', strtotime($data1->lpb_date)); echo $tgl; ?></p>

<label style="font-family:courier; font-size:12px; ">Quality Control,</label>

<br><br><br><br>
<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;</u>
    
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