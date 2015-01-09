<?php
App::uses('AppController', 'Controller');
/**
 * Sprints Controller
 *
 * @property Sprint $Sprint
 */
class SprintsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sprint->recursive = 0;
		$this->set('sprints', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Sprint->id = $id;
		if (!$this->Sprint->exists()) {
			throw new NotFoundException(__('Invalid sprint'));
		}
		$this->set('sprint', $this->Sprint->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sprint->create();
			if ($this->Sprint->save($this->request->data)) {
				$this->Session->setFlash(__('The sprint has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sprint could not be saved. Please, try again.'));
			}
		}
		$projects = $this->Sprint->Project->find('list');
		$this->set(compact('projects'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Sprint->id = $id;
		if (!$this->Sprint->exists()) {
			throw new NotFoundException(__('Invalid sprint'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sprint->save($this->request->data)) {
				$this->Session->setFlash(__('The sprint has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sprint could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Sprint->read(null, $id);
		}
		$projects = $this->Sprint->Project->find('list');
		$this->set(compact('projects'));
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
		$this->Sprint->id = $id;
		if (!$this->Sprint->exists()) {
			throw new NotFoundException(__('Invalid sprint'));
		}
		if ($this->Sprint->delete()) {
			$this->Session->setFlash(__('Sprint deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sprint was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Sprint->recursive = 0;
		$this->set('sprints', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Sprint->id = $id;
		if (!$this->Sprint->exists()) {
			throw new NotFoundException(__('Invalid sprint'));
		}
		$this->set('sprint', $this->Sprint->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Sprint->create();
			if ($this->Sprint->save($this->request->data)) {
				$this->Session->setFlash(__('The sprint has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sprint could not be saved. Please, try again.'));
			}
		}
		$projects = $this->Sprint->Project->find('list');
		$this->set(compact('projects'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->Sprint->id = $id;
		if (!$this->Sprint->exists()) {
			throw new NotFoundException(__('Invalid sprint'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sprint->save($this->request->data)) {
				$this->Session->setFlash(__('The sprint has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sprint could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Sprint->read(null, $id);
		}
		$projects = $this->Sprint->Project->find('list');
		$this->set(compact('projects'));
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
		$this->Sprint->id = $id;
		if (!$this->Sprint->exists()) {
			throw new NotFoundException(__('Invalid sprint'));
		}
		if ($this->Sprint->delete()) {
			$this->Session->setFlash(__('Sprint deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sprint was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
