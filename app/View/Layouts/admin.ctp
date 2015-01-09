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
?><!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; // . $this->fetch('title'); ?>
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>
        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Html->script('jquery-1.9.1');
        ?>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <?php
        echo $this->Html->script('html5');
        ?>
        <![endif]-->
    </head>
    <body>
        <?php
        echo $this->element('admin/nav');
        ?>
        <div class="container">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $this->Session->flash(); ?>

                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>

        </div>
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <?php
        echo $this->Html->css(
                array(
                    'smoothness/jquery-ui-1.10.1.custom.min',
                    'validationEngine.jquery',
                    'jquery.multiselect',
                    'bootstrap3',
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
        <?php echo $this->element('sql_dump'); ?>
        <script type="text/javascript">
                $('input').placeholder();
        </script>
    </body>
</html>
