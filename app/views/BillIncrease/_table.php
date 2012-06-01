<?php
$controller = isset($controller) ? $controller : $this->getController();
$fields = $controller->getGridColumns();
?>
<table id="table1" border="2" >
    <tr class="header_row">
        <?php foreach ($fields as $fieldLabel): ?>
        <td><?php echo $fieldLabel; ?></td>
        <?php endforeach; ?>
        <td>

        </td>
    </tr>
    <?php foreach ($data as $entity): ?>
    <tr>
        <td>
            <?php echo $entity->getTime()->format('Y-m-d H:i'); ?>
        </td>
        <td>
            <?php echo $entity->getValue()?>
        </td>
        <td>
            <a href="<?php echo $controller->createUrl('update', array('id' => $entity->getId())); ?>"><img src="/img/Edit.png"></a>
            <a href="<?php echo $controller->createUrl('delete', array('id' => $entity->getId())); ?>"><img src="/img/Delete.png"></a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>