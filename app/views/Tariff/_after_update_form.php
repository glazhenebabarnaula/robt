<?php
/**
 * @var $model Tariff
 */
?>
<h3>Тарификация начислений</h3>
<a href="<?php echo $this->createUrl('ChargeTypeTariffication', 'create', array('tariff_id' => $model->getId())); ?>">Добавить</a>
<?php $this->renderPartial('_table', array('data' => $model->getChargeTypesCosts(), 'controller' => new ChargeTypeTarifficationController())); ?>
