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
	 * @JoinColumn(name="traffic_class_id", referencedColumnName="id", onDelete="CASCADE",nullable=false)
	 */
	protected $traffic_class;

	/**
	 * @ManyToOne(targetEntity="Tariff", inversedBy="traffic_classes_costs")
	 * @JoinColumn(name="tariff_id", referencedColumnName="id", onDelete="CASCADE",nullable=false)
	 */
	protected $tariff;

	/**
	 * @Column(type="decimal", nullable=false)
	 */
	protected $minute_cost;

	/**
	 * @Column(type="decimal", nullable=false)
	 */
	protected $megabyte_cost;

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

    /**
     * Set minute_cost
     *
     * @param float $minuteCost
     * @return TrafficClassTariffication
     */
    public function setMinuteCost($minuteCost)
    {
        $this->minute_cost = $minuteCost;
        return $this;
    }

    /**
     * Get minute_cost
     *
     * @return float 
     */
    public function getMinuteCost()
    {
        return $this->minute_cost;
    }

    /**
     * Set megabyte_cost
     *
     * @param float $megabyteCost
     * @return TrafficClassTariffication
     */
    public function setMegabyteCost($megabyteCost)
    {
        $this->megabyte_cost = $megabyteCost;
        return $this;
    }

    /**
     * Get megabyte_cost
     *
     * @return float 
     */
    public function getMegabyteCost()
    {
        return $this->megabyte_cost;
    }
}