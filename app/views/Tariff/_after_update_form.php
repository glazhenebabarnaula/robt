<?php
/**
 * @var $model Tariff
 */
?>
<h3>Тарификация начислений</h3>
<a href="<?php echo $this->createUrl('ChargeTypeTariffication', 'create', array('tariff_id' => $model->getId())); ?>">Добавить</a>
<?php $this->renderPartial('_table', array('data' => $model->getChargeTypesCosts(), 'controller' => new ChargeTypeTarifficationController())); ?>
<h3>Тарификация Классов трафика</h3>
<a href="<?php echo $this->createUrl('TrafficClassTariffication', 'create', array('tariff_id' => $model->getId())); ?>">Добавить</a>
<?php $this->renderPartial('_table', array('data' => $model->getTrafficClassesCosts(), 'controller' => new TrafficClassTarifficationController())); ?>
