<?php
	//$_categories = $this->requestAction('categories/getActiveCategories');
?>
<div class="span2 sidebar">
	<ul class="unstyled">
		<li><a href="<?php echo $this->webroot; ?>" class="category">Home</a></li>
		<li><a href="<?php echo $this->webroot.'posts/browse'; ?>" class="category">Latest Posts</a></li>
		<li class="title">
			<a href="#" class="title">Sections</a>
		</li>
		<?php
		?>
			<ul class="subcategory unstyled">
				<?php
					foreach($sections as $k => $section) {
				?>
				<li><a href="<?php echo $this->webroot.''.$urls[$k]; ?>" class="category"><?php echo $section; ?></a></li>
				<?php
					}
				?>
			</ul>
		<?php
			foreach($_categories as $_category) {
		?>
		<li class="title">
			<a href="#" class="title"><?php echo $_category['Category']['name'] ?></a>
			<?php
			if(count($_category['ChildCategory'])) {
			?>
			<ul class="subcategory unstyled">
				<?php
					foreach($_category['ChildCategory'] as $_subcat) {
						if($_subcat['status'] == 1) {
				?>
				<li><a href="<?php echo $this->webroot.'browse/'.$_subcat['id']; ?>" class="category"><?php echo $_subcat['name']; ?></a></li>
				<?php
						}
					}
				?>
			</ul>
			<?php
			}
			?>
		</li>
		<?php
			}
		?>
		<!--<li style="padding-top: 15px;"><a href="<?php echo $this->webroot.'browse/'.USERS_FEED_CATEGORY; ?>" class="category"><button class="btn btn-primary">Users-feed</button></a></li>-->
	</ul>
	<br />
	<br />
	<br />
	<div class="row-fluid span12">
		<?php //echo $this->element('web/ads'); ?>
	</div>

</div> <!-- web/sidebar -->