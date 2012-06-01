<?php
class ChargeTypeTarifficationController extends CrudController {
	public static $gridColumns = array(
					'chargeType' => 'Тип начисления',
					'value' => 'Сумма',
	);
	public function getGridColumns()
	{
		return self::$gridColumns;
	}

	protected function getEntityName()
	{
		return 'Тарификация начислений';
	}

	private function redirectToTariff($entity) {
		$this->redirect(array('Tariff', 'update', array('id' => $entity->getTariff()->getId())));
	}

	protected function afterFormSave($entity)
	{
		$this->redirectToTariff($entity);
	}

	protected function afterDelete($entity)
	{
		$this->redirectToTariff($entity);
	}

	protected function buildNewEntity() {
		if (!isset($_GET['tariff_id'])) {
			throw new MoskvaHttpException(404);
		}

		$tariff_id = $_GET['tariff_id'];

		/**
		 * @var $entity ChargeTypeTariffication
		 */
		$entity = parent::buildNewEntity();
		$tariff = $this->getEntityManager()->find('Tariff', $tariff_id);
		$entity->setTariff($tariff);

		return $entity;
	}
}