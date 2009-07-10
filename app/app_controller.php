<?php
class AppController extends Controller {

  var $components = array('RequestHandler', 'History');
  var $helpers = array('Time', 'Admin', 'Javascript');

  var $paginate = array(
    'limit' => 10
  );

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