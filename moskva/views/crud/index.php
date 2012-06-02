<?php
/**
 * @var $fields array
 * @var $data array
 * @var $this Template
 */
$controller = Moskva::getInstance()->getController();
?>
<h2><?php echo $this->getControllerVar('entity_name', ''); ?></h2>

<a href="<?php echo $controller->createUrl('create'); ?>">Создать</a>
<?php $this->renderPartial('_table', array('data' => $data, 'controller' => $controller)); ?>