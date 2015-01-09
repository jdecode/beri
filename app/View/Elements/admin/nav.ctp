<?php
$user_id = $this->Session->read('Admin.User.id');
$_controller = $this->params->params['controller'];
?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <div class="row-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
				<?php
				echo $this->Html->link(BERI, array('controller' => 'users', 'action' => 'index', 'admin' => true), array('class' => 'brand'));
				?>
				<?php
				if (isset($user_id)) {
					?>
					<div class="nav-collapse">
						<ul class="nav">
							<li><?php echo $this->Html->link('Front-end', '/', array('target' => '_blank')); ?></li>
							<li class="<?php echo get_class_from_action('users', $_controller) ?> dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									Users
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
											<!--<a href="#adminModalUser" data-toggle="modal"><i class="icon-plus"></i>Add</a>-->
										<?php
										echo $this->Html->link('<i class="icon-plus"></i> Add ', array('controller' => 'users',
											'action' => 'add',
											'admin' => true), array('escape' => false)
										);
										?>
									</li>
									<li><?php
										echo $this->Html->link('<i class="icon-list"></i> List', array('controller' => 'users',
											'action' => 'index',
											'admin' => true), array('escape' => false)
										);
										?>
									</li>


								</ul>
							</li>
							<li class="<?php echo get_class_from_action('projects', $_controller) ?> dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									Projects
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li>
										<a href="#adminModalProject" data-toggle="modal"><i class="icon-plus"></i>Add</a>
										<?php
										/*
										  echo $this->Html->link('<i class="icon-plus"></i> Add',
										  array('controller'  => 'projects',
										  'action' => 'add',
										  'admin' => true
										  ),
										  array('escape' => false)
										  );
										 */
										?>
									</li>

									<li>
										<?php
										echo $this->Html->link('<i class="icon-list"></i> List', array('controller' => 'projects',
											'action' => 'index',
											'admin' => true), array('escape' => false)
										)
										?>
									</li>
								</ul>
							</li>
						

							<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Leads&nbsp;&nbsp;<i class="caret"></i></a>
								<ul class="dropdown-menu">
									<li><?php echo $this->Html->link("All", array("controller" => "leads", "action" => "index", "admin" => true)) ?></li>
									<li><?php echo $this->Html->link("Open bid", array("controller" => "leads", "action" => "index", 1, "admin" => true)) ?></li>
									<li><?php echo $this->Html->link("Bid Placed", array("controller" => "leads", "action" => "index", 2, "admin" => true)) ?></li>
									<li><?php echo $this->Html->link("Declined", array("controller" => "leads", "action" => "index", 3, "admin" => true)) ?></li>
									<li><?php echo $this->Html->link("Feedback", array("controller" => "leads", "action" => "index", 4, "admin" => true)) ?></li>
									<li><?php echo $this->Html->link("Project started", array("controller" => "leads", "action" => "index", 5, "admin" => true)) ?></li>
									<li><?php echo $this->Html->link("Private Leads", array("controller" => "leads", "action" => "index","private_leads", "admin" => true)) ?></li>
								</ul>

							</li>
						</ul>
					</div><!--/.nav-collapse -->
					<div class="pull-right">
						<a class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="#">
							Admin
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link('Settings', array('controller' => 'users', 'action' => 'settings', 'admin' => true)); ?></li>
							<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout', 'admin' => true)); ?></li>
						</ul>
					</div>
					<?php
				}
				?>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($user_id)) {
	echo $this->Element(
		'admin/modal', array(
		'modal_header' => 'Add Project',
		'modal_body' => 'project_add',
		'model_name' => 'Project'
		)
	);
}
?>