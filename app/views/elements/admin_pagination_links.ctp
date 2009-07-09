<div class="paging">
  <?php echo $paginator->prev('<< '.__('previous', true), array('tag' => 'span'), null, array('tag' => 'span', 'class'=>'disabled'));?>
  <?php echo $paginator->numbers(array('separator' => null));?>
  <?php echo $paginator->next(__('next', true).' >>', array('tag' => 'span'), null, array('tag' => 'span', 'class'=>'disabled'));?>
</div>