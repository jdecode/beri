<?php
	if(!isset ($nav)) {
		$nav = false;
	}
?>
<div class="<?php echo ($nav ? 'span12' : 'span8 well'); ?>">
	<div class="row-fluid">
		<div class="">
			<?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'login'));?>
			<fieldset>
				<?php echo ($nav ? '' : '<legend>Login</legend>'); ?>
				<?php
				echo $this->Form->input('username', array('placeholder' => 'Username', 'class' => ($nav ? 'span12' : 'span6'), 'label' => false));
				echo $this->Form->input('password', array('placeholder' => 'Password', 'class' => ($nav ? 'span12' : 'span6'), 'label' => false));
				echo $this->Form->button('Login', array('type' => 'Submit', 'class' => 'btn', 'value' => 'login'));
				?>
			</fieldset>
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>
