
<?php //print_r($peserta);?>
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
            		<?php echo $page ; ?>
                </header>
         		<div class="panel-body">
         			<div class="form-group">
					    <input type="text" class="form-control" id="judul" placeholder="Tuliskan judul disini" value="<?php echo ($page=="Edit Post") ? $data_post['judul'] : "" ; ?>">
					</div>
					<div class="form-group">
						<?php echo site_url().'/post/'; ?>
					    <input type="text" class="form-control" id="perma" placeholder="Permalink" value="<?php echo ($page=="Edit Post") ? $data_post['link'] : "" ; ?>">
					</div>
					<div class="form-group">
				    	<textarea ><?php echo ($page=="Edit Post") ? $data_post['content'] : "" ; ?></textarea>
					</div>
					<div class=" form-group ">
						<select class="form-control " name="tipe" id="tipe" value="">
							<option value="0" <?php echo ($page=="Edit Post") ? (($data_post['tipe']=='0') ? 'selected' : '' ) : '' ; ?>> - </option>
					      	<option value="1" <?php echo ($page=="Edit Post") ? (($data_post['tipe']=='1') ? 'selected' : '' ) : '' ; ?>>Berita</option>
					      	<option value="2" <?php echo ($page=="Edit Post") ? (($data_post['tipe']=='2') ? 'selected' : '' ) : '' ; ?>>Pengumuman</option>
					      	<option value="3" <?php echo ($page=="Edit Post") ? (($data_post['tipe']=='3') ? 'selected' : '' ) : '' ; ?>>Agenda</option>
					      	<option value="4" <?php echo ($page=="Edit Post") ? (($data_post['tipe']=='4') ? 'selected' : '' ) : '' ; ?>>Link ke Nav</option>			
						</select>
					</div>
					<?php if ($page=="Tambah Post"): ?>
						<input type="button" class="btn btn-success" value="Publish" id="submit">
						<input type="button" class="btn btn-primary" value="Simpan ke Draft" id="draft">
					<?php endif ?>

					<?php if ($page=="Edit Post"): ?>
						<input type="button" class="btn btn-success" value="Simpan" id="simpan">
						
					<?php endif ?>
					
          		</div>
           	</section>
        </div>
	</div>
</div>	  


<script type="text/javascript">


</script>


