
<?php //print_r($data_post);?>
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
                	Post
                </header>
         		<div class="panel-body">
                    <div>
                        <ul class="nav nav-pills">
                          <li <?php echo ($page=='Semua Post') ? 'class="active"' : '' ; ?> ><a href="<?php echo ($page=='Semua Post') ? '#' : site_url().'/admin/semuapost' ; ?>">Semua Post</a></li>
                          <li <?php echo ($page=='Berita Post') ? 'class="active"' : '' ; ?> ><a href="<?php echo ($page=='Berita Post') ? '#' : site_url().'/admin/beritapost' ; ?>">Berita Post</a></li>
                          <li <?php echo ($page=='Pengumuman Post') ? 'class="active"' : '' ; ?> ><a href="<?php echo ($page=='Pengumuman Post') ? '#' : site_url().'/admin/pengumumanpost' ; ?>">Pengumuman Post</a></li>
                          <li <?php echo ($page=='Agenda Post') ? 'class="active"' : '' ; ?> ><a href="<?php echo ($page=='Agenda Post') ? '#' : site_url().'/admin/agendapost' ; ?>">Agenda Post</a></li>
                          <li <?php echo ($page=='Link Nav') ? 'class="active"' : '' ; ?> ><a href="<?php echo ($page=='Link Nav') ? '#' : site_url().'/admin/linknavpost' ; ?>">Link Nav Post</a></li>
                          <li <?php echo ($page=='Draft') ? 'class="active"' : '' ; ?> ><a href="<?php echo ($page=='Draft') ? '#' : site_url().'/admin/draftpost' ; ?>">Draft</a></li>
                          <li <?php echo ($page=='Trash') ? 'class="active"' : '' ; ?> ><a href="<?php echo ($page=='Trash') ? '#' : site_url().'/admin/trashpost' ; ?>">Trash</a></li>
                          
                        </ul>
                    </div>
                    <br>
         			      <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th style="width:120px">Datetime</th>
                                <th style="width:60px">Tipe</th>
                                <th style="width:60px">Status</th>
                                <th style="width:200px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_post as $key => $value): ?>
                                <tr>
                                    <td><?php echo $value['judul']; ?></td>
                                    <td><?php echo $value['datetime_post']; ?></td>
                                    <td><?php echo (($value['tipe']==1) ? "Berita" : (($value['tipe']==2) ? "Pengumuman" : (($value['tipe']==3) ? "Agenda" :  (($value['tipe']==4) ? "Link ke Nav" : "Uncatagorized")))) ; ?></td>
                                    <td><?php echo ($value['status']=="1") ? "Published" : "Draft" ; ?></td>
                                    
                                    <td>
                                        <?php if ($value['status']!=2): ?>
                                            <a href="<?php echo site_url().'/admin/editpost/'.$value['id_post']; ?>"> Edit |</a> 
                                        <?php endif ?>

                                        <?php if ($value['status']==1): ?>
                                            <a href="<?php echo site_url().'/admin/dounpublish/'.$value['id_post']; ?>"> Unpublish |</a> 
                                        <?php endif ?>
                                         
                                         <?php if ($value['status']==0): ?>
                                            <a href="<?php echo site_url().'/admin/dopublish/'.$value['id_post']; ?>"> Publish |</a> 
                                        <?php endif ?>

                                        <?php if ($value['status']!=2): ?>
                                             <a href="<?php echo site_url().'/admin/dohapus/'.$value['id_post']; ?>"> Hapus |</a> 
    
                                        <?php endif ?>
                                        
                                         <a target="_blank" href="<?php echo site_url().'/main/post/'.$value['link']; ?>"> View</a></td>
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

