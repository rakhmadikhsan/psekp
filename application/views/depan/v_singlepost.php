<div class="top-article">
    <ul class="breadcrumbs breadcrumb" style="background-color:transparent;margin-bottom: -1px;">
    	<li>
    		<a href="<?php echo base_url(); ?>">Beranda</a>
    		<span class="divider">
    			
    		</span>
    	</li>
    	<li>
    		<a href="<?php echo site_url(); ?>/main/<?php echo ($post['tipe']==1) ? 'berita' : (($post['tipe']==2) ? 'pengumuman' : (($post['tipe']=3) ? 'agenda' : '' ) ) ; ?>">
    			<?php echo ($post['tipe']==1) ? 'Berita' : (($post['tipe']==2) ? 'Pengumuman' : (($post['tipe']=3) ? 'Agenda' : '' ) ) ; ?>
    		</a>
    	</li>
    	<li class="active">
    		<?php echo $post['judul']; ?>
    	</li>
    </ul>        
</div>

<div class="kiri">
	<div class="k kls1">
		<div class="rounded post">
			<?php 
				//echo '<pre>';
				//	print_r($post) ;
				//echo '</pre>';
			 ?>	

			<div class="judul">
				<h1><?php echo $post['judul']?></h1>
			</div>	
				 
			<div style="margin-top:10px;">
				Diterbitkan pada: <?php echo $post['datetime_nice'] ?>
			</div>

			<div class="content" style="margin-top:10px">
				<?php echo $post['content'] ?>
			</div>

			<!-- Go to www.addthis.com/dashboard to customize your tools -->
			<div class="addthis_native_toolbox"></div>

		</div>
	</div>
</div>
<div class="kanan">
	<div class="k rls1">
		<div class="rounded berita">
			<div class="khead">
				<h6 class="titlewidget redtxt">
					<a href="<?php echo site_url().'/main/'; ?><?php echo ($post['tipe']==1) ? 'berita' : (($post['tipe']==2) ? 'pengumuman' : (($post['tipe']==3) ? 'agenda' : '' ) ) ; ?>"><img src="<?php echo base_url();?>assets/img/info_icon.png" width="14" height="14" class="imagesmall">
						&nbsp;<?php echo ($post['tipe']==1) ? 'Berita' : (($post['tipe']==2) ? 'Pengumuman' : (($post['tipe']==3) ? 'Agenda' : '' ) ) ; ?>
					
				</h6>
			</div>
			<div  class="kbody">
				<div id="pane6" class="scrollinfo">
			         <ul class="list_content">
			          	<?php foreach ($sideartikel as $key => $value): ?>
			          		<a href="<?php echo $value['link'];?>"><li><?php echo $value['judul']; ?></li></a>	
			          	<?php endforeach ?>
			        	
			        </ul>
			    </div>
			</div>
		</div>
	</div>
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
					<img src="assets/img/info_icon.png" width="14" height="14" class="imagesmall">
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