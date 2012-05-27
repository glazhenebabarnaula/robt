<?php
/**
 * @Entity
 * @Table(name="tariffs")
 */
class Tariff {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @Column(type="string", nullable=False)
	 */
	protected $name;


	/**
	 * @OneToMany(targetEntity="ChargeTypeTariffication", mappedBy="tariff")
	 */
	protected $charge_types_costs;

	/**
	 * @OneToMany(targetEntity="TrafficClassTariffication", mappedBy="tariff")
	 */
	protected $traffic_classes_costs;


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
     * Set name
     *
     * @param string $name
     * @return Tariff
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    public function __construct()
    {
        $this->charge_types_costs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->traffic_classes_costs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add charge_types_costs
     *
     * @param ChargeTypeTariffication $chargeTypesCosts
     * @return Tariff
     */
    public function addChargeTypeTariffication(\ChargeTypeTariffication $chargeTypesCosts)
    {
        $this->charge_types_costs[] = $chargeTypesCosts;
        return $this;
    }

    /**
     * Get charge_types_costs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChargeTypesCosts()
    {
        return $this->charge_types_costs;
    }

    /**
     * Add traffic_classes_costs
     *
     * @param TrafficClassTariffication $trafficClassesCosts
     * @return Tariff
     */
    public function addTrafficClassTariffication(\TrafficClassTariffication $trafficClassesCosts)
    {
        $this->traffic_classes_costs[] = $trafficClassesCosts;
        return $this;
    }

    /**
     * Get traffic_classes_costs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTrafficClassesCosts()
    {
        return $this->traffic_classes_costs;
    }
}