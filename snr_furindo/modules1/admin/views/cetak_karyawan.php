<?php
  ob_start();
?>
<page footer="page">

    <style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal; }
.tg .tg-yw4l{vertical-align:top}
</style>
<table class="tg" width="100%">
      
      <col style="width: 5%">
      <col style="width: 25%">
      <col style="width: 45%">
      <col style="width: 20%">

  <tr>
    <th colspan="4" style="border-style:none;">
      <?php 
        $header = $this->load->view('headerLaporan', true); 
        echo $header;
     ?> 
    </th>
  </tr> 
  <tr>
      <td colspan="4" style="border-style:none;border-bottom:1px solid black; padding-left:300px;">
        <div class="headerTitle1">DATA KARYAWAN</div>
      </td>
  </tr>
      
  <tr>
    <th class="tg-031e">No</th>
    <th class="tg-031e">Nama</th>
    <th class="tg-031e">Alamat</th>
    <th class="tg-yw4l">No Telp</th>
  </tr>
  <?php 
      $data = $this->db->query("SELECT * from mst_karyawan");
      $i=1;
      foreach ($data->result() as $row) {
       
      
  ?>
  <tr>
    <td class="tg-031e"><?php echo $i; ?></td>
    <td class="tg-031e"><?php echo $row->nama_karyawan; ?></td>
    <td class="tg-031e"><?php echo $row->alamat; ?></td>
    <td class="tg-yw4l"><?php echo $row->telp; ?></td>
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