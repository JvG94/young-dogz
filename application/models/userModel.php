<?php

class UserModel extends Model {

    public $role, 
            $created, 
            $modified, 
            $email, 
            $password, 
            $hash, 
            $active, 
            $firstName, 
            $insertion, 
            $lastName, 
            $gender,
            $country,
            $city,
            $postalCode,
            $address,
            $phone,
            $newsletter;
    
    protected $_table = 'users';
    protected $_fields = array(
        'id' => 'id',
        'role' => 'role',
        'created' => 'created',
        'modified' => 'modified',
        'email' => 'email',
        'password' => 'password',
        'hash' => 'hash',
        'active' => 'active',
        'first_name' => 'firstName',
        'insertion' => 'insertion',
        'last_name' => 'lastName',
        'gender' => 'gender',
        'country' => 'country',
        'city' => 'city',
        'postal_code' => 'postalCode',
        'address' => 'address',
        'phone' => 'phone',
        'newsletter' => 'newsletter'
    );

}