<?php
//pr($task_statuses);
?>
<div class="well row">
    <div class="pull-left span10">
        <div class="span2">
            Hello
            <?php
            if (isset($_web_user_id) && $_web_user_id) {
                echo $_web_user_data['first_name'];
            }
            ?>
        </div>
        <div class="span2">
           <?php if($sale_access=="yes"){echo $this->Html->link("Leads",array("controller"=>"leads","action"=>"index"),array("class"=>'btn btn-small btn-success'));}?>
        </div>
    </div>
    <div class="pull-left span10">
        <div class="span10">	
            <?php
			
            echo $this->Form->create('User', array('controller' => 'users', 'action' => 'dashboard'));
            if (!isset($entry['Entry']['id'])) {
                echo $this->Form->input('type', array('type' => 'hidden', 'value' => '1'));
				echo '<br />';
                echo $this->Form->button('START DAY', array('type' => 'submit', 'class' => 'btn btn-large btn-danger'));
            } else {
                if ($entry['Entry']['type'] == 2) {
                    echo $this->Form->input('type', array('type' => 'hidden', 'value' => '1'));
					echo '<br />';
                    echo $this->Form->button('START DAY', array('type' => 'submit', 'class' => 'btn btn-large btn-danger'));
                } else if ($entry['Entry']['type'] == 1) {
                    echo $this->Form->input('type', array('type' => 'hidden', 'value' => '2'));
					echo '<br />';
					_task_list($tasks, $this->Form, $task_statuses);
                    echo $this->Form->button('END DAY', array('type' => 'submit', 'class' => 'btn btn-large btn-success'));
                }
            }
            echo $this->Form->end();
			
			
			function _task_list($tasks = array(), $form, $task_statuses) {
				if(is_array($tasks) && count($tasks)) {
					//pr($tasks);
					?>
					<table class="table">
						<tr>
							<td>&nbsp;</td>
							<td>Task</td>
							<td>Allocated hours</td>
							<td>Consumed hours</td>
							<td>Available hours</td>
							<td>Enter hours</td>
							<td>Status</td>
							<td>Completed?</td>
						</tr>
					<?php
					foreach ($tasks as $task) {
						echo "<tr>";
							echo "<td>";
								echo '&nbsp;';
								/*
								echo $form->input(
										"data[User][tasks][{$task['TasksUser']['id']}]",
										array(
											'type' => 'checkbox',
											'value' => 1,
											'label' => false
											)
										);
										*/
							echo "</td>";
							echo "<td>";
								echo $task['Task']['name'];
							echo "</td>";
							echo "<td>";
								echo $task['Task']['hours_allocated'];
							echo "</td>";
							echo "<td>";
								echo $task['TasksUser']['hours'];
							echo "</td>";
							echo "<td>";
								$available_hours = ((float)$task['Task']['hours_allocated']) - ((float) $task['TasksUser']['hours']);
								if($available_hours < 0) {
									echo '<span class="red">'.$available_hours.'</span>';
								}
							echo "</td>";
							echo "<td>";
								echo $form->input(
										"data[User][tasks][{$task['TasksUser']['id']}]",
										array(
											'div' => false,
											'label' => false,
											'placeholder' => 'Enter hours worked',
											'name' => "data[User][tasks][{$task['TasksUser']['id']}]",
										)
									);
							echo "</td>";
							echo "<td>";
								echo $task_statuses[$task['Task']['status']];
							echo "</td>";
							echo "<td>";
								echo $form->input(
										"data[User][tasks_completed][{$task['TasksUser']['id']}]",
										array(
											'type' => 'checkbox',
											'value' => 1,
											'label' => false,
											'name' => "data[User][tasks_completed][{$task['TasksUser']['id']}]",
											)
										);
							echo "</td>";
							
						echo "</tr>";
					}
					?>
					</table>
					<?php
				}
			}
			
            ?>
        </div>
    </div>

    
    <div class="span10">
        <?php
        $_last_10 = 12;
        ?>
        <table class="table table-bordered table-striped">
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Day start time
                </th>
                <th>
                    Day end time
                </th>
                <th>
                    Logged in time
                </th>
            </tr>
            <?php
            $session_stop = 0;
            $first = true;
            $i = 0;
            $data = '';


            foreach ($entries as $_entry) {

                $date = date('F d, Y', $_entry['Entry']['timestamp']);
                $session_start = date('H:i', $_entry['Entry']['timestamp']);
                if ($_entry['Entry']['type'] == 1) {
                    $green_zone = mktime(9, 30, 0, date("n", $_entry['Entry']['timestamp']), date("j", $_entry['Entry']['timestamp']), date("Y", $_entry['Entry']['timestamp']));
                    $orange_zone = $green_zone + 60 * 15;
                    if ($_entry['Entry']['timestamp'] <= $green_zone) {
                        $class = 'green';
                    }
                    if ($_entry['Entry']['timestamp'] > $green_zone && $_entry['Entry']['timestamp'] <= $orange_zone) {
                        $class = 'orange';
                    }
                    if ($_entry['Entry']['timestamp'] > $orange_zone) {
                        $class = 'red';
                    }
                }
                if ($first && $_entry['Entry']['type'] == 1) {
                    $_time = time();
                    $_diff = $_time - $_entry['Entry']['timestamp'];
                    $session_hours_ = floor(($_diff) / 3600);
                    $session_mins_ = floor(($_diff) / 60) % 60;
                    $data = "
						<tr class='$class'>
							<td>
								$date
							</td>
							<td>
								$session_start
							</td>
							<td>
								--
							</td>
							<td>
								<strong>$session_hours_ h $session_mins_ min</strong> [since last login]
							</td>
						</tr>
						";
                    $first = false;
                    continue;
                }
                if ($_entry['Entry']['type'] == 2) {
                    $_session_stop = $_entry['Entry']['timestamp'];
                }
                if ($_entry['Entry']['type'] == 1) {

                    $session_stop = date('H:i', $_session_stop);
                    $diff = $_session_stop - $_entry['Entry']['timestamp'];
                    $session_hours = floor(($diff) / 3600);
                    $session_mins = floor(($diff) / 60) % 60;
                    $_award = '';
                    if ($session_hours >= 9) {
                        $_award = '<i class="iconic-o-plus" style="color:#51A351; font-size: 18px;"></i>';
                    }
                    if ($session_hours > 12) {
                        //$_award = '<i class="iconic-award" style="color:#51A351; font-size: 18px;"></i><i class="iconic-o-plus" style="color:#51A351; font-size: 18px;"></i>';
                    }
                    if ($session_hours < 9) {
                        $_award = '<i class=" iconic-o-minus" style="color:#BD362F;"></i>';
                    }

                    //	<br />
                    //{$_entry['Entry']['timestamp']}<br /> ".GREEN_ZONE."<br />".ORANGE_ZONE."<br />$class
                    $data .= "
						<tr>
							<td>
								$date | {$_entry['Entry']['id']}
							</td>
							<td class='$class'>
								$session_start
							</td>
							<td>
								$session_stop
							</td>
							<td>
								$session_hours h $session_mins min $_award
							</td>
						</tr>
						";
                    $session_stop = 0;
                }
                $first = false;
            }
            echo $data;
            ?>
        </table>
		
		<br />
		Legend
		<table>
			<tr>
				<td class="red">&nbsp; &nbsp; &nbsp;</td>
				<td> &nbsp; Late</td>
			</tr>
			<tr>
				<td class="orange"  style="margin-top: 2px; padding-top: 2px; border-top: 2px solid white">&nbsp; &nbsp; &nbsp;</td>
				<td> &nbsp; Warning zone</td>
			</tr>
			<tr>
				<td class="green"><i class="iconic-o-plus" style="color:#51A351; font-size: 18px;"></i>;</td>
				<td> &nbsp; Overtime</td>
			</tr>
			<tr>
				<td class="green"><i class="iconic-o-minus" style="color:#BD362F; font-size: 18px;"></i>;</td>
				<td> &nbsp; Early leave</td>
			</tr>
		</table>
    </div>
</div>

