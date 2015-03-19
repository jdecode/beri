<?php

App::uses('AppController', 'Controller');

/**
 * TasksUsers Controller
 *
 * @property TasksUser $TasksUser
 */
class TasksUsersController extends AppController {

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
			),
			'web' => array(
			)
		);
		$this->_deny_url($this->_deny);
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->TasksUser->recursive = 0;
		$this->set('tasksUsers', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->TasksUser->id = $id;
		if (!$this->TasksUser->exists()) {
			throw new NotFoundException(__('Invalid tasks user'));
		}
		$this->set('tasksUser', $this->TasksUser->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TasksUser->create();
			if ($this->TasksUser->save($this->request->data)) {
				$this->Session->setFlash(__('The tasks user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tasks user could not be saved. Please, try again.'));
			}
		}
		$tasks = $this->TasksUser->Task->find('list');
		$users = $this->TasksUser->User->find('list');
		$this->set(compact('tasks', 'users'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->TasksUser->id = $id;
		if (!$this->TasksUser->exists()) {
			throw new NotFoundException(__('Invalid tasks user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TasksUser->save($this->request->data)) {
				$this->Session->setFlash(__('The tasks user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tasks user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TasksUser->read(null, $id);
		}
		$tasks = $this->TasksUser->Task->find('list');
		$users = $this->TasksUser->User->find('list');
		$this->set(compact('tasks', 'users'));
	}

	/**
	 * delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->TasksUser->id = $id;
		if (!$this->TasksUser->exists()) {
			throw new NotFoundException(__('Invalid tasks user'));
		}
		if ($this->TasksUser->delete()) {
			$this->Session->setFlash(__('Tasks user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tasks user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * admin_index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->TasksUser->recursive = 0;
		$this->set('tasksUsers', $this->paginate());
	}

	/**
	 * admin_view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->TasksUser->id = $id;
		if (!$this->TasksUser->exists()) {
			throw new NotFoundException(__('Invalid tasks user'));
		}
		$this->set('tasksUser', $this->TasksUser->read(null, $id));
	}

	/**
	 * admin_add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->TasksUser->create();
			if ($this->TasksUser->save($this->request->data)) {
				$this->Session->setFlash(__('The tasks user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tasks user could not be saved. Please, try again.'));
			}
		}
		$tasks = $this->TasksUser->Task->find('list');
		$users = $this->TasksUser->User->find('list');
		$this->set(compact('tasks', 'users'));
	}

	/**
	 * admin_edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->TasksUser->id = $id;
		if (!$this->TasksUser->exists()) {
			throw new NotFoundException(__('Invalid tasks user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TasksUser->save($this->request->data)) {
				$this->Session->setFlash(__('The tasks user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tasks user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TasksUser->read(null, $id);
		}
		$tasks = $this->TasksUser->Task->find('list');
		$users = $this->TasksUser->User->find('list');
		$this->set(compact('tasks', 'users'));
	}

	/**
	 * admin_delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->TasksUser->id = $id;
		if (!$this->TasksUser->exists()) {
			throw new NotFoundException(__('Invalid tasks user'));
		}
		if ($this->TasksUser->delete()) {
			$this->Session->setFlash(__('Tasks user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tasks user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
