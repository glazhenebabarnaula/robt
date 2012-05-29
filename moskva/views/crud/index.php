<?php
/**
 * @var $fields array
 * @var $data array
 */
$controller = Moskva::getInstance()->getController();
?>
<a href="<?php echo $controller->createUrl('create'); ?>">Создать</a>
<table border="1">
<tr>
	<?php foreach ($fields as $fieldLabel): ?>
	<td><?php echo $fieldLabel; ?></td>
	<?php endforeach; ?>
	<td>

	</td>
</tr>
<?php foreach ($data as $entity): ?>
<tr>
	<?php foreach (array_keys($fields) as $fieldKey): ?>
		<?php $getterName = mInflector::getterMethod($fieldKey); ?>
		<td>
			<?php echo $entity->$getterName(); ?>
		</td>
	<?php endforeach; ?>
	<td>
		<a href="<?php echo $controller->createUrl('delete', array('id' => $entity->getId())); ?>">Удалить</a>
		&nbsp;
		<a href="<?php echo $controller->createUrl('update', array('id' => $entity->getId())); ?>">Редактировать</a>
	</td>
</tr>
<?php endforeach; ?>
</table>