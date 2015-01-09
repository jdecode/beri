<div class="users form well">
<?php echo $this->Form->create('User', array('class' => ''));?>
	<fieldset>
		<legend>Admin Login</legend>
	<?php
		echo $this->Form->input('email', array('placeholder' => 'Email', 'class' => 'span3', 'label' => false));
		echo $this->Form->input('password', array('placeholder' => 'Password', 'class' => 'span3', 'label' => false));
		echo $this->Form->button('Login', array('type' => 'Submit', 'class' => 'btn'));
		//echo '<br />';
		//echo $this->Html->link('Forgot password', array('controller' => 'users', 'action' => 'forgot_password', 'admin' => true), array('class' => 'btn', 'style' => 'margin-left: 55px;'));
	?>
	</fieldset>
<?php echo $this->Form->end();?>
</div>