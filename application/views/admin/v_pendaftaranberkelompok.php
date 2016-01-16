
<?php print_r($data_excel);?>
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
                	Pendaftaran Berkelompok
                </header>
         		<div class="panel-body">
         			<div class="col-lg-4">
         				<select class="form-control" name="id_pelatihan" id="id_pelatihan" value="" onchange="goToAnotherPage(this);">
						    <option value="">Pilih Pelatihan</option>
						    <?php foreach ($pelatihan_active as $key => $value): ?>
						    	<option value="<?php echo $value['id_pelatihan'];?>"><?php echo $value['nama_pelatihan'];?></option>	
						    <?php endforeach ?>
						</select>
         			</div>
         			
         			<table class="table table table-hover">
                        <tbody>
                        	
                        	<tr>
		                        <th style="width: 10px">#</th>
								<th>Tanggal</th>
								<th>File</th>
		                        <th>Reff</th>
		                        <th style="width: 100px"></th>
                        	</tr>
                        	<?php foreach ($data_excel as $key => $value): ?>
                        	<tr>
                        		<td><?php echo $key+1;?></td>
		                        <td><?php echo $value['datetime'];?></td>
		                        <td><?php echo $value['filename'];?></td>
		                        <td><?php echo $value['id_peserta_fk'];?></td>
		                      
		                        <td>
		                        	<a data-toggle="modal" onclick="clickEditPelatihan();" data-target="#editModal"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></button></a>
			                        <a data-toggle="modal" onclick="clickHapusPelatihan();" data-target="#hapusModal"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></button></a>
			                    </td>
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
	(function() {
	   // your page initialization code here
	   // the DOM will be available here
		//alert("<?php echo $id_pelatihan;?>") 

		var id_pelatihan = document.getElementById('id_pelatihan');
    	id_pelatihan.value = "<?php echo $id_pelatihan;?>";
	})();

	

    function goToAnotherPage(sel) {
          //alert(sel.value)        ;
          window.open("<?php echo site_url();?>"+"/admin/pendaftaranberkelompok/"+sel.value,"_self");

    }
</script>
