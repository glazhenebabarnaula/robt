<?php
class SessionController extends CrudController{
    public function getGridColumns()
    {   //TODO begin & end
        return
            array(
				'begin_format' => 'Начало',
				'end_format' => 'Конец',
				'traffic_class' => 'Класс трафика',
                'traffic_amount'=>'Количество трафика',
				'cost'=>'Стоимость',
			);
    }

    protected function getEntityName()
    {
        return 'Сессии';
    }

    private function redirectToContract($entity) {
        $this->redirect(array('Contract', 'update', array('id' => $entity->getContract()->getId())));
    }

    protected function afterFormSave($entity)
    {
        $this->redirectToContract($entity);
    }

	protected function beforeFormSave($entity, $form) {
		parent::beforeFormSave($entity, $form);
		BillingCalculator::getInstance()->processSession($entity);
	}

	protected function beforeDelete($entity) {
		BillingCalculator::getInstance()->processSessionDelete($entity);
	}

	protected function afterDelete($entity)
	{
		$this->redirectToContract($entity);
	}

    protected function buildNewEntity() {
        if (!isset($_GET['contract_id'])) {
            throw new MoskvaHttpException(404);
        }

        $contract_id = $_GET['contract_id'];

        /**
         * @var $entity Charge
         */
        $entity = parent::buildNewEntity();
        $contract = $this->getEntityManager()->find('Contract', $contract_id);
        $entity->setContract($contract);

        return $entity;
    }
}
