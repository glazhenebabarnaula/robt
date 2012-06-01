<?php
/**
 * @Entity
 * @Table(name="users")
 * */
class User implements mUser {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @Column(type="string", nullable=false, unique=True)
	 */
	protected $username;

	/**
	 * @Column(type="string", nullable=false)
	 */
	protected $password;

	/**
	 * @Column(type="array", nullable=False)
	 */
	protected $permissions = array();


	/**
	 * @OneToOne(targetEntity="Contract", mappedBy="user")
	 */
	protected $contract;

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
	 * Set username
	 *
	 * @param string $username
	 * @return
	 */
	public function setUsername($username)
	{
		$this->username = $username;
		return $this;
	}

	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Set password
	 *
	 * @param string $password
	 * @return mUser
	 */
	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}

	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	public function hasAccess($name) {
		return $this->getPermissions() && in_array($name, $this->getPermissions());
	}

    /**
     * Set permissions
     *
     * @param array $permissions
     * @return User
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
        return $this;
    }

    /**
     * Get permissions
     *
     * @return array 
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Set contract
     *
     * @param Contract $contract
     * @return User
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