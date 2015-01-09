<?php

/**
 * Custom function for action based <li>'s class
 */
if(!function_exists('get_class_from_action')) {
	function get_class_from_action($action, $_action) {
		if ($action == $_action) {
			return "active";
		} else {
			return "";
		}
	}
}
if(!function_exists('is_errored')) {
	function is_errored($key, $errors, $_key = 0) {
		if(isset ($errors)) {
			if(array_key_exists($key, $errors)) {
				echo '<label for="'.Inflector::camelize('user_'.$key).'" class="clear-error">'.$errors[$key][$_key].'</label>';
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}



?>