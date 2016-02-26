
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
                	Banner
                </header>
         		<div class="panel-body">
                  	<div class="col-lg-12">
	         			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                        <thead>
	                            <tr>
	                                <th>Nama Banner</th>
	                                <th>Image</th>
	                                <th>Link</th>
	                                <th style="width:100px"></th>
	                            	
	                            </tr>
	                        </thead>
	                        <tfoot>
	                        	<tr>
	                        		<form method="POST" action="<?php echo site_url().'/admin/tambahbannermitra/'; ?>">
	                        			<input type="hidden" name="tipe" value="1">
										<td><input type="text" class="form-control" name="nama" placeholder="nama" value=""></td>
		                        		<td><input type="text" class="form-control" name="src" placeholder="src" value=""></td>
		                        		<td><input type="text" class="form-control" name="link" placeholder="link" value=""></td>
		                        		<td>
		                        			<button type="submit" class="btn btn-success" aria-label="Left Align">
											  	<span class="fa fa-plus" aria-hidden="true">
											  		Tambah
											  	</span>
											</button>
		                        		</td>
	                        		</form>
	                        		
	                        	</tr>
	                        </tfoot>
	                        <tbody>
	                        	<?php foreach ($banner as $key => $value): ?>
	                        		<tr>
	                         		<td><a href="#" class="banner_nama" data-type="text" data-pk="<?php echo $value['id_bannernmitra'];?>" data-title="Banner Name"><?php echo $value['nama']; ?></a></td>
	                         		<td><a href="#" class="banner_src" data-type="text" data-pk="<?php echo $value['id_bannernmitra'];?>" data-title="Banner src"><?php echo $value['src']; ?></a></td>
	                         		<td><a href="#" class="banner_link" data-type="text" data-pk="<?php echo $value['id_bannernmitra'];?>" data-title="Banner link"><?php echo $value['link']; ?></a></td>
	                         		<td>
	                         			<a href="<?php echo site_url().'/admin/hapusbannermitra/'.$value['id_bannernmitra'] ?>" type="button" class="btn btn-danger" aria-label="Left Align">
										  	<span class="fa fa-trash" aria-hidden="true">
										  		Hapus
										  	</span>
										</a>
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

	<div class="row">
    	<div class="col-lg-12">
          	<section class="panel">
            	<header class="panel-heading">
                	Mitra
                </header>
         		<div class="panel-body">
                  	<div class="col-lg-12">
         			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                        <thead>
	                            <tr>
	                                <th>Nama Mitra</th>
	                                <th>Image</th>
	                                <th>Link</th>
	                                <th style="width:100px"></th>
	                            	
	                            </tr>
	                        </thead>
	                        <tfoot>
	                        	<tr>
	                        		<form method="POST" action="<?php echo site_url().'/admin/tambahbannermitra/'; ?>">
	                        			<input type="hidden" name="tipe" value="2">
										<td><input type="text" class="form-control" name="nama" placeholder="nama" value=""></td>
		                        		<td><input type="text" class="form-control" name="src" placeholder="src" value=""></td>
		                        		<td><input type="text" class="form-control" name="link" placeholder="link" value=""></td>
		                        		<td>
		                        			<button type="submit" class="btn btn-success" aria-label="Left Align">
											  	<span class="fa fa-plus" aria-hidden="true">
											  		Tambah
											  	</span>
											</button>
		                        		</td>
	                        		</form>
	                        		
	                        	</tr>
	                        </tfoot>
	                        <tbody>
	                        	<?php foreach ($mitra as $key => $value): ?>
	                        		<tr>
	                         		<td><a href="#" class="banner_nama" data-type="text" data-pk="<?php echo $value['id_bannernmitra'];?>" data-title="Banner Name"><?php echo $value['nama']; ?></a></td>
	                         		<td><a href="#" class="banner_src" data-type="text" data-pk="<?php echo $value['id_bannernmitra'];?>" data-title="Banner src"><?php echo $value['src']; ?></a></td>
	                         		<td><a href="#" class="banner_link" data-type="text" data-pk="<?php echo $value['id_bannernmitra'];?>" data-title="Banner link"><?php echo $value['link']; ?></a></td>
	                         		<td>
	                         			<a href="<?php echo site_url().'/admin/hapusbannermitra/'.$value['id_bannernmitra'] ?>" type="button" class="btn btn-danger" aria-label="Left Align">
										  	<span class="fa fa-trash" aria-hidden="true">
										  		Hapus
										  	</span>
										</a>
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

