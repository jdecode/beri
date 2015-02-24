<?php

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('Entry', 'Model');
App::uses('TasksUser', 'Model');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	/**
	 * Stores array of deniable methods, without logging in.
	 */
	//private $_deny = array();
	private $_tasks = array();

	/**
	 * beforeFilter method
	 */
	function beforeFilter() {
		parent::beforeFilter();
		// Place methods that require login in the following array
		$this->_deny = array(
			'admin' => array(
				'admin_index',
				'admin_add',
				'admin_edit',
				'admin_delete',
				'admin_view',
				'admin_logout',
				'update_group',
				'admin_userdetail',
			),
			'web' => array(
				'logout',
				'dashboard',
			)
		);
		$this->_deny_url($this->_deny);
	}

	function beforeRender() {
		parent::beforeRender();
		$this->set('title_for_layout', BERI_DESCRIPTION);
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->helpers[] = 'User';
		$this->layout = 'admin';

		$this->User->recursive = 1;



		$conditions = array(
			'User.group_id != ' . ADMIN_GROUP_ID,
		);

		$_like = array();
		if ($this->request->is('post') || $this->request->is('put')) {
			//pr($this->request->data);
			// Update status of selected rows, as per selected _action, display error/warning messages otherwise
			$_selected = false;
			$_selected_array = array();
			foreach ($this->request->data['User'] as $k => $v) {
				if (is_numeric($k)) {
					if ($v) {
						$_selected = true;
						$_selected_array[] = $k;
					}
				}
			}

			// If atleast one checkbox is selected
			if ($_selected) {

				// If "Export to CSV" is clicked, then export the csv
				if (isset($this->request->data['User']['export_to_csv']) && $this->request->data['User']['export_to_csv'] == 'export_to_csv') {
					// Export User listing in CSV format
					// Headers
					$headers = "User ID, Email, Joined On, User Type, Status\n";

					// Get and set data
					$_users = $this->User->find(
						'all', array(
						'conditions' => array(
							'User.id' => $_selected_array
						)
						)
					);
					if (count($_users)) {
						$data = '';
						$first = true;
						$_nl = "\n";
						foreach ($_users as $k => $_user) {
							if ($first) {
								$first = false;
							} else {
								$data .= $_nl;
							}
							$data .= "{$_user['User']['id']}, {$_user['User']['email']}, " . date("M d Y H:i:s", $_user['User']['created']) . ", {$_user['Group']['name']}, " . $status[$_user['User']['status']];
						}
					}

					$name = date("M-d-Y-H-i-s");
					header("Content-type: application/octet-stream");
					header("Content-Disposition: attachment; filename=$name.csv");
					header("Pragma: no-cache");
					header("Expires: 0");
					print "$headers$data";
					$this->autoRender = false;
				} else {
					// If status change button is clicked
					if (isset($this->request->data['User']['update_status'])) {
						if (trim($this->request->data['User']['_action']) == '') {
							// If no selection is made
							$this->Session->setFlash('Please select an action for selected rows', 'flash_close', array('class' => 'alert alert-info'));
						} else {
							// Update status of selected rows, as per selected action
							if (
								$this->User->updateAll(
									array('User.status' => $this->request->data['User']['_action']), array('User.id' => $_selected_array)
								)) {
								$this->Session->setFlash('Selected rows have been updated', 'flash_close', array('class' => 'alert alert-success'));
								$this->redirect('/admin/users/');
							} else {
								$this->Session->setFlash('Selected rows couldn\'t be updated', 'flash_close', array('class' => 'alert alert-error'));
							}
						}
					}
				}
			} else {
				// If "Export to CSV" is clicked, then export the csv
				if (isset($this->request->data['User']['export_to_csv']) && $this->request->data['User']['export_to_csv'] == 'export_to_csv') {
					// Export User listing in CSV format
					// Headers
					$headers = "User ID, Email, Joined On, User Type, Status\n";

					// Get and set data
					$_users = $this->User->find(
						'all', array(
						'conditions' => array(
							'User.group_id != ' . ADMIN_GROUP_ID // Admin group_id
						)
						)
					);
					if (count($_users)) {
						$data = '';
						$first = true;
						$_nl = "\n";
						foreach ($_users as $k => $_user) {
							if ($first) {
								$first = false;
							} else {
								$data .= $_nl;
							}
							$data .= "{$_user['User']['id']}, {$_user['User']['email']}, " . date("M d Y H:i:s", $_user['User']['created']) . ", {$_user['Group']['name']}, " . $status[$_user['User']['status']];
						}
					}

					$name = date("M-d-Y-H-i-s");
					header("Content-type: application/octet-stream");
					header("Content-Disposition: attachment; filename=$name.csv");
					header("Pragma: no-cache");
					header("Expires: 0");
					print "$headers$data";
					$this->autoRender = false;
				} else {
					if (isset($this->request->data['User']['_action']) && trim($this->request->data['User']['_action']) != '') {
						// If no selection is made
						$this->Session->setFlash('Please select row(s) for selected action', 'flash_close', array('class' => 'alert alert-info'));
					}
				}
			}

			// Filter by group_id / type
			if (isset($this->request->data['User']['_type']) && trim($this->request->data['User']['_type']) != '') {
				$conditions['AND'][] = array(
					"User.group_id" => $this->request->data['User']['_type']
				);
			}
			// Filter by status
			if (isset($this->request->data['User']['_status']) && trim($this->request->data['User']['_status']) != '') {
				$conditions['AND'][] = array(
					"User.status" => $this->request->data['User']['_status']
				);
			}
			// Search by keyword
			if (isset($this->request->data['User']['q']) && trim($this->request->data['User']['q']) != '') {
				$_like[] = array("User.email like '%{$this->request->data['User']['q']}%'");
				$conditions['AND'][] = array('OR' => $_like);
			}
		}

		$this->paginate = array(
			'conditions' => $conditions,
			'order' => 'User.id DESC'
		);



		$user_set_data = $this->paginate();

		//set all awards leads
		$this->loadModel("LeadView");

		$LeadViewData = $this->LeadView->find("all", array("fields" => array("LeadView.user_id", "LeadView.lead_id", "LeadView.bid_status")));
		$user_lead_data = array();
		$user_place_lead_data = array();
		$user_decline_lead_data = array();
		$user_feedback_lead_data = array();


		if (!empty($LeadViewData)) {
			// Project started--arr

			foreach ($LeadViewData as $val) {
				if ($val["LeadView"]["bid_status"] == 5) {

					if (array_key_exists($val["LeadView"]["user_id"], $user_lead_data)) {
						$counter = $user_lead_data[$val["LeadView"]["user_id"]];
						$countlead = $counter + 1;
					} else {
						$countlead = 1;
					}

					$user_lead_data[$val["LeadView"]["user_id"]] = $countlead;
				}

				if ($val["LeadView"]["bid_status"] == 4) {

					if (array_key_exists($val["LeadView"]["user_id"], $user_feedback_lead_data)) {
						$counter_4 = $user_feedback_lead_data[$val["LeadView"]["user_id"]];
						$countlead_4 = $counter_4 + 1;
					} else {
						$countlead_4 = 1;
					}

					$user_feedback_lead_data[$val["LeadView"]["user_id"]] = $countlead_4;
				}
				if ($val["LeadView"]["bid_status"] == 3) {

					if (array_key_exists($val["LeadView"]["user_id"], $user_decline_lead_data)) {
						$counter_3 = $user_decline_lead_data[$val["LeadView"]["user_id"]];
						$countlead_3 = $counter_3 + 1;
					} else {
						$countlead_3 = 1;
					}

					$user_decline_lead_data[$val["LeadView"]["user_id"]] = $countlead_3;
				}
				if ($val["LeadView"]["bid_status"] == 2) {

					if (array_key_exists($val["LeadView"]["user_id"], $user_place_lead_data)) {
						$counter_2 = $user_place_lead_data[$val["LeadView"]["user_id"]];
						$countlead_2 = $counter_2 + 1;
					} else {
						$countlead_2 = 1;
					}

					$user_place_lead_data[$val["LeadView"]["user_id"]] = $countlead_2;
				}
			}
		}
//pr($user_place_lead_data);





		$this->set('users', $user_set_data);
		$this->set(compact('user_lead_data', 'user_place_lead_data', 'user_decline_lead_data', 'user_feedback_lead_data'));

		// Get Groups info
		$groups = $this->User->Group->find('list');
		unset($groups[4]);
		$this->set('groups', $groups);
	}

	/**
	 * admin_login method
	 *
	 * @return void
	 */
	public function admin_login() {
		if ($this->_admin_auth_check()) {
			$this->redirect('/admin/users');
		}
		$this->layout = 'admin';
		if ($this->request->is('post')) {
			$user = $this->User->find(
				'first', array(
				'conditions' => array(
					'User.email' => $this->request->data['User']['email'],
					'User.group_id' => ADMIN_GROUP_ID
				),
				'recursive' => -1
				)
			);
			if ($user) {
				if ($user['User']['password'] == sha1($this->request->data['User']['password'])) {
					$this->Session->write('Admin', $user);
					$_redirect = @$this->Session->read('redirect');
					if (trim($_redirect) != '') {
						$this->Session->setFlash('Welcome back!', 'flash_close', array('class' => 'alert alert-success'));
						$this->Session->delete('redirect');
						$this->redirect("$_redirect");
					} else {
						$this->Session->setFlash('You are now logged in', 'flash_close', array('class' => 'alert alert-success'));
						$this->redirect('/admin/users/');
					}
				} else {
					$this->Session->setFlash('Password is incorrect. Please try again', 'flash_close', array('class' => 'alert alert-error'));
				}
			} else {
				$this->Session->setFlash('We didn\'t recognize the Email you entered. Please try again', 'flash_close', array('class' => 'alert alert-error'));
			}
		}
	}

	/**
	 * admin_logout method
	 *
	 * @return void
	 */
	public function admin_logout() {
		$this->Session->delete('Admin');
		$this->Session->setFlash('You are now logged out.', 'flash_close', array('class' => 'alert alert-success'));
		$this->redirect('/admin');
	}

	/**
	 * admin_settings method
	 * 
	 * @return void
	 */
	public function admin_settings() {
		$this->layout = 'admin';

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data = Sanitize::clean(
					$this->request->data, array(
					'odd_spaces' => true,
					'backslash' => true,
					'remove_html' => true,
					'encode' => true
					)
			);
			$_user = $this->Session->read('Admin.User');
			$this->User->data = $_user;
			$this->User->validate = $this->User->change_password;

			if (
				$this->User->validates() && trim($this->request->data['User']['old_password']) != '' && trim($this->request->data['User']['new_password']) != '' && $this->request->data['User']['repeat_password'] == $this->request->data['User']['new_password'] && $this->User->data['password'] == sha1($this->request->data['User']['old_password'])
			) {
				$this->User->data['password'] = sha1($this->request->data['User']['new_password']);
				$this->request->data['User'] = $this->User->data;

				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The password has been updated'), 'flash_close', array('class' => 'alert alert-success'));
					$this->redirect(array('action' => 'settings'));
				} else {
					$this->Session->setFlash(__('The password could not be updated. Please, try again.'), 'flash_close', array('class' => 'alert alert-error'));
				}
			} else {
				// If Model validation fails, then set errors
				$this->set('errors', $this->User->validationErrors);
				$this->Session->setFlash(__('Please enter required fields with valid data.'), 'flash_close', array('class' => 'alert alert-error'));
			}
		}
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		$this->layout = 'admin';

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data = Sanitize::clean(
					$this->request->data, array(
					'odd_spaces' => true,
					'backslash' => true,
					'remove_html' => true,
					'encode' => true
					)
			);
			$this->User->data = $this->request->data;
			if ($this->User->validates()) {
				$this->request->data['User']['password'] = sha1($this->request->data['User']['password']);
				$this->request->data['User']['status'] = 1;
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('User has been saved'), 'flash_close', array('class' => 'alert alert-success'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('User could not be saved. Please, try again.'), 'flash_close', array('class' => 'alert alert-error'));
				}
			} else {
				// If Model validation fails, then set errors
				$this->set('errors', $this->User->validationErrors);
				$this->Session->setFlash(__('Please enter required fields.'), 'flash_close', array('class' => 'alert alert-error'));
			}
		}
		$groups = $this->User->Group->find('list');
		unset($groups[ADMIN_GROUP_ID]); // Remove "Administrator" group
		$this->set(compact('groups'));
	}

	/**
	 * login method
	 *
	 * @return void
	 */
	public function login() {
		$this->set('title_for_layout', 'Login');
		if ($this->_web_auth_check()) {
			$this->redirect('/dashboard');
		}
		$this->layout = 'web';
		if ($this->request->is('post')) {
			$user = $this->User->find(
				'first', array(
				'conditions' => array(
					'User.email' => $this->request->data['User']['username'],
					'User.group_id != ' . ADMIN_GROUP_ID // General user or Editor User
				),
				'recursive' => -1
				)
			);
			if ($user) {
				if ($user['User']['password'] == sha1($this->request->data['User']['password'])) {
					$this->Session->write('Web', $user);
					$this->Session->setFlash('You are now logged in', 'flash_close', array('class' => 'alert-success'));
					$this->redirect('/dashboard');
					/*
					  $_redirect = @$this->Session->read('redirect');
					  if(trim($_redirect) != '') {
					  $this->Session->setFlash('Welcome back!', 'flash_close', array('class' => 'alert alert-success'));
					  $this->Session->delete('redirect');
					  $this->redirect("$_redirect");
					  } else {
					  $this->Session->setFlash('You are now logged in', 'flash_close', array('class' => 'alert alert-success'));
					  $this->redirect('/dashboard');
					  }
					 */
				} else {
					$this->Session->setFlash('Password you entered is incorrect. Please try again', 'flash_close', array('class' => 'alert alert-error'));
				}
			} else {
				$this->Session->setFlash('We didn\'t recognize the Username you entered. Please try again', 'flash_close', array('class' => 'alert alert-error'));
			}
		}
	}

	/**
	 * logout method
	 *
	 * @return void
	 */
	public function logout() {
		$this->Session->delete('Web');
		$this->Session->setFlash('You are now logged out.', 'flash_close', array('class' => 'alert alert-success'));
		$this->redirect('/');
	}

	/**
	 * Front end user's dashboard
	 */
	function dashboard() {
		$this->layout = 'web';
		$this->Entry = new Entry();
		$this->TasksUser = new TasksUser();

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->_save_tasks();
			$this->end_day();
			$this->Session->setFlash('Your hours have been logged', 'flash_close', array('class' => 'alert alert-success'));
			$this->redirect('/dashboard');
		}
		$this->set('sale_access', $this->_is_sales_resource());

		$this->_set_last_entry();
		$this->_set_last_10_entries();
		$this->_set_tasks();
	}

	function _is_sales_resource() {
		$_user = $this->Session->read('Web.User');
		$sale_access = "No";
		if (!empty($_user)) {
			if ($_user['group_id'] == 4) {
				$sale_access = "yes";
			}
		}
		return $sale_access;
	}

	function _set_last_entry() {

		$_last_entry = $this->Entry->find(
			'first', array(
			'conditions' => array(
				'Entry.user_id' => $this->_web_user_id
			),
			'order' => 'Entry.id DESC'
			)
		);
		$this->set('entry', $_last_entry);
	}

	function _set_last_10_entries() {

		$_l10_entries = $this->Entry->find(
			'all', array(
			'conditions' => array(
				'Entry.user_id' => $this->_web_user_id
			),
			'order' => 'Entry.id DESC',
			'limit' => 70
			)
		);
		$this->set('entries', $_l10_entries);
	}

	function _set_tasks($return = false, $recursive = 1) {

		$this->TasksUser->recursive = is_numeric($recursive) ? $recursive : 0;
		$_tasks = $this->TasksUser->find(
			'all', array(
			'conditions' => array(
				'TasksUser.user_id' => $this->_web_user_id,
				'TasksUser.status' => 1,
			),
			'order' => 'TasksUser.id DESC',
			)
		);
		if ($return) {
			return $_tasks;
		} else {
			$this->set('tasks', $_tasks);
		}
	}

	function _get_tasks($return = true, $recursive = -1) {
		return $this->_set_tasks($return, $recursive);
	}

	/**
	 * Front end user's dashboard
	 */
	function admin_userdetail($id) {
		$this->helpers[] = 'User';
		$this->layout = 'admin';
		$this->Entry = new Entry();
		$this->set('user', $this->User->read(null, $id));
	
		
		$_last_entry = $this->Entry->find(
			'first', array(
			'conditions' => array(
				'Entry.user_id' => $id
			),
			'order' => 'Entry.id DESC'
			)
		);
		
		
		$this->Entry->bindModel(
			 array(
                 'hasOne'=>array(
                     'Comment'=>array(
                      'className' => 'Comment',
                      'foreignKey' => 'type_connection',
                      //'conditions' => array('Comment.type_connection' => 'Event.id')
                    )        
               )
            )
			);
		$_l10_entries = $this->Entry->find('all', array(
			'conditions' => array(
				'Entry.user_id' => $id
			),
			'order' => 'Entry.id DESC', 'limit' => 65)
		);
		
		
		$this->set('entry', $_last_entry);
		$this->set('entries', $_l10_entries);
	}

	/**
	 * User dashboard
	 */
	function user_dashboard() {
		$this->layout = 'web';
		$this->loadModel("Lead");
		$this->loadModel("LeadView");
		$user_session = $this->Session->read('Web.User');
		$user_id = $user_session["id"];

		$view_data = $this->LeadView->find("all", array("conditions" => array("LeadView.user_id" => $user_id, "LeadView.bid_status !=" => 1)
			, 'joins' => array(
				array(
					'table' => 'leads',
					'alias' => 'Lead',
					'type' => 'LEFT',
					'conditions' => array(
						'Lead.id = LeadView.lead_id'
					)
				)
			)
			, "fields" => array("LeadView.*", "Lead.title")
			)
		);
		$setLeadData = array();
		if (!empty($view_data)) {
			foreach ($view_data as $val) {
				$setLeadData[$val["LeadView"]["bid_status"]][] = array("lead_id" => $val["LeadView"]["lead_id"], "lead_title" => $val["Lead"]["title"]);
			}
		}
		$this->set(compact("setLeadData"));
	}

	function end_day() {
		$this->Entry = new Entry();

		if (($this->request->is('post') || $this->request->is('put')) && (!empty($this->request->data["Comment"]["comment"]) || $this->request->data["User"]["type"] == 1 )) {

			$_event = array();
			$_event['user_id'] = (int) $this->_web_user_id;
			$_event['timestamp'] = time();
			$_event['type'] = $this->request->data['User']['type'];
			$this->Entry->create();
			if ($this->Entry->save($_event)) {

				if ($_event['type'] == 1) {
					$this->Session->setFlash('You are now logged in at office.', 'flash_close', array('class' => 'alert alert-success'));
				} else if ($_event['type'] == 2) {
					$_last_event_id = $this->Entry->getLastInsertId();
					$save_comment = array("type_connection" => $_last_event_id, "type" => 1, "comment" => $this->request->data["Comment"]["comment"]);
					$this->loadModel('Comment');
					$this->Comment->save($save_comment);
					$this->Session->setFlash('You are now logged out of office.', 'flash_close', array('class' => 'alert alert-success'));
				}
				return true;
			} else {
				$this->Session->setFlash('Your session could not be initiated.', 'flash_close', array('class' => 'alert alert-error'));
				return false;
			}
		} else {
			$this->Session->setFlash('Comment is required.', 'flash_close', array('class' => 'alert alert-error'));
			$this->redirect('/dashboard');
		}
		//die;
		//$this->Session->setFlash('Your hours have been logged.', 'flash_close', array('class' => 'alert alert-success'));
		//$this->redirect('/dashboard');
	}

	function _pick_ids_from_task_array($tasks = array()) {
		$_new_tasks = array();
		if (is_array($tasks) && count($tasks)) {
			foreach ($tasks as $task) {
				$_new_tasks[$task['TasksUser']['id']] = $task['TasksUser']['id'];
			}
		}
		return $_new_tasks;
	}

	function _save_tasks() {
		$this->_tasks = $this->_get_tasks(true, -1);
		$_tasks = $this->_pick_ids_from_task_array($this->_tasks);
		if (($this->request->is('post') || $this->request->is('put')) && isset($this->request->data['User']['tasks']) && is_array($this->request->data['User']['tasks'])) {
			$diff = array_diff_key($this->request->data['User']['tasks'], $_tasks);
			if (count($diff) == 0) {
				$this->_update_tasks($this->request->data['User']['tasks'], $this->request->data['User']['tasks_completed']);
			} else {
				$this->Session->setFlash('Fiddling attempt identified', 'flash_close', array('class' => 'alert alert-error'));
				$this->redirect('/logout');
			}
		}
	}

	function _update_tasks($_tasks_entered = array(), $_tasks_statuses = array()) {

		$_tasks = $this->_tasks;
		foreach ($_tasks as $_task) {
			if (isset($_tasks_entered[$_task['TasksUser']['id']]) && trim($_tasks_entered[$_task['TasksUser']['id']]) != '' && is_numeric($_tasks_entered[$_task['TasksUser']['id']])) {
				$_task['TasksUser']['hours'] += (int) $_tasks_entered[$_task['TasksUser']['id']];
				if ($_tasks_statuses[$_task['TasksUser']['id']]) {
					$_task['TasksUser']['status'] = 3; // Completed
				}
				$this->TasksUser->save($_task);
			}
		}
	}

	function session_history() {
		
	}

}
