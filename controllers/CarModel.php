<?php

class CarModel extends Controller {

    private static $table = "car_model";

    function __construct() {
        parent:: __construct();
    }

    public function index($id = FALSE) {
        require 'Manufacturer.php';
        $allManufact = Manufacturer::getManufacturer();
        $this->view->allManufact = $allManufact;
        $this->view->render('addcarmodel', $allManufact);
    }

    public function addCarModel($id = FALSE) {
        $fileerror = [];
        if (empty($_FILES)) {
            $fileerror[] = 'images are required';
        } else {
            //echo count($_FILES['car_imgs']['name']); die;
            if (count($_FILES['car_imgs']['name']) != 2) {
                $fileerror[] = 'mix max 2 images are required';
            }
        }
        $validation = array(
            'car_model_name' => array('required'),
            'manufacturer_name' => array('required'),
            'car_color' => array('required'),
            'manufacturing_year' => array('required'),
            'car_registration_number' => array('required', 'vehicle_reg_number')
        );
        $insertmodel = array(
            'car_model_name' => getValue('car_model_name'),
            'manufacturer_id' => getValue('manufacturer_name'),
            'car_color' => getValue('car_color'),
            'car_note' => getValue('note'),
            'manufacturing_year' => getValue('manufacturing_year'),
            'car_regis_number' => getValue('car_registration_number')
        );
        $valierror = formValidation($validation);
        $error = array_merge($valierror, $fileerror);
        if (empty($error)) {
            $insertid = Db::insert(self::$table, $insertmodel);
            if ($insertid) {
                $uploadMsg = mulFileUpload('car_imgs', 'assets/images/car_images/' . $insertid . '/', 500, array('.jpg,.png,.jpeg', '.JPG', '.PNG'));
                echo response(200, 'Car model added successfully');
            } else {
                echo response(300, 'Something went wrong');
            }
            die;
        } else {
            echo response(300, 'You have errors', implode(', ', $error));
            die;
        }
    }
      public function delCarModel($id = FALSE) {
           $modelid= getValue('car_model_id');
           $del =Db::Query("DELETE FROM car_model WHERE car_model_id=".$modelid);
            if ($del) {
                echo response(200, 'Car model deleted successfully');
            } else {
                echo response(300, 'Something went wrong');
            }
            die;
      }

}
