<?php
/**
 * @Entity
 * @Table(name="bill_increases")
 */
class BillIncrease {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @Column(type="datetime", nullable=false)
	 */
	protected $time;

	/**
	 * @ManyToOne(targetEntity="Contract", inversedBy="bill_increases")
	 * @JoinColumn(name="contract_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $contract;

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
     * @return BillIncrease
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
     * @return BillIncrease
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
     * @return BillIncrease
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
}