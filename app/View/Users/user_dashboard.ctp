<div class="" >
	<h2>&nbsp;</h2>
	<div class="span2">

		<?php echo $this->Html->image("user.png", array("class" => "img-rounded")) ?>
	</div>
	<div class="span9">

		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#lA">Leads</a></li>
				<li><a data-toggle="tab" href="#lB">Section 2</a></li>
				<li><a data-toggle="tab" href="#lC">Section 3</a></li>
			</ul>
			<div class="tab-content">
				<div id="lA" class="tab-pane active">

					<div style=" padding:5px; border-left: 1px solid #dddddd;border-top: 1px solid #dddddd;">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#A">Project started</a></li>
							<li><a data-toggle="tab" href="#B">Feedback</a></li>
							<li><a data-toggle="tab" href="#C">Bid Placed</a></li>
							<li><a data-toggle="tab" href="#D">Decline</a></li>
						</ul>
						<div class="tab-content">
							<div id="A" class="tab-pane active">

								<table class="table table-bordered">
									<thead>
										<tr>
											<th width="5%">Sr.no.</th>
											<th width="75%">Title</th>
											<th width="20%">Action</th>
										</tr>
									</thead><tbody>
										<?php
										if (!empty($setLeadData["5"])) {
											$i = 1;
											foreach ($setLeadData["5"] as $val) {
												?>

												<tr>
													<td><?php echo $i; ?></td>
													<td ><?php echo $val["lead_title"] ?></td>
													<td><?php echo $this->Html->link("View", array("controller" => "leads", "action" => "index", 5,$val["lead_id"])); ?></td>
												</tr>

												<?php
												$i++;
											}
										} else {

											printf("<tr><td colspan=\"3\">%s</td></tr>", "No Record Found");
										}
										?>
									</tbody>
								</table>
							</div>
							<div id="B" class="tab-pane">

								<table class="table table-bordered">
									<thead>
										<tr>
											<th width="5%">Sr.no.</th>
											<th width="75%">Title</th>
											<th width="20%">Action</th>
										</tr>
									</thead><tbody>
										<?php
										if (!empty($setLeadData["4"])) {
											$i = 1;
											foreach ($setLeadData["4"] as $val) {
												?>

												<tr>
													<td><?php echo $i; ?></td>
													<td ><?php echo $val["lead_title"] ?></td>
													<td><?php echo $this->Html->link("View", array("controller" => "leads", "action" => "index",4, $val["lead_id"])); ?></td>
												</tr>

												<?php
												$i++;
											}
										} else {

											printf("<tr><td colspan=\"3\">%s</td></tr>", "No Record Found");
										}
										?>
									</tbody>
								</table>
							</div>
							<div id="C" class="tab-pane">

								<table class="table table-bordered">
									<thead>
										<tr>
											<th width="5%">Sr.no.</th>
											<th width="75%">Title</th>
											<th width="20%">Action</th>
										</tr>
									</thead><tbody>
										<?php
										if (!empty($setLeadData["2"])) {
											$i = 1;
											foreach ($setLeadData["2"] as $val) {
												?>

												<tr>
													<td><?php echo $i; ?></td>
													<td ><?php echo $val["lead_title"] ?></td>
													<td><?php echo $this->Html->link("View", array("controller" => "leads", "action" => "index",2, $val["lead_id"])); ?></td>
												</tr>

												<?php
												$i++;
											}
										} else {

											printf("<tr><td colspan=\"3\">%s</td></tr>", "No Record Found");
										}
										?>
									</tbody>
								</table>
							</div>
							<div id="D" class="tab-pane">

								<table class="table table-bordered">
									<thead>
										<tr>
											<th width="5%">Sr.no.</th>
											<th width="75%">Title</th>
											<th width="20%">Action</th>
										</tr>
									</thead><tbody>
										<?php
										if (!empty($setLeadData["3"])) {
											$i = 1;
											foreach ($setLeadData["3"] as $val) {
												?>

												<tr>
													<td><?php echo $i; ?></td>
													<td ><?php echo $val["lead_title"] ?></td>
													<td><?php echo $this->Html->link("View", array("controller" => "leads", "action" => "index",3, $val["lead_id"])); ?></td>
												</tr>

												<?php
												$i++;
											}
										} else {

											printf("<tr><td colspan=\"3\">%s</td></tr>", "No Record Found");
										}
										?>
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
				<div id="lB" class="tab-pane">
					<p>Howdy, I'm in Section B.</p>
				</div>
				<div id="lC" class="tab-pane">
					<p>What up girl, this is Section C.</p>
				</div>
			</div>
		</div>
	</div>
</div>
