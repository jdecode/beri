<div class="well row-fluid">
	<div class="span10">
		<h3>
		Reporting for <?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?>
		</h3>
	</div>
	<div class="content span10">
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
			$comment = '';

			
			foreach($entries as $_entry) {

				$date = date('F d, Y', $_entry['Entry']['timestamp']);
				$session_start = date('H:i', $_entry['Entry']['timestamp']);
				
				$class = $this->User->getClassFromEntry($_entry);
				//pr($_entry);
			
				if($first && $_entry['Entry']['type'] == 1) {
					$_time = time();
					$_diff = $_time - $_entry['Entry']['timestamp'];
					$session_hours_ = floor(($_diff)/3600);
					$session_mins_ = floor(($_diff)/60)%60;
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
							<td>
							<span title='User comment'  data-html='true' data-content='".$comment."' data-placement='left' data-toggle='popover' class='btn comment_pop'  data-original-title='Popover on left'>Comment</span>
								</td>
						</tr>
						";
					$first = false;
					continue;
				}
				if($_entry['Entry']['type'] == 2) {
					$_session_stop = $_entry['Entry']['timestamp'];
					$comment=!empty($_entry["Comment"]["comment"])?$_entry["Comment"]["comment"]:"<i style=color:red>No Comment Entered</i>";
				}
				if($_entry['Entry']['type'] == 1) {

					$session_stop = date('H:i', $_session_stop);
					$diff = $_session_stop - $_entry['Entry']['timestamp'];
					$session_hours = floor(($diff)/3600);
					$session_mins = floor(($diff)/60)%60;
					$_award = '';
					if($session_hours >= MINIMUM_OFFICE_HOURS) {
						$_award = '<i class="iconic-o-plus" style="color:#51A351; font-size: 18px;"></i>';
					}
					if($session_hours > 12) {
						//$_award = '<i class="iconic-award" style="color:#51A351; font-size: 18px;"></i><i class="iconic-o-plus" style="color:#51A351; font-size: 18px;"></i>';
					}
					if($session_hours < MINIMUM_OFFICE_HOURS) {
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
							<td>
							<span title='User comment'  data-html='true' data-content='".$comment."' data-placement='left' data-toggle='popover' class='btn comment_pop'  data-original-title='Popover on left'>Comment</span>
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
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.comment_pop').popover();
	})
	
	</script>
