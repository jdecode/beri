<div class="leads form">
	<fieldset>
		<legend><?php echo __('Add Lead'); ?></legend>


		<?php echo $this->Form->create("Lead", array('url' => array('controller' => 'leads', 'action' => 'add'), "class" => "form-horizontal","id"=>"add_new_project_lead")); ?>
		<div class="control-group">
			<label class="control-label" for="inputEmail"><strong>Title:</strong></label>
			<div class="controls">
				<?php echo $this->Form->input('title', array("type" => "text", "label" => false, "class" => "input-xxlarge validate[required] text-input","required"=>false)); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword"><strong>Link:</strong></label>
			<div class="controls">
				<?php echo $this->Form->input('link', array("type" => "text", "label" => false, "class" => "input-xxlarge  validate[required] text-input","required"=>false)); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="inputPassword"><strong>Budget $:</strong></label>
			<div class="controls">
				<?php echo $this->Form->input('budget_amount', array("type" => "text", "label" => false, "class" => "input-small  validate[required] text-input","required"=>false)); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="inputPassword"><strong>Source:</strong></label>
			<div class="controls">
				<?php echo $this->Form->input('source', array("options" => $sources, "label" => false, "class" => "input-large","default"=>3)); ?>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="inputPassword"><strong>Description:</strong></label>
			<div class="controls">
				<?php echo $this->Form->input('description', array("type" => "textarea", "label" => false, "class" => "input-xxlarge  validate[required] text-input","required"=>false)); ?>
			</div>
		</div>



		





		<div class="control-group">
			<div class="controls">
				<?php echo $this->Html->link('Cancel', array("controller" => "leads", "action" => "index"), array("class" => "btn btn-success", "div" => false)); ?>
				<?php echo $this->Form->button('Add', array("type" => "submit", "label" => false, "class" => "btn btn-success", "div" => false)); ?>
			</div>
		</div>
		</form>
	</fieldset>
</div>

<?php
/*
  <div class="leads form">
  <?php echo $this->Form->create('Lead'); ?>
  <fieldset>
  <legend><?php echo __('Add Lead'); ?></legend>
  <?php
  echo $this->Form->input('uid');
  echo $this->Form->input('link');
  echo $this->Form->input('title');
  echo $this->Form->input('description');
  echo $this->Form->input('source');
  echo $this->Form->input('status');
  echo $this->Form->input('reply');
  echo $this->Form->input('active');
  echo $this->Form->input('deleted');
  ?>
  </fieldset>
  <?php echo $this->Form->end(__('Submit')); ?>
  </div>
  <div class="actions">
  <h3><?php echo __('Actions'); ?></h3>
  <ul>

  <li><?php echo $this->Html->link(__('List Leads'), array('action' => 'index')); ?></li>
  </ul>
  </div>
 */?>