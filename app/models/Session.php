<?php
/**
 * @Entity
 * @Table(name="sessions")
 * @HasLifecycleCallbacks
 */
class Session {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @Column(type="time", nullable=false)
	 */
	protected $begin;
	/**
	 * @Column(type="time", nullable=true)
	 */
	protected $end;

	/**
	 * @Column(type="decimal", nullable=false)
	 */
	protected $traffic_amount;

	/**
	 * @ManyToOne(targetEntity="Contract", inversedBy="sessions")
	 * @JoinColumn(name="contract_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $contract;

	/**
	 * @ManyToOne(targetEntity="TrafficClass")
	 * @JoinColumn(name="traffic_class_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $traffic_class;

	/**
	 * @Column(type="decimal", nullable=false)
	 */
	protected $cost = 0;

	public function __construct() {
		$this->setBegin(new DateTime('now'));
	}

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set begin
     *
     * @param \DateTime $begin
     * @return Session
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;
        return $this;
    }

    /**
     * Get begin
     *
     * @return \DateTime 
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Session
     */
    public function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set traffic_amount
     *
     * @param float $trafficAmount
     * @return Session
     */
    public function setTrafficAmount($trafficAmount)
    {
        $this->traffic_amount = $trafficAmount;
        return $this;
    }

    /**
     * Get traffic_amount
     *
     * @return float 
     */
    public function getTrafficAmount()
    {
        return $this->traffic_amount;
    }

    /**
     * Set cost
     *
     * @param float $cost
     * @return Session
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * Get cost
     *
     * @return float 
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set contract
     *
     * @param Contract $contract
     * @return Session
     */
    public function setContract(\Contract $contract = null)
    {
        $this->contract = $contract;
        return $this;
    }

    /**
     * Get contract
     *
     * @return Contract 
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set traffic_class
     *
     * @param TrafficClass $trafficClass
     * @return Session
     */
    public function setTrafficClass(\TrafficClass $trafficClass = null)
    {
        $this->traffic_class = $trafficClass;
        return $this;
    }

    /**
     * Get traffic_class
     *
     * @return TrafficClass
     */
    public function getTrafficClass()
    {
        return $this->traffic_class;
    }

	private function getTariff() {
		return $this->getContract()->getTariff();
	}

	/**
	 * @return TrafficClassTariffication
	 */
	public function getTrafficClassTarification() {
		$traffic_class_id = $this->getTrafficClass()->getId();
		return $this->getTariff()->getTrafficClassesCosts()->filter(
			function(TrafficClassTariffication $obj) use ($traffic_class_id) {
				return $obj->getTrafficClass()->getId() === $traffic_class_id;
			}
		)->first();
	}

	private function getSessionTrafficCost() {
		$tariffication = $this->getTrafficClassTarification();
		return $tariffication->getMegabyteCost() * $this->getTrafficAmount();
	}

	private function getSessionLengthCost() {
		$tariffication = $this->getTrafficClassTarification();
		$begin = $this->getBegin();
		$end = $this->getEnd();

		if (empty($end)) {
			$end = new DateTime('now');
		}

		$diff = $end->diff($begin);

		return $diff->m * $tariffication->getMinuteCost();
	}

	private function getSessionTotalCost() {
		return $this->getSessionTrafficCost() + $this->getSessionTrafficCost();
	}


	public function calculateCost() {
		$this->setCost($this->getSessionTotalCost());
		return $this->getCost();
	}
}