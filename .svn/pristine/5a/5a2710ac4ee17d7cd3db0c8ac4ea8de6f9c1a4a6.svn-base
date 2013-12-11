<?php

class ReservationsController extends Controller {

    /**
     * reservations/index
     */
    public function index() {
        $this->view->render();
    }

    /**
     * reservations/add
     * This function is used for the placing of an reservation. 
     * It is all used with AJAX and should only be called by the url.
     */
    public function add() {
        // The customer has to be logged in before placing an reservation.
        if (isset($_SESSION['user']['id'])) {
            // If there is something posted to the server with AJAX.
            if (is('post') && is('ajax')) {
                // Get the post data and format it correctly.
                $form = $_POST['form'];
                $amount = (int) $_POST['amount'];
                $date = date(DATE_FORMAT, strtotime($_POST['date']));
                $time = date(TIME_FORMAT, strtotime($_POST['time']));
                $duration = (int) $_POST['duration'];

                // Get the available spots.
                $availableSpots = $this->get_available_spots($date, $time, $duration);

                // If the amount is higher than the number of available spots echo an JSON error.
                if ($amount > $availableSpots) {
                    echo json_encode(['error' => true]);
                }
                elseif ($form == 'availability') {

                    // Find all active menu's.
                    $Menu = new MenuModel();
                    $menus = $Menu->findAll(['conditions' => ['active' => true]]);

                    // Set the correct variables for the view.
                    $this->view->set([
                        'menus' => $menus,
                        'amount' => $amount,
                        'date' => $date,
                        'duration' => $duration,
                        'time' => $time
                    ]);

                    echo json_encode(['error' => false, 'html' => $this->view->element('reservations/add_menu')]);
                }
                elseif ($form == 'menu') {
                    // Get the posted menu data and create the reservation.
                    $reservation = new ReservationModel();
                    $menus = $_POST['menus'];

                    $reservation->amount = $amount;
                    $reservation->date = $date;
                    $reservation->time = $time;
                    $reservation->duration = $duration;
                    $reservation->usersId = $_SESSION['user']['id'];

                    $reservation->create();
                    if ($reservation->update()) {
                        // For each posted menu execute the following.
                        foreach ($menus as $menu) {
                            // Check if the menu exists and if so if it is active.
                            $menuModel = new MenuModel($menu['id']);
                            if ($menuModel->id && $menuModel->active) {
                                // Attach the menu to the reservation which was just created.
                                $reservationMenuModel = new ReservationMenuModel();
                                $reservationMenuModel->reservationsId = $reservation->id;
                                $reservationMenuModel->menusId = $menuModel->id;
                                $reservationMenuModel->comment = $menu['comment'];

                                $reservationMenuModel->create();
                                $reservationMenuModel->update();
                            }
                        }

                        // Set the correct variables for the view.
                        $this->view->set([
                            'amount' => $amount,
                            'date' => $date,
                            'duration' => $duration,
                            'time' => $time
                        ]);
                        $this->send_reservation_email($reservation->id, $_SESSION['user']['id']);
                        echo json_encode(['error' => false, 'html' => $this->view->element('reservations/add_success')]);
                    }
                    else {
                        echo json_encode(['error' => true]);
                    }
                }
            }
            else {
                $user = new UserModel($_SESSION['user']['id']);
                $this->view->set([
                    'user' => $user
                ]);
                $this->view->render();
            }
        }
        else {
            $this->view->render('users/login');
        }
    }

    /**
     * Echo's the maximum amount of customers on the date posted, in JSON.
     */
    public function json_get_max_amount() {
        if (is('post')) {
            $date = date('Y-m-d', strtotime($_POST['date']));
            echo json_encode(['amount' => $this->get_max_amount($date)]);
        }
    }

    /**
     * Echo's the schedule of the posted date in JSON.
     */
    public function json_get_schedule() {
        if (is('post')) {
            $date = date('Y-m-d', strtotime($_POST['date']));
            echo json_encode([
                'times' => $this->get_times_list($date),
                'amount' => $this->get_max_amount($date)
            ]);
        }
    }

    /**
     * Echo's the amount of available spotss based on the date in JSON.
     */
    public function json_get_available_spots() {
        if (is('post')) {
            $date = $_POST['date'];
            $time = $_POST['time'];
            $duration = $_POST['duration'];

            $availableSpots = $this->get_available_spots($date, $time, $duration);
            echo json_encode(['spots' => $availableSpots]);
        }
    }

    public function add_availablity() {
        $this->view->set('list', $this->list_reservations(date('Y-m-d')));
        $this->view->element('reservations/add_menu');
    }

    /**
     * Returns the available spots depending the date, time and duration. It first retrieves a list of the reservations for the day.
     * Then checks the given time and duration. The lowest amount is returned.
     * Date must be in 'Y-m-d' format and time in 'H:i:s' format.
     * @param date $date
     * @param date $time
     * @param int $duration
     * @return int
     */
    private function get_available_spots($date, $time, $duration) {
        $date = date('Y-m-d', strtotime($date));
        $maxAmount = $this->get_max_amount($date);
        $list = $this->list_reservations($date);

        $availableSpots = $maxAmount;
        for ($i = 0; $i <= $duration / INTERVAL; $i++) {
            $currentTime = date('H:i:s', strtotime($time) + INTERVAL * $i);
            $availableSpots = ($maxAmount - $list[$currentTime]) < $availableSpots ? $maxAmount - $list[$currentTime] : $availableSpots;
        }
        return $availableSpots;
    }

    /**
     * Returns an array with the amount of reservations for each interval. Returns the array with the key as a time('H:i:s') and the value the number of reservations.
     * @param date $date
     * @return array
     */
    private function list_reservations($date) {
        $date = date('Y-m-d', strtotime($date));
        $sql = 'SELECT * FROM `reservations` WHERE `date` = "' . $date . '"';

        $Reservation = new ReservationModel();
        $reservations = $Reservation->findAllBySql($sql);

        for ($i = 0; $i <= DAY; $i += INTERVAL) {
            $peopleBooked = 0;
            $currentTime = date('H:i:s', $i);
            if ($reservations) {
                foreach ($reservations as $reservation) {
                    if (($reservation->time >= $currentTime || $reservation->timeEnd >= $currentTime) && ($reservation->time <= $currentTime || $reservation->timeEnd <= $currentTime)) {
                        $peopleBooked += $reservation->amount;
                    }
                }
            }
            $list[$currentTime] = $peopleBooked;
        }
        return $list;
    }

    /**
     * Get a list of the times available for selecting requires a date in the following format 'Y-m-d'.
     * Return a list with the key of a type time('H:i:s') and the value 'H:i'. It gets the times from the schedule if the schedule exists.
     * Else it grabs the default times.
     * @param date $date
     * @return array
     */
    private function get_times_list($date) {
        $schedule = new ScheduleModel();
        $schedule->find(array('conditions' => array('date' => $date)));

        if ($schedule->id) {
            $timeStart = $schedule->timeStart;
            $timeEnd = $schedule->timeEnd;
        }
        else {
            $timeStart = DEFAULT_TIME_START;
            $timeEnd = DEFAULT_TIME_END;
        }

        $list = array();
        for ($i = strtotime($timeStart); $i <= strtotime($timeEnd); $i += INTERVAL) {
            $list[date('H:i:s', $i)] = date('H:i', $i);
        }
        return $list;
    }

    /**
     * Returns the maximum amount of people that are allowed to reserve. Requires the date. If a schedule has been found it retrieves the amount, else it 
     * retrieves the default value.
     * Requires the date in the following format 'Y-m-d'.
     * @param date $date
     * @return int
     */
    private function get_max_amount($date) {
        $schedule = new ScheduleModel();
        $schedule->find(array('conditions' => array('date' => $date)));

        if ($schedule->amount) {
            return $schedule->amount;
        }
        return DEFAULT_MAX;
    }

    private function send_reservation_email($reservationId, $userId) {
        $reservation = new ReservationModel($reservationId);
        $user = new UserModel($userId);

        if ($reservation->id && $user->id) {
            $mailer = new Mailer();
            $mailer->setTo($user->email);
            $mailer->setSubject('Reservering ' . $reservation->date . ' om ' . $reservation->time . ' voor ' . $reservation->amount . ' personen');
            $mailer->setPath('reservations' . DS . 'reservation');
            return (bool) $mailer->send();
        }
        return false;
    }

}