<?php
class CommentsController extends AppController {

	var $name = 'Comments';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comment.', true), 'flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Comment->create();
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The Comment has been saved', true), 'flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Add Another', true)) {
					$this->History->back(0);
				} elseif (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Go Back', true)) {
					$this->History->back();
				} else {
					$this->redirect(array('action' => 'edit', $this->Comment->getInsertID()));
				}
			} else {
				$this->Session->setFlash(__('The Comment could not be saved. Please, try again.', true), 'flash_bad');
			}
		}
		$posts = $this->Comment->Post->find('list');
		$this->set(compact('posts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Comment', true), 'flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The Comment has been saved', true), 'flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save', true)) {
					$this->History->back(0);
				} else {
					$this->History->back();
				}
			} else {
				$this->Session->setFlash(__('The Comment could not be saved. Please, try again.', true), 'flash_bad');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comment->read(null, $id);
		}
		$posts = $this->Comment->Post->find('list');
		$this->set(compact('posts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comment', true), 'flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comment->del($id)) {
			$this->Session->setFlash(__('Comment deleted', true), 'flash_good');
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comment.', true), 'admin_flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Comment->create();
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The Comment has been saved', true), 'admin_flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Add Another', true)) {
					$this->History->back(0);
				} elseif (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Go Back', true)) {
					$this->History->back();
				} else {
					$this->redirect(array('action' => 'edit', $this->Comment->getInsertID()));
				}
			} else {
				$this->Session->setFlash(__('The Comment could not be saved. Please, try again.', true), 'admin_flash_bad');
			}
		}
		$posts = $this->Comment->Post->find('list');
		$this->set(compact('posts'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Comment', true), 'admin_flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The Comment has been saved', true), 'admin_flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save', true)) {
					$this->History->back(0);
				} else {
					$this->History->back();
				}
			} else {
				$this->Session->setFlash(__('The Comment could not be saved. Please, try again.', true), 'admin_flash_bad');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comment->read(null, $id);
		}
		$posts = $this->Comment->Post->find('list');
		$this->set(compact('posts'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comment', true), 'admin_flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comment->del($id)) {
			$this->Session->setFlash(__('Comment deleted', true), 'admin_flash_good');
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>