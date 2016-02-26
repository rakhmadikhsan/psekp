<?php //echo $this->uri->segment(3) ?>
<div class="top-article">
    <ul class="breadcrumbs breadcrumb" style="background-color:transparent;margin-bottom: -1px;">
    	<li>
    		<a href="<?php echo base_url(); ?>">Beranda</a>
    		<span class="divider">
    			
    		</span>
    	</li>

    	<li class="active">
    		<?php echo $page; ?>
    	</li>
    </ul>        
</div>

<div class="kiri">
	<div class="k kls1">
		<div class="rounded artikel">
			<?php 
				//print_r($artikel);
			 ?>

			 <?php foreach ($artikel as $key => $value): ?>
			 	<div class="artikel_item">
			 		<div class="judul"><a href="<?php echo base_url().'index.php/main/post/'.$value['link'] ?>"><h1><?php echo $value['judul'] ?></h1></a></div>
			 		<div class="date_artikel" style="margin-top:10px; margin-bottom:5px;font-style: italic;">Diposting: <?php echo $value['datetime_nice'] ?></div>
			 		<div  class="row" style=" margin:0px;">
			 			<?php if ($value['img']!=null): ?>
			 				
			 				<img align="left" src="<?php echo $value['img']; ?>" height=80 style="margin-right:10px">	
			 			<?php endif ?>
			 			
			 			<div class="date_artikel"><p><?php echo $value['parag'] ?></p></div>
			 			
			 		</div>
			 		<div  style="
    text-align: right;">
			 			<a  style="right:0px;" href="<?php echo base_url().'index.php/main/post/'.$value['link'] ?>">read more</a>
			 		</div>
			 		
			 	</div>
			 <?php endforeach ?>
			 <br>
			<div style="text-align:center;">
				<?php echo $links ?>
			</div>	 
			 
		</div>
	</div>
</div>
<div class="kanan">
	
	<div class="k rls2">
		<div class="rounded">
			<div  class="kbody">
				<?php foreach ($bannermitra as $key => $value): ?>
					<?php if ($value['tipe']=='1'): ?>
						<div class="bannermitra">
							<abbr title="<?php echo $value['nama']; ?>">
								<a href="<?php echo $value['link']; ?>" ><img src="<?php echo $value['src']; ?>" class="bannermitraimg"></a>
							</abbr>
						</div>
						
					<?php endif ?>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<div class="k rls3">
		<div class="rounded">
			<div class="khead">
				<h6 class="titlewidget redtxt">
					<img src="<?php echo base_url() ?>assets/img/info_icon.png" width="14" height="14" class="imagesmall">
					&nbsp;Mitra
				</h6>
			</div>
			<div  class="kbody">
				<?php foreach ($bannermitra as $key => $value): ?>
					<?php if ($value['tipe']=='2'): ?>
						<div class="bannermitra">
							<abbr title="<?php echo $value['nama']; ?>">
								<a href="<?php echo $value['link']; ?>" ><img src="<?php echo $value['src']; ?>" class="bannermitraimg"></a>
							</abbr>
						</div>
						
					<?php endif ?>
				<?php endforeach ?>
			</div>
		</div>
	</div><!-- 
	<div class="k rls2">
		<div class="rounded berita">
			<div class="khead">
				<h6 class="titlewidget redtxt">
					<img src="assets/images/info_icon.png" width="14" height="14" class="imagesmall">
					&nbsp;Info
				</h6>
			</div>
			<div  class="kbody">
				body
			</div>
		</div>
	</div> -->
</div>
</div>