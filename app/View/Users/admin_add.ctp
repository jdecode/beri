<div class="">
<?php echo $this->Form->create('User', array('class' => ""));?>
	<div class="<?php //echo $_class; ?>">
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input(
				'group_id',
				array(
				'options' =>
					$groups,
					'type' => 'radio',
					'class' => "radio validate[required]",
					'legend' => false,
					'error' => false,
					'default' => isset($this->request->data['User']['group_id']) ? @$this->request->data['User']['group_id'] : 1
					)
				);
			is_errored('group_id', @$errors);
		echo "<br />";
		echo $this->Form->input(
				'first_name',
				array(
					'class' => "span3 validate[required]",
					'error' => false,
					'label' => 'First Name <span style="color:red;">*</span>',
					'escape' => false
					)
				);
			is_errored('first_name', @$errors);
		echo $this->Form->input(
				'last_name',
				array(
					'class' => "span3 validate[required]",
					'error' => false,
					'label' => 'Last Name <span style="color:red;">*</span>',
					'escape' => false
					)
				);
			is_errored('last_name', @$errors);
		echo $this->Form->input(
				'email',
				array(
					'class' => "span3 validate[required,custom[email]]",
					'error' => false,
					'label' => 'Email <span style="color:red;">*</span>',
					'escape' => false
					)
				);
			is_errored('email', @$errors);
		echo $this->Form->input(
				'password',
				array(
					'class' => "span3 validate[required]",
					'error' => false,
					'label' => 'Password <span style="color:red;">*</span>',
					'escape' => false
					)
				);
		echo $this->Form->button('Add', array('type' => 'submit', 'class' => 'btn'));
		echo $this->Html->link('Cancel', '#', array('style' => 'padding-left : 10px;', 'id' => 'Cancel'));
	?>
	</div>
<?php echo $this->Form->end();?>
</div>
<script type="text/javascript">
	$(document).ready( function () {
		$("#UserAdminAddForm").validationEngine();
		$('#Cancel').click( function () {
			$('input').each(function() {
				$(this).val('');
			});
		});
	});
</script>
<!--[if IE ]>
<style type="text/css">
	.radio label { float: left; width: 100px; padding-top: 6px;}
</style>
<![endif]-->