<?php
/**
 * @var $fields array
 * @var $data array
 * @var $this Template
 */
$controller = Moskva::getInstance()->getController();
?>

<a href="<?php echo $controller->createUrl('create'); ?>">Создать</a>
<?php $this->renderPartial('_table', array('data' => $data, 'controller' => $controller)); ?>