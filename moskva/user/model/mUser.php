<?php

interface mUser {
	public function getUsername();
	public function getPassword();
	public function getId();
	public function hasAccess($name);
}