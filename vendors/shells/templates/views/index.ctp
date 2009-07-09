<div id="main"><div class="block" id="block-tables">
<h2 class="title"><?php echo "<?php __('{$pluralHumanName}');?>";?></h2>
<div class="content">
<div class="inner">
<?php echo "<?php echo \$this->element('admin_pagination_count'); ?>"; ?>
<table cellpadding="0" cellspacing="0" class="table">
<tr>
<?php
$ignore = array('lft', 'rght', 'parent_id', 'slug', 'child_count', 'direct_child_count');
foreach ($fields as $index => $field) :
  if (in_array($field, $ignore)) {
    continue;
  }
  if ($schema[$field]['type'] == 'text') {
    continue;
  }
  ?>
	<th<?php if ($index == 0) echo ' class="first"'; ?>><?php echo "<?php echo \$paginator->sort('{$field}');?>";?></th>
<?php endforeach;?>
	<th class="last"><?php echo "<?php __('Actions');?>";?></th>
</tr>
<?php
echo "<?php
\$i = 0;
foreach (\${$pluralVar} as \${$singularVar}):
	\$class = ' class=\"odd\"';
	if (\$i++ % 2 == 0) {
		\$class = ' class=\"even\"';
	}
?>\n";
	echo "\t<tr<?php echo \$class;?>>\n";
		foreach ($fields as $field) {
      if (in_array($field, $ignore)) {
        continue;
      }
      if ($schema[$field]['type'] == 'text') {
        continue;
      }
      if ($schema[$field]['type'] == 'datetime') {
        echo "\t\t<td>\n\t\t\t<?php echo \$time->niceShort(\${$singularVar}['{$modelClass}']['{$field}']); ?>\n\t\t</td>\n";
        continue;
      }
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $alias => $details) {
					if ($field === $details['foreignKey']) {
						$isKey = true;
						echo "\t\t<td>\n\t\t\t<?php echo \$html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller'=> '{$details['controller']}', 'action'=>'edit', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				echo "\t\t<td>\n\t\t\t<?php echo \${$singularVar}['{$modelClass}']['{$field}']; ?>\n\t\t</td>\n";
			}
		}

		echo "\t\t<td class=\"actions\">\n";
	 	echo "\t\t\t<?php echo \$html->link(__('Edit', true), array('action'=>'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
	 	echo "\t\t\t<?php echo \$html->link(__('Delete', true), array('action'=>'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), null, sprintf(__('Are you sure you want to delete # %s?', true), \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
		echo "\t\t</td>\n";
	echo "\t</tr>\n";

echo "<?php endforeach; ?>\n";
?>
</table><div class="actions-bar">
<?php echo "<?php echo \$this->element('admin_pagination_links'); ?>"; ?>
<div class="clear"></div></div></div></div></div></div>
<div id="sidebar"><div class="block"><h3>Actions</h3>
	<ul class="navigation">
		<li><?php echo "<?php echo \$html->link(__('New {$singularHumanName}', true), array('action'=>'add')); ?>";?></li>
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
</div>