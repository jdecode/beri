<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
		//'DebugKit.Toolbar',
		'Session'
	);

	public $_web_user_id = 0;
	public $_web_user_data = array();

	public $_admin_user_id = 0;
	public $_admin_user_data = array();

	public $_deny = array();
	public $task_statuses = array();

	/**
	 * _admin_auth_check method
	 * 
	 * @return true, if logged in as admin, false otherwise
	 */
	function _admin_auth_check() {
		$_user = $this->Session->read('Admin.User');
		if (isset($_user['id']) && is_numeric($_user['id']) && $_user['group_id'] == ADMIN_GROUP_ID) { // Admin group_id is 1
			return true;
		} else {
			return false;
		}
	}

	function _deny_url() {
		$action = $this->params->params['action'];
		// If method requires login then redirect to login page[if logged out] with referer URL, and to dashboard otherwise
		if (!empty($this->_deny['admin'])) {
			if (in_array($action, $this->_deny['admin'])) {
				if (!$this->_admin_auth_check()) {
					$this->Session->write('redirect', "/" . $this->params->url);
					$this->redirect('/'.ADMIN_LOGIN);
				}
			}
		}
		// If method requires login then redirect to login page[if logged out] with referer URL, and to homepage otherwise
		if (!empty($this->_deny['web'])) {
			if (in_array($action, $this->_deny['web'])) {
				if (!$this->_web_auth_check()) {
					$this->Session->write('redirect', "/".$this->params->url);
					$this->redirect('/'.USER_LOGIN);
				}
			}
		}
	}

	/**
	 * _web_auth_check method
	 *
	 * @return true, if logged in as admin, false otherwise
	 */
	function _web_auth_check() {
		$_user = $this->Session->read('Web.User');
		if (
				isset($_user['id']) &&
				is_numeric($_user['id']) &&
				(
				$_user['group_id'] == 3 ||
				$_user['group_id'] == 2 ||
				$_user['group_id'] == 4
				)
		) { // Front end user => 3, Manager => 2, Sales => 4
			return true;
		} else {
			return false;
		}
	}

	/**
	 * beforeRender method
	 */
	function beforeRender() {
		$_web_user_id = $this->Session->read('Web.User.id');
		$_web_user_data = $this->Session->read('Web.User');
		$this->set('_web_user_id', $_web_user_id);
		$this->set('_web_user_data', $_web_user_data);

		$this->set('task_statuses', Configure::read('task_statuses'));
	}

	/**
	 * beforeFilter method
	 */
	function beforeFilter() {
		$_web_user_id = $this->Session->read('Web.User.id');
		$_web_user_data = $this->Session->read('Web.User');
		$this->_web_user_id = $_web_user_id;
		$this->_web_user_data = $_web_user_data;

		$_admin_user_id = $this->Session->read('Admin.User.id');
		$_admin_user_data = $this->Session->read('Admin.User');
		$this->_admin_user_id = $_admin_user_id;
		$this->_admin_user_data = $_admin_user_data;

		$this->task_statuses = Configure::read('task_statuses');
	}

	public function _isArrayReadyToUse($array = array()) {
		if (isset($array) && is_array($array) && count($array)) {
			return true;
		}
		return false;
	}

	function _get_random_name() {
		return sha1(time() . microtime() . rand() . rand());
	}

	function _upload_file($source, $destination = '') {
		if (trim($destination) == '') {
			$destination = APP . DS . 'webroot' . DS . 'files' . DS . 'documents' . DS;
		}
		if (!is_array($source) || $source['error'] != 0) {
			return false;
		}
		$random_name = $this->_get_random_name();
		$_name_fragments = explode('.', $source['name']);
		$extension = $_name_fragments[count($_name_fragments)-1];
		$filename = $random_name . '.' . $extension;
		if (move_uploaded_file($source['tmp_name'], $destination . $filename)) {
			return $filename;
		}
		return false;
	}

}
