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

class DevrazecClass extends ObjectModel
{
    public $id;
    public $meta_key;
    public $meta_value;       
    public $active = true;
    public $created;

    public static $definition = array(
		'table'          => 'devrazec_setting',
		'primary'        => 'id',
        'multilang'      => true,
        'multilang_shop' => true,
		'fields'         => array(
            'meta_key'   => array('type' => self::TYPE_STRING, 'required' => true, 'size' => 128),
            'meta_value' => array('type' => self::TYPE_STRING, 'required' => true, 'size' => 512),           
            'active'     => array('type' => self::TYPE_BOOL,   'validate' => 'isBool', 'required' => true),
            'created'    => array('type' => self::TYPE_DATE,   'validate' => 'isString', 'required' => true)
		),
	);  
}