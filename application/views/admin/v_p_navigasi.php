
<?php 
// echo '<pre>';
// print_r($nav);
// echo '</pre>';
?>
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
                	Navigasi
                </header>
         		<div class="panel-body">
                  <div class="col-lg-12">
         				<table class="table table table-hover">
                    <thead>
                    	<tr>
                        
                        <th>Nav</th>
                        <th>Sub Nav</th>
                        <th>link</th>
                        <th style="width: 100px"></th>
                    	</tr>
                    </thead>

                     <tfoot>
                      <tr>
                        <form method="POST" action="<?php echo site_url().'/admin/tambahnavsubnav/'; ?>">
                           
                            <td>

                              <!-- <input type="text" class="form-control" name="nav" placeholder="Nav" value=""> -->
                              <input type="text" name="nav" autocomplete="off" class="form-control" placeholder="Nav" data-provide="typeahead" data-items="4" data-source="[
                                <?php foreach ($nav as $key => $val): ?>
                                  &quot;<?php echo $val['parent']['kategori_parent'];?>&quot;<?php echo (($key>=sizeof($nav)-1) ? '' : ',') ;?>
                                <?php endforeach ?>
                                ]">
                                <ul class="typeahead dropdown-menu" style="top: 69px; left: 19px; display: none;">
                                  <li data-value="Alaska" class="active">
                                    <a href="#">
                                      <strong>Alas</strong>ka
                                    </a>
                                  </li>
                                </ul>
                            </td>
                            <td>
                              <input type="text" class="form-control" name="subnav" placeholder="Sub Nav" value="">
                              <!-- <input type="text" name="subnav" autocomplete="off" class="form-control" placeholder="Sub Nav" data-provide="typeahead" data-items="4" data-source="[
                                <?php foreach ($nav as $key => $val): ?>
                                  <?php foreach ($val['child'] as $keya => $value): ?>
                                    &quot;<?php echo $value['kategori'];?>&quot;<?php echo ((($key>=sizeof($nav)-1) && ($keya>=sizeof($val['child'])-1)) ? '' : ',') ;?>
                                  <?php endforeach ?>
                                <?php endforeach ?>
                                ]">
                                <ul class="typeahead dropdown-menu" style="top: 69px; left: 19px; display: none;">
                                  <li data-value="Alaska" class="active">
                                    <a href="#">
                                      <strong>Alas</strong>ka
                                    </a>
                                  </li>
                                </ul> -->
                            </td>
                            <td><input type="text" class="form-control" name="link" placeholder="Link" value=""></td>
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
                      <?php foreach ($nav as $key => $value): ?>
                        <tr>
                          <td><a href="#" class="nav_name" data-type="text" data-pk="<?php echo $value['parent']['id_kategori_parent'] ?>" data-title="Nav"><?php echo $value['parent']['kategori_parent'] ?></a></td>
                          <td></td>
                          <td><a href="#" class="nav_link" data-type="text" data-pk="<?php echo $value['parent']['id_kategori_parent'] ?>" data-title="Nav Link"><?php echo $value['parent']['parent_another_link'] ?></a></td>
                          <td>
                            <a <?php echo ($value['parent']['deleteable']==0) ? 'disabled' : '' ; ?> href="<?php echo site_url().'/admin/hapusnav/'.$value['parent']['id_kategori_parent'] ;?>" type="button" class="btn btn-danger" aria-label="Left Align">
                                <span class="fa fa-trash" aria-hidden="true">
                                  Hapus
                                </span>
                            </a>
                          </td>
                        </tr>
                        <?php foreach ($value['child'] as $key => $valu): ?>
                          <tr>
                          <td></td>
                          <td><a href="#" class="subnav_name" data-type="text" data-pk="<?php echo $valu['id_kategori'] ?>" data-title="subNav"><?php echo $valu['kategori'] ?></a></td>
                          <td><a href="#" class="subnav_link" data-type="text" data-pk="<?php echo $valu['id_kategori'] ?>" data-title="subNav Link"><?php echo $valu['another_link'] ?></a></td>
                          <td>
                            <a <?php echo ($valu['deleteable']==0) ? 'disabled' : '' ; ?>  href="<?php echo site_url().'/admin/hapussubnav/'.$valu['id_kategori'] ;?>" type="button" class="btn btn-danger" aria-label="Left Align">
                                <span class="fa fa-trash" aria-hidden="true">
                                  Hapus
                                </span>
                            </a>
                          </td>
                        </tr>
                        <?php endforeach ?>
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

