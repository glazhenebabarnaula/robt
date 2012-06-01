<?php
/**
 * @var $model Contract
 */
?>
<h3>Начисления</h3>
<a href="<?php echo $this->createUrl('Charge', 'create', array('contract_id' => $model->getId())); ?>">Добавить</a>
<?php $this->renderPartial('_table', array('data' => $model->getCharges(), 'controller' => new ChargeController())); ?>
<h3>Пополнения</h3>
<a href="<?php echo $this->createUrl('BillIncrease', 'create', array('contract_id' => $model->getId())); ?>">Добавить</a>
<?php $this->renderPartial('_table', array('data' => $model->getBillIncreases(), 'controller' => new BillIncreaseController()), 'BillIncrease'); ?>
<h3>Сессии</h3>
<a href="<?php echo $this->createUrl('Session', 'create', array('contract_id' => $model->getId())); ?>">Добавить</a>
<?php $this->renderPartial('_table', array('data' => $model->getSessions(), 'controller' => new SessionController())); ?>
