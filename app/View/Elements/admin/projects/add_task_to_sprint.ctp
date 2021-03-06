<div class="clearfix"><br /></div>
<div class="row-fluid">
	<div class="span12">


		<!-- --------------------------------------------------- -->



		<div class="tab-content1" >
			<?php
			echo $this->Form->create('Task', array('url' => '/admin/projects/assgin_task_to', 'id' => 'add_sprint_task', 'class' => 'ajax_form'));
			?>
			<div id="to_do_ID_show" class="tab-pane" >
				<div style="height: 200px; overflow-y: scroll;">
					<table class="table table-bordered table-striped" >
						<tr>
							<th>Module</th>
							<th>Task</th>
							<th>Hours</th>
							<th>Select</th>
							<th>Assign to</th>
						</tr>
						<?php
						echo $this->Form->input("project", array("type" => "hidden", "value" => $tasks[0]['Module']['project_id']));
						echo $this->Form->input("sprint_id", array("type" => "hidden", "value" => '', 'id' => 'ren_sprint_id'));
						
							foreach ($tasks as $k => $task) {
							
							if(!empty($task["TasksUser"])){
								$un="line-through";
								$sel="disabled";
							}else{
								$un="";
								$sel="";
							}
							?>
						<tr id="tr<?php echo $task['Task']['id']; ?>" style=" text-decoration:<?php echo $un; ?>">
								<td ><?php
									echo $task['Module']['name'];
									?></td>
								<td><?php echo $task['Task']['name'] ?></td>
								<td><?php echo $task['Task']['hours_allocated'] ?></td>
								<td><?php
									$checked = "";
									if (!empty($task['SprintsTask']["id"])) {
										$checked = "checked";
									}

									echo $this->Form->input(
										'select', array(
										'type' => 'checkbox',
										'label' => false,
										'div' => false,
										'name' => 'tasks[]',
										'value' => $task['Task']['id'],
										'rel' => $task['SprintsTask']['sprint_id'],
										'id' => 'checkbox_task_' . $task['Task']['id'],
										'checked' => $checked
										)
									);
									?></td>
								<td><?php
								
								$default='';
								if (!empty($task['TasksUser'])) {
									
									$user_id_arr=end($task["TasksUser"]);
									//pr($user_id_arr);
										$default = $user_id_arr["user_id"];
									}
									
								
									echo $this->Form->input(
										'assign', array(
										'label' => false,
										'div' => false,
										'options' => $users,
										'name' => "user[{$task['Task']['id']}][]",
										'id' => 'user_task_' . $task['Task']['id'],
										'default'=>$default,
										'empty'=>"Select",
										$sel=>$sel	
										)
									);
									?></td>
							</tr>
							<?php
						}
						?>
					</table>

				</div>
				<div style="margin-top: 10px;">

					&nbsp;
				</div>
				<div class="span2" style="width:10.53%;margin-left: 0">	<?php
					echo $this->Form->input("Cancel", array("type" => "button", "class" => "btn btn-inverse", "label" => false, "aria-hidden" => "true", "data-dismiss" => "modal", "div" => false));
					?></div>
				<div class="span2"  style="width:10.53%;margin-left:0">	
					<?php
					echo $this->Form->input("Assign", array("type" => "button", "class" => "btn btn-inverse", "label" => false, "div" => false));
					?>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>

		</div>


		<!------------------------------------------------------->





	</div>
</div>

<script>
    $(document).ready(function () {
        $('.ajax_form').validationEngine();



    });
</script>