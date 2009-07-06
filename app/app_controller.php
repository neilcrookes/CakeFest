<?php
class AppController extends Controller {

  function beforeFilter() {
    $this->_checkAdmin();
  }

  function _checkAdmin() {

    $admin = Configure::read('Routing.admin');

    if (!$admin) {
      return;
    }

    if (!isset($this->params[$admin])) {
      return;
    }

    $this->layout = 'admin';

  }

}
?>