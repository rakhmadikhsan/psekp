
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
                	Peserta
                </header>
         		<div class="panel-body">
         			<table class="table table table-hover">
                        <tbody>
                        	<tr>
                        		<form action='<?php echo site_url().'/admin/managepeserta' ?>' method="GET">
		                        <td style="width: 10px"></th>
		                        <td><input type="text" name="nip" class="form-control" value="<?php echo (isset($_GET['nip'])) ? $_GET['nip'] : '' ;?>"></td>
		                        <td><input type="text" name="nama" class="form-control" value="<?php echo (isset($_GET['nama'])) ? $_GET['nama'] : '' ;?>"></td>
		                        <td><input type="text" name="email" class="form-control" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : '' ;?>"></td>
		                        <td><input type="text" name="instansi" class="form-control" value="<?php echo (isset($_GET['instansi'])) ? $_GET['instansi'] : '' ;?>"></td>
		                        <td><input type="text" name="daerah" class="form-control" value="<?php echo (isset($_GET['daerah'])) ? $_GET['daerah'] : '' ;?>"></td>
		                        <td><input type="text" name="hp" class="form-control" value="<?php echo (isset($_GET['hp'])) ? $_GET['hp'] : '' ;?>"></td>
		                        <td><input type="text" name="telepon" class="form-control" value="<?php (isset($_GET['telepon'])) ? $_GET['telepon'] : '' ;?>"></td>
		                        <td><button type="submit" class="btn btn-info">Filter</button></td>
		                        </form>
                        	</tr>
                        	<tr>
		                        <th style="width: 10px">#</th>
		                        <th>NIP</th>
		                        <th>Nama</th>
		                        <th>Email</th>
		                        <th>Instansi</th>
		                        <th>Daerah</th>
		                        <th>Hp</th>
		                        <th>Telepon</th>
		                        <th style="width: 100px"></th>
                        	</tr>
                        	<?php foreach ($peserta as $key => $value): ?>
                        	<tr>
		                        <td><?php echo $key+1;?></td>
		                        <td><?php echo $value['nip'];?></td>
		                        <td><?php echo $value['nama'];?></td>
		                        <td><?php echo $value['email'];?></td>
		                        <td><?php echo $value['instansi'];?></td>
		                        <td><?php echo $value['daerah'];?></td>
		                        <td><?php echo $value['hp'];?></td>
		                        <td><?php echo $value['telepon'];?></td>
		                        <td>
		                        	<a data-toggle="modal" onclick="clickEditPic(<?php echo $value['id_peserta'];?>,'<?php echo $value['nip'];?>','<?php echo $value['nama'];?>','<?php echo $value['img'];?>');" data-target="#imageModal"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-picture"></i></button></a>
			                        <a data-toggle="modal" onclick="clickEditPeserta(<?php echo $value['id_peserta'];?>, '<?php echo $value['nip'];?>', '<?php echo $value['nama'];?>', '<?php echo $value['email'];?>', '<?php echo $value['instansi'];?>', '<?php echo $value['daerah'];?>', '<?php echo $value['hp'];?>', '<?php echo $value['fax'];?>', '<?php echo $value['telepon'];?>', '<?php echo $value['alamat'];?>');" data-target="#editModal"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></button></a>
			                        <a data-toggle="modal" onclick="clickHapus(<?php echo $value['id_peserta'];?>,'<?php echo $value['nip'];?>');" data-target="#hapusModal"><button class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></button></a>
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

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
     	<form id="formeditpeserta" class="form-horizontal" action="" method="POST">
	     	<div class="modal-content">
	     		<div class="modal-header">
	     			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	     			<h4 class="modal-title">Edit Data Peserta</h4>
	     		</div>
	     		<div class="modal-body">
	     			<fieldset>
					  
					  <div class="form-group">
					    <label for="nip" class="col-sm-2 control-label">NIP</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" readonly id="edit_nip" name="nip" placeholder="NIP"  value="">
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Nama</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="edit_nama" name="nama" placeholder="Nama" value="">
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Email</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="edit_email" name="email" placeholder="Nama" value="">
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Instansi</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="edit_instansi" name="instansi" placeholder="Nama" value="">
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Daerah</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="edit_daerah" name="daerah" placeholder="Nama" value="">
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Hp</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="edit_hp" name="hp" placeholder="Nama" value="">
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Fax</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="edit_fax" name="fax" placeholder="Nama" value="">
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Telepon</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="edit_telepon" name="telepon" placeholder="Nama" value="">
					    </div>
					  </div>
					   <div class="form-group">
					    <label for="Nama" class="col-sm-2 control-label">Alamat</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="edit_alamat" name="alamat" placeholder="Nama" value="">
					    </div>
					  </div>
					  </fieldset>
					</div>
					
	     		<div class="modal-footer">
	     			<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	     			<button class="btn btn-warning" type="submit">Simpan</button>
	     		</div>
	     	</div>
	     </form>
     </div> 
</div>
<!-- modal -->
<!-- Modal -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Hapus Peserta</h4>
			</div>
			<form  class="form-horizontal" id="formhapuspeserta" action="<?php echo site_url().'/peserta/hapusPeserta'; ?>" method="POST" enctype="multipart/form-data">
			<div id="body_hapus" class="modal-body">
				Body goes here...
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				<button class="btn btn-danger" type="submit" type="button">Hapus</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- modal -->
<!-- modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Upload Photo</h4>
			</div>
			<form  class="form-horizontal" id="formuoloadimage" action="<?php echo site_url().'/peserta/uploadPic'; ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<div>
						
						<fieldset>
							<div class="form-group">
							    <label for="nip" class="col-sm-1">NIP</label>
							    <label id="picNIP" class="col-sm-5 ">NIP</label>
							  </div>
							<div class="form-group">
							    <label for="Nama" class="col-sm-1 ">Nama</label>
							    <label id="picNama" class="col-sm-5 ">NIP</label>
							</div>
						<fieldset>
						<center>
							<img id="img_peserta" src="" class="img-responsive"	width="150" height="150">
						</center>

					</div>
					<br>
					<input type="file" name="userfile" size="100"  multiple="multiple"/>

				</div>
				<div class="modal-footer">
					<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
					<button class="btn btn-success" type="submit">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- modal -->

<script type="text/javascript">


    function clickEditPic(id_peserta,nip,nama, img) {

        var img_src=document.getElementById('img_peserta');
        var formuoloadimage=document.getElementById('formuoloadimage');
        var picNIP=document.getElementById('picNIP');
        var picNama=document.getElementById('picNama');
        img_src.src="<?php echo base_url();?>"+"upload/peserta/"+img;
        picNama.innerHTML=": "+nama;
        picNIP.innerHTML=": "+nip;
        formuoloadimage.action="<?php echo site_url();?>"+"/admin/uploadPic/"+id_peserta;
        //alert(formuoloadimage.action);
    }
    function clickEditPeserta(id_peserta, nip, nama, email, instansi, daerah,hp, telepon, fax, alamat) {
      
        var edit_nip = document.getElementById('edit_nip');
        var edit_nama = document.getElementById('edit_nama');
        var edit_email = document.getElementById('edit_email');
        var edit_instansi = document.getElementById('edit_instansi');
        var edit_daerah = document.getElementById('edit_daerah');
        var edit_hp = document.getElementById('edit_hp');
        var edit_telepon = document.getElementById('edit_telepon');
        var edit_fax = document.getElementById('edit_fax');
        var edit_alamat = document.getElementById('edit_alamat');
        var formeditpeserta=document.getElementById('formeditpeserta');


        edit_nip.value=nip;
        edit_nama.value=nama;
        edit_email.value=email;
        edit_instansi.value=instansi;
        edit_daerah.value=daerah;
        edit_hp.value=hp;
        edit_telepon.value=telepon;
        edit_fax.value=fax;
        edit_alamat.value=alamat;

        formeditpeserta.action="<?php echo site_url();?>"+"/admin/ubahPeserta/"+id_peserta;
    }
    function clickHapus(id_peserta,nip) {
    	var formhapuspeserta=document.getElementById('formhapuspeserta');
    	formhapuspeserta.action="<?php echo site_url();?>"+"/admin/hapusPeserta/"+id_peserta;
        document.getElementById("body_hapus").innerHTML = "Apakah anda yakin akan menghapus peserta dengan NIP <b>"+nip+"</b>?";
    }

</script>

