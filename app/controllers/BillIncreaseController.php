<?php
class BillIncreaseController extends CrudController{
    public function getGridColumns()
    {
        return array('time_format' => 'Время пополнения',
                    'value'=>'Размер пополнения');
    }

    protected function getEntityName()
    {
        return 'Пополнения';
    }

    private function redirectToContract($entity) {
        $this->redirect(array('Contract', 'update', array('id' => $entity->getContract()->getId())));
    }

    protected function afterFormSave($entity)
    {
        $this->redirectToContract($entity);
    }

	protected function beforeFormSave($entity, $form) {
		$oldValue = $entity->getValue();
		if (empty($oldValue)) {
			$oldValue = 0.0;
		}
		parent::beforeFormSave($entity, $form);
		BillingCalculator::getInstance()->processBillIncrease($entity, $oldValue);
	}

	protected function beforeDelete($entity) {
		BillingCalculator::getInstance()->processBillIncreaseDelete($entity);
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
