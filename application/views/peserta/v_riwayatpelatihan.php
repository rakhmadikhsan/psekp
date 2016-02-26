<?php //echo "<pre>"; ?>
<?php //print_r($riwayat_pelatihan); ?>
<?php //echo "</pre>"; ?>

<div class="row">
    	<div class="col-lg-12">
          	<section class="panel">
            	<header class="panel-heading">
                	RIWAYAT PELATIHAN
                </header>
         		<div class="panel-body">
         			<table class="table table table-hover">
                        <tbody>
                        	<thead>
                        		<tr>
                        			<th style="width: 10px">#</th>
                        			<th>Pelatihan</th>
                        			<th>Tanggal</th>
                        			<th>ID Peserta</th>
                        			<th>No Sertifikat</th>
                        			<th>Status</th>
                        		</tr>	
                        	</thead>
                        	
                        	<tbody>
                        		<?php foreach ($riwayat_pelatihan as $key => $value): ?>
                        			<tr>
                        				<td><?php echo ++$key; ?></td>
                        				<td><?php echo $value['nama_pelatihan'] ?></td>
                        				<td><?php echo $value['date_nice'] ?></td>
                        				<td><?php echo $value['id_peserta_has_pelatihan'] ?></td>
                        				<td><?php echo $value['sertifikat'] ?></td>
                        				<td><?php echo ($value['status_kehadiran']=='1') ? 'Hadir' : (($value['status_kehadiran']=='2') ? 'Batal Hadir' : 'Belum Konfirmasi') ; ?></td>
                        				<td><?php echo $value['status_kehadiran']; ?></td>

                        			</tr>
                        		<?php endforeach ?>
                        	</tbody>
                        	
                            
                        </tbody>
                    </table>
          		</div>
           	</section>
        </div>
	</div>
</div>	  
