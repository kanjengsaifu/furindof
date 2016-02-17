<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Session_app
	{				
		public function sessionAppStart()
		{			

      		session_start();
      		session_name('TIMESHEET_SYNCORE_SESSION');

      		if (!isset($_SERVER['HTTPS']) || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'on') )
			{
				//header('Location:https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);	
			} 		
		} 			

	}	
