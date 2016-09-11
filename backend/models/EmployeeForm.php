<?php
namespace backend\models;
use yii;
use yii\base\Model;
use backend\models\Employee;

class EmployeeForm extends Model 
{
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $address;
	public $gender;
	public $street;
	public $city;
	public $state;
	public $country;
	public $date_of_birth;
	public $role_type;		
	private $_user;

	public function rules() 
	{
		return [
			[['first_name', 'last_name', 'date_of_birth', 'city', 'state', 'country'], 'required'],
			[['city', 'state', 'country'], 'integer'],

		];
	}

	public function addEmployee()
	{
		if (!$this->validate()) {
            return null;
        }
        
        $employee = new Employee();
        $employee->first_name = $this->first_name;
        $employee->last_name = $this->last_name;
        $employee->address = $this->address;
        $employee->gender = $this->gender;
        $employee->street = $this->street;
        $employee->city = (int)$this->city;
        $employee->state = (int)$this->state;
        $employee->country = (int)$this->country;
        $employee->date_of_birth = $this->date_of_birth;
        
        return $employee->save() ? $employee : null;
	}
}