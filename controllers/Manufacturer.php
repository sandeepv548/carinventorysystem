<?php

class Manufacturer extends Controller {

    function __construct() {
        parent:: __construct();
    }

    private static $table = "manufacturer";

    public function index($id = FALSE) {
        $this->view->render('index');
    }

    public function addManufacturer() {
        $validation = array(
            'manufacturer_name' => array('required')
        );
        $error = formValidation($validation);
        if (empty($error)) {
            $insert = Db::insert(self::$table, array('manufacturer_name' => getValue('manufacturer_name')));
            if ($insert) {
                echo response(200, 'Manufacturer added successfuly');
            } else {
                echo response(300, 'Something went wrong');
            }
        } else {
            echo response(300, 'You have errors', implode(', ', $error));
        }
    }

    public static function getManufacturer($where = FALSE) {
        if ($where != FALSE) {
            $whereStr = Db::where($where);
        } else {
            $whereStr = '';
        }
        $getRecords = Db::getRecords(self::$table, array('manufacturer_id', 'manufacturer_name'), $whereStr);
        return $getRecords;
    }

}
