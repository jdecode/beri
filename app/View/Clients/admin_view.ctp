<div class="clients view">
<h2><?php  echo __('Client'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($client['Client']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($client['Client']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($client['Client']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($client['Client']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo h($client['Client']['company']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($client['Client']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Skype'); ?></dt>
		<dd>
			<?php echo h($client['Client']['skype']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Google'); ?></dt>
		<dd>
			<?php echo h($client['Client']['google']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Yahoo'); ?></dt>
		<dd>
			<?php echo h($client['Client']['yahoo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Hotmail'); ?></dt>
		<dd>
			<?php echo h($client['Client']['hotmail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modifed'); ?></dt>
		<dd>
			<?php echo h($client['Client']['modifed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($client['Client']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Client'), array('action' => 'edit', $client['Client']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Client'), array('action' => 'delete', $client['Client']['id']), null, __('Are you sure you want to delete # %s?', $client['Client']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('action' => 'add')); ?> </li>
	</ul>
</div>
