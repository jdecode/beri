<div class="clearfix"><br /></div>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-bordered table-striped">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>File</th>
			</tr>
			<?php
			if (isset($documents) && count($documents)) {
				foreach ($documents as $document) {
					?>
					<tr>
						<td>
							<div class="row-fluid">
								<div class="span12">
									<?php
									echo $document['Document']['id'];
									?>
								</div>
							</div>
						</td>
						<td>
							<div class="row-fluid">
								<div class="span12">
									<?php
									echo $document['Document']['name'];
									?>
								</div>
							</div>
						</td>
						<td>
							<div class="row-fluid">
								<div class="span12">
									<?php
									echo $this->Html->link('Download', '/files/documents/'.$document['Document']['filename']);
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

