<?php

class MenuModel extends Model {

    public $usersId, 
            $created, 
            $modified, 
            $title, 
            $description, 
            $price,
            $active;
    
    protected $_table = 'menus';
    protected $_fields = array(
        'id' => 'id',
        'users_id' => 'usersId',
        'created' => 'created',
        'modified' => 'modified',
        'title' => 'title',
        'description' => 'description',
        'price' => 'price',
        'active' => 'active'
    );

}