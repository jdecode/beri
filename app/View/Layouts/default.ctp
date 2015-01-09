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
$cakeDescription = __d('cake_dev', 'Intranet');
?>
<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $cakeDescription ?>:
			<?php echo $title_for_layout; ?>
		</title>
		<?php
		echo $this->Html->meta('icon');



		echo $this->Html->script('jquery-1.9.1');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<?php
		echo $this->Html->script('html5');
		?>
		<![endif]-->
	</head>
	<body>
		<div id="Wrapper_main">
			<div id="container">

				<?php echo $this->element('web/header'); ?>

				<div id="content">

					<?php echo $this->Session->flash(); ?>

					<?php echo $this->fetch('content'); ?>
				</div>


				<?php echo $this->element('web/footer'); ?>


			</div>
		</div>

		<br>
		<?php echo $this->element('sql_dump'); ?>
		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<?php
		echo $this->Html->css(
				array(
					'smoothness/jquery-ui-1.10.1.custom.min',
					'validationEngine.jquery',
					'jquery.multiselect',
					'bootstrap.min',
					'bootstrap-responsive',
					'app',
				)
		);
		echo $this->Html->script(
				array(
					'jquery.validationEngine',
					'jquery.validationEngine-en',
					'jquery-ui-1.10.1.custom.min',
					'ckeditor',
					'jquery.multiselect',
					'bootstrap.min',
					'jquery.placeholder.min',
				)
		);
		?>
	</body>
</html>
