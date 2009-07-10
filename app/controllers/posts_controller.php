<?php
class PostsController extends AppController {

	var $name = 'Posts';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Post.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Add Another', true)) {
					$this->History->back(0);
				} elseif (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Go Back', true)) {
					$this->History->back();
				} else {
					$this->redirect(array('action' => 'edit', $this->Post->getInsertID()));
				}
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		$tags = $this->Post->Tag->find('list');
		$categories = $this->Post->Category->find('list');
		$this->set(compact('tags', 'categories'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save', true)) {
					$this->History->back(0);
				} else {
					$this->History->back();
				}
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
		$tags = $this->Post->Tag->find('list');
		$categories = $this->Post->Category->find('list');
		$this->set(compact('tags','categories'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Post', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Post->del($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Post.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Add Another', true)) {
					$this->History->back(0);
				} elseif (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Go Back', true)) {
					$this->History->back();
				} else {
					$this->redirect(array('action' => 'edit', $this->Post->getInsertID()));
				}
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		$tags = $this->Post->Tag->find('list');
		$categories = $this->Post->Category->find('list');
		$this->set(compact('tags', 'categories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save', true)) {
					$this->History->back(0);
				} else {
					$this->History->back();
				}
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
		$tags = $this->Post->Tag->find('list');
		$categories = $this->Post->Category->find('list');
		$this->set(compact('tags','categories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Post', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Post->del($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>