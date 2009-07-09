<p>
<?php
echo $paginator->counter(array(
  'format' => __('%start% to %end% of %count%', true)
));
?>
</p>