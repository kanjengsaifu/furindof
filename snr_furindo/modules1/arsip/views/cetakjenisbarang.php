<?php
	ob_start();
?>
<page>
	 <style type="text/css">
    .tabelContent  {border-collapse:collapse;border-spacing:0;}
    .tabelContent td{font-family:Arial, sans-serif;font-size:10px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .tabelContent th{font-family:Arial, sans-serif;font-size:10px;font-weight:bold;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
    .headerTitle1 {font-family:arial;font-size:10px;font-weight:bold;text-align:center;padding-bottom:10px;width:100%}
    .headerTitle2 {font-family:arial;font-size:10px;text-align:left;padding-bottom:5px;width:100%}
    </style>


     <table class="tabelContent">
      
      <col style="width: 20%">
      <col style="width: 73%">

      <thead> 
         <tr>
            <th colspan="6" style="border-style:none;">
              <?php 
                $header = $this->load->view('headerLaporan', true); 
                echo $header;
             ?> 
            </th>
          </tr> 
          <tr>
              <td colspan="6" style="border-style:none;border-bottom:1px solid black;">
                <div class="headerTitle1">LAPORAN DATA JENIS BARANG</div>
              </td>
          </tr>      
         <tr>
            <td> Kode Jenis Barang</td>
            <td> Nama Jenis Barang</td>
         </tr>
      </thead>

			  <?php

        		$data = $this->db->query("select id_jenis_barang as ID, kode_jenis_barang as Kode, nama_jenis_barang as Nama 
        								  from jenis_barang 
        								  order by Kode asc");

        		foreach ($data->result_array() as $row) {
        		
     	
                    echo '<tr>
                        <td>'.$row['Kode'].'</td>
                        <td>'.$row['Nama'].'</td>
                      
                    </tr>';     
             	}
			                                    ?>                       
    </table>
    <?php $ttd = $this->db->query("SELECT * from mst_penandatanganan")->row(); ?>                 
        <table style="margin-top:20px;" class="tg">
        <tr>
          <th style="padding-left:500px;"></th>
          <th class="tg-031e">Yogyakarta, <?php echo date("d-M-Y")?></th>
        </tr>
        <tr>
          <td class="tg-yw4l"></td>
          <td class="tg-yw4l"><?php echo $ttd->jabatan ?></td>
        </tr>
        <tr>
          <td class="tg-yw4l"></td>
          <td style="padding-top:50px;" class="tg-yw4l"></td>
        </tr>
        <tr>
          <td class="tg-031e"></td>
          <td class="tg-031e">(<?php echo $ttd->nama ?>)</td>
        </tr>
        <tr>
          <td class="tg-031e"></td>
          <td class="tg-031e">NIP.<?php echo $ttd->nip ?></td>
        </tr>
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