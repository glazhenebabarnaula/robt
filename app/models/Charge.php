<?php
/**
 * @Entity
 * @Table(name="charges")
 */
class Charge {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ManyToOne(targetEntity="Contract", inversedBy="charges")
	 * @JoinColumn(name="contract_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $contract;
	/**
	 * @ManyToOne(targetEntity="ChargeType")
	 * @JoinColumn(name="charge_type_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $charge_type;
	/**
	 * @Column(type="time", nullable=false)
	 */
	protected $time;

	/**
	 * @Column(type="decimal", nullable=false)
	 */
	protected $value;

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
     * Set time
     *
     * @param \DateTime $time
     * @return Charge
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return Charge
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set contract
     *
     * @param Contract $contract
     * @return Charge
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
     * Set charge_type
     *
     * @param ChargeType $chargeType
     * @return Charge
     */
    public function setChargeType(\ChargeType $chargeType = null)
    {
        $this->charge_type = $chargeType;
        return $this;
    }

    /**
     * Get charge_type
     *
     * @return ChargeType 
     */
    public function getChargeType()
    {
        return $this->charge_type;
    }
}