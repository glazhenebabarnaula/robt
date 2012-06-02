<?php
/**
 * @var $form mModelForm
 * @var $this Template
 */

?>
<?php $this->renderPartial('_before_form', array('model' => $form->getModel() )); ?>
<form method="POST">
	<h2><?php echo $this->getControllerVar('entity_name', ''); ?></h2>
	<?php echo $this->renderPartial('_form', array('form' => $form)); ?>
	<input type="submit" value="Создать">
</form>