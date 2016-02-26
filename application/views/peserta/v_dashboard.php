
<?php 
//echo '<pre>';
//print_r($jadwal);
//echo '</pre>';
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

    <div class="row" style="margin-bottom:5px;">
		
	</div>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Daftar Pelatihan Aktif
                </header>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Pelatihan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Tempat</th>
                            <th>Kapasitas</th>
                        </thead>
                        <tbody>
                            <?php foreach ($jadwal as $key => $value): ?>
                                <tr>
                                    <td><?php echo $key+1; ?></td>
                                    <td><?php echo $value['nama_pelatihan']; ?></td>
                                    <td><?php echo $value['date_nice']; ?></td>
                                    <td><?php echo $value['time_nice']; ?></td>
                                    <td><?php echo $value['tempat']; ?></td>
                                    <td>
                                        <?php 
                                            $persen=$value['jumlah']/$value['quota']*100;
                                            $class="";
                                            $class2="";
                                            if ($persen<=(100*1/3)) {
                                                $class='success';
                                                $class2='green';
                                            }else if ($persen<=(100*2/3)) {
                                                $class='warning';
                                                $class2='yellow';
                                            }else if ($persen>(100*2/3)) {
                                                $class='danger';
                                                $class2='red';
                                            }

                                         ?>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-<?php echo $class;?>" style="width: <?php echo ($value['jumlah']/$value['quota']*100); ?>%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-<?php echo $class2 ;?>"><?php echo $value['jumlah'].'/   '.$value['quota'] ?></span></td>
                                </tr>
                                
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>  

    
	</div>
</div>	  

