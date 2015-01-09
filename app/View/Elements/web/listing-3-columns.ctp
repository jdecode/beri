
<div class="row-fluid">
	<div class="span12"></div>
<?php
	if(isset($category_id)) {
		//$posts = $this->requestAction('/posts/load/15/0/'.$category_id);
	} else {
		//$posts = $this->requestAction('/posts/load/');
	}
	$rows = 3;
	$_span = 12/$rows;
	$i = 0;
	//for( $i = 1; $i <= $rows; $i++) {
	$_first = true;
	$_time_ago = 0;
	$_time = time();
	foreach( $posts as $post) {
		if($i == 3) {
			$i = 0;
		}
			?>
	<div class="span<?php echo $_span; ?> border" style=" margin-top: 5px ; padding: 15px; <?php echo ($i) ? '' : 'margin-left: 0; clear: both;' ?>">
		<div class="_post" style="min-height: 150px; padding-bottom: 20px;">
		<?php

			if(trim($post['Post']['image']) != '') {

				echo '<div class="_image">';
					echo "<a class=\"photo\" href=\"{$this->webroot}uploads/images/500/{$post['Post']['image']}\"><img src=\"{$this->webroot}uploads/images/100/{$post['Post']['image']}\" alt=\"{$post['Post']['description']}\" /></a>";
				echo '</div>';

			}
			if(trim($post['Post']['description']) != '') {
				
				$post['Post']['_description'] = str_replace('\n', ' ', $post['Post']['description']);
				$post['Post']['description'] = str_replace('\n', '<br />', $post['Post']['description']);
				echo '<div class="_description_full" style="display: none;" title="'.$post['Post']['_description'].'">';
					echo $post['Post']['description'];
				echo '</div>';
				echo '<div class="_description" title="'.$post['Post']['_description'].'">';
					if(strlen($post['Post']['description']) > 100) {
						echo substr($post['Post']['description'], 0, 97).'...';
						echo '<span class="see_more link" style="font-size: 11px; font-weight: bold;">see more</span>';
					} else {
						echo $post['Post']['description'];
					}
				//echo $post['Post']['description'];
				if(trim($post['Post']['image']) == '') {
					echo '<br />';
					echo '<br />';
				}
				echo '</div>';
				echo '<br />';
				echo '<span class="time">';
					if($_time - $post['Post']['created'] <= 5) {
						echo "Added Just now";
					} else {
						if($_time - $post['Post']['created'] <= 15) {
							echo "Few seconds ago";
						} else {
							if($_time - $post['Post']['created'] <= 60) {
								echo ($_time - $post['Post']['created'])." seconds ago";
							} else {
								if( ($_time - $post['Post']['created']) <= _DAY ) {
									$diff_seconds = $_time - $post['Post']['created'];
									$_mins = round($diff_seconds/60);
									if($_mins > 60) {
										$_hours = round($_mins/60);
										echo "$_hours hours ago";
									} else {
										echo "$_mins minutes ago";
									}
								} else {
									if( ($_time - $post['Post']['created']) <= _DAY*2 ) {
										echo 'Yesterday, '.date('H:i', $post['Post']['created']);
									} else {
										echo date('F j, H:i', $post['Post']['created']);
									}
								}
							}
						}
					}
				echo '</span>';
				echo '<br />In '.$this->Html->link($post['Category']['name'], '/browse/'.$post['Category']['id']);
				
			}
		?>
		</div>
	</div><?php
		$i++;
	}
?>
</div>

<script type="text/javascript">
	$('.see_more').click( function () {
		$(this).parent().hide();
		$(this).parent().parent().find('._description_full').show();
	});
	$(document).ready( function () {
		$(".photo").colorbox();
	});
</script>