<?php


define('BERI', 'B.E.R.I.');

define('BERI_DESCRIPTION', 'Best Enterprise Resource planning Interface');


define('ADMIN_LOGIN', 'admin');

define('USER_LOGIN', 'login');


define('TIME1', microtime());

define('ADMIN_GROUP_ID', 1);

define('NINE_HOURS', 60*60*9);


Configure::write('source', array(1 =>'oDesk', 2 =>'Elance',3=>"Private"));
Configure::write('leads_status',  array(1 => "Open bid", 2 => "Bid Placed", 3 => "Declined", 4 => "Feedback", 5 => "Project start"));
