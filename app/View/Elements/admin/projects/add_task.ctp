<div class="row-fluid">
	<div class="span12">
		<?php
		echo $this->Form->create('Task', array('url' => '/admin/tasks/add', 'class' => 'ajax_form', 'id' => 'add_task'));
		echo $this->Form->input('name', array('class' => 'validate[required]', 'Placeholder' => 'Task name'));
		echo $this->Form->input('hours', array('class' => 'validate[required]', 'Placeholder' => 'Hours'));
		echo $this->Form->input(
			'module_id', array(
			'options' => $modules,
			'class' => 'validate[required]',
			'empty' => '--- Select One ---'
			)
		);
		echo $this->Form->input(
			'add_module', array(
			'Placeholder' => 'Enter a new module',
			'label' => false,
			'class' => 'validate[required]',
			'div' => array(
				'style' => 'display: none;'
			)
			)
		);
		echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-inverse', 'label' => false, 'value' => 'Save', 'id' => 'save_task'));
		echo $this->Form->end();
		?>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('.ajax_form').validationEngine();
		$('#TaskModuleId').change( function () {
			if($(this).val() == 0) {
				$('#TaskAddModule').parent().show();
			} else {
				$('#TaskAddModule').parent().hide();
			}
		});
		 
		$('#add_task').submit( function () {
			//Ajax Post data save
			//alert($("#add_task").validationEngine('validate'));
			
			if(!$("#add_task").validationEngine('validate'))
			{
				return false;
			} else {
				$.ajax({
					type: "POST",
					data: {
						'data[Task][name]': $('#TaskName').val(),
						'data[Task][module_id]': $('#TaskModuleId').val(),
						'data[Task][project_id]': <?php echo $id; ?>,
						'data[Task][add_module]]': $('#TaskAddModule').val(),
						'data[Task][hours]]': $('#TaskHours').val()
					},
					url: "<?php echo $this->webroot; ?>projects/add_task/"
				}).done(function( data ) {
					_json_data = jQuery.parseJSON(data);
					if(_json_data.status == 0) {
						alert('Task could not be saved.. please try again');
					}
					if(_json_data.status == 1) {
						alert('Task Saved');
						if(!isNaN(_json_data.module) && _json_data.module != 0) {
							$('#TaskModuleId').append('<option value="'+_json_data.module+'">'+$('#TaskAddModule').val()+'</option>');
							$('#TaskModuleId').val(_json_data.module);
							$('#TaskAddModule').parent().hide();
							$('#TaskAddModule').val('');
						}
						$('#TaskName').val('');
						$('#TaskHours').val('');
						$('#TaskName').focus();
					}
					if(_json_data.status == 2) {
						alert('Please enter new module name');
					}
				});
			}
			
			return false;
		});
		
		
	});
</script>
