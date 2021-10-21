<?php

namespace Models;

class Company {

	private $id;
	private $cuit;
	private $name;
	private $role;
	private $active;

	public function __construct() {
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getRole() {
		return $this->role;
	}

	public function setRole($role) {
		$this->role = $role;
	}

	public function getActive()
	{
		return $this->active;
	}
  
	public function setActive($active)
	{
		$this->active = $active;
	}

	public function getCuit()
	{
		return $this->cuit;
	}
  
	public function setCuit($cuit)
	{
		$this->cuit = $cuit;
	}
}
