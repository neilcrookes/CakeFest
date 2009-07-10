<?php
class TagsController extends AppController {

	var $name = 'Tags';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Tag->recursive = 0;
		$this->set('tags', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Tag.', true), 'flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tag', $this->Tag->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tag->create();
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The Tag has been saved', true), 'flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Add Another', true)) {
					$this->History->back(0);
				} elseif (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Go Back', true)) {
					$this->History->back();
				} else {
					$this->redirect(array('action' => 'edit', $this->Tag->getInsertID()));
				}
			} else {
				$this->Session->setFlash(__('The Tag could not be saved. Please, try again.', true), 'flash_bad');
			}
		}
		$posts = $this->Tag->Post->find('list');
		$this->set(compact('posts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tag', true), 'flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The Tag has been saved', true), 'flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save', true)) {
					$this->History->back(0);
				} else {
					$this->History->back();
				}
			} else {
				$this->Session->setFlash(__('The Tag could not be saved. Please, try again.', true), 'flash_bad');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tag->read(null, $id);
		}
		$posts = $this->Tag->Post->find('list');
		$this->set(compact('posts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Tag', true), 'flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tag->del($id)) {
			$this->Session->setFlash(__('Tag deleted', true), 'flash_good');
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Tag->recursive = 0;
		$this->set('tags', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Tag.', true), 'admin_flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tag', $this->Tag->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Tag->create();
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The Tag has been saved', true), 'admin_flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Add Another', true)) {
					$this->History->back(0);
				} elseif (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Go Back', true)) {
					$this->History->back();
				} else {
					$this->redirect(array('action' => 'edit', $this->Tag->getInsertID()));
				}
			} else {
				$this->Session->setFlash(__('The Tag could not be saved. Please, try again.', true), 'admin_flash_bad');
			}
		}
		$posts = $this->Tag->Post->find('list');
		$this->set(compact('posts'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tag', true), 'admin_flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tag->save($this->data)) {
				$this->Session->setFlash(__('The Tag has been saved', true), 'admin_flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save', true)) {
					$this->History->back(0);
				} else {
					$this->History->back();
				}
			} else {
				$this->Session->setFlash(__('The Tag could not be saved. Please, try again.', true), 'admin_flash_bad');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tag->read(null, $id);
		}
		$posts = $this->Tag->Post->find('list');
		$this->set(compact('posts'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Tag', true), 'admin_flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tag->del($id)) {
			$this->Session->setFlash(__('Tag deleted', true), 'admin_flash_good');
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>