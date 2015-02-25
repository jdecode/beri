<?php

App::uses('AppController', 'Controller');
App::uses('Thread', 'Model');
App::uses('Project', 'Model');

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
	 * thread method
	 *
	 * @return void
	 */
	public function admin_thread($id = null, $project_id = null) {
		$this->layout = 'admin';

		$this->Thread = new Thread();
		$this->Project = new Project();

		$this->Document->id = $id;
		if (!$this->Document->exists()) {
			$this->Session->setFlash('Invalid document link.', 'flash_close', array('class' => 'alert alert-error'));
			$this->redirect('/admin');
		} else {
			$_document = $this->Document->read(null, $id);
			$this->set('document', $_document);
		}
		$this->Project->id = $project_id;
		if (!$this->Project->exists()) {
			$this->Session->setFlash('Invalid Project link.', 'flash_close', array('class' => 'alert alert-error'));
			$this->redirect('/admin');
		}
		
		if($this->request->is('post')) {
			$thread = array(
				'Thread' => array(
					'user_id' => $this->_admin_user_id,
					'status' => 1,
					'type' => 1,
					'type_link' => $id,
					'document_added' => 0,
					'post' => $this->request->data['Comment']['comment'],
					)
				);
			if($this->Thread->save($thread)) {
				$this->Session->setFlash('Comment saved.', 'flash_close', array('class' => 'alert alert-info'));
			} else {
				$this->Session->setFlash('Comment could not be saved.', 'flash_close', array('class' => 'alert alert-error'));
			}
			$this->redirect("/admin/documents/thread/$id/$project_id");
		}
		
		$_threads = $this->Thread->find('all', array('conditions' => array('Thread.type_link' => $id, 'type' => 1)));
		$this->set('threads', $_threads);
		$this->set('project_id', $project_id);
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
