
<?php 
echo "<pre>";
echo print_r($penilaian_pengjar_kritik_saran);
echo "</pre>";
 ?>
<html>
<head>
	<title></title>
	<style type="text/css">
		.tbl {
		    border-collapse: collapse;
		    width: 100%;
		}

		.tbl, .tbl tr td, .tbl tr th {
		    border: 1px solid black;
		}

		.judul
		{
			  text-align: center;
			  font-weight: bold; 
			  font-size: 15pt;
		}

		.numb
		{
			text-align: center;
		}
	</style>

</head>
<body>

	<div class="judul">
		<p>KUISIONER EVALUASI KINERJA FASILITATOR/PENGAJAR</p>
		<p>"<?php echo $data_pelatihan[0]['nama_pelatihan'];?>"</p>		
	</div>

	<div class="detail">
		<table>
			<tr>
				<td>Nama Fasilitator/Pengajar</td>
				<td>: <?php echo $data_pengajar['nama'];?></td>
			</tr>
			<tr>
				<td>Hari/Tanggal</td>
				<td>: <?php echo $hari_mengisi.', '.$tanggal_mengisi; ?></td>
			</tr>
			<tr>
				<td>Materi</td>
				<td>: <?php echo $data_pengajar['materi'];?></td>
			</tr>
		</table>		
	</div>	
	<div class="poinpoin">
		<p>Berikan tanda (v) pada kolom sesuai dengan penilaian bapak/ibu.</p>
		<table class="tbl">
	        <thead>
				<tr>
					<th rowspan="2" style="width: 30px;">No</th>
					<th rowspan="2">Variabel Penilaian</th>
					<th colspan="5">Penilaian Responden</th>
				</tr>
				<tr>
					<th style="width: 50px;">BurukSekali</th>
					<th style="width: 50px;">Buruk</th>
					<th style="width: 50px;">Cukup</th>
					<th style="width: 50px;">Baik</th>
					<th style="width: 50px;">Sangat Baik</th>
				</tr>
			</thead>

	        <tbody  class="tb_penilaian">
	        	<?php 
	        		$total[1]=0;
	        		$total[2]=0;
	        		$total[3]=0;
	        		$total[4]=0;
	        		$total[5]=0;
	        	?>
	        	<?php foreach ($result_penilaian as $key => $value): ?>
	        		<tr class="active">
	        			<td></td>
	        			<td colspan="6"><b><?php echo $value['kategori'];?></b></td>
	        			
	        		</tr>
	        		<?php 
	        			$nomor=0;
	        		?>
	        		<?php foreach ($value['point'] as $key => $valu): ?>
	        			<tr>
	        				<td><center><p class="numb"><?php echo ++$nomor;?>.</p></center></td>
	        				<td><?php echo $valu['point'];?></td>
	        				<td><center><?php echo (isset($valu[1])) ? $valu[1] : '0' ;?></center></td>
	        				<td><center><?php echo (isset($valu[2])) ? $valu[2] : '0' ;?></center></td>
	        				<td><center><?php echo (isset($valu[3])) ? $valu[3] : '0' ;?></center></td>
	        				<td><center><?php echo (isset($valu[4])) ? $valu[4] : '0' ;?></center></td>
	        				<td><center><?php echo (isset($valu[5])) ? $valu[5] : '0' ;?></center></td>

	        			</tr>
	        			<?php 
								for ($i=1; $i <6 ; $i++) { 
	            				# code...
	            				if(isset($valu[$i]))
	            				{
	            					$total[$i]=$total[$i]+$valu[$i];
	            				}
	            			}

	        			 ?>
	        		<?php endforeach ?>
	        		<?php 
	        			$nomor=1;
	        		?>
	        	<?php endforeach ?>
	        	<tr class="active">
	        		<td></td>
	        		<th>TOTAL</th>
	        		<td><center><?php echo $total[1]; ?></center></td>
	        		<td><center><?php echo $total[2]; ?></center></td>
	        		<td><center><?php echo $total[3]; ?></center></td>
	        		<td><center><?php echo $total[4]; ?></center></td>
	        		<td><center><?php echo $total[5]; ?></center></td>
	        	</tr>
	        </tbody>
	        <tfoot>
	        	
	        </tfoot>
	    </table>
	</div>
	<br>
	<div>
		<table class="tbl">
        	<thead>
        		<tr>
            		<th style="width:200px">Inputan</th>
            		<td></td>
            	</tr>
        	</thead>
        	
        	<tr>
        		<td >Quota</td>
        		<td ><?php echo $data_pelatihan[0]['quota']; ?></td>
        	</tr>
        	<tr>
        		<td>Menigisi</td>
        		<td><?php echo $data_submited; ?></td>
        	</tr>
        	<tr>
        		<td>Tidak mengisi</td>
        		<td><?php echo ($data_pelatihan[0]['quota']-$data_submited); ?></td>
        	</tr>
       </table>
	</div>
	<br>
	<div>
		<table class="tbl ">
            <thead>
            	<tr>
                    <th style="width: 30px;">No</th>
                    <th >Kritik dan Saran</th>
                    
            	</tr>
            </thead>

            <tbody  class="tb_penilaian">
            	<?php foreach ($penilaian_pengjar_kritik_saran as $key => $value): ?>
            	<tr>
            		<td><p class="numb"><?php echo 1+$key;?>.</p></center></td>
            		<td><?php echo $value['kritik_saran'];?></td>
            	</tr>
     				
     			<?php endforeach ?>
            </tbody>
        </table>
	</div>
</body>
</html>


