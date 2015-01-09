<?php
App::uses('AppController', 'Controller');
/**
 * Entries Controller
 *
 * @property Entry $Entry
 */
class EntriesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Entry->recursive = 0;
		$this->set('entries', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Entry->id = $id;
		if (!$this->Entry->exists()) {
			throw new NotFoundException(__('Invalid entry'));
		}
		$this->set('entry', $this->Entry->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Entry->create();
			if ($this->Entry->save($this->request->data)) {
				$this->Session->setFlash(__('The entry has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entry could not be saved. Please, try again.'));
			}
		}
		$users = $this->Entry->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Entry->id = $id;
		if (!$this->Entry->exists()) {
			throw new NotFoundException(__('Invalid entry'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Entry->save($this->request->data)) {
				$this->Session->setFlash(__('The entry has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The entry could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Entry->read(null, $id);
		}
		$users = $this->Entry->User->find('list');
		$this->set(compact('users'));
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
		$this->Entry->id = $id;
		if (!$this->Entry->exists()) {
			throw new NotFoundException(__('Invalid entry'));
		}
		if ($this->Entry->delete()) {
			$this->Session->setFlash(__('Entry deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Entry was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
