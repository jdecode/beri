<?php
	$_status = array(0 => 'Deactivate', 1 => 'Activate');
?>
<div class="input-append row-fluid">
	<div class="span4">
	<?php
	echo $this->Form->input(
			'_action',
			array(
				'class' => '',
				'label' => false,
				'type' => 'select',
				'div' => false,
				'options' => $_status,
				'empty' => '--with selected--'
				)
			);
	echo $this->Form->button(
			'OK',
			array(
				'class' => 'btn',
				'label' => false,
				'value' => 'ok',
				'type' => 'submit'
				)
			);
	?>
	</div>
</div>
