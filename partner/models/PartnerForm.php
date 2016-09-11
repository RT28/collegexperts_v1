<?php
namespace partner\models;
use yii;
use yii\base\Model;

class EmployeeForm extends Model 
{
	public $first_name;
	public $last_name;
	public $address;
	public $gender;
	public $street;
	public $city;
	public $state;
	public $country;
	public $date_of_birth;
	private $_user;

	public function rules() 
	{
		return [
			[['first_name', 'last_name', 'date_of_birth'], 'required'],
		];
	}
}