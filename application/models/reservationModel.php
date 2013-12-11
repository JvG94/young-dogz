<?php

class ReservationModel extends Model {

    public $usersId,
            $duration,
            $created,
            $modified,
            $amount,
            $date,
            $time,
            $active,
            $status,
            $comment;
    protected $_table = 'reservations';
    protected $_fields = array(
        'id' => 'id',
        'users_id' => 'usersId',
        'duration' => 'duration',
        'created' => 'created',
        'modified' => 'modified',
        'amount' => 'amount',
        'date' => 'date',
        'time' => 'time',
        'active' => 'active',
        'status' => 'status',
        'comment' => 'comment'
    );
    private $timeEnd;

    public function __get($name) {
        switch ($name) {
            case 'timeEnd':
                if (!isset($this->timeEnd)) {
                    $this->timeEnd = date('H:i:s', strtotime($this->time) + $this->duration);
                }
                return $this->timeEnd;
        }
    }

}