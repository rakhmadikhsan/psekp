<html>
<head>

	<meta charset="UTF-8">
    <title>TEST</title>
	<!-- Include Required Prerequisites -->
	
   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
 

        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

</head>
<body>
 <div class="form-group">
<a href="#" id="username" data-type="text" data-pk="1" data-title="Enter username">superuser</a>
                      </div>
                       <script type="text/javascript">
       
$.fn.editable.defaults.mode = 'inline';
$(document).ready(function() {
     $('#username').editable({
           url: '<?php echo site_url().'/test/xedit' ?>',   
            success: function(response, newValue) {
                if(response.status == 'error') return response.msg; //msg will be shown in editable form
            }
    });
});

    </script>
</body>
</html>