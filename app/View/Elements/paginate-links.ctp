<div class="pagination">
    <ul>
		<?php
		echo $this->Paginator->prev(
			'&#60; ' . __('Previous'),
			array(
				'escape' => false,
				'tag' => 'li'
			),
			'<a onclick="return false;">&#60; Previous</a>',
			array(
				'class'=>'disabled prev',
				'escape' => false,
				'tag' => 'li'
			)
		)		?>
		<?php
		echo $this->Paginator->numbers(
				array(
				'separator' => ' ',
				'tag' => 'li'
				)
			);
		?>
		<?php
		echo $this->Paginator->next(
				__('Next') . ' &#62;',
				array(
					'escape' => false,
					'tag' => 'li'
				),
				'<a onclick="return false;">Next &#62;</a>',
				array(
					'class' => 'disabled next',
					'escape' => false,
					'tag' => 'li'
				)
			);
		?>
    </ul>
</div>

<script type="text/javascript">
	$('.pagination .current').html('<a>'+$('.pagination .current').html()+'</a>');
	$('.pagination .current').addClass('disabled');
</script>
