
<?php //print_r($bannermitra) ?>
<div class="kiri">
	<div class="k kls1">
		<div class="rounded hl">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
		      	<!-- Carousel Indikator -->
		        <ol class="carousel-indicators"  style="top:3%;">
		        	<li data-target="carousel-example-generic" data-slide-to="0" class="active">1</li>
		            <li data-target="carousel-example-generic" data-slide-to="1" class=""></li>
		            <li data-target="carousel-example-generic" data-slide-to="2" class=""></li>
		            <li data-target="carousel-example-generic" data-slide-to="3" class=""></li>
		            <li data-target="carousel-example-generic" data-slide-to="4" class=""></li>
		        </ol>
		        
		        <!-- Wrapper for Slide -->
		        <div class="carousel-inner">
		        	<?php foreach ($hlthumb as $key => $value): ?>
		        		<?php if ($key<=5): ?>
		        			<div class="item <?php echo ($key==0) ? 'active' : '' ; ?>">
		        				<a href="<?php echo base_url().'index.php/main/post/'.$value['link'] ?>">
		        					<img src="<?php echo $value['img'];?>" alt="Slide <?php echo $key+1; ?>">
					                <div class="carousel-caption" style="width:100%; left:0%; margin-left:0%; bottom:0%; padding:10px; .caption-headline {
									    width: 498px;
									    padding: 10px 10px 12px 10px;
									    font: Arial, Helvetica, sans-serif;
									    color: white;
									    ">
					                	<h4 style="color:white; text-align:center;"><?php echo $value['judul']; ?></h3>
					                    <!-- <p><?php echo $value['parag']; ?></p> -->
					                </div>
		        				</a>
				            	
				            </div>
		        		<?php endif ?>
		        	<?php endforeach ?>
		        	
		        </div>
		        
		        <!-- Control -->
		        <a href="#carousel-example-generic" class="carousel-control left " data-slide="prev" role="button">
		        	<span class="glyphicon glyphicon-chevron-left" style="left:15%"></span>
		        </a>
		        <a href="#carousel-example-generic" class="carousel-control right " data-slide="next" role="button">
		        	<span class="glyphicon glyphicon-chevron-right" style="right:15%"></span>
		        </a>
		   	</div>
		</div>
	</div>
	<div class="k kls2">
		<div class="rounded gg">
			<div id="carousel-example-generic2" class="carousel slide" data-ride="carousel2" >
		      	<!-- Carousel Indikator -->
		        		        <!-- Wrapper for Slide -->
		        <div class="carousel-inner">
		        	<?php foreach ($hlthumb as $key => $value): ?>
		        		<?php if (($key==0)||(($key%5)==0)): ?>
		        			<div class="item dua <?php echo ($key==0) ? 'active' : '' ; ?>" style="float:left;">
		        		<?php endif ?>
		        		<abbr title="<?php echo $value['judul']; ?>">
							<a href="<?php echo base_url().'index.php/main/post/'.$value['link'] ?>">
		        				<div class="thumb <?php echo ((($key%5)==4)) ? 'pad' : '' ; ?>">
				                	<img style="width:100%" src="<?php echo $value['img'];?>" alt="Slide 1">
				                </div>
		        			</a>
		        		</abbr>
		        			
		        			


		        		<?php if ((($key%5)==4) || ($key==(sizeof($hlthumb)-1))): ?>
		        			</div>
		        		<?php endif ?>
		        	<?php endforeach ?>
		        </div>

		        	
		        
		        <!-- Control -->
		       <!--  <a href="#carousel-example-generic2" class="carousel-control left" data-slide="prev" role="button">
		        	<span class="glyphicon glyphicon-chevron-left"></span>
		        </a>
		        <a href="#carousel-example-generic2" class="carousel-control right" data-slide="next" role="button">
		        	<span class="glyphicon glyphicon-chevron-right"></span>
		        </a> -->
		   	</div>
		</div>
	</div>
	<div class="k kls3">
		<div class=" ll">
			<div class="rounded lld">
				<div class="khead">
					<h6 class="titlewidget redtxt">
						<a href="<?php echo site_url().'/main/berita'; ?>"><img src="<?php echo base_url();?>assets/img/info_icon.png" width="14" height="14" class="imagesmall">
						&nbsp;<?php echo $this->lang->line('BERITA'); ?></a>
					</h6>
				</div>
				<div  class="kbody">
					 <div id="pane1" class="scroll">
				          <ul class="list_content">
				          	<?php foreach ($berita as $key => $value): ?>
				          		<a href="<?php echo base_url().'index.php/main/post/'.$value['link'];?>"><li><?php echo $value['judul']; ?></li></a>	
				          	<?php endforeach ?>
				        	
				        </ul>
				    </div>
				</div>
			</div>
			
		</div>
		<div class=" lr">
			<div class="rounded lrd">
				<div class="khead">
					<h6 class="titlewidget redtxt">
						<img src="<?php echo base_url();?>assets/img/info_icon.png" width="14" height="14" class="imagesmall">
						&nbsp;BIMTEK
					</h6>
				</div>
				<div  class="kbody" style="background-image: url('<?php echo $setimage['pendaftaran']; ?>'); background-size: cover;">
					<?php if ($this->session->userdata('logged_in_peserta')): ?>
					 	<div style="margin:5px; text-align:center;">
					 		<?php $session_data = $this->session->userdata('logged_in_peserta'); ?>
					 		Anda sedang login sebagai : <strong><?php echo  $session_data['nama'];?></strong>
					 		<div style="width:100%; font-size:15pt; font-weight: bold; margin-top:20px">
								<a href="<?php echo site_url().'/peserta' ?>"><?php echo  $session_data['nip'];?></a>
							</div>
							<!-- <p>Dengan login sebagai member BIMTEK, anda dapat mendaftarkan peserta lain.</p> -->
							
						</div>	
					<?php else: ?>	
						<div style="padding:5px; text-align:center;">
							
							<div style="width:100% ; padding-bottom:10px; padding-top:38px;">
								<a href="<?php echo site_url().'/loginpeserta' ?>"><input style="margin-top:10px" type="submit" value="<?php echo $this->lang->line('Masuk ke Menu BIMTEK'); ?>" class="btnmasuk"></a>
							</div>
							<div style="width:100%; padding-bottom:31px">
								<a  href="<?php echo site_url().'/register' ?> "><?php echo $this->lang->line('Daftar Baru'); ?></a>
							</div>
							
						
						</div>						
					<?php endif ?>
					<!-- <a href=""><img src="<?php echo $setimage['pendaftaran']; ?>" style="width:340;height:148px"></a> -->
					
					 
				</div>
			</div>
		</div>
	</div>

	<div class="k kls2">
		<div class=" ll">
			<div class="rounded lld">
				<div class="khead">
					<h6 class="titlewidget redtxt">
						<a href="<?php echo site_url().'/main/agenda'; ?>"><img src="<?php echo base_url();?>assets/img/info_icon.png" width="14" height="14" class="imagesmall">
						&nbsp;<?php echo $this->lang->line('AGENDA'); ?></a>
					</h6>
				</div>
				<div  class="kbody">
					<div id="pane2" class="scroll">
				          <ul class="list_content">
				          	<?php foreach ($agenda as $key => $value): ?>
				          		<a href="<?php echo base_url().'index.php/main/post/'.$value['link'];?>"><li><?php echo $value['judul']; ?></li></a>	
				          	<?php endforeach ?>
				        	
				        </ul>
				    </div>
				</div>
			</div>
			
		</div>
		<div class=" lr">
			<div class="rounded lrd">
				<div class="khead">
					<h6 class="titlewidget redtxt">
						<a href="<?php echo site_url().'/main/pengumuman'; ?>"><img src="<?php echo base_url();?>assets/img/info_icon.png" width="14" height="14" class="imagesmall">
						&nbsp;<?php echo $this->lang->line('PENGUMUMAN'); ?></a>
					</h6>
				</div>
				<div  class="kbody">
					<div id="pane3" class="scroll">
				          <ul class="list_content">
				          	<?php foreach ($pengumuman as $key => $value): ?>
				          		<a href="<?php echo base_url().'index.php/main/post/'.$value['link'];?>"><li><?php echo $value['judul']; ?></li></a>	
				          	<?php endforeach ?>
				        	
				        </ul>
				    </div>
				</div>
			</div>
		</div>
	</div>

	
</div>
<div class="kanan">
	<div class="k rls1">
		<div class="rounded berita">
			<div class="khead">
				<h6 class="titlewidget redtxt">
					<img src="<?php echo base_url();?>assets/img/info_icon.png" width="14" height="14" class="imagesmall">
					&nbsp;<?php echo $this->lang->line('BERITA UGM'); ?>
				</h6>
			</div>
			<div  class="kbody">
				<?php if ($infougm!=null): ?>
					<div id="pane4" class="scrollinfo">
				         <ul class="list_content">
				          	<?php foreach ($infougm as $key => $value): ?>
				          		<a target="_blank" href="<?php echo $value['link'];?>"><li><?php echo $value['judul']; ?></li></a>	
				          	<?php endforeach ?>
				        	
				        </ul>
				    </div>
				<?php endif ?>
				
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
					<img src="<?php echo base_url();?>assets/img/info_icon.png" width="14" height="14" class="imagesmall">
					&nbsp;<?php echo $this->lang->line('MITRA'); ?>
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
	</div>
</div>
</div>