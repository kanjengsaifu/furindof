<?php
  ob_start();
?>
<page footer="page" style="color:#012473;border-color: #012473 !important;">

    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0; border-color: #012473 !important;}
.tg td{font-family:courier, sans-serif;font-size:11px;padding:0px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color: #012473 !important;}
.tg th{font-family:courier, sans-serif;font-size:11px;font-weight:normal;padding:2px 2px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color: #012473 !important; }
.tg .tg-s6z2{text-align:center;}
.tg .tg-baqh{text-align:center;vertical-align:top;}
.tg .tg-yw4l{text-align:right;vertical-align:top;}
tr{
    border-color: red !important;
  }
  td{
    border-color: #012473 !important;
  }
  th{
    border-color: #012473 !important;
  }
</style>
<?php 
  $data1 = $this->db->query("SELECT * from trx_lpb_liquid inner join mst_provider on trx_lpb_liquid.provider_id = mst_provider.provider_id inner join trx_lpb_liquid_detail  on trx_lpb_liquid.lpb_liquid_id = trx_lpb_liquid_detail.lpb_liquid_id
    left join trx_purchase_order_liquid on trx_purchase_order_liquid.purchase_order_liquid_id = trx_lpb_liquid_detail.purchase_order_liquid_id where trx_lpb_liquid.lpb_liquid_id = '".$lpb."'")->row();
  $tgl=date('d M Y', strtotime($data1->lpb_liquid_date));
  $tgl1=date('d.m.y', strtotime($data1->purchase_order_liquid_date));
?>

<table class="tg" width="100%" style="height:-25px; color:#012473;">
      
      
      <col style="width: 40">
      <col style="width: 170">
      <col style="width: 20">
      <col style="width: 80">
      <col style="width: 100">
      <col style="width: 160"> 
      <col style="width: 5">    

   
   <tr style="color:#012473;border-color: #012473 !important;"> 
   <th colspan="1" style="border-style:none; font-size:11px; height:-10px;">&nbsp;
      <img src="<?php echo base_url().'/assets/images/logo11.png'?>" alt="Logo Bakti Husada"/>
    </th>   
    <th colspan="3" style="border-style:none; font-size:11px; height:-10px;">
      <label style="font-family:courier; font-size:11px; ">C.V. SNR EKSPOR FURINDO</label><br>
      <label style="font-family:courier; font-size:11px; ">JL. RING ROAD SELATAN, TLAJUK/WOJO RT.7/RW.11</label><br>
      <label style="font-family:courier; font-size:11px; ">BANGUN HARJO, SEWON, BANTUL, YOGYAKARTA</label><br>
      <label style="font-family:courier; font-size:11px; ">TEL/FAX: +62-274-3057199</label>
    </th>
    <th colspan="3" style="border-style:none; font-size:11px; padding-left:0px">
      <label style="font-family:courier; font-size:11px; ">Terima Dari : <?php echo $data1->provider_name; ?></label><br>
      <label style="font-family:courier; font-size:11px; ">Tanggal : <?php echo $tgl; ?></label><br>
      <label style="font-family:courier; font-size:11px; ">Attn : <?php echo $data1->provider_contact_person; ?></label><br>
      <label style="font-family:courier; font-size:11px; ">Alamat : <?php echo $data1->provider_address ?></label>
    </th>
  </tr>   
  <tr>
      <td colspan="7" style="border-style:none;border-bottom:0px solid #012473; text-align:center; font-size:16px;">
        <b>GOOD RECEIVING REPORT</b>
      </td>
  </tr> 

  <tr>
      <td colspan="4" style="border-style:none;border-bottom:1px solid #012473; font-size:11px;">
       NOMOR : <?php echo $data1->lpb_liquid_code; ?>
      </td>
      <td colspan="2" style="border-style:none;border-bottom:1px solid #012473; font-size:11px; text-align:right">
       NO NOTA : <?php echo $data1->lpb_liquid_note; ?>
      </td>
  </tr> 
      
  <tr style="color:#012473;border-color: #012473 !important;">
    <!-- <th class="tg-s6z2">No</th> -->
    <th class="tg-s6z2">Kode</th>
    <th class="tg-s6z2">Deskripsi</th>
    <th class="tg-baqh">QTY</th>
    <th class="tg-baqh">Harga @</th>
    <th class="tg-baqh">Total</th>
    <th colspan="2" class="tg-baqh">Catatan</th>
  </tr>
  <?php 
      $data = $this->db->query("SELECT * from trx_lpb_liquid_detail inner join mst_material on trx_lpb_liquid_detail.material_id = mst_material.material_id where lpb_liquid_id = '".$lpb."'");
      $i=1;
      $ttl=0;
      $jml=0;
      $price=0;
      foreach ($data->result() as $row) {
       
      
  ?>
  <tr style="color:#012473;border-color: #012473 !important;">
    <!-- <td class="tg-s6z2"><?php echo $i; ?></td> -->
    <td class="tg-031e"><?php echo $row->material_code; ?></td>
    <td class="tg-031e"><?php echo $row->material_name; ?></td>
    <td class="tg-031e"><?php $jml += $row->lpb_liquid_detail_qty; echo $row->lpb_liquid_detail_qty; ?></td>
    <td class="tg-031e"><?php echo rp($row->lpb_liquid_detail_price); ?></td>
    <td class="tg-031e"><?php $ttl = $row->lpb_liquid_detail_qty*$row->lpb_liquid_detail_price; echo rp($ttl);?></td>
    <td colspan="2" class="tg-031e"><?php $price += $ttl; $note = $data1->purchase_order_liquid_code."/ GDG-".$tgl1; echo $note; ?></td>
  </tr>  
  <?php $i++; }?>
  <tr>
    <td colspan="2" style="text-align:right;"><b>TOTAL</b></td>
    <td style="text-align:center;"><?php echo $jml;  ?></td>
    <td class="tg-031e"></td>
    <td class="tg-031e" style="padding:2px"><?php echo rp($price); ?></td>
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
        <b>: <?php echo rp($data1->lpb_liquid_biaya); ?></b>
      </td>
  </tr>
  <tr> 
      <td style="border-style:none;"></td>    
      <td colspan="2" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>Jumlah yang Harus Dibayar </b>
      </td>
      <td colspan="4" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>: <?php $bby = $data1->lpb_liquid_biaya + $price; echo rp($bby); ?></b>
      </td>
  </tr> 
  <tr>  
      <td colspan="7" style="font-family:courier; border-style:none; border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>Terbilang : <?php echo $terbilang; ?></b>        
      </td>      
  </tr>
</table>
<p style="font-family:courier; font-size:11px;">BANTUL, <?php  echo $tgl; ?></p>

<label style="font-family:courier; font-size:11px; ">Prepared By,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:11px; ">Checked By,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:11px; ">Approved By,</label>
<br><br><br><br><br>
<label style="font-family:courier; font-size:11px; ">
   (&nbsp;&nbsp;&nbsp;LUSI
   &nbsp;&nbsp;&nbsp;)
   &nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
   (&nbsp;&nbsp;&nbsp;&nbsp;ZAKARIA
   &nbsp;&nbsp;&nbsp;&nbsp;)
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
  (&nbsp;&nbsp;ENNY F ORAH&nbsp;&nbsp;) 
  </label>  
</page>
<page footer="page" style="color:#012473;border-color: #012473 !important;">

    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color: #012473 !important;}
.tg td{font-family:courier, sans-serif;font-size:11px; padding:0px 5px; border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color: #012473 !important;}
.tg th{font-family:courier, sans-serif;font-size:11px;font-weight:normal; padding:2px 2px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color: #012473 !important; }
.tg .tg-s6z2{text-align:center;border-color: #012473 !important;}
.tg .tg-baqh{text-align:center;vertical-align:top;border-color: #012473 !important;}
.tg .tg-yw4l{text-align:right;vertical-align:top;border-color: #012473 !important;}
tr{
    border-color: red !important;
  }
  td{
    border-color: #012473 !important;
  }
  th{
    border-color: #012473 !important;
  }
</style>
<?php 
  $data1 = $this->db->query("SELECT * from trx_lpb_liquid inner join mst_provider on trx_lpb_liquid.provider_id = mst_provider.provider_id inner join trx_lpb_liquid_detail  on trx_lpb_liquid.lpb_liquid_id = trx_lpb_liquid_detail.lpb_liquid_id
    left join trx_purchase_order_liquid on trx_purchase_order_liquid.purchase_order_liquid_id = trx_lpb_liquid_detail.purchase_order_liquid_id where trx_lpb_liquid.lpb_liquid_id = '".$lpb."'")->row();
  $tgl=date('d M Y', strtotime($data1->lpb_liquid_date));
  $tgl1=date('d.m.y', strtotime($data1->purchase_order_liquid_date));
?>

<table class="tg" width="100%" style="height:-25px; color:#012473;border-color: #012473 !important;">
      
      
      <col style="width: 40">
      <col style="width: 170">
      <col style="width: 20">
      <col style="width: 80">
      <col style="width: 100">
      <col style="width: 160"> 
      <col style="width: 5">    

   
   <tr style="color:#012473;border-color: #012473 !important;"> 
   <th colspan="1" style="border-style:none; font-size:11px; height:-10px;">&nbsp;
      <img src="<?php echo base_url().'/assets/images/logo11.png'?>" alt="Logo Bakti Husada"/>
    </th>   
    <th colspan="3" style="border-style:none; font-size:11px; height:-10px;">
      <label style="font-family:courier; font-size:11px; ">C.V. SNR EKSPOR FURINDO</label><br>
      <label style="font-family:courier; font-size:11px; ">JL. RING ROAD SELATAN, TLAJUK/WOJO RT.7/RW.11</label><br>
      <label style="font-family:courier; font-size:11px; ">BANGUN HARJO, SEWON, BANTUL, YOGYAKARTA</label><br>
      <label style="font-family:courier; font-size:11px; ">TEL/FAX: +62-274-3057199</label>
    </th>
    <th colspan="3" style="border-style:none; font-size:11px; padding-left:0px">
      <label style="font-family:courier; font-size:11px; ">Terima Dari : <?php echo $data1->provider_name; ?></label><br>
      <label style="font-family:courier; font-size:11px; ">Tanggal : <?php echo $tgl; ?></label><br>
      <label style="font-family:courier; font-size:11px; ">Attn : <?php echo $data1->provider_contact_person; ?></label><br>
      <label style="font-family:courier; font-size:11px; ">Alamat : <?php echo $data1->provider_address ?></label>
    </th>
  </tr>   
  <tr>
      <td colspan="7" style="border-style:none;border-bottom:0px solid #012473; text-align:center; font-size:16px;">
        <b>GOOD RECEIVING REPORT</b>
      </td>
  </tr> 

  <tr>
      <td colspan="4" style="border-style:none;border-bottom:1px solid #012473; font-size:11px;">
       NOMOR : <?php echo $data1->lpb_liquid_code; ?>
      </td>
      <td colspan="2" style="border-style:none;border-bottom:1px solid #012473; font-size:11px; text-align:right">
       NO NOTA : <?php echo $data1->lpb_liquid_note; ?>
      </td>
  </tr> 
      
  <tr style="color:#012473;border-color: #012473 !important;">
    <!-- <th class="tg-s6z2">No</th> -->
    <th class="tg-s6z2">Kode</th>
    <th class="tg-s6z2">Deskripsi</th>
    <th class="tg-baqh">QTY</th>
    <th class="tg-baqh">Harga @</th>
    <th class="tg-baqh">Total</th>
    <th colspan="2" class="tg-baqh">Catatan</th>
  </tr>
  <?php 
      $data = $this->db->query("SELECT * from trx_lpb_liquid_detail inner join mst_material on trx_lpb_liquid_detail.material_id = mst_material.material_id where lpb_liquid_id = '".$lpb."'");
      $i=1;
      $ttl=0;
      $jml=0;
      $price=0;
      foreach ($data->result() as $row) {
       
      
  ?>
  <tr style="color:#012473;border-color: #012473 !important;">
    <!-- <td class="tg-s6z2"><?php echo $i; ?></td> -->
    <td class="tg-031e"><?php echo $row->material_code; ?></td>
    <td class="tg-031e"><?php echo $row->material_name; ?></td>
    <td class="tg-031e"><?php $jml += $row->lpb_liquid_detail_qty; echo $row->lpb_liquid_detail_qty; ?></td>
    <td class="tg-031e"><?php rp($row->lpb_liquid_detail_price); ?></td>
    <td class="tg-031e"><?php $ttl = $row->lpb_liquid_detail_qty*$row->lpb_liquid_detail_price;  rp($ttl);?></td>
    <td colspan="2" class="tg-031e"><?php $price += $ttl; $note = $data1->purchase_order_liquid_code."/ GDG-".$tgl1; echo $note; ?></td>
  </tr>  
  <?php $i++; }?>
  <tr>
    <td colspan="2" style="text-align:right;"><b>TOTAL</b></td>
    <td style="text-align:center;"><?php echo $jml;  ?></td>
    <td class="tg-031e"></td>
    <td class="tg-031e" style="padding:2px"><?php  rp($price); ?></td>
    <td></td>
  </tr>
  <!-- <tr>  
      <td style="border-style:none;"></td>    
      <td colspan="2" style="font-family:courier; border-style:none; border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>Terbilang : <?php echo $terbilang; ?></b>
        <b>TOTAL </b>
      </td>
      <td colspan="4" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>: <?php  rp($price); ?></b>
      </td>
  </tr>
  <tr>   
      <td style="border-style:none;"></td>    
      <td colspan="2" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>Biaya Kirim </b>
      </td>
      <td colspan="4" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>: <?php  rp($data1->lpb_liquid_biaya); ?></b>
      </td>
  </tr>
  <tr> 
      <td style="border-style:none;"></td>    
      <td colspan="2" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>Jumlah yang Harus Dibayar </b>
      </td>
      <td colspan="4" style="font-family:courier; border-style:none;border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>: <?php $bby = $data1->lpb_liquid_biaya + $price;  rp($bby); ?></b>
      </td>
  </tr> 
  <tr>  
      <td colspan="7" style="font-family:courier; border-style:none; border-bottom:0px solid black; text-align:left; font-size:12px;">
        <b>Terbilang : <?php  $terbilang; ?></b>        
      </td>      
  </tr> -->
</table>
<p style="font-family:courier; font-size:11px;">BANTUL, <?php  echo $tgl; ?></p>

<label style="font-family:courier; font-size:11px; ">Prepared By,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:11px; ">Checked By,</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label style="font-family:courier; font-size:11px; ">Approved By,</label>
<br><br><br><br><br>
<label style="font-family:courier; font-size:11px; ">
   (&nbsp;&nbsp;&nbsp;LUSI
   &nbsp;&nbsp;&nbsp;)
   &nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
   (&nbsp;&nbsp;&nbsp;&nbsp;ZAKARIA
   &nbsp;&nbsp;&nbsp;&nbsp;)
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   
  (&nbsp;&nbsp;ENNY F ORAH&nbsp;&nbsp;) 
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