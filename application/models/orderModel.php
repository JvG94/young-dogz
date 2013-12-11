<?php

class OrderModel extends Model {

    public $usersId, $created, $modified;
    protected $_table = 'orders';
    protected $_fields = array(
        'id' => 'id',
        'users_id' => 'usersId',
        'created' => 'created',
        'modified' => 'modified'
    );
    
}