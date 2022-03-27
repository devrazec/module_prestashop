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

$sql = array();
$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'devrazec_setting`';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}

return true;