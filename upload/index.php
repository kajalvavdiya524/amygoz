<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<?php echo $_SERVER['SERVER_NAME'].'/img/';?>

	<textarea name="" id="" cols="30" rows="10"></textarea>
    
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	     
	    /*tinymce.init({
	      selector: "textarea",
	      
	      // ===========================================
	      // INCLUDE THE PLUGIN
	      // ===========================================
	    	
	      plugins: [
	        "advlist autolink lists link image charmap print preview anchor",
	        "searchreplace visualblocks code fullscreen",
	        "insertdatetime media table contextmenu paste jbimages"
	      ],
	    	
	      // ===========================================
	      // PUT PLUGIN'S BUTTON on the toolbar
	      // ===========================================
	    	
	      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	    	
	      // ===========================================
	      // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
	      // ===========================================
	    	
	      relative_urls: false
	    	
	    });*/
	     
	</script>
    <script type="text/javascript">
      tinymce.init({
          selector: "textarea",
          theme: "modern",
          menubar : false,
          plugins: [
              "advlist autolink lists link image charmap print preview hr anchor pagebreak",
              "searchreplace wordcount visualblocks visualchars code fullscreen",
              "insertdatetime media nonbreaking save table contextmenu directionality",
              "emoticons template paste textcolor colorpicker textpattern imagetools"
          ],
          toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons",
          image_advtab: true,
          templates: [
              {title: 'Test template 1', content: 'Test 1'},
              {title: 'Test template 2', content: 'Test 2'}
          ],
          convert_urls : false,
          relative_urls:false
      });
  </script>
	<!-- /TinyMCE -->
</body>
</html>