<?php
  ob_start();
?>
<page footer="page">

    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:5px 10px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; }
.tg .tg-s6z2{text-align:center}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" width="100%">
      
      <col style="width: 5%">
      <col style="width: 30%">
      <col style="width: 20%">
      <col style="width: 40%">

  <tr>
    <th colspan="4" style="border-style:none;">
      <?php 
        $header = $this->load->view('headerLaporan', true); 
        echo $header;
     ?> 
    </th>
  </tr> 
  <tr>
      <td class="tg-s6z2" colspan="4" style="border-style:none;border-bottom:1px solid black;">
        DATA KELOMPOK SWADAYA MASYARAKAT
      </td>
  </tr>
      
  <tr>
    <th class="tg-s6z2">No</th>
    <th class="tg-s6z2">Nama</th>
    <th class="tg-s6z2">Tanggal Daftar</th>
    <th class="tg-baqh">Keterangan</th>
  </tr>
  <?php 
      $data = $this->db->query("SELECT * from mst_ksm");
      $i=1;
      foreach ($data->result() as $row) {
       
      
  ?>
  <tr>
    <td class="tg-s6z2"><?php echo $i; ?></td>
    <td class="tg-031e"><?php echo $row->nama_ksm; ?></td>
    <td class="tg-s6z2"><?php echo $row->tgl_daftar; ?></td>
    <td class="tg-yw4l"></td>
  </tr>
  <?php $i++; }?>
</table>
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