<div class="clearfix"><br /></div>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-bordered table-striped">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Thread</th>
			</tr>
			<?php
			if (isset($notes) && count($notes) > 0) {
				foreach ($notes as $note) {
					?>
					<tr>
						<td>
							<div class="row-fluid">
								<div class="span12">
									<?php
									echo $note['Document']['id'];
									?>
								</div>
							</div>
						</td>
						<td>
							<div class="row-fluid">
								<div class="span12">
									<?php
									echo $note['Document']['name'];
									?>
								</div>
							</div>
						</td>
						
						<td>
							<div class="row-fluid">
								<div class="span12">
									<?php
									echo $this->Html->link(
											'View Thread',
											'/admin/documents/notethread/'.$note['Document']['id'].'/'.$id,
											array('class' => 'btn btn-primary')
											);
									?>
								</div>
							</div>
						</td>
					</tr>
					<?php
				}
			}
			?>
		</table>
	</div>
</div>

