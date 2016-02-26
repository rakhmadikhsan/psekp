
<?php //print_r($map);?>
<div class="content">
	<?php if ($this->session->flashdata('msg')): ?>
      	<div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $this->session->flashdata('msg'); ?>
    	</div>

	<?php elseif($this->session->flashdata('error')): ?>
    	<div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $this->session->flashdata('error'); ?>
    	</div>
    <?php endif; ?>

    <div class="row">
    	<div class="col-lg-12">
          	<section class="panel">
            	<header class="panel-heading">
                	Set Images
                </header>
         		<div class="panel-body">
                   <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                  	<thead>
                  		<tr>
                  			<th style="width:50px">#</th>
                  		<th  style="width:150px">Image</th>
                  		<th>src</th>
                  		<th style="width:80px"></th>
                  		</tr>
                  	</thead>
                  	<tbody>
                  		<?php foreach ($dataimageconfig as $key => $value): ?>
                  			<tr>
	                  			<form method="POST" action="<?php echo site_url().'/admin/dosetimage' ?>">
	                  				<input type="hidden" name="id" value="<?php echo $value['id_image_config']; ?>">
	                  				<td><?php echo $key+1; ?></td>
		                  			<td><?php echo $value['image_config']; ?></td>
		                  			<td><input type="text" name="src" class="form-control" id="src" placeholder="src image" value="<?php echo $value['src']; ?>"></td>
		                  			<td><input type="submit" class="btn btn-success" value="Simpan"></td>
	                  			</form>
	                  		</tr>
                  		<?php endforeach ?>
                  		
                  	</tbody>
                  </table>
          		</div>
           	</section>
        </div>
	</div>
</div>	  


<script type="text/javascript">


</script>

