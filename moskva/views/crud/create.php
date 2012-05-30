<?php
/**
 * @var $form mModelForm
 * @var $this TemplateCollection
 */
?>
<form method="POST">
	<?php echo $this->renderPartial('_form', array('form' => $form)); ?>
	<input type="submit" value="Создать">
</form>