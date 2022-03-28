<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to a MIT license 
 *
 *  @author    Devrazec <https://devrazec.com/>
 *  @copyright 2022
 *  @license   MIT
 */


// Get data from different sources inside or outside of Prestashop
class DevrazecGetDataClass extends ObjectModel
{
    // Customer
    public function getCustomerDataById($id_customer)
    {
        $customer = Db::getInstance()->executeS(
            "SELECT *
            FROM `" . _DB_PREFIX_ . "customer`
            WHERE id_customer = " . (int)$id_customer
        );

        if ($customer) {
            return $customer;
        }
        return false;
    }

    // Order
    public function getOrderDataById($id_order)
    {
        $order = Db::getInstance()->executeS(
            "SELECT * 
            FROM `" . _DB_PREFIX_ . "orders`
            WHERE id_order = " . (int)$id_order
        );
        
        if ($order) {
            return $order;
        }
        return false;
    }    
}