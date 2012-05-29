<?php
/** @Entity @Table(name="tests") */
class Test {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @Column(type="string")
	 */
	protected $value;

	/**
	 * @ManyToOne(targetEntity="ChargeType")
	 * @JoinColumn(name="charge_type_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $charge_type;

	/**
	 * @Column(type="integer", nullable=True)
	 */
	protected $charge_type_id;

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
     * Set value
     *
     * @param string $value
     * @return Test
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set charge_type
     *
     * @param ChargeType $chargeType
     * @return Test
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

    /**
     * Set charge_type_id
     *
     * @param integer $chargeTypeId
     * @return Test
     */
    public function setChargeTypeId($chargeTypeId)
    {
        $this->charge_type_id = $chargeTypeId;
        return $this;
    }

    /**
     * Get charge_type_id
     *
     * @return integer 
     */
    public function getChargeTypeId()
    {
        return $this->charge_type_id;
    }

	public function getFk() {
		if ($this->getChargeType() === null) {
			return 'Не выбрано';
		}
		return $this->getChargeType()->getName();
	}
}