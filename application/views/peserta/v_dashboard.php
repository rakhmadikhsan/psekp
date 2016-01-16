
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

    <div class="row" style="margin-bottom:5px;">
		
	</div>

    <div class="row">
    	<div class="col-lg-9">
          	<section class="panel">
            	<header class="panel-heading">
                	Daftar Pelatihan
                </header>
         		<div class="panel-body">
         			<table class="table table-striped">
                        <tbody>
                        	<tr>
		                        <th style="width: 10px">#</th>
		                        <th>Pelatihan</th>
		                        <th class="col-lg-1">Tanggal Mulai</th>
		                        <th class="col-lg-1">Tanggal Selesai</th>
		                        <th>Quota</th>
		                        <th style="width: 40px"></th>
                        	</tr>
                            <tr>
                            	<td>1.</td>
                               	<td>pELATIHAN 1</td>
                               	<td>04/11/2016</td>
                               	<td>04/11/2016</td>
                                <td>
                                	<div class="progress xs">
                                    	<div class="progress-bar progress-bar-primary" style="width: 55%"></div>
                                    </div>
                                </td>
                             	<td><span class="badge bg-blue">75/150</span></td>
                            <tr>
                            <tr>
                            	<td>1.</td>
                               	<td>pELATIHAN 1</td>
                               	<td>04/11/2016</td>
                               	<td>04/11/2016</td>
                                <td>
                                	<div class="progress xs">
                                    	<div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                </td>
                             	<td><span class="badge bg-red">140/150</span></td>
                            <tr>
                            <tr>
                            	<td>1.</td>
                               	<td>pELATIHAN 1</td>
                               	<td>04/11/2016</td>
                               	<td>04/11/2016</td>
                                <td>
                                	<div class="progress xs">
                                    	<div class="progress-bar progress-bar-success" style="width: 55%"></div>
                                    </div>
                                </td>
                             	<td><span class="badge bg-green">10/150</span></td>
                            <tr>
                            
                        </tbody>
                    </table>
          		</div>
           	</section>
        </div>
        <div class="col-md-3">
        	<div class="sm-st clearfix">
            	<span class="sm-st-icon st-red"><i class="fa fa-check-square-o"></i></span>
            	<div class="sm-st-info">
            		<span>3200</span>
                    Pelatihan yang telah diikuti
                </div>
            </div>
        </div>
	</div>

	<div class="row">
    	<div class="col-lg-9">
          	<section class="panel">
            	<header class="panel-heading">
                	Pelatihan yang sedang saya ikuti
                </header>
         		<div class="panel-body">
         			<table class="table table-striped">
                        <tbody>
                        	<tr>
		                        <th style="width: 10px">#</th>
		                        <th>Pelatihan</th>
		                        <th class="col-lg-1">Tanggal Mulai</th>
		                        <th class="col-lg-1">Tanggal Selesai</th>
		                        <th>Quota</th>
		                        <th style="width: 40px"></th>
                        	</tr>
                            <tr>
                            	<td>1.</td>
                               	<td>pELATIHAN 1</td>
                               	<td>04/11/2016</td>
                               	<td>04/11/2016</td>
                                <td>
                                	<div class="progress xs">
                                    	<div class="progress-bar progress-bar-primary" style="width: 55%"></div>
                                    </div>
                                </td>
                             	<td><span class="badge bg-blue">75/150</span></td>
                            <tr>
                            <tr>
                            	<td>1.</td>
                               	<td>pELATIHAN 1</td>
                               	<td>04/11/2016</td>
                               	<td>04/11/2016</td>
                                <td>
                                	<div class="progress xs">
                                    	<div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                </td>
                             	<td><span class="badge bg-red">140/150</span></td>
                            <tr>
                            <tr>
                            	<td>1.</td>
                               	<td>pELATIHAN 1</td>
                               	<td>04/11/2016</td>
                               	<td>04/11/2016</td>
                                <td>
                                	<div class="progress xs">
                                    	<div class="progress-bar progress-bar-success" style="width: 55%"></div>
                                    </div>
                                </td>
                             	<td><span class="badge bg-green">10/150</span></td>
                            <tr>
                            
                        </tbody>
                    </table>
          		</div>
           	</section>
        </div>
        <div class="col-md-3">
        	<div class="sm-st clearfix">
            	<span class="sm-st-icon st-red"><i class="fa fa-check-square-o"></i></span>
            	<div class="sm-st-info">
            		<span>3200</span>
                    Pelatihan yang telah diikuti
                </div>
            </div>
        </div>
	</div>
</div>	  

