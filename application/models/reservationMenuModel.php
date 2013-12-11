<?php

class ReservationMenuModel extends Model {

    public $reservationsId, $menusId, $comment;
    protected $_table = 'reservations_menus';
    protected $_fields = array(
        'id' => 'id',
        'reservations_id' => 'reservationsId',
        'menus_id' => 'menusId',
        'comment' => 'comment'
    );
    
}