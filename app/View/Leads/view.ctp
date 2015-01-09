<div class="leads view">
<h2><?php echo __('Lead'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uid'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['uid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Source'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['source']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reply'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['reply']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['deleted']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($lead['Lead']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Lead'), array('action' => 'edit', $lead['Lead']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Lead'), array('action' => 'delete', $lead['Lead']['id']), array(), __('Are you sure you want to delete # %s?', $lead['Lead']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Leads'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lead'), array('action' => 'add')); ?> </li>
	</ul>
</div>
