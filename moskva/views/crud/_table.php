<?php
$controller = isset($controller) ? $controller : $this->getController();
$fields = $controller->getGridColumns();
?>
<table class="entity-table" border="2" >
	<tr class="header_row">
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
			<?php echo htmlspecialchars($entity->$getterName()); ?>
		</td>
		<?php endforeach; ?>
		<td>
			<a href="<?php echo $controller->createUrl('update', array('id' => $entity->getId())); ?>"><img src="/img/Edit.png"></a>
			<a href="<?php echo $controller->createUrl('delete', array('id' => $entity->getId())); ?>"><img src="/img/Delete.png"></a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>