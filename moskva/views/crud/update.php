<?php
/**
 * @var $form mModelForm
 * @var $this Template
 */
?>

<a href="<?php echo $this->createUrl('index'); ?>">К списку</a><br/>
<form method="POST">
	<h2><?php echo $this->getControllerVar('entity_name', ''); ?></h2>
<?php echo $this->renderPartial('_form', array('form' => $form)); ?>
<input type="submit" value="Изменить">
</form>