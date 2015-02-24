<?php

/**
 * Custom Helper
 *
 * For custom theme specific methods.
 *
 * If your theme requires custom methods,
 * copy this file to /app/views/themed/your_theme_alias/helpers/custom.php and modify.
 *
 * You can then use this helper from your theme's views using $custom variable.
 *
 * @category Helper
 * @package  Beri
 * @version  1.0
 * @author   Arun Kumar <arun.techennova@gmail.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 */
App::uses('Helper', 'View');

class CustomHelper extends Helper {

    /**
     * Other helpers used by this helper
     *
     * @var array
     * @access public
     */
    public $helpers = array();

    public function userinfo($user_id = null) {
        //$this->loadModel('User');
        App::import("Model", "User");
        $model = new User();

        return $model->find("first", array("conditions" => array("User.id" => $user_id), "fields" => array("User.first_name", "User.last_name", "User.email")));
    }

}
