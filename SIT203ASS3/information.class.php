<?php
class information
{
	private $name;
	private $gender;
	private $type;
	private $brand;
	private $price;
	private $picture;

	public function set_name($s)
	{
		$this->name=$s;
	}
	public function get_name()
	{
		return $this->name;
	}
	public function set_gender($s)
	{
		$this->gender=$s;
	}
	public function get_gender()
	{
		return $this->gender;
	}
	public function set_type($s)
	{
		$this->type=$s;
	}
	public function get_type()
	{
		return $this->type;
	}
	public function set_brand($s)
	{
		$this->brand=$s;
	}
	public function get_brand()
	{
		return $this->brand;
	}
	public function set_price($s)
	{
		$this->price=$s;
	}
	public function get_price()
	{
		return $this->price;
	}
	public function set_picture($s)
	{
		$this->picture=$s;
	}
	public function get_picture()
	{
		return $this->picture;
	}
}
?>