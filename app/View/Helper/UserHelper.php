<?php
/**
 * User Helper
 *
 * For User specific helper methods
 *
 * @category Helper
 * @package  Beri
 * @version  1.0
 * @author   Jagdeep Singh <jdecode@gmail.com>
 */
App::uses('Helper', 'View');

class UserHelper extends Helper {

	public function getClassFromEntry($_entry = array()) {
		$class = '';
		if ($_entry['Entry']['type'] == 1) {
			$green_zone = mktime(OFFICE_START_HOUR, OFFICE_START_MINUTE, 0, date("n", $_entry['Entry']['timestamp']), date("j", $_entry['Entry']['timestamp']), date("Y", $_entry['Entry']['timestamp']));
			$orange_zone = $green_zone + 60 * OFFICE_START_LENIANCE;
			if ($_entry['Entry']['timestamp'] <= $green_zone) {
				$class = 'green2';
			}
			if ($_entry['Entry']['timestamp'] > $green_zone && $_entry['Entry']['timestamp'] <= $orange_zone) {
				$class = 'orange';
			}
			if ($_entry['Entry']['timestamp'] > $orange_zone) {
				$class = 'red';
			}
		}
		//echo date('F d, Y H:i', $_entry['Entry']['timestamp']).'<br />';
		return $class;
	}

	function _task_list($tasks = array(), $form, $task_statuses) {
		if (is_array($tasks) && count($tasks)) {
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
					$available_hours = ((float) $task['Task']['hours_allocated']) - ((float) $task['TasksUser']['hours']);
					if ($available_hours < 0) {
						echo '<span class="red">' . $available_hours . '</span>';
					}
					echo "</td>";
					echo "<td>";
					echo $form->input(
							"data[User][tasks][{$task['TasksUser']['id']}]", array(
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
							"data[User][tasks_completed][{$task['TasksUser']['id']}]", array(
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

	}
	