<?php
class BillingCalculator extends mComponent {

	/**
	 * @var BillingCalculator
	 */
	private static $_instance = null;
	public static function getInstance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new BillingCalculator();
		}

		return self::$_instance;
	}

	private function updateContractBilledItemCost(Contract $contract, $oldCost, $newCost) {
		if (empty($oldCost)) {
			$oldCost = 0.0;
		}

		$delta = $newCost - $oldCost;

		if ($delta > 0) {
			$contract->decreaseBalance($delta);
		} else {
			$contract->increaseBalance(-$delta);
		}
	}

	public function processSession(Session $session) {
		$oldCost = $session->getCost();
		$newCost = $session->calculateCost();

		$this->updateContractBilledItemCost($session->getContract(), $oldCost, $newCost);
	}

	public function processCharge(Charge $charge) {
		$oldCost = $charge->getValue();
		$newCost = $charge->calculateValue();

		$this->updateContractBilledItemCost($charge->getContract(), $oldCost, $newCost);
	}

	public function processBillIncrease(BillIncrease $increase, $oldValue = 0) {
		$this->updateContractBilledItemCost($increase->getContract(), $oldValue, $increase->getValue());
	}
}