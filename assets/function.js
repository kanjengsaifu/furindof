
/* disable type */
$(document).on("keydown",'input.disable',function(e) 
{
   e.preventDefault();
   return false;
});

$.fn.tanggal = function tgl()
{
	$(this).mask("99 / 99 / 9999",{placeholder:"dd/mm/yyyy"}).datepicker({ dateFormat: 'dd / mm / yy' });
}


$.fn.load_modal = function msgShow(settings) 
{
	//console.log(settings) ;	
	$("#block").remove();
	$("#modal").remove();

	/* set default start */
	if ( settings.judul == undefined ) 
	{
		judul = "dialog box"; 	
	}
	else
	{
		judul = settings.judul; 
	}
	if ( settings.content == undefined ) 
	{
		content = " <span style='color:red'>silahkan cek kembali syntaxt javascript</span> " ; 	
	}
	else
	{
		content = settings.content ; 
	}

	/* menampilkan modal start */
	$("body").prepend('<div id="block"></div><div id="modal"><div id="modal-judul">'+judul+'<a class="close"><i class="fa fa-times"></i></a><a class="max"><i class="fa fa-arrows-alt"></i></a></div><table id="modal_wrapper"><tr><td id="modal_content" valign="top"><div class="wrapmodal"> '+content+'</div> </td></tr></table><div style="padding:10px; float:right"></div><div style="clear:both"></div></div>');

	/* menampilkan dan mensetting modal */
	$("#modal").draggable(
	{
		handle:".max", 
		start:function(e,ui)
		{
			var position = $("#modal").offset() ; 
			//alert(position.left) ; 
			$(ui).css("left",1000);
			
		}
	});

	$("#modal .max").click(function()
	{
		var position = $("#modal").offset() ; 
	});
	$("#block").show();
	$("#modal").show();
	
	/* 
		load url modal start
		apabila url di setting 
	*/
	

	if ( settings.url != undefined ) 
	{
		$(".wrapmodal").load(settings.url,function(response , status,xhr)
		{
			if ( status == "error" ) 
			{
				var msg = "Sorry but there was an error: ";
				$("#modal_content").html(msg + xhr.status + " " + xhr.statusText);
			}
		});
	}

	/* setting width apa bila url di setting */
	if ( settings.width != undefined )
	{
		if ( $(window).width() > 800 )
		{
			$("#modal").css("width",settings.width) ; 
		}
		
	}

	/* setting tinggi start apa bila url di setting */
	if ( settings.height != undefined )
	{
		$("#modal td").css("height",settings.height) ; 
	}

	/* setting top posision start */
	if ( settings.top != undefined )
	{
		$("#modal").css("margin-top",settings.top) ; 
	}


	
	$("#modal .close").click(function()
	{
		$("#block").remove();
		$("#modal").remove();
	});

	$("#modal .max").click(function()
	{
		/*$("#modal").css("width","98%");
		$("#modal").css("margin-top","10px");
		$("#modal table").css("height","100%");*/
	});
}

	function modalclose()
	{

		$("#block").remove();
		$("#modal").remove();
		
	}


	function openmodal(settings)
	{ 
		/* set default start */
		if ( settings.width == undefined ) 
		{
			width = 600; 	
		}
		else
		{
			width = settings.width; 
		}

		if ( settings.height == undefined ) 
		{
			height = 500 ; 	
		}
		else
		{
			height = settings.height ; 
		}

		if ( settings.url == undefined ) 
		{
			url = 500 ; 	
		}
		else
		{
			url = settings.url ; 
		}

		//posisi 
		var left = (screen.width/2)-(width/2);
  		var top = (screen.height/2)-(height/2);

	  	popupWindow =window.open(url,"_blank","directories=no,  menubar=no, scrollbars=yes, resizable=no,width="+width+", height="+height+",top="+top+",left="+left);
	  	return popupWindow ;
	}

	function jangan_di_close()
	{
		$("body").prepend('<div id="block"></div><div id="modal"><div id="modal-judul">JANGAN TUTUP HALAMAN INI</div><table id="modal_wrapper"><tr><td id="modal_content" valign="top"><div class="wrapmodal" style="background:red; color:#fff; font-weight:bold ; padding:20px;"> <h1>LOADING...</h1> halaman sedang melakukan pemrosesan data , jangan tutup halaman ini. apabila proses ini terputus anda harus melakukan reset status untuk mengulangi proses ini </div> </td></tr></table><div style="padding:10px; float:right"></div><div style="clear:both"></div></div>');

		$("#block").show();
		$("#modal").show();

		window.onbeforeunload = function (e) 
		{
			return false ; 
		};
	}

	function redirect(url)
	{
		window.location.href = url ; 
	}