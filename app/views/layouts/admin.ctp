<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<?php echo $html->charset(); ?>
	<title><?php echo $title_for_layout; ?></title>
	<?php
		echo $html->meta('icon');
		echo $html->css(array('base', 'drastic-dark'));
		echo $scripts_for_layout;
	?>
</head>
<body>
  <div id="container">
    <div id="header">
      <h1><a href="/index.html/">Cake Fest Berlin Demo</a></h1>
      <div id="user-navigation">
        <ul>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Settings</a></li>
          <li><a class="logout" href="#">Logout</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div id="main-navigation">
        <ul>
          <?php
          foreach (array('categories', 'posts', 'comments', 'tags') as $i => $controller) {
            $class = array();
            if ($i==0) {
              $class[] = 'first';
            }
            if ($controller == $this->params['controller']) {
              $class[] = 'active';
            }
            $label = Inflector::humanize($controller);
            echo $html->tag('li', $html->link($label, array('controller' => $controller)), implode(' ', $class));
          }
          ?>
        </ul>
        <div class="clear"></div>
      </div>
    </div>
    <div id="wrapper">
      <?php $session->flash(); ?>
      <div id="main">
        <?php echo $content_for_layout; ?>
      </div>
      <div id="sidebar">
        <div class="block">
          <h3>Sidebar</h3>
          <ul class="navigation">
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
          </ul>
        </div>
        <div class="block">
          <h3>Simple Block</h3>
          <div class="content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div>
      </div>
      <div class="clear"></div>
      <div id="footer">
        <div class="block">
          <p>Copyright &copy; 2009 Cake Fest Berlin Demo.</p>
        </div>
      </div>
    </div>
  </div>
  <?php echo $cakeDebug; ?>
</body>
</html>