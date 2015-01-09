
<div class="span9 content">
	<?php
		echo $this->element('web/ticker');
	?>
</div>

<div class="span10 content">
	<div class="row-fluid span12">
		<div class="row-fluid span10">
			<?php
				echo $this->element('web/listing');
			?>
		</div>
	</div>
</div> <!-- web/content -->
<script type="text/javascript">
	$(document).ready( function () {
		$('.fb_iframe').each( function () {
			//$(this).html('<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fsalabhak&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80&amp;appId=235924333093046" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:400px; height:25px;" allowTransparency="true"></iframe>');
		});
	});
</script>
