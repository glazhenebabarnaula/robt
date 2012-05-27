<?php
/**
 * @Entity
 * @Table(name="charge_types_tariffication")
 */
class ChargeTypeTariffication {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="ChargeType", inversedBy="tariffs")
	 * @JoinColumn(name="charge_type_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $charge_type;

	/**
	 * @ManyToOne(targetEntity="Tariff", inversedBy="charge_types_costs")
	 * @JoinColumn(name="tariff_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $tariff;

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
     * Set value
     *
     * @param float $value
     * @return ChargeTypeTariffication
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
     * Set charge_type
     *
     * @param ChargeType $chargeType
     * @return ChargeTypeTariffication
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
     * Set tariff
     *
     * @param Contract $tariff
     * @return ChargeTypeTariffication
     */
    public function setTariff(\Contract $tariff = null)
    {
        $this->tariff = $tariff;
        return $this;
    }

    /**
     * Get tariff
     *
     * @return Contract 
     */
    public function getTariff()
    {
        return $this->tariff;
    }
}