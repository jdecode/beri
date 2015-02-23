<?php

App::uses('AppController', 'Controller');

/**
 * Documents Controller
 *
 * @property Document $Document
 */
class DocumentsController extends AppController {

	/**
	 * Stores array of deniable methods, without logging in.
	 */
	public $_deny = array();

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
		$action = $this->params->params['action'];
		// If method requires login then redirect to login page[if logged out] with referer URL, and to dashboard otherwise
		if (in_array($action, $this->_deny['admin'])) {
			$this->layout = 'admin';
			if (!$this->_admin_auth_check()) {
				$this->Session->write('redirect', "/" . $this->params->url);
				$this->redirect('/' . ADMIN_LOGIN);
			}
		}
		// If method requires login then redirect to login page[if logged out] with referer URL, and to homepage otherwise
		if (in_array($action, $this->_deny['web'])) {
			if (!$this->_web_auth_check()) {
				//$this->Session->write('redirect', "/".$this->params->url);
				$this->redirect('/' . USER_LOGIN);
			}
		}
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function admin_index() {
		$this->Document->recursive = 0;
		$this->set('documents', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_view($id = null) {
		$this->Document->id = $id;
		if (!$this->Document->exists()) {
			throw new NotFoundException(__('Invalid document'));
		}
		$this->set('document', $this->Document->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$_file_name = $this->_upload_file($this->request->data['Document']['file']);
			if (!$_file_name) {
				$this->Session->setFlash('The document could not be saved. Please, try again.', 'flash_close', array('class' => 'alert alert-error'));
				$this->redirect('/admin/projects/manage/' . $this->request->data['Document']['project_id']);
			}
			$document = array(
				'Document' => array(
					'status' => 1,
					'downloaded_count' => 0,
					'document_connection' => 1,
					'connector_link' => $this->request->data['Document']['project_id'],
					'name' => $this->request->data['Document']['name'],
					'file_type' => $this->request->data['Document']['file']['type'],
					'filename' => $_file_name,
				)
			);
			$this->Document->create();
			if ($this->Document->save($document)) {
				$this->Session->setFlash('The document has been saved', 'flash_close', array('class' => 'alert alert-info'));
			} else {
				$this->Session->setFlash('The document could not be saved. Please, try again.', 'flash_close', array('class' => 'alert alert-error'));
			}
			$this->redirect('/admin/projects/manage/' . $this->request->data['Document']['project_id']);
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->Document->id = $id;
		if (!$this->Document->exists()) {
			throw new NotFoundException(__('Invalid document'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Document->save($this->request->data)) {
				$this->Session->setFlash(__('The document has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The document could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Document->read(null, $id);
		}
	}

	/**
	 * delete method
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
		$this->Document->id = $id;
		if (!$this->Document->exists()) {
			throw new NotFoundException(__('Invalid document'));
		}
		if ($this->Document->delete()) {
			$this->Session->setFlash(__('Document deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Document was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
