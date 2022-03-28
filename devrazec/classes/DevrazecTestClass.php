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

class DevrazecTestClass extends ObjectModel
{
   

     //foreach ($data["areas-academicas"]["data"]["options"] as $area) {
    //    echo $area["title"];
    //  }
    
    $return = parent::add($autoDate, true);
    Hook::exec('actionAttributeGroupSave', array('id_attribute_group' => $this->id));
    
}