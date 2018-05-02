<?php

class ViewInventory extends Controller {

    function __construct() {
        parent:: __construct();
    }

    public function index($id = FALSE) {
        $this->view->inventory=$this->getInventoryDetails();
        $this->view->render('viewinventory');
    }

    public function getInventoryDetails() {
        $sql = "SELECT * FROM car_model LEFT JOIN manufacturer USING (manufacturer_id)";
        $rows = Db::getByQuery($sql);
        foreach ($rows as $key => $value) {
            $rows[$key]['images']=glob('assets/images/car_images/'.$value['car_model_id'].'/*'); 
        }
        return $rows;
    }

}
