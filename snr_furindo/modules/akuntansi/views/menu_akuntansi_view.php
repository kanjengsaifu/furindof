<?php 
  echo $dataMenu;
?>

<script>
  $(document).ready(function(e){       

      $('a[class="sidebarMenu"]').click(function(e)
      {   
        e.preventDefault();   
        ajaxLinkURL($(this).attr('href'), 'content-wrapper');        
      }); 

	 $('body').attr('class','skin-yellow fixed');

  });
    
</script>
