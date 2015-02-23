<?php ?>
<div class="navbar navbar-fixed-top intranet-blue">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <a href="<?php echo $this->webroot; ?>" class="brand active white"><?php echo BERI; ?></a>
        <div class="nav-collapse">
            <ul class="nav">
                <?php
                if (isset($_web_user_id) && $_web_user_id) {
                    ?>
                    <li class="dropdown">
                        <a
                            class="white font16 bold dropdown-toggle"
                            href="#"
                            data-toggle="dropdown"
                            ><?php echo $_web_user_data['first_name']; ?>&nbsp;&nbsp;<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
							<?php
							if($sale_access == 'yes') {
							?>
                            <li><?php echo $this->Html->link('Profile', array("controller"=>"users", "action"=>"user_dashboard")); ?></li>
                            <li><?php echo $this->Html->link('History', array("controller" => "users", "action" => "session_history")); ?></li>
							<?php
							}
							?>
                            <li><?php echo $this->Html->link('Logout', '/logout'); ?></li>
                        </ul>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="dropdown">
                        <a
                            class="white font16 bold dropdown-toggle"
                            href="#"
                            data-toggle="dropdown"
                            >Login&nbsp;&nbsp;<i class="caret"></i>
                        </a>
                        <div class="dropdown-menu drop-login">
                            <?php
                            echo $this->element('web/login', array('nav' => true));
                            ?>
                        </div>
                    </li>
                    <?php
                }
                if (!empty($_web_user_data) && $_web_user_data["group_id"] && $sale_access == 'yes') {
                    ?>
                    <li class="dropdown"><a class="white font16 bold dropdown-toggle" data-toggle="dropdown">Leads&nbsp;&nbsp;<i class="caret"></i></a>
                        <ul class="dropdown-menu">
                            <li><?php echo $this->Html->link("All",array("controller"=>"leads","action"=>"index"))?></li>
                            <li><?php echo $this->Html->link("Open bid",array("controller"=>"leads","action"=>"index",1))?></li>
                            <li><?php echo $this->Html->link("Bid Placed",array("controller"=>"leads","action"=>"index",2))?></li>
                            <li><?php echo $this->Html->link("Declined",array("controller"=>"leads","action"=>"index",3))?></li>
                            <li><?php echo $this->Html->link("Feedback",array("controller"=>"leads","action"=>"index",4))?></li>
                            <li><?php echo $this->Html->link("Project started",array("controller"=>"leads","action"=>"index",5))?></li>
                            <li><?php echo $this->Html->link("Private Leads",array("controller"=>"leads","action"=>"private_leads"))?></li>
                        </ul>

                    </li>
                <?php } ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<script type="text/javascript">
	
	Rootsiteurl="<?php echo $this->webroot?>";
	
    $(document).ready(function() {
        // Fix input element click problem
        $('.dropdown input, .dropdown label').click(function(e) {
            e.stopPropagation();
        });
        $('#UserLoginForm').validationEngine({scroll: false});
    });
</script>
