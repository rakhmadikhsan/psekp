<html>
<head>

	<meta charset="UTF-8">
    <title>TEST</title>
	<!-- Include Required Prerequisites -->
	

	 <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	  <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">


	<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>	
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script src="<?php echo base_url();?>assets/bootstrap/js/transition.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/bootstrap/js/collapse.js" type="text/javascript"></script>	
	<script src="<?php echo base_url();?>assets/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>	

</head>
<body>
<div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker3'>
                    <input type='text' class="form-control data-date-format="yyyy-mm-dd HH:mm"" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker({
                });
            });
        </script>
    </div>
</div>
</body>
</html>