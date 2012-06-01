<?php
class ChargeController extends CrudController{
    public function getGridColumns()
    {
        return
            array('id'=>'Id',
                  'value'=>'Размер');
    }

    protected function getEntityName()
    {
        return 'Начисления';
    }

    private function redirectToContract($entity) {
        $this->redirect(array('Contract', 'update', array('id' => $entity->getContract()->getId())));
    }

    protected function afterFormSave($entity)
    {
        $this->redirectToContract($entity);
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
