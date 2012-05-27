<?php
/**
 * @Entity
 * @Table(name="contracts")
 */
class Contract {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @OneToOne(targetEntity="User")
	 * @JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $user;

	/**
	 * @Column(type="string", nullable=False, length=250)
	 */
	protected $first_name;

	/**
	 * @Column(type="string", nullable=False, length=250)
	 */
	protected $second_name;

	/**
	 * @Column(type="string", nullable=False, length=250, unique=true)
	 */
	protected $number;
	/**
	 * @Column(type="date", nullable=false)
	 */
	protected $date;

	/**
	 * @Column(type="decimal", nullable=false)
	 */
	protected $balance = 0;


	/**
	 * @OneToMany(targetEntity="BillIncrease", mappedBy="contract")
	 */
	protected $bill_increases;

	/**
	 * @OneToMany(targetEntity="Charge", mappedBy="contract")
	 */
	protected $charges;

	/**
	 * @OneToMany(targetEntity="Session", mappedBy="contract")
	 */
	protected $session;

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
     * Set first_name
     *
     * @param string $firstName
     * @return Contract
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
        return $this;
    }

    /**
     * Get first_name
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set second_name
     *
     * @param string $secondName
     * @return Contract
     */
    public function setSecondName($secondName)
    {
        $this->second_name = $secondName;
        return $this;
    }

    /**
     * Get second_name
     *
     * @return string 
     */
    public function getSecondName()
    {
        return $this->second_name;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Contract
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Contract
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set balance
     *
     * @param float $balance
     * @return Contract
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
        return $this;
    }

    /**
     * Get balance
     *
     * @return float 
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Contract
     */
    public function setUser(\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User 
     */
    public function getUser()
    {
        return $this->user;
    }
    public function __construct()
    {
        $this->bill_increases = new \Doctrine\Common\Collections\ArrayCollection();
        $this->charges = new \Doctrine\Common\Collections\ArrayCollection();
        $this->session = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add bill_increases
     *
     * @param BillIncrease $billIncreases
     * @return Contract
     */
    public function addBillIncrease(\BillIncrease $billIncreases)
    {
        $this->bill_increases[] = $billIncreases;
        return $this;
    }

    /**
     * Get bill_increases
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBillIncreases()
    {
        return $this->bill_increases;
    }

    /**
     * Add charges
     *
     * @param Charge $charges
     * @return Contract
     */
    public function addCharge(\Charge $charges)
    {
        $this->charges[] = $charges;
        return $this;
    }

    /**
     * Get charges
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCharges()
    {
        return $this->charges;
    }

    /**
     * Add session
     *
     * @param Session $session
     * @return Contract
     */
    public function addSession(\Session $session)
    {
        $this->session[] = $session;
        return $this;
    }

    /**
     * Get session
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSession()
    {
        return $this->session;
    }
}