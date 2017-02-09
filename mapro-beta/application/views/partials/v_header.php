		
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="<?php echo base_url();?>" class="navbar-brand"><?php echo sys_name();?></a>
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
				</div>
				<div class="navbar-collapse collapse" id="navbar-main">
					<ul class="nav navbar-nav">
						<li class="<?php echo ($this->uri->segment(1) == 'dashboard' ? 'active' : '');?>">
							<a href="<?php echo base_url('dashboard');?>"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
						</li>
						<li class="<?php echo ($this->uri->segment(1) == 'account' ? 'active' : '');?>">
							<a href="<?php echo base_url('account');?>"><i class="glyphicon glyphicon-plane"></i> My Account</a>
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" id="administration"><i class="glyphicon glyphicon-wrench"></i> Administration <span class="caret"></span></a>
							<ul class="dropdown-menu" aria-labelledby="administration">
								<li class="<?php echo ($this->uri->segment(1) == 'projects' ? 'active' : '');?>"><a href="<?php echo base_url('projects');?>"><i class="glyphicon glyphicon-briefcase"></i> Project Administration</a></li>
								<li class="divider"></li>
								
								<!-- <li class="<?php echo ($this->uri->segment(1) == 'customers' ? 'active' : '');?>"><a href="<?php echo base_url('customers');?>"><i class="glyphicon glyphicon-lamp"></i> Customer Administration</a></li>
								<li class="divider"></li> -->

								<li class="<?php echo ($this->uri->segment(1) == 'roles' ? 'active' : '');?>"><a href="<?php echo base_url('roles');?>"><i class="glyphicon glyphicon-move"></i> Roles</a></li>
								<li class="<?php echo ($this->uri->segment(1) == 'users' ? 'active' : '');?>"><a href="<?php echo base_url('users');?>"><i class="glyphicon glyphicon-user"></i> User Administration</a></li>
								<li class="divider"></li>
								<li class="<?php echo ($this->uri->segment(1) == 'settings' ? 'active' : '');?>"><a href="<?php echo base_url('settings');?>"><i class="glyphicon glyphicon-cog"></i> System Administration</a></li>
							</ul>
						</li>
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void();" id="account_nav"><?php echo$this->session->userdata('mapro_login')['fullname'];?> <span class="caret"></span></a>
							<ul class="dropdown-menu" aria-labelledby="account_nav">
								<li><a href="javascript:void(0)" onClick="do_logout()">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>