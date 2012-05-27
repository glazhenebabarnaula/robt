<?php
/**
 * @Entity
 * @Table(name="traffic_classes")
 */
class TrafficClass {
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
	 * @Column(type="string", nullable=true)
	 */
	protected $iptables_rule;

	/**
	 * @OneToMany(targetEntity="TrafficClassTariffication", mappedBy="traffic_class")
	 */
	protected $traffic_classes_costs;

    /**
     * Set name
     *
     * @param string $name
     * @return TrafficClass
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

    /**
     * Set iptables_rule
     *
     * @param string $iptablesRule
     * @return TrafficClass
     */
    public function setIptablesRule($iptablesRule)
    {
        $this->iptables_rule = $iptablesRule;
        return $this;
    }

    /**
     * Get iptables_rule
     *
     * @return string 
     */
    public function getIptablesRule()
    {
        return $this->iptables_rule;
    }
    public function __construct()
    {
        $this->traffic_classes_costs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add traffic_classes_costs
     *
     * @param TrafficClassTariffication $trafficClassesCosts
     * @return TrafficClass
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