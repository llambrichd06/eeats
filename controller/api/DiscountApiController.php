<?php
include_once 'model/dao/DiscountDAO.php';

class DiscountApiController {

    // public function getDiscountByID() {
    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $discount = DiscountDAO::getDiscountByID($id);  
    //         echo json_encode($discount->toArray()); 
    //     }
    // }

    public function getDiscounts() {
        $discounts = DiscountDAO::getDiscounts();
        $discountsArray = [];
        foreach ($discounts as $discount) {
            array_push($discountsArray, $discount->toArray());
        }
        echo json_encode($discountsArray); 
    }

    public function saveDiscount($data) {
        if (isset($data['type'], $data['percent'], $data['begins_at'], $data['ends_at'], $data['deleted'])) {
            $discount = new Discount();
            $discount->setData(
                $data['code'],
                $data['type'],
                $data['percent'],
                $data['uses'],
                $data['begins_at'],
                $data['ends_at'],
                $data['deleted']
            );
            DiscountDAO::saveDiscount($discount);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Discount inserted correctly',
            ]);
        }
    }

    public function editDiscount($data) {
        if (isset($data['id'], $data['type'], $data['percent'], $data['begins_at'], $data['ends_at'], $data['deleted'])) {
            $discount = new Discount();
            $discount->setData(
                $data['code'],
                $data['type'],
                $data['percent'],
                $data['uses'],
                $data['begins_at'],
                $data['ends_at'],
                $data['deleted'],
                $data['id']
            );
            DiscountDAO::editDiscount($discount);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Discount edited correctly'
            ]);
        }
    }

    public function deleteDiscount($data) {
        if (isset($data['id'])) {
            DiscountDAO::deleteDiscount($data['id']);
            echo json_encode([
                'status' => 'Success',
                'data' => 'Discount deleted successfully'
            ]);
        }
    }
}
