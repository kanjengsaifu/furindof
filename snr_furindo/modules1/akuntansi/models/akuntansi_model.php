<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

    class Akuntansi_model extends CI_Model{
    	
		  private $selectQuery;
      private $arrMenuData;

      public function __construct() {
          parent::__construct();
      }

      public function GetMenuAkuntansi()
      {
        
          $this->selectQuery = $this->db->query("SELECT id_modul as IDModul FROM sys_modul WHERE nama_modul='Akuntansi'");
          
          $this->arrMenuData = $this->selectQuery->row_array();
          
          $this->IDModulInduk =$this->arrMenuData['IDModul'];

          return getTreeMenuData($this->IDModulInduk, 'sys_modul', 'id_modul', 'id_modul', 'nama_modul');           
      	
      }

      public function GetKodeProgram($IDProgram)
      {

        $this->IDProgram  = $this->security->xss_clean($IDProgram);

        $this->selectQuery = $this->db->query("SELECT kode_program as KodeProgram from mst_program where id_program='".$this->IDProgram."' ");
          
        $this->arrData =  ($this->selectQuery->num_rows() > 0)  ? $this->selectQuery->row_array() : array('KodeProgram' => '');
          
        return $this->arrData['KodeProgram'];
      }

      public function GetDaftarAkun()

        {



          $this->selectQuery = $this->db->query("SELECT * FROM mst_kasbank order by kode_kasbank asc");



          $arrSelectQuery = array();



          foreach ($this->selectQuery->result_array() as $row) {

             $cek = $this->db->query("SELECT id_kasbank from mst_kasbank where id_induk = '".$row['id_kasbank']."'");

            //$strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick='dialogFormEditShow()'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button>&nbsp;<button type='button' class='btn btn-xs btn-danger'  onclick='deleteConfirmShow()'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>";
             $name = $row['nama_kasbank'];
             $nama = str_replace(" ","_",$name);
             $kd = $row['kode_kasbank'];
             $kode = str_replace(" ","_",$kd);
             $id = $row['id_kasbank'];
            if ($row['level'] == 0) {             
              $kode = "<span class='glyphicon glyphicon-home' aria-hidden='true'></span> ".$row['kode_kasbank'];
              $strDataAction ='';
            } else if ($row['level'] == 1) {              
              $kode = "&nbsp;&nbsp;<span class='glyphicon glyphicon-share' aria-hidden='true'></span> ".$row['kode_kasbank'];
              $strDataAction = "<button type='button' class='btn btn-xs btn-warning' onclick=PilihPemasukan('$kd','$nama',$id)><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Pilih</button>";
            } else if ($row['level'] == 2) {              
              $kode = "&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-share-alt' aria-hidden='true'></span> ".$row['kode_kasbank'];
            }
            

            $arrSelectQuery[] = array('idx'         => $row['id_kasbank'],
                                      
                                      'kode'        => $kode,

                                      'nama'        => $row['nama_kasbank'],

                                      'norekbank'   => $row['norek_bank'],

                                      'namabank'    => $row['nama_bank'],

                                      'notaktif'    => $row['status'],

                                      'deskripsi'   => $row['deskripsi_kasbank'],

                                      'action'      => $strDataAction

                                      );

          }



          return json_encode($arrSelectQuery);



        }

        public function GetDaftarAkuntansi()
        {
                     
            $this->selectQuery = $this->db->query("SELECT * from trx_jurnal where nobukti like '%PS%' group by nobukti ");
         
            $arrSelectQuery = array();

            foreach ($this->selectQuery->result_array() as $row) {
              $idpinjam = $row['id_jurnal'];              
              $strDataAction = "<button type='button' class='btn btn-xs btn-primary'  onclick='dialogFormPrint($idpinjam)'><span class='glyphicon glyphicon-print' aria-hidden='true'></span> Print</button>&nbsp;<button type='button' class='btn btn-xs btn-success'  onclick='dialogFormDetailShow($idpinjam)'><span class='glyphicon glyphicon-book' aria-hidden='true'></span> Detail</button>";

              $arrSelectQuery[] = array('idx'    => $row['id_jurnal'],
                                        'tgl'   => date("d-m-Y", strtotime($row['tgl'])),                                   
                                        'nomor'   => $row['nobukti'],
                                        'uraian'   => $row['memo'],
                                        'nominal' => rp($row['nominal']),                                      
                                        'action'  => $strDataAction);
            }


          return json_encode($arrSelectQuery);

        }
      

    }

