<?php
class CategoriesController extends AppController {

	var $name = 'Categories';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Category.', true), 'flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('category', $this->Category->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Category->create();
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The Category has been saved', true), 'flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Add Another', true)) {
					$this->History->back(0);
				} elseif (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Go Back', true)) {
					$this->History->back();
				} else {
					$this->redirect(array('action' => 'edit', $this->Category->getInsertID()));
				}
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true), 'flash_bad');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Category', true), 'flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The Category has been saved', true), 'flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save', true)) {
					$this->History->back(0);
				} else {
					$this->History->back();
				}
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true), 'flash_bad');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Category->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Category', true), 'flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Category->del($id)) {
			$this->Session->setFlash(__('Category deleted', true), 'flash_good');
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Category->recursive = 0;
		$this->set('categories', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Category.', true), 'admin_flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('category', $this->Category->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Category->create();
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The Category has been saved', true), 'admin_flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Add Another', true)) {
					$this->History->back(0);
				} elseif (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save and Go Back', true)) {
					$this->History->back();
				} else {
					$this->redirect(array('action' => 'edit', $this->Category->getInsertID()));
				}
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true), 'admin_flash_bad');
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Category', true), 'admin_flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Category->save($this->data)) {
				$this->Session->setFlash(__('The Category has been saved', true), 'admin_flash_good');
				if (isset($this->params['form']['submit']) && $this->params['form']['submit'] == __('Save', true)) {
					$this->History->back(0);
				} else {
					$this->History->back();
				}
			} else {
				$this->Session->setFlash(__('The Category could not be saved. Please, try again.', true), 'admin_flash_bad');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Category->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Category', true), 'admin_flash_bad');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Category->del($id)) {
			$this->Session->setFlash(__('Category deleted', true), 'admin_flash_good');
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>