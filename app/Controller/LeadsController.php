<?php

App::uses('AppController', 'Controller');

/**
 * Leads Controller
 *
 * @property Lead $Lead
 * @property PaginatorComponent $Paginator
 */
class LeadsController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');
	public $helpers = array('Custom');

	/**
	 * Before Filter method
	 */
	function beforeFilter() {
		parent::beforeFilter();
		$this->layout = 'web';
		$this->_deny = array(
			'web' => array(
				'index',
				'hit_leads',
				"add"
			),
			"admin" => array('admin_index')
		);
		$this->_deny_url($this->_deny);
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index($id = null, $source_action = null) {
		$this->Lead->recursive = 0;
		$user_session = $this->Session->read('Web.User');
		$user_id = $user_session["id"];
		$source = Configure::read('source');
		$this->set("sources", $source);
		$this->loadModel("LeadView");

		$bidstatus = array();
		if (!empty($user_id)) {
			$bidstatus = $this->LeadView->find("list", array("conditions" => array("LeadView.user_id" => $user_id), "fields" => array("LeadView.lead_id", "LeadView.bid_status")));
		}


		if (!empty($id) && $id == "odesk") {
			$status_search_all = 1;
		} elseif (!empty($id) && $id == "elance") {
			$status_search_all = 2;
		} else {
			$status_search_all = array(1, 2);
		}

		if (!empty($source_action) && !in_array($source_action, array("odesk", "elance"))) {
			
			$this->Paginator->settings = array(
					'conditions' => array('Lead.id' => $source_action),
					'limit' => 10
				);
		} else {


			if ($id != null && $id != "odesk" && $id != "elance") {
				$search = array();
				$search1 = array();
				foreach ($bidstatus as $key => $val) {
					if ($val == $id && $id != 1) {
						$search[] = $key;
					}
					if ($id == 1 && $val != 1) {
						$search1[] = $key;
					}
				}

				if (!empty($source_action) && $source_action == "odesk") {
					$status_search = 1;
				} elseif (!empty($source_action) && $source_action == "elance") {
					$status_search = 2;
				} else {
					$status_search = array(1, 2);
				}




				if ($id == 1) {

					$findfive = $this->LeadView->find("list", array("conditions" => array("LeadView.bid_status" => 5, "LeadView.user_id !=" => $user_id), "fields" => array("LeadView.lead_id")));
					$arr1 = array_merge($search1, array_values($findfive));

					$this->Paginator->settings = array(
						'conditions' => array('NOT' => array("Lead.id" => $arr1), 'Lead.type !=' => 2, "source" => $status_search),
						'limit' => 10
					);
				} else {

					$this->Paginator->settings = array(
						'conditions' => array('Lead.id' => $search, 'Lead.type !=' => 2, "source" => $status_search),
						'limit' => 10
					);
				}
			} else {
				$this->Paginator->settings = array(
					'conditions' => array('Lead.type !=' => 2, "source" => $status_search_all),
					'limit' => 10
				);
			}
		}
		$alldata = $this->Paginator->paginate();
		$this->set('leads', $alldata);


		$this->set("userBidStatus", $bidstatus);
		$this->loadModel("Project");
		$Awdprojects = $this->Project->find("list", array("fields" => array("Project.lead_id", "Project.user_id")));

		$this->set("Awdprojects", $Awdprojects);
	}

	public function admin_index($id = null, $user_id = null) {

		$this->layout = "admin";
		$this->Lead->recursive = 0;
		$this->loadModel('LeadView');
		$source = Configure::read('source');
		$this->set("sources", $source);
		$leads_action_data = $this->LeadView->find("all");

		// pr($leads_action_data);
		if (!empty($leads_action_data)) {
			$setDataU = array();
			$setDataV = array();
			foreach ($leads_action_data as $val) {
				if ($val["LeadView"]["bid_status"] != 1) {
					$setDataU[$val["LeadView"]["lead_id"]][] = array("id" => $val["LeadView"]["user_id"], "name" => ($val["User"]["first_name"] . " " . $val["User"]["last_name"]), "email" => $val["User"]["email"], "bid_status" => $val["LeadView"]["bid_status"]);
					if (array_key_exists($val["LeadView"]["lead_id"], $setDataV) && $val["LeadView"]["viewed"] == 1) {
						$cont = $setDataV[$val["LeadView"]["lead_id"]];
						$counter = $cont + 1;
					} elseif ($val["LeadView"]["viewed"] == 1) {
						$counter = 1;
					} else {
						$counter = 0;
					}
					$setDataV[$val["LeadView"]["lead_id"]] = $counter;
				}
			}
		}
		//print_r($setDataU);


		$this->set(compact('setDataU', 'setDataV'));

		if (!empty($user_id) && !empty($id)) {

			$bidstatus = $this->LeadView->find("list", array("conditions" => array("LeadView.user_id" => $user_id, "LeadView.bid_status" => $id), "fields" => array("LeadView.lead_id")));

			$this->Paginator->settings = array(
				'conditions' => array("Lead.id" => $bidstatus),
				'limit' => 10
			);
		} elseif (empty($user_id) && !empty($id)) {


			if ($id == "private_leads") {
				$this->Paginator->settings = array(
					'conditions' => array("Lead.type" => 2),
					'limit' => 10
				);
			} else {

				if ($id != 1) {
					$bidstatus = $this->LeadView->find("list", array("conditions" => array("LeadView.bid_status" => $id), "fields" => array("LeadView.lead_id")));
					$this->Paginator->settings = array(
						'conditions' => array("Lead.id" => $bidstatus),
						'limit' => 10
					);
				} else {
					$bidstatus = $this->LeadView->find("list", array("conditions" => array("LeadView.bid_status !=" => $id), "fields" => array("LeadView.lead_id")));


					$this->Paginator->settings = array(
						'conditions' => array("NOT" => array("Lead.id" => $bidstatus), "Lead.type !=" => 2),
						'limit' => 10
					);
				}
			}
		} else {
			$this->Paginator->settings = array(
				//'conditions' => array('Lead.type !=' => 2),
				'limit' => 10
			);
		}
		$alldata = $this->Paginator->paginate();


		$this->set('leads', $alldata);
	}

	/*
	  Private Leads
	 */

	function private_leads() {
		$this->Lead->recursive = 0;
		$sources = Configure::read('source');
		$user_session = $this->Session->read('Web.User');
		$user_id = $user_session["id"];

		$sources = Configure::read('source');
		$leads_status = Configure::read('leads_status');
		$this->set(compact("sources", "leads_status"));


		$this->loadModel("LeadView");

		$bidstatus = array();
		if (!empty($user_id)) {
			$bidstatus = $this->LeadView->find("list", array("conditions" => array("LeadView.user_id" => $user_id), "fields" => array("LeadView.lead_id", "LeadView.bid_status")));
		}
		$this->Paginator->settings = array(
			'conditions' => array('Lead.type' => 2, 'Lead.user_id' => $user_id),
			'limit' => 10
		);
		$alldata = $this->Paginator->paginate();
		$this->set('leads', $alldata);
		$this->set("userBidStatus", $bidstatus);
		$this->loadModel("Project");
		$Awdprojects = $this->Project->find("list", array("fields" => array("Project.lead_id", "Project.user_id")));
		$this->set(compact("Awdprojects", "sources"));
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->Lead->exists($id)) {
			throw new NotFoundException(__('Invalid lead'));
		}
		$options = array('conditions' => array('Lead.' . $this->Lead->primaryKey => $id));
		$this->set('lead', $this->Lead->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		$sources = Configure::read('source');
		$this->set(compact('sources'));
		///pr($sources);
		if ($this->request->is('post')) {
			///$this->Lead->create();
			$user_session = $this->Session->read('Web.User');
			$user_id = $user_session["id"];
			$this->request->data["Lead"]["user_id"] = $user_id;
			$this->request->data["Lead"]["type"] = 2;
			$this->request->data["Lead"]["budget_text"] = "$" . $this->request->data["Lead"]["budget_amount"];


			if ($this->Lead->save($this->request->data)) {
				$this->Session->setFlash('The lead has been saved', 'flash_close', array('class' => 'alert alert-info'));
				return $this->redirect(array("controller" => "leads", 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lead could not be saved. Please, try again.'));
			}
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if (!$this->Lead->exists($id)) {
			throw new NotFoundException(__('Invalid lead'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Lead->save($this->request->data)) {
				$this->Session->setFlash(__('The lead has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lead could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Lead.' . $this->Lead->primaryKey => $id));
			$this->request->data = $this->Lead->find('first', $options);
		}
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Lead->id = $id;
		if (!$this->Lead->exists()) {
			throw new NotFoundException(__('Invalid lead'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Lead->delete()) {
			$this->Session->setFlash(__('The lead has been deleted.'));
		} else {
			$this->Session->setFlash(__('The lead could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function hit_leads() {
		$this->autoRender = false;
		$lead_id = $this->request->data["lid"];
		$user_session = $this->Session->read('Web.User');
		$this->loadModel("LeadView");
		$user_id = $user_session["id"];
		if (!empty($user_session)) {
			$sel_data = $this->LeadView->find("first", array("conditions" => array("user_id" => $user_id, "lead_id" => $lead_id)));


			if (empty($sel_data)) {
				if ($this->request->data["action"] == "viewed") {
					if ($this->LeadView->save(array("user_id" => $user_id, "lead_id" => $lead_id, "viewed" => 1, "bid_status" => 1))) {
						return 1;
					}
				} else {
					if ($this->LeadView->save(array("user_id" => $user_id, "lead_id" => $lead_id, "viewed" => 2, "bid_status" => $this->request->data["status"]))) {
						return 1;
					}
				}
			} else {
				if ($this->request->data["action"] == "viewed") {
					if ($this->LeadView->save(array("viewed" => 1, "id" => $sel_data["LeadView"]["id"]))) {
						return 1;
					}
				} else {
					if ($this->LeadView->save(array("bid_status" => $this->request->data["status"], "id" => $sel_data["LeadView"]["id"]))) {
						return 1;
					}
				}
			}
		}
		//$_user["id"]
	}

	public function update_status() {
		$this->autoRender = false;
		$lead_id = $this->request->data["lid"];
		$user_session = $this->Session->read('Web.User');
		$this->loadModel("LeadView");
		$this->loadModel("Lead");
		$user_id = $user_session["id"];
		if (!empty($user_session)) {
			if ($this->Lead->save(array("id" => $lead_id, "status" => $this->request->data["status"]))) {
				sleep(1);
				return 1;
			}
		}
		//$_user["id"]
	}

	public function start_project_in() {
		if ($this->request->is('post')) {
			$this->loadModel('Project');
			$this->loadModel("LeadView");
			$this->loadModel("Lead");

			$this->Project->create();
			$user_session = $this->Session->read('Web.User');
			$user_id = $user_session["id"];


			$this->loadModel("Project");
			$Awdprojects = $this->Project->find("list", array("fields" => array("Project.lead_id", "Project.user_id")));
			if (!empty($Awdprojects) && array_key_exists($this->request->data["Project"]["lead_id"], $Awdprojects)) {
				$this->Session->setFlash('The project already awarded', 'flash_close', array('class' => 'alert alert-error'));
			} else {

				$this->request->data["Project"]["user_id"] = $user_id;
				if ($this->Project->save($this->request->data)) {
					$this->Lead->save(array("id" => $this->request->data["Project"]["lead_id"], "status" => 5));
					$sel_data = $this->LeadView->find("first", array("conditions" => array("LeadView.user_id" => $user_id, "LeadView.lead_id" => $this->request->data["Project"]["lead_id"])));

					$this->LeadView->save(array("bid_status" => 5, "id" => $sel_data["LeadView"]["id"]));

					$this->Session->setFlash('The project has been saved', 'flash_close', array('class' => 'alert alert-info'));
				} else {
					$this->Session->setFlash('The project could not be saved. Please, try again', 'flash_close', array('class' => 'alert alert-error'));
				}
				$this->redirect(array("controller" => "leads", 'action' => 'index'));
			}
		}
	}

}
