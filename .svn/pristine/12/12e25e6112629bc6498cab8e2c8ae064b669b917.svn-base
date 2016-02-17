<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Credential_model extends CI_Model{
    	
    
        function __construct() {
            parent::__construct();
            $this->load->database();
        }
        
        public function isLoginOK($email = '', $kataSandi = '', $isFromLoginForm = false)
        {  

            $this->sessionId = ($isFromLoginForm ) ? '' : $this->session->userdata('session_id');
          
            //Pertama check sesi yang masih aktif
            $this->query = "SELECT id_user as IDUser 
                            FROM   sys_session 
                            WHERE  id_session='".$this->sessionId. "'";
                        
            $this->selectQuery = $this->db->query($this->query); 
      
            $this->isSessionFound = ($this->selectQuery->num_rows() > 0);               

            //sessi ditemukan, set IDUser
            if ($this->isSessionFound){
                $this->arrSelectQuery = $this->selectQuery->row_array();
                $this->IDUser = $this->arrSelectQuery['IDUser'];                      
            }            

            $this->email  = $this->security->xss_clean($email);
            $this->kataSandi = $this->security->xss_clean($kataSandi);       

            if ($this->isSessionFound)                
                $this->sqlWhere = "id_karyawan = '".$this->IDUser."'";
            else
                $this->sqlWhere = "email='".$this->email. "' and kata_sandi='".md5($this->kataSandi)."'";
                      
            $this->selectQuery = $this->db->query("SELECT id_karyawan AS IDUser, id_group as IDGroup    
                                                    FROM mst_karyawan   
                                                    WHERE aktif = TRUE AND ".$this->sqlWhere);
          
            if ($this->selectQuery->num_rows() > 0 ){

                $this->sessionId       = $this->session->userdata('session_id');
                $this->IpAddress       = $this->session->userdata('ip_address');
                $this->userAgent       = $this->session->userdata('user_agent');
                $this->lastActivity    = $this->session->userdata('last_activity');
                
                $this->arrSelectQuery  = $this->selectQuery->row_array();
                
                $_SESSION['IDUser']     = $this->arrSelectQuery['IDUser'];
                $_SESSION['IDGroup']    = $this->arrSelectQuery['IDGroup'];
                
                $this->IDUser           =  $this->arrSelectQuery['IDUser'];

                $qryGetSessionID = $this->db->query("select id_session from sys_session 
                                                    where id_session='".$this->sessionId."' and 
                                                          id_user = '".$this->IDUser."' and 
                                                          ip_address = '".$this->IpAddress."' and 
                                                          user_agent = '".$this->userAgent."'");

                //jika sessi tidak ditemukan, masukkan ke database
                if ($qryGetSessionID->num_rows() == 0)
                {
                    $qrySessionAdd = $this->db->query("insert into sys_session (id_session, ip_address, user_agent, id_user) 
                                                  values ('".$this->sessionId."', '".$this->IpAddress."', '".$this->userAgent."', '".$this->IDUser."') ");
                }  
     
                } //if ($selectQuery->num_rows() > 0){

                return $this->selectQuery->num_rows() > 0;
            }    

            public function sessionDestroy()
            {   
              
                $this->sessionId   = $this->session->userdata('session_id');

                $selectQuery = $this->db->query("select id_user 
                                                 from sys_session  
                                                 where id_session='". $this->sessionId. "'");                                           

                if ($selectQuery->num_rows() > 0){
                    $row = $selectQuery->row_array();
                    $this->IDUser = $row['id_user'];   
                }            

                //hapus session di database
                $query = $this->db->query("delete from sys_session 
                                           where id_session='".$this->sessionId."'
                                           and id_user ='".$this->IDUser."' ");                                
              
                //hapus semua session
                $this->session->sess_destroy();
                         
            }            
    }
