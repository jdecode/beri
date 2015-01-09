<div class="row-fluid">
	<div class="span12">
		<?php
		echo $this->Form->create('Sprint', array('url' => '/admin/sprints/add', 'class' => 'ajax_form', 'id' => 'add_sprint'));
		echo $this->Form->input('name', array('class' => 'validate[required]', 'Placeholder' => 'Sprint name'));
		echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-inverse', 'label' => false, 'value' => 'Save', 'id' => 'save_sprint'));
		echo $this->Form->end();
		?>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.ajax_form').validationEngine();
		$('#add_sprint').submit( function () {
			//Ajax Post data save
			if(!$("#add_sprint").validationEngine('validate'))
			{
				return false;
			} else {
				$.ajax({
					type: "POST",
					data: {
						'data[Sprint][name]': $('#SprintName').val(),
						'data[Sprint][project_id]': <?php echo $id; ?>
					},
					url: "<?php echo $this->webroot; ?>projects/add_sprint/"
				}).done(function( data ) {
					_json_data = jQuery.parseJSON(data);
					if(_json_data.status == 0) {
						alert('Sprint could not be saved.. please try again');
					}
					if(_json_data.status == 1) {
						alert('Sprint Saved');
						$('#SprintName').val('');
						$('#SprintName').focus();
					}
				});
			}
			return false;
		});
	});
</script>
