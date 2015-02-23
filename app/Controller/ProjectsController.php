<?php

App::uses('AppController', 'Controller');
App::uses('Module', 'Model');
App::uses('Task', 'Model');
App::uses('Sprint', 'Model');
App::uses('User', 'Model');

/**
 * Projects Controller
 *
 * @property Project $Project
 */
class ProjectsController extends AppController {
	/**
	 * Stores array of deniable methods, without logging in.
	 */
	//private $_deny = array();

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
				'admin_manage',
			)
		);
		$this->_deny_url($this->_deny);
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->layout = "admin";
		$this->Project->recursive = 0;
		$this->set('projects', $this->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		$this->set('project', $this->Project->read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Project->create();
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash('The project has been saved', 'flash_close', array('class' => 'alert alert-info'));
			} else {
				$this->Session->setFlash('The project could not be saved. Please, try again', 'flash_close', array('class' => 'alert alert-error'));
			}
			$this->redirect(array('action' => 'index'));
		}
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->Project->id = $id;
		if (!$this->Project->exists()) {
			throw new NotFoundException(__('Invalid project'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('The project has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Project->read(null, $id);
		}
	}

	function admin_manage($id) {
		$this->layout = 'admin';
		$this->set('id', $id);
		$project = $this->Project->find('first', array('conditions' => array('Project.id' => $id)));
		/*
		 * If Project found
		 */
		if ($project) {
			$this->set('project', $project);

			$modules = array();
			$_modules = array();
			$modules[0] = 'Add New';

			/*
			 * If any modules exist, set modules for view
			 */
			if ($this->_isArrayReadyToUse($project['Module'])) {
				foreach ($project['Module'] as $_module) {
					$modules[$_module['id']] = $_module['name'];
					$_modules[] = $_module['id'];
				}
			}
			$this->set('modules', $modules);

			/*
			 * If any tasks exist for those modules, set those for view
			 */
			$tasks = array();
			if (count($_modules)) {
				$this->Task = new Task();
				$tasks = $this->Task->find(
					'all', array(
					'conditions' => array(
						'Task.module_id' => $_modules,
						'Task.status' => 1,
					)
					)
				);
			}


			//pr($tasks);

			$this->set('tasks', $tasks);

			/**
			 * If any sprints exist for the project, set those too.
			 */
			$sprints = array();
			if ($this->_isArrayReadyToUse($project['Sprint'])) {
				foreach ($project['Sprint'] as $_sprint) {
					$sprints[] = $_sprint;
				}
			}
			$this->set('sprints', $sprints);

			/**
			 * Fetch users list
			 */
			$this->User = new User();
			$this->set(
				'users', $this->User->find(
					'list', array(
					'fields' => array(
						'User.id', 'User.first_name'
					),
					'conditions' => array(
						'User.group_id != 1'
					)
					)
				)
			);
		} else {
			$this->Session->setFlash('Invalid Project ID.', 'flash_close', array('class' => 'alert alert-error'));
			$this->redirect(array('action' => 'index'));
		}
	}

	function admin_assgin_task_to() {

		$this->autoRender = false;
		$this->loadModel("TasksUser");
		$this->loadModel("SprintsTask");
		$tasks = array();
		foreach ($this->request->data["tasks"] as $val) {
			if ($val != 0) {
				$tasks[] = $val;
			}
		}
		$saveArr = array();
		foreach ($tasks as $val) {
			$saveArr[] = array("task_id" => $val, "user_id" => $this->request->data["user"][$val][0], "hours" => 0);
		}
		$save_ap_arr = array();
		foreach ($tasks as $val) {

			$is_exist = $this->SprintsTask->find("count", array("conditions" => array("task_id" => $val, "sprint_id" => $this->request->data["Task"]["sprint_id"])));
			if ($is_exist == 0) {
				$save_ap_arr[] = array("task_id" => $val, "sprint_id" => $this->request->data["Task"]["sprint_id"]);
			}
		}
		if ($this->TasksUser->saveAll($saveArr)) {
			$this->SprintsTask->saveAll($save_ap_arr);

			$this->Session->setFlash("Project assignment is updated", 'flash_close', array('class' => 'alert alert-info'));
			$id = '';
			if (!empty($this->request->data["Task"]["project"])) {
				$id = $this->request->data["Task"]["project"];
			}
			$this->redirect(array("controller" => "projects", "action" => "manage", $id));
		}
	}

	/**
	 * Add Task from Admin, via ajax
	 */
	function add_task() {
		$this->layout = 'ajax';
		$this->Task = new Task();

		$return = array('status' => 0, 'message' => '', 'module' => 0);

		$task['Task']['name'] = $this->request->data['Task']['name'];
		$task['Task']['hours_allocated'] = $this->request->data['Task']['hours'];
		$task['Task']['module_id'] = $this->request->data['Task']['module_id'];
		$task['Task']['status'] = 1;

		// If "Add New" Module option is selected
		if ($this->request->data['Task']['module_id'] == 0) {
			if (trim($this->request->data['Task']['add_module']) != '') {
				$module['Module']['project_id'] = $this->request->data['Task']['project_id'];
				$module['Module']['name'] = $this->request->data['Task']['add_module'];
				$module['Module']['status'] = 1;

				$this->Module = new Module();
				$this->Module->save($module, array('validate' => false));
				$module_id = $this->Module->getLastInsertID();
				$task['Task']['module_id'] = $module_id;
				$return['module'] = $module_id;
			} else {
				$return['status'] = 2;
			}
		}
		if ($return['status'] != 2) {
			if ($this->Task->save($task, array('validate' => false))) {
				$return['status'] = 1;
			} else {
				$return['status'] = 0;
			}
		}
		echo json_encode($return);
		die;
	}

	/**
	 * Add Sprint from Admin, via ajax
	 */
	function add_sprint() {
		$this->layout = 'ajax';
		$this->Sprint = new Sprint();

		$return = array('status' => 0, 'message' => '');

		$sprint['Sprint']['name'] = $this->request->data['Sprint']['name'];
		$sprint['Sprint']['project_id'] = $this->request->data['Sprint']['project_id'];
		$sprint['Sprint']['status'] = 1;

		if ($this->Sprint->save($sprint, array('validate' => false))) {
			$return['status'] = 1;
		} else {
			$return['status'] = 0;
		}
		echo json_encode($return);
		die;
	}

	/**
	 * admin_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	/* 	public function admin_delete($id = null) {
	  if (!$this->request->is('post')) {
	  throw new MethodNotAllowedException();
	  }
	  $this->Project->id = $id;
	  if (!$this->Project->exists()) {
	  throw new NotFoundException(__('Invalid project'));
	  }
	  if ($this->Project->delete()) {
	  $this->Session->setFlash(__('Project deleted'));
	  $this->redirect(array('action' => 'index'));
	  }
	  $this->Session->setFlash(__('Project was not deleted'));
	  $this->redirect(array('action' => 'index'));
	  }
	 */
}
