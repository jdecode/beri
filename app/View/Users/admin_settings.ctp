<div class="well">
<?php echo $this->Form->create('User', array('class' => ""));?>
	<div class="<?php //echo $_class; ?>">
		<legend><?php echo __('Settings'); ?></legend>
	<?php

		echo $this->Form->input(
				'old_password',
				array(
					'class' => "span3 validate[required]",
					'error' => false,
					'type' => 'password',
					'value' => '',
					'autocomplete' => 'off'
					)
				);
			is_errored('old_password', @$errors);
		echo $this->Form->input(
				'new_password',
				array(
					'class' => "span3 validate[required]",
					'error' => false,
					'type' => 'password',
					'value' => '',
					'autocomplete' => 'off'
					)
				);
			is_errored('new_password', @$errors);
		echo $this->Form->input(
				'repeat_password',
				array(
					'class' => "span3 validate[required]",
					'error' => false,
					'type' => 'password',
					'value' => '',
					'autocomplete' => 'off',
					'label' => 'Confirm Password'
					)
				);
			is_errored('repeat_password', @$errors);
		echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn'));
		echo $this->Html->link('Cancel', '#', array('style' => 'padding-left : 5px;', 'id' => 'Cancel'));
	?>
	</div>
<?php echo $this->Form->end();?>
</div>
<script type="text/javascript">
	$(document).ready( function () {
		$("#UserAdminSettingsForm").validationEngine();
		$('#Cancel').click( function () {
			$('input').each(function() {
				$(this).val('');
			});
		});
	});
</script>
