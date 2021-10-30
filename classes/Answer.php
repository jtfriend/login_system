<?php
class Answer {
    private $_db,
            $_data;
    public $_results;

    public function __construct($car = null) {
        $this->_db = DB::getInstance();
    }

    public function create($fields) {
        if(!$this->_db->insert('answers', $fields)) {
            throw new Exception('there was a problem creating an answer.');
        }
    }

    // public function findById($carId = null) {
    //     if ($carId) {
    //         $data = $this->_db->get('cars', ['c_id', '=', $carId]);
    //     }

    //     if ($data->count()) {
    //         $this->_data = $data->first();
    //         return true;
    //     }
    //     return false;
    // }

    // public function findByCarModel($carModel = null) {
    //     if ($carModel) {
    //         $data = $this->_db->get('cars', ['c_model', '=', $carModel]);
    //         if ($data->count()) {
    //             $this->_data = $data->first();
    //             return true;
    //         }
    //     }

    //     return false;
    // }
} ?>
