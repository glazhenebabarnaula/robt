<?php
/**
 * @Entity
 * @Table(name="traffic_classes_tariffication")
 */
class TrafficClassTariffication {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	/**
	 * @ManyToOne(targetEntity="TrafficClass", inversedBy="tarifications")
	 * @JoinColumn(name="contract_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $traffic_class;

	/**
	 * @ManyToOne(targetEntity="Tariff", inversedBy="traffic_classes_costs")
	 * @JoinColumn(name="contract_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $tariff;

	/**
	 * @Column(type="decimal", nullable=false)
	 */
	protected $value;


    /**
     * Set value
     *
     * @param float $value
     * @return TrafficClassTariffication
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
     * Set traffic_class
     *
     * @param TrafficClass $trafficClass
     * @return TrafficClassTariffication
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

    /**
     * Set tariff
     *
     * @param Tariff $tariff
     * @return TrafficClassTariffication
     */
    public function setTariff(\Tariff $tariff = null)
    {
        $this->tariff = $tariff;
        return $this;
    }

    /**
     * Get tariff
     *
     * @return Tariff 
     */
    public function getTariff()
    {
        return $this->tariff;
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
}