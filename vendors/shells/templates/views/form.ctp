<div id="main"><div class="block" id="block-forms">
<h2 class="title"><?php echo "<?php __('".Inflector::humanize($action)." {$singularHumanName}');?>";?></h2>
<div class="content">
<div class="inner">
<?php echo "<?php echo \$form->create('{$modelClass}', array('class' => 'form'));?>\n";?>
<?php
		echo "\t<?php\n";
		foreach ($fields as $field) {
			if ($action == 'add' && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				echo "\t\techo \$admin->input('{$field}');\n";
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				echo "\t\techo \$admin->input('{$assocName}');\n";
			}
		}
		echo "\t?>\n";
?>
<?php
echo "<?php".PHP_EOL;
if ($action == 'edit') {
  echo "echo \$form->submit(__('Save', true), array('name' => 'submit', 'class' => 'button', 'div' => false)) . ' or ';".PHP_EOL;
  echo "echo \$form->end(array('name' => 'submit', 'label' => __('Save and Go Back', true), 'class' => 'button', 'div' => false)) . ' or ';".PHP_EOL;
} else {
  echo "echo \$form->submit(__('Save', true), array('name' => 'submit', 'class' => 'button', 'div' => false)) . ' or ';".PHP_EOL;
  echo "echo \$form->submit(__('Save and Add Another', true), array('name' => 'submit', 'class' => 'button', 'div' => false)) . ' or ';".PHP_EOL;
  echo "echo \$form->end(array('name' => 'submit', 'label' => __('Save and Go Back', true), 'class' => 'button', 'div' => false));".PHP_EOL;
}
echo "if (isset(\$previousPage)) echo ' or ' . \$html->link(__('Back to '.\$previousPage['title'], true), \$previousPage['uri']);".PHP_EOL;
echo "?>".PHP_EOL;
?>
</div></div></div></div>
<div id="sidebar"><div class="block"><h3>Actions</h3>
<div class="actions">
	<ul class="navigation">
<?php if ($action != 'add'):?>
		<li><?php echo "<?php echo \$html->link(__('Delete', true), array('action'=>'delete', \$form->value('{$modelClass}.{$primaryKey}')), null, sprintf(__('Are you sure you want to delete # %s?', true), \$form->value('{$modelClass}.{$primaryKey}'))); ?>";?></li>
<?php endif;?>
		<li><?php echo "<?php echo \$html->link(__('List {$pluralHumanName}', true), array('action'=>'index'));?>";?></li>
<?php
		$done = array();
		foreach ($associations as $type => $data) {
			foreach ($data as $alias => $details) {
				if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
					echo "\t\t<li><?php echo \$html->link(__('List ".Inflector::humanize($details['controller'])."', true), array('controller'=> '{$details['controller']}', 'action'=>'index')); ?> </li>\n";
					echo "\t\t<li><?php echo \$html->link(__('New ".Inflector::humanize(Inflector::underscore($alias))."', true), array('controller'=> '{$details['controller']}', 'action'=>'add')); ?> </li>\n";
					$done[] = $details['controller'];
				}
			}
		}
?>
	</ul>
</div>
</div></div>