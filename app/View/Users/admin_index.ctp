<?php
//pr($users);
?>
<div class="well">
	<?php
	?>
	<table cellpadding="0" cellspacing="0" class="table table-striped table-condensed table-bordered ">
		<tr>
			<th><?php echo $this->Paginator->sort('id', 'User ID'); ?></th>
			<th><?php echo 'Time'; ?></th>
			<th><?php echo $this->Paginator->sort('first_name', 'Name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Joined On'); ?></th>
			<th><?php echo 'View Detail'; ?></th>
			<th>Project Status</th>
		</tr>
		<?php
		if (count($users)) {
			foreach ($users as $user):
				$_entry['Entry'] = isset($user['Entry'][0]) ? $user['Entry'][0] : false;
				$class = $this->User->getClassFromEntry($_entry);
				?>
				<tr class="<?php echo $class; ?>">
					<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
					<td><?php echo date('H:i', $_entry['Entry']['timestamp']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['first_name']) . ' ' . h($user['User']['last_name']); ?>&nbsp;</td>
					<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
					<td><?php echo ($user['User']['created']) ? date("m/d/y", $user['User']['created']) : "N.A."; ?>&nbsp;</td>
					<td><?php
						echo $this->Html->link(
							'View Detail', array(
							'controller' => 'users',
							'action' => 'userdetail/' . $user['User']['id'],
							'admin' => true,
							)
						);
						?></td>


					<td class="text-center">
						<?php
						$total_leads = 0;
						if (array_key_exists($user["User"]["id"], $user_lead_data)) {
							$total_leads = $user_lead_data[$user["User"]["id"]];
						}
						echo $this->Html->link('&nbsp;<span  style="background: #54A954;
                                  color: #fff;
                                  float: left;
                                  font-size: 11px;
                                  padding: 1px 7px 1px 7px;margin-left:7px;
                                  width: auto;" class="img-circle">' . $total_leads . ' </span>', array("controller" => "leads", "action" => "index", 5, $user["User"]["id"]), array("escape" => false, "title" => "Project started"));




						$total_feedback = 0;
						if (array_key_exists($user["User"]["id"], $user_feedback_lead_data)) {
							$total_feedback = $user_feedback_lead_data[$user["User"]["id"]];
						}
						echo $this->Html->link('<span  style="background:#F8960A;
                                  color: #fff;
                                  float: left;
                                  font-size: 11px;
                                  padding: 1px 7px 1px 7px;margin-left:7px;
                                  width: auto;" class="img-circle">' . $total_feedback . ' </span>', array("controller" => "leads", "action" => "index", 4, $user["User"]["id"]), array("escape" => false, "title" => "Feedback"));


						$total_decline = 0;
						if (array_key_exists($user["User"]["id"], $user_decline_lead_data)) {
							$total_decline = $user_decline_lead_data[$user["User"]["id"]];
						}
						echo $this->Html->link('<span  style="background:#C83F39;
                                  color: #fff;
                                  float: left;
                                  font-size: 11px;
                                  padding: 1px 7px 1px 7px;margin-left:7px;
                                  width: auto;" class="img-circle">' . $total_decline . ' </span>', array("controller" => "leads", "action" => "index", 3, $user["User"]["id"]), array("escape" => false, "title" => "Decline"));


						$total_placed = 0;
						if (array_key_exists($user["User"]["id"], $user_place_lead_data)) {
							$total_placed = $user_place_lead_data[$user["User"]["id"]];
						}
						echo $this->Html->link('<span  style="background:#2F96B4;
                                  color: #fff;
                                  float: left;
                                  font-size: 11px;
                                  padding: 1px 7px 1px 7px;margin-left:7px;
                                  width: auto;" class="img-circle">' . $total_placed . ' </span>', array("controller" => "leads", "action" => "index", 2, $user["User"]["id"]), array("escape" => false, "title" => "Placed bid"));
						?>

					</td>



				</tr>
				<?php
			endforeach;
		} else {
			?>
			<tr>
				<td colspan="9">
					<div class="pagination-centered">
						<strong><?php echo __('NO_RECORD_FOUND'); ?></strong>
					</div>
				</td>
			</tr>
			<?php
		}
		?>
	</table>
	<div class="paging">
		<?php echo $this->Element('paginate-links'); ?>
	</div>
</div>

