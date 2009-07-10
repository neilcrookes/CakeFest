<div id="main"><div class="block" id="block-forms">
<h2 class="title"><?php __('Add Tag');?></h2>
<div class="content">
<div class="inner">
<?php echo $form->create('Tag', array('class' => 'form'));?>
	<?php
		echo $admin->input('tag');
		echo $admin->input('Post');
	?>
<?php
echo $form->submit(__('Save', true), array('name' => 'submit', 'class' => 'button', 'div' => false)) . ' or ';
echo $form->submit(__('Save and Add Another', true), array('name' => 'submit', 'class' => 'button', 'div' => false)) . ' or ';
echo $form->end(array('name' => 'submit', 'label' => __('Save and Go Back', true), 'class' => 'button', 'div' => false));
if (isset($previousPage)) echo ' or ' . $html->link(__('Back to '.$previousPage['title'], true), $previousPage['uri']);
?>
</div></div></div></div>
<div id="sidebar"><div class="block"><h3>Actions</h3>
<div class="actions">
	<ul class="navigation">
		<li><?php echo $html->link(__('List Tags', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
</div></div>