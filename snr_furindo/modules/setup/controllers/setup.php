<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');

	class Setup extends MY_Controller {
	    
	  	private $IDSumberDana;

	    public function __construct() 
	    {
			parent::__construct();
			$this->load->helper('func_helper');
		}
	         
		public function index()
		{	
 			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->load->model('setup_model', 'ModelSetup');
            $dataMenu = array('dataMenu' => $this->ModelSetup->GetMenuSetup());
                    
            $menu    = $this->load->view('menu_setup_view', $dataMenu, true);
            $content  = $this->load->view('dashboard_view', '', true);
        
            $arrData = array('menu'     => $menu,
                             'content'  => $content);

            echo json_encode($arrData);

		}

		public function KasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();


            $content = $this->load->view('master_kasbank_view', '', true);
            // $content = $this->load->view('chart', '', true);

                          

            echo $content;

		}



		public function GetDaftarKasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();

            

            $this->load->model('setup_model', 'ModelJenisPemda');

            

            echo $this->ModelJenisPemda->GetDaftarKasBank(); 

		}

		public function TambahKasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            //$this->form_validation->set_rules('matauang', 'Mata uang', 'trim|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('kodebaru', 'Kode Kas Bank', 'trim|is_unique[mst_kasbank.kode_kasbank]|required|min_length[1]|xss_clean');

    		$this->form_validation->set_rules('namabaru', 'Nama Kas Bank', 'trim|required|xss_clean');

    		

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('kodebaru').form_error('namabaru');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				
				$this->kode 		= $this->input->post('kodebaru', true); 	

				$this->nama 		= $this->input->post('namabaru', true);

				$this->induk 	= $this->input->post('induk', true);

				$this->status 	= $this->input->post('status', true);

				$this->deskripsi 	= $this->input->post('deskripsibaru', true);



				$arrData = array('kode_kasbank' 	 => $this->kode,

								 'nama_kasbank' 	 => $this->nama,

								 'induk'	 => $this->induk,

								 'status'	 => $this->status,

								 'deskripsi_kasbank' => $this->deskripsi);



	            $messageData = $this->load->model('setup_model', 'ModelJenisPemda');

	            $messageData = $this->ModelJenisPemda->TambahKasBank($arrData);

	            echo $messageData;

        	}

		}



		public function UbahKasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



            //$this->form_validation->set_rules('ID', 'ID KasBank', 'trim|required|xss_clean');            

    		$this->form_validation->set_rules('kodeUbah', 'Kode KasBank', 'trim|required|xss_clean');

    		$this->form_validation->set_rules('namaUbah', 'Nama KasBank', 'trim|required|xss_clean');

	

			if ( ! $this->form_validation->run() )

			{				

				$errorMessage = form_error('ID').form_error('mataUangUbah').form_error('kodeUbah').form_error('namaUbah');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');

				echo $messageData;

			}

			else

			{

				$this->ID 			= $this->input->post('ID', true); 					

				$this->kode 		= $this->input->post('kodeUbah', true); 	

				$this->nama 		= $this->input->post('namaUbah', true);

				$this->notAktif 	= $this->input->post('notAktifUbah', true);

				$this->deskripsi 	= $this->input->post('deskripsiUbah', true);

				

				$arrData = array('idx' 	     => $this->ID,

								 'kode' 	 => $this->kode,

								 'nama' 	 => $this->nama,

								 'notAktif'	 => $this->notAktif,

								 'deskripsi' => $this->deskripsi);

			

	            $messageData = $this->load->model('setup_model', 'ModelJenisPemda');

	            $messageData = $this->ModelJenisPemda->UbahKasBank($arrData);

	            echo $messageData;

        	}

		}



		public function HapusKasBank()

		{

			$this->checkCredentialAccess();



            $this->checkIsAjaxRequest();



			$this->ID = $this->input->post('ID', true);

			

            $messageData = $this->load->model('setup_model', 'ModelJenisPemda');

            $messageData = $this->ModelJenisPemda->HapusKasBank($this->ID);

            echo $messageData;

			

		}	

//--------------------------------------------------END KAS BANK ---------------------------------------------------------------------------------
	   
	    public function GroupUser()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
    
            $content = $this->load->view('master_group_view', '', true);
                          
            echo $content;

		}

		public function GetDaftarGroupUser()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->load->model('master_group_model', 'ModelDaftarGroupUser');
	        $arrDaftarGroupUser = $this->ModelDaftarGroupUser->GetDaftarGroupUser();
	        
	        $i=0; 
	        $strDaftarGroupUser = '';

        	foreach($arrDaftarGroupUser as $row){
       
        	 	$strDaftarGroupUser.='<tr role="row">
				  					  <td class="sorting_'.$i.'"><span class="sr-only">'.$row['IDGroup'].'</span><span>'.$row['NamaGroup'].'</span></td>
				  					  <td>'.$row['Deskripsi'].'</td>
				  					  <td>
				  						<button type="button" class="btn btn-xs btn-warning" onclick="dialogFormEditShow(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
				  						<button type="button" class="btn btn-xs btn-danger"  onclick="deleteConfirmShow(this)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
				  					  </td>
				  				      </tr>';
				$i++;  				      
  			}	

	  		echo $strDaftarGroupUser;	
		}

		public function TambahGroup()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

    		$this->form_validation->set_rules('namaGroup', 'Nama Group', 'trim|is_unique[sys_group.nama_group]|required|min_length[2]|max_length[15]|xss_clean');
			$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|xss_clean');
	
			if ( ! $this->form_validation->run() )
			{				

				$errorMessage = form_error('namaGroup');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->namaGroup =  $this->input->post('namaGroup', true);
				$this->deskripsi =  $this->input->post('deskripsi', true);

	            $messageData = $this->load->model('master_group_model', 'ModelTambahGroup');
	            $messageData = $this->ModelTambahGroup->TambahGroup($this->namaGroup, $this->deskripsi);
	            echo $messageData;
        	}
		}

		public function UbahGroup()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

    		$this->form_validation->set_rules('namaGroupUbah', 'Nama Group', 'trim|required|min_length[2]|max_length[15]|xss_clean');
    		$this->form_validation->set_rules('IDGroupUbah', 'ID Group ', 'trim|required|xss_clean');
			$this->form_validation->set_rules('deskripsiUbah', 'Deskripsi', 'trim|xss_clean');
	
			if ( ! $this->form_validation->run() )
			{				

				$errorMessage = form_error('namaGroupUbah');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->namaGroup 	=  $this->input->post('namaGroupUbah', true);
				$this->deskripsi 	=  $this->input->post('deskripsiUbah', true);
				$this->IDGroupUbah 	=  $this->input->post('IDGroupUbah', true);

	            $messageData = $this->load->model('master_group_model', 'ModelUbahGroup');
	            $messageData = $this->ModelUbahGroup->UbahGroup($this->IDGroupUbah, $this->namaGroup, $this->deskripsi);
	            echo $messageData;

        	}

		}

		public function HapusGroup()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->IDGroup =   $this->input->post('IDGroup', true);
			
            $messageData = $this->load->model('master_group_model', 'ModelHapusGroup');
            $messageData = $this->ModelHapusGroup->HapusGroup($this->IDGroup);
            echo $messageData;
			
		}

		public function CariGroup()
	    {
	    	$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|min_length[2]|xss_clean');
	
			if ( ! $this->form_validation->run() )
			{				

				$errorMessage = form_error('kategori');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->kategori 	=  $this->input->post('kategori', true);
				$this->kataKunci 	=  $this->input->post('kataKunci', true);
	            
	            $this->load->model('master_group_model', 'ModelCariGroup');
		        $arrDaftarCariGroup = $this->ModelCariGroup->GetCariGroup($this->kategori, $this->kataKunci);
		        
		        $i=0; 
		        $strDaftarGroupUser = '';

	        	foreach($arrDaftarCariGroup as $row){

	        	 	$strDaftarGroupUser.='<tr role="row">
					  					  <td class="sorting_'.$i.'"><span class="sr-only">'.$row['IDGroup'].'</span><span>'.$row['NamaGroup'].'</span></td>
					  					  <td>'.$row['Deskripsi'].'</td>
					  					  <td>
					  						<button type="button" class="btn btn-xs btn-warning" onclick="dialogFormEditShow(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
					  						<button type="button" class="btn btn-xs btn-danger"  onclick="deleteConfirmShow(this)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
					  					  </td>
					  				      </tr>';
					$i++;  				      
	  			}	

	  			echo $strDaftarGroupUser;

        	}	    	
	    }

		public function User()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
    
            $this->load->model('group_user_model', 'ModelGroupUser');
            $data = array('daftarGroupUser' => $this->ModelGroupUser->GetDaftarGroupUser());

            $content = $this->load->view('master_user_view', $data, true);                

            echo  $content;
		}

		public function TambahUser()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
    
            $this->form_validation->set_rules('namaLengkap', 'Nama Lengkap', 'trim|required|min_length[2]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('namaUser', 'Nama User', 'trim|required|is_unique[sys_user.nama_user]|xss_clean');
			$this->form_validation->set_rules('kataSandi', 'Kata Sandi', 'trim|required|min_length[5]|max_length[100]|matches[kataSandiKonfirmasi]|md5|xss_clean');
			$this->form_validation->set_rules('kataSandiKonfirmasi', 'Kata Sandi Konfirmasi', 'trim|required|min_length[5]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('userGroup', 'Group User', 'trim|required|min_length[1]|max_length[2]|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|valid_email|xss_clean');
	
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('namaLengkap').
								form_error('namaUser').
								form_error('kataSandi').
								form_error('kataSandiKonfirmasi').
								form_error('userGroup').
								form_error('email').
								form_error('uptd');

				$messageData  = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->namaLengkap = $this->input->post('namaLengkap', true);
			    $this->namaUser    = $this->input->post('namaUser', true);
			    $this->kataSandi   = $this->input->post('kataSandi', true);
			    $this->userGroup   = $this->input->post('userGroup', true);
			    $this->uptd 	   = $this->input->post('uptd', true);
			    $this->email       = $this->input->post('email', true);

			    $this->dataTambahUser = array('namaLengkap' => $this->namaLengkap,
			    							  'namaUser' 	=> $this->namaUser,
			    							  'kataSandi' 	=> $this->kataSandi,
			    							  'userGroup' 	=> $this->userGroup,
			    							  'uptd' 		=> $this->uptd,
			    							  'email' 		=> $this->email);

            	$this->load->model('master_user_model', 'ModelTambahUser');
        		$messageData = $this->ModelTambahUser->TambahUser($this->dataTambahUser);

	            echo $messageData;
          	}
		}

		public function GetDaftarUser()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->load->model('master_user_model', 'ModelDaftarUser');
	        $arrDaftarUser = $this->ModelDaftarUser->GetDaftarUser();
	        
	        $i=0; 
	        $strDaftarGroupUser = '';

        	foreach($arrDaftarUser as $row){
        		
        		$userAktif = ($row['Aktif'] == 1) ? 'Ya' : 'Tidak';

        	 	$strDaftarGroupUser.='<tr role="row">
				  					  <td class="sorting_'.$i.'"><span class="sr-only">'.$row['IDUser'].'</span><span>'.$row['NamaUser'].'</span></td>
				  					  <td>'.$row['NamaLengkap'].'</td>
				  					  <td>'.$row['Email'].'</td>
				  					  <td><span class="sr-only">'.$row['IDGroup'].'</span><span class="sr-only">'.$row['IDUPTD'].'</span><span class="sr-only">'.$row['LevelKerja'].'</span><span>'.$row['NamaGroup'].'</span></td>
				  					  <td>'.$userAktif.'</td>
				  					  <td>
				  						<button type="button" class="btn btn-xs btn-warning" onclick="dialogFormEditShow(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
				  						<button type="button" class="btn btn-xs btn-danger"  onclick="deleteConfirmShow(this)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
				  					  </td>
				  				      </tr>';
				$i++;  				      
  			}	

	  		echo $strDaftarGroupUser;	
		}

		public function UbahUser()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

    		$this->form_validation->set_rules('namaLengkapUbah', 'Nama Lengkap', 'trim|required|min_length[2]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('namaUserUbah', 'Nama User', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kataSandiUbah', 'Kata Sandi', 'trim|min_length[5]|max_length[100]|matches[kataSandiKonfirmasiUbah]|md5|xss_clean');
			$this->form_validation->set_rules('kataSandiKonfirmasiUbah', 'Kata Sandi Konfirmasi', 'trim|min_length[5]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('userGroupUbah', 'Group User', 'trim|required|min_length[1]|max_length[2]|xss_clean');
			$this->form_validation->set_rules('emailUbah', 'Email', 'trim|required|min_length[5]|max_length[100]|valid_email|xss_clean');
			//$this->form_validation->set_rules('aktif', 'Aktif', 'trim|required|min_length[1]|xss_clean');

			if ( ! $this->form_validation->run() )
			{				

				$errorMessage = form_error('namaLengkapUbah').
								form_error('namaUserUbah').
								form_error('kataSandiUbah').
								form_error('kataSandiKonfirmasiUbah').
								form_error('userGroupUbah').
								form_error('emailUbah');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
			
				$this->IDUser       = $this->input->post('IDUserUbah', true);	
				$this->namaLengkap  = $this->input->post('namaLengkapUbah', true);
			    $this->namaUser     = $this->input->post('namaUserUbah', true);
			    $this->kataSandi    = $this->input->post('kataSandiUbah', true);
			    $this->userGroup    = $this->input->post('userGroupUbah', true);
			    $this->uptd 	    = $this->input->post('uptd', true);
			    $this->email        = $this->input->post('emailUbah', true);
			    $this->aktif 		= $this->input->post('aktif', true);

			    $this->dataUbahUser = array(  'IDUser'	    => $this->IDUser,
			    							  'namaLengkap' => $this->namaLengkap,
			    							  'namaUser' 	=> $this->namaUser,
			    							  'kataSandi' 	=> $this->kataSandi,
			    							  'userGroup' 	=> $this->userGroup,
			    							  'uptd' 		=> $this->uptd,
			    							  'email' 		=> $this->email,
			    							  'aktif'		=> $this->aktif);

	            $messageData = $this->load->model('master_user_model', 'ModelUbahUser');
	            $messageData = $this->ModelUbahUser->UbahUser($this->dataUbahUser);
	            echo $messageData;

        	}

		}

		public function HapusUser()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->IDUser =   $this->input->post('IDUser', true);
			
            $messageData = $this->load->model('master_user_model', 'ModelHapuUser');
            $messageData = $this->ModelHapuUser->HapusUser($this->IDUser);
            echo $messageData;
			
		}

		public function CariUser()
	    {
	    	$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|min_length[2]|xss_clean');
	
			if ( ! $this->form_validation->run() )
			{				

				$errorMessage = form_error('kategori');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->kategori 	=  $this->input->post('kategori', true);
				$this->kataKunci 	=  $this->input->post('kataKunci', true);
	            
	            $this->load->model('master_user_model', 'ModelCariUser');
		        $arrDaftarUser = $this->ModelCariUser->GetCariUser($this->kategori, $this->kataKunci);
		        
		        $i=0; 
		        $strDaftarUser = '';

	        	foreach($arrDaftarUser as $row){
	        		
	        		$userAktif = ($row['Aktif'] == '1') ? 'Ya' : 'Tidak';

	        	 	$strDaftarUser.='<tr role="row">
				  					  <td class="sorting_'.$i.'"><span class="sr-only">'.$row['IDUser'].'</span><span>'.$row['NamaUser'].'</span></td>
				  					  <td>'.$row['NamaLengkap'].'</td>
				  					  <td>'.$row['Email'].'</td>
				  					   <td><span class="sr-only">'.$row['IDGroup'].'</span><span>'.$row['NamaGroup'].'</span></td>
				  					   <td>'.$userAktif.'</td>
				  					  <td>
				  						<button type="button" class="btn btn-xs btn-warning" onclick="dialogFormEditShow(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
				  						<button type="button" class="btn btn-xs btn-danger"  onclick="deleteConfirmShow(this)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
				  					  </td>
				  				      </tr>';
					$i++;  				      
	  			}	

	  			echo $strDaftarUser;

        	}	    	
	    }

		public function UserModul()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

    		$this->load->model('group_user_model', 'ModelGroupUser');
            $data = array('daftarGroupUser' => $this->ModelGroupUser->GetDaftarGroupUser());

            $content = $this->load->view('master_user_modul_view', $data, true);
                 
            echo $content;

		}

		public function SetUserModul()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
    
    		$this->form_validation->set_rules('userGroupTreeviewData', 'User Modul', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('userGroup', 'Group User', 'trim|required|xss_clean');

			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('userGroupTreeviewData').form_error('userGroup');
				$messageData  = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->dataTreeView = $this->input->post('userGroupTreeviewData', true);
			    $this->userGroup   = $this->input->post('userGroup', true);

            	$messageData = $this->load->model('master_user_modul_model', 'ModelTambahUserModul');
        		$messageData = $this->ModelTambahUserModul->SetUserModul($this->dataTreeView, $this->userGroup);
	            echo $messageData;
			}

		}       

		public function CariUserModul()
	    {
	    	$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|min_length[2]|xss_clean');
	
			if ( ! $this->form_validation->run() )
			{				

				$errorMessage = form_error('kategori');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->kategori 	=  $this->input->post('kategori', true);
				$this->kataKunci 	=  $this->input->post('kataKunci', true);
	            
	            $this->load->model('master_user_modul_model', 'ModelCariUserModul');
		        $arrDaftarUserModul = $this->ModelCariUserModul->CariUserModul($this->kategori, $this->kataKunci);
		        
		        $i=0; 
		        $strDaftarUserModul = '';

	        	foreach($arrDaftarUserModul as $row){

	        	 	$strDaftarUserModul.='<tr role="row">
					  					  <td class="sorting_'.$i.'"><span class="sr-only">'.$row['IDGroup'].'</span><span>'.$row['NamaGroup'].'</span></td>
					  					  <td>'.$row['JmlUser'].'</td> 
					  					  <td>
					  						<button type="button" class="btn btn-xs btn-success" onclick="dialogFormEditShow(this)"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Set</button>
					  						<button type="button" class="btn btn-xs btn-warning"  onclick="deleteConfirmShow(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Ubah</button>
					  					  </td>
					  				      </tr>';
					$i++;  				      
	  			}	

	  			echo $strDaftarUserModul;

        	}	    	
	    }

		public function GetDaftarGroupUserModul()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

	  		$IDGroup = $this->input->post('IDGroup', true);
			$this->load->model('master_user_modul_model', 'ModelDaftarUserGroup');
            $data = $this->ModelDaftarUserGroup->GetDaftarUserModul($IDGroup);
            
            foreach ($data as $row) {
            	echo "<li class='list-group-item'><span class='glyphicon glyphicon-user' aria-hidden='true'></span>&nbsp;<label>".$row['NamaUser']."</label></li>";
            } 	

        	$this->load->model('master_user_modul_model', 'ModelDaftarAksesUserModul');
        	$dataAksesUserModul = $this->ModelDaftarAksesUserModul->GetDaftarAksesUserModul($IDGroup);

        	//data akses user modul
        	$aksesUserModul = '';
        	foreach ($dataAksesUserModul as $rowAksesUserModul) {
        		$aksesUserModul.= $rowAksesUserModul['IDModul'].',';
        	}

        	$aksesUserModul = substr($aksesUserModul, 0, strlen($aksesUserModul) - 1);

        	echo "<script>$('#userGroupTreeviewData').val('".$aksesUserModul."');</script>";
            	
		}

	    public function GetDaftarUserModul(){
	    	
	    	$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();			
	    
	    	$fieldList = "id_modul as IDModul, kode_modul as KodeModul, nama_modul as NamaModul, header as Header, modul_report as IsModulReport";
   			$dataList	= array('IDModul', 'KodeModul', 'NamaModul', 'Header', 'IsModulReport');
			$actionList = '';

            echo getTreeGridMenu('', $fieldList, $dataList, $actionList, 'sys_modul', 'IDModul', 'KodeModul', 'NamaModul');    	

	    }


	    public function SumberDana()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
    
            $this->load->model('master_sumber_dana_model', 'ModelSumberDana');
            $data = array('daftarSumberDana' => $this->ModelSumberDana->GetDaftarSumberDana());

            $content = $this->load->view('master_sumber_dana_view', $data, true);                

            echo  $content;
		}

		public function TambahSumberDana()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
    
            $this->form_validation->set_rules('namaSumberDana', 'Nama Sumber Dana', 'trim|required|min_length[2]|max_length[200]|xss_clean');
			
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('namaSumberDana');
				$messageData  = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->namaSumberDana = $this->input->post('namaSumberDana', true);
			  
            	$messageData = $this->load->model('master_sumber_dana_model', 'ModelTambahSumberDana');
        		$messageData = $this->ModelTambahSumberDana->TambahSumberDana($this->namaSumberDana);
	            echo $messageData;
          	}
		}

		public function GetDaftarSumberDana()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->load->model('master_sumber_dana_model', 'ModelDaftarSumberDana');
	        $arrDaftarSumberDana = $this->ModelDaftarSumberDana->GetDaftarSumberDana();
	        
	        $i=0; 
	        $strDaftarGroupUser = '';

        	foreach($arrDaftarSumberDana as $row){

        	 	$strDaftarGroupUser.='<tr role="row">
				  					  <td class="sorting_'.$i.'"><span class="sr-only">'.$row['IDSumberDana'].'</span><span>'.$row['NamaSumberDana'].'</span></td>			 
				  					  <td>
				  						<button type="button" class="btn btn-xs btn-warning" onclick="dialogFormEditShow(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
				  						<button type="button" class="btn btn-xs btn-danger"  onclick="deleteConfirmShow(this)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
				  					  </td>
				  				      </tr>';
				$i++;  				      
  			}	

	  		echo $strDaftarGroupUser;	
		}

		public function UbahSumberDana()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

    		$this->form_validation->set_rules('namaSumberDanaUbah', 'Nama Sumber Dana', 'trim|required|min_length[2]|max_length[200]|xss_clean');
		

			if ( ! $this->form_validation->run() )
			{				

				$errorMessage = $errorMessage = form_error('namaSumberDanaUbah');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->IDSumberDana    	=  $this->input->post('IDSumberDana', true);	
				$this->namaSumberDana 	=  $this->input->post('namaSumberDanaUbah', true);
				
	            $messageData = $this->load->model('master_sumber_dana_model', 'ModelUbahSumberDana');
	            $messageData = $this->ModelUbahSumberDana->UbahSumberDana($this->IDSumberDana, $this->namaSumberDana);

        	}

		}

		public function HapusSumberDana()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->IDSumberDana =   $this->input->post('IDSumberDana', true);
			
            $messageData = $this->load->model('master_sumber_dana_model', 'ModelHapusSumberDana');
            $messageData = $this->ModelHapusSumberDana->HapusSumberDana($this->IDSumberDana);
            echo $messageData;
			
		}

		public function CariSumberDana()
	    {
	    	$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|min_length[2]|xss_clean');
	
			if ( ! $this->form_validation->run() )
			{				

				$errorMessage = form_error('kategori');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->kategori 	=  $this->input->post('kategori', true);
				$this->kataKunci 	=  $this->input->post('kataKunci', true);
	            
	            $this->load->model('master_sumber_dana_model', 'ModelCariSumberDana');
		        $arrDaftarCariSumberDana = $this->ModelCariSumberDana->GetCariSumberDana($this->kategori, $this->kataKunci);
		        
		        $i=0; 
		        $strDaftarGroupUser = '';

	        	foreach($arrDaftarCariSumberDana as $row){

	        	 	$strDaftarGroupUser.='<tr role="row">
					  					  <td class="sorting_'.$i.'"><span class="sr-only">'.$row['IDSumberDana'].'</span><span>'.$row['NamaSumberDana'].'</span></td>
					  					  <td>
					  						<button type="button" class="btn btn-xs btn-warning" onclick="dialogFormEditShow(this)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
					  						<button type="button" class="btn btn-xs btn-danger"  onclick="deleteConfirmShow(this)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
					  					  </td>
					  				      </tr>';
					$i++;  				      
	  			}	

	  			echo $strDaftarGroupUser;

        	}	    	
	    }


	   	public function PeriodeAkuntansi()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
    
            $this->load->model('periode_akuntansi_model', 'ModelPeriodeAkuntansi');
            $this->load->model('date_model', 'ModelBulan');
           	$data = array('dataPeriodeAkuntansi' => $this->ModelPeriodeAkuntansi->GetPeriodeAkuntansi(),
           				  'dataDaftarBulan' => $this->ModelBulan->GetDaftarBulan());

            $content = $this->load->view('periode_akuntansi_view', $data, true);                

            echo  $content;
		}

		public function SetPeriodeAkuntansi()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
			
			$this->form_validation->set_rules('tahunPeriode', 'Tahun periode', 'trim|required|min_length[4]|max_length[4]|xss_clean');
			$this->form_validation->set_rules('bulanAwalPeriode', 'Bulan Awal', 'trim|required|min_length[1]|max_length[2]|xss_clean');
			$this->form_validation->set_rules('bulanAkhirPeriode', 'Bulan Akhir', 'trim|required|min_length[1]|max_length[2]|xss_clean');
	
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('tahunPeriode').
								form_error('bulanAwalPeriode').
								form_error('bulanAkhirPeriode');

				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				
				$this->tahunPeriode			=	$this->input->post('tahunPeriode', true);
				$this->bulanAwalPeriode		=	$this->input->post('bulanAwalPeriode', true);
				$this->bulanAkhirPeriode	=	$this->input->post('bulanAkhirPeriode', true);

            	$this->load->model('periode_akuntansi_model', 'ModelPeriodeAkuntansi');
           		$messageData = $this->ModelPeriodeAkuntansi->SetPeriodeAkuntansi($this->tahunPeriode, $this->bulanAwalPeriode, $this->bulanAkhirPeriode);

            	echo $messageData;
        	}
		}

		public function UserUnitKerja()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
	
    		$this->load->model('group_user_model', 'ModelGroupUser');
            $data = array('daftarGroupUser' => $this->ModelGroupUser->GetDaftarGroupUser());

            $content = $this->load->view('user_unit_kerja_view', $data, true);
                 
            echo $content;

		}

		public function SetUserUnitKerja()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
    
    		$this->form_validation->set_rules('aksesUserUnitKerjaTreeData', 'Akses User Unit Kerja', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('IDUserUnitKerjaTreeData', 'User Unit Kerja', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('userGroup', 'Group User', 'trim|required|xss_clean');


			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('aksesUserUnitKerjaTreeData').
								form_error('IDUserUnitKerjaTreeData').
								form_error('userGroup');
								
				$messageData  = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->dataTreeView = $this->input->post('aksesUserUnitKerjaTreeData', true);
			    $this->IDUser   	= $this->input->post('IDUserUnitKerjaTreeData', true);
			    $this->userGroup   	= $this->input->post('userGroup', true);

            	$messageData = $this->load->model('user_unit_kerja_model', 'ModelUserUnitKerja');
        		$messageData = $this->ModelUserUnitKerja->SetUserUnitKerja($this->dataTreeView, $this->userGroup, $this->IDUser);
	            echo $messageData;
			}

		}       

	    public function GetDaftarUserUnitKerja(){
	    	
	    	$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();			
	    
	    	$fieldList = "id_modul as IDModul, kode_modul as KodeModul, nama_modul as NamaModul, header as Header";
   			$dataList	= array('IDModul', 'KodeModul', 'NamaModul');
			$actionList = '<input type=\"checkbox\" id=\"baru\">&nbsp;Baru</input>&nbsp;<input type=\"checkbox\" id=\"ubah\">&nbsp;Ubah</input>&nbsp;<input type=\"checkbox\" id=\"hapus\">&nbsp;Hapus</input>';

            echo getTreeGridMenu('', $fieldList, $dataList, $actionList, 'sys_modul', 'IDModul', 'KodeModul', 'NamaModul');    	

	    }

		public function UPTD()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->load->model("master_uptd_model", "ModelMasterUPTD");
            $this->dataBrowseUPTD = array('dataBrowseUPTD' => $this->ModelMasterUPTD->BrowseDaftarUPTD());
    
           	$content = $this->load->view('master_uptd_view', $this->dataBrowseUPTD, true);                

            echo  $content;
		}

		public function TambahUPTD()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
    
            $this->form_validation->set_rules('kodeUPTD', 'Kode UPTD', 'trim|required|is_unique[mst_uptd.kode_uptd]|max_length[20]|xss_clean');
			$this->form_validation->set_rules('namaUPTD', 'Nama UPTDa', 'trim|required|max_length[50]|xss_clean');
			
	    	if ( ! $this->form_validation->run() )
			{	
				$errorMessage = form_error('kodeUPTD').form_error('namaUPTD');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;				
			}
			else
			{
				$this->kodeUPTD 	= $this->input->post('kodeUPTD', true);
				$this->namaUPTD 	= $this->input->post('namaUPTD', true);
				$this->npwp 		= $this->input->post('npwp', true);
				$this->namaPimpinan = $this->input->post('namaPimpinan', true);
				$this->nip 			= $this->input->post('nip', true);
				$this->alamat 		= $this->input->post('alamat', true);
				$this->kodePos 		= $this->input->post('kodePos', true);
				$this->telepon 		= $this->input->post('telepon', true);
				$this->fax 			= $this->input->post('fax', true);
				$this->email 		= $this->input->post('email', true);
				$this->website 		= $this->input->post('website', true);
		
				//check kode UPTD
				$this->load->model("master_uptd_model", "ModelMasterUPTD"); 
				$this->arrDaftarValidUPTD  = $this->ModelMasterUPTD->BrowseDaftarUPTD();
				
				$isFound = false;
				foreach ($this->arrDaftarValidUPTD as $row) {
					if (in_array($this->kodeUPTD, $row, true) ){
						$isFound = true;
					}
				}

				if (!$isFound){
					$errorMessage = 'Kode UPTD tidak terdaftar';
					$messageData = ConstructMessageResponse($errorMessage , 'warning');
					echo $messageData;
					exit;
				}

				$this->dataUPTD = array( 'kodeUPTD' 	=> $this->kodeUPTD,
									  	 'namaUPTD' 	=> $this->namaUPTD,
									  	 'npwp' 		=> $this->npwp,
									  	 'namaPimpinan' => $this->namaPimpinan,
									  	 'nip'			=> $this->nip,
									  	 'alamat'		=> $this->alamat,
									  	 'kodePos'		=> $this->kodePos,
									  	 'telepon'		=> $this->telepon,
									  	 'fax'			=> $this->fax,
									  	 'email'	 	=> $this->email,
									  	 'website' 		=> $this->website
										);
				$this->load->model('master_uptd_model', 'ModelUPTD');
	          	$message = $this->ModelUPTD->TambahUPTD($this->dataUPTD);
	     
			}
            
		}

		public function GetDaftarUPTD()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();
            
            $this->load->model("master_uptd_model", "ModelMasterUPTD");
            
            echo $this->ModelMasterUPTD->GetDaftarUPTD(); 
		}

		public function BrowseDaftarUPTD()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->load->model("master_uptd_model", "ModelMasterUPTD");

            return $this->ModelMasterUPTD->BrowseDaftarUPTD(); 
        }

		public function UbahUPTD()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

    		$this->form_validation->set_rules('kodeUPTDUbah', 'Kode UPTD', 'trim|required|max_length[20]|xss_clean');
			$this->form_validation->set_rules('namaUPTDUbah', 'Nama ', 'trim|required|max_length[100]|xss_clean');
			
	    	if ( ! $this->form_validation->run() )
			{	
				$errorMessage = form_error('kodeUPTDUbah').form_error('namaUPTDUbah');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;				
			}
			else
			{
				$this->IDUPTD     		= $this->input->post('IDUPTD', true);
				$this->kodeUPTD 		= $this->input->post('kodeUPTDUbah', true);
				$this->namaUPTD 		= $this->input->post('namaUPTDUbah', true);
				$this->npwp 			= $this->input->post('npwpUbah', true);
				$this->namaPimpinan 	= $this->input->post('namaPimpinanUbah', true);
				$this->nip 				= $this->input->post('nipUbah', true);
				$this->alamat 			= $this->input->post('alamatUbah', true);
				$this->kodePos 			= $this->input->post('kodePosUbah', true);
				$this->telepon 			= $this->input->post('teleponUbah', true);
				$this->fax 				= $this->input->post('faxUbah', true);
				$this->email 			= $this->input->post('emailUbah', true);
				$this->website 			= $this->input->post('websiteUbah', true);
				
				//check kode UPTD
				$this->load->model("master_uptd_model", "ModelMasterUPTD"); 
				$this->arrDaftarValidUPTD  = $this->ModelMasterUPTD->BrowseDaftarUPTD();
				
				$isFound = false;
				foreach ($this->arrDaftarValidUPTD as $row) {
					if (in_array($this->kodeUPTD, $row, true) ){
						$isFound = true;
					}
				}

				if (!$isFound){
					$errorMessage = 'Kode UPTD tidak terdaftar';
					$messageData = ConstructMessageResponse($errorMessage , 'warning');
					echo $messageData;
					exit;
				}

				$this->dataUbahUPTD 	= array('IDUPTD'		=> $this->IDUPTD,
											  'kodeUPTD' 		=> $this->kodeUPTD,
											  'namaUPTD' 		=> $this->namaUPTD,
											  'npwp' 			=> $this->npwp,
											  'namaPimpinan' 	=> $this->namaPimpinan,
											  'nip'				=> $this->nip,
											  'alamat'			=> $this->alamat,
											  'kodePos'			=> $this->kodePos,
											  'telepon'			=> $this->telepon,
											  'fax'				=> $this->fax,
											  'email'	 		=> $this->email,
											  'website' 		=> $this->website
										);
			
	            $messageData = $this->load->model('master_uptd_model', 'ModelUbahUPTD');
	            $messageData = $this->ModelUbahUPTD->UbahUPTD($this->dataUbahUPTD);
	            echo $messageData;

        	}

		}

		public function HapusUPTD()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->IDUPTD = $this->input->post('IDUPTD', true);
			
            $messageData = $this->load->model('master_uptd_model', 'ModelHapusUPTD');
            $messageData = $this->ModelHapusUPTD->HapusUPTD($this->IDUPTD);
            echo $messageData;
			
		}

		public function CariUnitKerja()
	    {
	    	$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

			$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required|min_length[1]|xss_clean');
	
			if ( ! $this->form_validation->run() )
			{				

				$errorMessage = form_error('kategori');
				$messageData = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->kategori 	=  $this->input->post('kategori', true);
				$this->kataKunci 	=  $this->input->post('kataKunci', true);
	            
	            //$this->load->model('master_uptd_model', 'ModelCariUnitKerja');
		        //$arrDaftarCariGroup = $this->ModelCariUnitKerja->GetCariUnitKerja($this->kategori, $this->kataKunci);
		        
	   			$fieldWhere = ($this->kategori == 'kodeUnitKerja') ? 'kode_unit_kerja' : 'nama_unit_kerja';

	   			$WhereList = " and ".$fieldWhere. " like \'%". $this->kataKunci ."%\'";

	   			echo "<script>loadGridData('setup/GetDaftarUnitKerja');</script>";      

        	}	    	
	    }

		public function TampilkanDataComplement()
		{
			$this->checkCredentialAccess();

            $this->checkIsAjaxRequest();

            $this->form_validation->set_rules('levelKerja', 'Level Kerja', 'trim|required|min_length[1]|xss_clean');
	
			if ( ! $this->form_validation->run() )
			{				

				$errorMessage = form_error('levelKerja');
				$messageData  = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$this->level = $this->input->post('levelKerja', true);
				
				$htmlTextOut = '';

				if ($this->level == 'uptd'){
					
					$this->load->model("master_user_model", "ModelMasterUser");
					$this->puskesmas = $this->ModelMasterUser->GetDataPuskesmas();

					$htmlTextOut = '<div class="form-group ajaxUPTD">
							  		<label for="level" class="col-sm-3 control-label">Puskesmas</label>
							  		<div class="col-sm-9">
							  		<select id="uptd" name="uptd" class="form-control">';

						foreach($this->puskesmas as $row){
							$htmlTextOut.='<option value="'.$row['IDUPTD'].'">'.$row['KodeUPTD'].' - '.$row['NamaUPTD'].'</option>';							
						}

					$htmlTextOut .= '</select></div></div>';
				}

				echo $htmlTextOut;
        	}
		}

		public function JenisPemdaDanPejabat()
		{
			$this->checkCredentialAccess();
			
			$this->checkIsAjaxRequest();

			$this->load->model('setup_model', 'ModelJenisPemda');

			$this->data  = $this->ModelJenisPemda->GetPemdaDanPejabat();

			$content = $this->load->view('master_jenis_pemda_dan_pejabat_view', $this->data, true);
			echo $content;

		}

		public function UnitKerja()
		{
			$this->checkCredentialAccess();
			
			$this->checkIsAjaxRequest();
			
			$this->load->model('setup_model', 'ModelUnitKerja');

			$this->data  = $this->ModelUnitKerja->GetUnitKerja();

			$content = $this->load->view('master_unit_kerja_view', $this->data, true);
			echo $content;
		}

		//master pemerintahan daerah
		public function addPemda()
		{

			$this->checkCredentialAccess();
			
			$this->load->model('setup_model', 'ModelPemdaDanPejabat');
			
			$this->dateEntry    = RealDateTime();
			$this->userEntry    = $_SESSION['IDUser'];
			
			$this->form_validation->set_rules('jenisPemda', 'Jenis Pemerintahan Daerah', 'trim|required|xss_clean');
			$this->form_validation->set_rules('jenisBupati', 'Jenis Kepala Daerah', 'trim|required|xss_clean');
			$this->form_validation->set_rules('bupati', 'Kepala Daerah', 'trim|required|xss_clean');
			$this->form_validation->set_rules('sekertaris', 'Sekertaris Daerah', 'trim|required|xss_clean');
			$this->form_validation->set_rules('ppkd', 'PPKD', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kadisKesehatan', 'Kadis Kesehatan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nipBupati', 'NIP Kepala Daerah', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nipSekertaris', 'NIP Sekertaris', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nipPPKD', 'NIP PPKD', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nipKadisKesehatan', 'NIP Kadis Kesehatan', 'trim|required|xss_clean');
			
			/*if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('jenisPemda').form_error('jenisBupati').form_error('bupati').
								form_error('sekertaris').form_error('ppkd').form_error('kadisKesehatan').
								form_error('nipBupati').form_error('nipSekertaris').form_error('nipPPKD').form_error('nipKadisKesehatan');
				
				$messageData  = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{*/
				$dataPemda = array(
					'jenis_wilayah_daerah' => $this->input->post('jenisPemda',true),
					'wilayah_daerah' => 'MADIUN',
					'jenis_kepala_daerah' => $this->input->post('jenisBupati',true),
					'nama_kepala_daerah' => $this->input->post('bupati',true),
					'nama_sekertaris_daerah' => $this->input->post('sekertaris',true),
					'nama_pejabat_pengelola_keuangan_daerah' => $this->input->post('ppkd',true),
					'nama_kepala_dinas' => $this->input->post('kadisKesehatan',true),
					'nip_kepala_daerah' => $this->input->post('nipBupati',true),
					'nip_sekertaris_daerah' => $this->input->post('nipSekertaris',true),
					'nip_pejabat_pengelola_keuangan_daerah' => $this->input->post('nipPPKD',true),
					'nip_kepala_dinas' => $this->input->post('nipKadisKesehatan',true)
				);
				
				$query = $this->db->get('ref_pemerintahan_daerah');
				if($query->num_rows()==0)
				{
					$this->ModelPemdaDanPejabat->addPemda($dataPemda);
				}
				else
				{
					$this->ModelPemdaDanPejabat->updatePemda($dataPemda,'1');
				}

				$messageData  = ConstructMessageResponse('Update Data Jenis pemda & pejabat telah berhasil' , 'success');
				echo $messageData;
			//}
		}
		
		//master unit kerja
		public function addUnitkerja()
		{
			$this->checkCredentialAccess();
			$this->load->model('setup_model', 'ModelUnitKerja');
			$this->dateEntry    = RealDateTime();
			$this->userEntry    = $_SESSION['IDUser'];
			
			$this->form_validation->set_rules('nama', 'Nama Unit Kerja', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kode', 'Kode Unit Kerja', 'trim|required|xss_clean');
			$this->form_validation->set_rules('kodepos', 'Kode Pos', 'trim|required|xss_clean');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|xss_clean');
			$this->form_validation->set_rules('telepon', 'No. Telepon', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pimpinan', 'Nama Pimpinan', 'trim|required|xss_clean');
			$this->form_validation->set_rules('nip', 'NIP Pimpinan', 'trim|required|xss_clean');
			
			if ( ! $this->form_validation->run() )
			{				
				$errorMessage = form_error('nama').form_error('kodepos').
								form_error('kode').form_error('alamat').
								form_error('telepon').form_error('nip').
								form_error('pimpinan');
						
				$messageData  = ConstructMessageResponse($errorMessage , 'warning');
				echo $messageData;
			}
			else
			{
				$dataUnitkerja= array(
					'nama_unit_kerja' => $this->input->post('nama',true),
					'kode_unit_kerja' => $this->input->post('kode',true),
					'kodepos' => $this->input->post('kodepos',true),
					'alamat' => $this->input->post('alamat',true),
					'telepon' => $this->input->post('telepon',true),
					'website' => $this->input->post('website',true),
					'email' => $this->input->post('email',true),
					'fax' => $this->input->post('fax',true),
					'nama_pimpinan' => $this->input->post('pimpinan',true),
					'nip' => $this->input->post('nip',true),
					'npwp' => $this->input->post('npwp',true)
				);
				
				$query = $this->db->get('mst_unit_kerja');
				if($query->num_rows()==0)
				{
					$this->ModelUnitKerja->addUnitkerja($dataUnitkerja);
				}
				else
				{
					$this->ModelUnitKerja->updateUnitkerja($dataUnitkerja,'1');
				}

				$messageData  = ConstructMessageResponse('Update Data Unit Kerja telah berhasil' , 'success');
				echo $messageData;
			}
		}

	}

/* End of fiel setup.php */