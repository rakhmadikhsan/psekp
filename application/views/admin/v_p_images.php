
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
                	Images
                </header>
         		<div class="panel-body">
                  <div class="col-lg-12">
         				 <!-- Standar Form -->
			          <h4>Select files from your computer</h4>
			          <form action="<?php echo site_url().'/admin/uploadDragdrop' ?>" method="post" enctype="multipart/form-data" id="js-upload-form">
			            <div class="form-inline">
			              <div class="form-group">
			                <input type="file" name="userfile" id="js-upload-files" multiple>
			              </div>
			              <button type="submit" class="btn btn-sm btn-primary" id="js-upload-submit">Upload</button>
			            </div>
			          </form>

			          <br>

			          <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Image Name</th>
                                <th>Image</th>
                                <th></th>
                            	
                            </tr>
                        </thead>
                        <tbody>
                         	<?php foreach ($map as $key => $value): ?>
                         		<tr>
                         			<td id="copyTarget<?php echo $key;?>">
                         				<?php echo base_url().'upload/post_images/'.$value; ?>
                         			</td>
                         			<td>
                         				<a target="_blank" href="<?php echo base_url().'upload/post_images/'.$value; ?>"><img src="<?php echo base_url().'upload/post_images/'.$value; ?>" width=100px></a>
                         			</td>
                         			<td>
                         				<button class="btn btn-primary" id="copyButton<?php echo $key; ?>">Copy image url</button>
                         			</td>
                         		</tr>
                         	<?php endforeach ?>
                        </tbody>
                    </table>

			       
         			</div>
                  
          		</div>
           	</section>
        </div>
	</div>
</div>	  


<script type="text/javascript">


</script>

