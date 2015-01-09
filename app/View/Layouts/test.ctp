<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$time1 = microtime();
?><!DOCTYPE html>
<html lang="en">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title> Intranet
			<?php
			$_controller = $this->params->params['controller'];
			$_action = $this->params->params['action'];
			?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="Intranet user management." />
		<meta name="author" content="" />
		<?php
		echo $this->Html->script('jquery');
		echo $this->Html->css(
				array(
					'ticker', 
					'bootstrap', 
					'validationEngine.jquery', 
					'jquery.ui.all', 
					'intranet', 
					'bootstrap-responsive', 
					'colorbox',
					'styles/jqx.base'
					)
				);
		?>
		<style type="text/css">
			body {
				padding-top: 43px; /* To make the container go all the way to the bottom of the topbar */
			}
		</style>
		<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<?php
		?>
		<![endif]-->
	</head>
	<body>
		<div class="container-fluid no-padding">
			<div class="row-fluid">
				<?php echo $this->element('web/nav'); ?>
				<div class="sidebar-container">
					<div class="row-fluid">
						<div class="offset2 span10">
							<?php echo $this->Session->flash(); ?>
							<?php echo $this->fetch('content'); ?>
						</div>
					</div>
				</div>
				<div>
					<?php echo $this->element('web/footer'); ?>
				</div>
			</div>

		</div>
		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<?php
		echo $this->Html->script(
				array(
					'html5',
					//'bootstrap-transition',
					//'bootstrap-alert',
					//'bootstrap-modal',
					'bootstrap-dropdown',
					//'bootstrap-scrollspy',
					//'bootstrap-tab',
					//'bootstrap-tooltip',
					//'bootstrap-popover',
					'bootstrap-button',
					//'bootstrap-collapse',
					//'bootstrap-typeahead',
					//'bootstrap-carousel',
					'jquery.validationEngine',
					'jquery.validationEngine-en',
					'jquery.ui.core',
					'jquery.ui.widget',
					'jquery.ui.datepicker',
					'jquery.colorbox',
					'jquery.infinitescroll',
					'jquery.masonry',
					'jquery.placeholder.min',
					'jqwidgets/jqxcore',
					'jqwidgets/jqxchart',
					'jqwidgets/jqxgauge',
					'jqwidgets/jqxdata',
					'jqwidgets/jqxbuttons',
					'jqwidgets/jqxslider',
					'gettheme',
				)
		);
		?>
		<?php echo $this->element('sql_dump'); ?>
		<script type="text/javascript">
			$('input').placeholder();
			if($('#flash_close').length == 1) {
				$('#flash_close').delay(5000).slideUp('slow');
			}
		</script>
	</body>
	<?php
	$time2 = microtime();
	?>
	<!-- <?php echo ($time2 - TIME1) . ' seconds'; ?> -->
</html>
