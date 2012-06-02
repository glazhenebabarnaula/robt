<?php
class TrafficClassTarifficationController extends CrudController {
	public static $gridColumns = array(
		'traffic_class' => 'Класс трафика',
		'minute_cost' => 'Стоимость минуты',
		'megabyte_cost' => 'Стоимость мегабайта',
	);
	public function getGridColumns()
	{
		return self::$gridColumns;
	}

	protected function getEntityName()
	{
		return 'Тарификация классов трафика';
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
		 * @var $entity TrafficClassTariffication
		 */
		$entity = parent::buildNewEntity();
		$tariff = $this->getEntityManager()->find('Tariff', $tariff_id);
		$entity->setTariff($tariff);

		return $entity;
	}
}