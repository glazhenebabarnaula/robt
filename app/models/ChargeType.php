<?php
/**
 * @Entity
 * @Table(name="charge_types")
 */
class ChargeType {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @Column(type="string", nullable=False, length=250)
	 */
	protected $name;

	/**
	 * @Column(type="string", nullable=true, length=250)
	 */
	protected $crontab_rule;


	/**
	 * @OneToMany(targetEntity="ChargeTypeTariffication", mappedBy="charge_type")
	 */
	protected $tariffs;


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
     * @return ChargeType
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
     * Set crontab_rule
     *
     * @param string $crontabRule
     * @return ChargeType
     */
    public function setCrontabRule($crontabRule)
    {
        $this->crontab_rule = $crontabRule;
        return $this;
    }

    /**
     * Get crontab_rule
     *
     * @return string 
     */
    public function getCrontabRule()
    {
        return $this->crontab_rule;
    }
    public function __construct()
    {
        $this->tariffs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add tariffs
     *
     * @param ChargeTypeTariffication $tariffs
     * @return ChargeType
     */
    public function addChargeTypeTariffication(\ChargeTypeTariffication $tariffs)
    {
        $this->tariffs[] = $tariffs;
        return $this;
    }

    /**
     * Get tariffs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTariffs()
    {
        return $this->tariffs;
    }
}