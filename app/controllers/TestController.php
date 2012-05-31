<?php
class TestController extends CrudController {
	protected function getAdminOnlyActions()
	{
		return array('*');
	}

	protected function getAuthenticatedOnlyActions()
	{
		return array('*');
	}


	public function getGridColumns()
	{
		return array('value' => 'Значение',  'fk' => 'Внешний ключ - круто!');
	}


	public function testAction() {
		$contract = $this->getEntityManager()->getRepository('Contract')->find(1);

		$session = new Session();
		$session->setEnd(new DateTime('now'));
		$session->setContract($contract);
		$session->setTrafficClass( $this->getEntityManager()->getRepository('TrafficClass')->find(1));
		$session->setTrafficAmount(100);

		BillingCalculator::getInstance()->processSession($session);
		$this->getEntityManager()->persist($session);
		$this->getEntityManager()->flush();
	}
}