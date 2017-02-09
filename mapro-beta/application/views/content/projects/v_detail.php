<div class="panel panel-primary">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
		<h4 class="panel-title">Detail Project</h4>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="loading-overlay" style="display:none;"></div>
				<a href="<?php echo base_url('projects');?>" class="btn btn-xs btn-primary pull-right" title="Back to list projects">
					<i class="glyphicon glyphicon-arrow-left"></i> Back to list projects
				</a>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_dashboard" data-toggle="tab"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a></li>
					<li class=""><a href="#tab_milestones" data-toggle="tab"><i class="glyphicon glyphicon-th-list"></i> Milestones</a></li>
					<li class=""><a href="#tab_tasklists" data-toggle="tab"><i class="glyphicon glyphicon-list"></i> Tasklists</a></li>
					<li class=""><a href="#tab_files" data-toggle="tab"><i class="glyphicon glyphicon-file"></i> Files</a></li>
					<li class=""><a href="#tab_users" data-toggle="tab"><i class="glyphicon glyphicon-user"></i> Users</a></li>
					<li class=""><a href="#tab_curve" data-toggle="tab"><i class="glyphicon glyphicon-signal"></i> S-Curve</a></li>
				</ul>
				<div id="myTabContent" class="tab-content"><br>
					<div class="tab-pane fade active in" id="tab_dashboard">
                        <div>
                            <table class="table" style="width:760px;">
                                <tr>
                                    <td style="width:100px;">Project</td>
                                    <td style="width:5px;">:</td>
                                    <td><?php echo $detail['projects'];?></td>
                                </tr>
                                <tr>
                                    <td style="width:100px;">Decription</td>
                                    <td style="width:5px;">:</td>
                                    <td><?php echo $detail['description'];?></td>
                                </tr>
                                <tr>
                                    <td style="width:100px;">Start Project</td>
                                    <td style="width:5px;">:</td>
                                    <td><?php echo sys_date_format($detail['start_projects']);?></td>
                                </tr>
                                <tr>
                                    <td style="width:100px;">End Project</td>
                                    <td style="width:5px;">:</td>
                                    <td><?php echo sys_date_format($detail['end_projects']);?></td>
                                </tr>
                                <tr>
                                    <td style="width:100px;">Budget</td>
                                    <td style="width:5px;">:</td>
                                    <td>Rp <?php echo number_format($detail['budget'], 0, ', ', '.');?></td>
                                </tr>
                            </table>
                        </div>
					</div>
					<div class="tab-pane fade" id="tab_milestones">
						<?php echo $tab_milestones;?>
					</div>
					<div class="tab-pane fade" id="tab_tasklists">
                        <div class="clearfix"></div>
                        <div id="data-tasklists">
                            <?php echo $tab_tasks?>
                        </div>
						<?php echo $tab_task_src;?>
					</div>
					<div class="tab-pane fade" id="tab_files">
						<?php echo $tab_files;?>
					</div>
					<div class="tab-pane fade" id="tab_users">
						<?php echo $tab_users;?>
					</div>
					<div class="tab-pane fade" id="tab_curve">
						<?php echo $tab_curve;?>
					</div>
				</div>
			</div><!-- col-md-12 -->
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/jQuery-UI/jquery-ui.min.css');?>">
<style>
	.ui-datepicker .ui-datepicker-title select {
		color:#333333;
	}
</style>
<script src="<?php echo base_url('assets/plugins/jQuery-UI/jquery-ui.min.js');?>"></script>

