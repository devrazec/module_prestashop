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

class DevrazecController extends ModuleAdminController
{
    public function __construct()   {
        $this->bootstrap = true;
        parent::__construct();
    }

    public function initToolbar() {
        parent::initToolbar();
    }

    public $menu = array(       
        array(
            'name' => array(
                'en' => 'Setting',
                'es' => 'Ajuste',
            ),
            'class_name' => 'Devrzec',
            'module' => 'devrazec',
            'icon'   => 'settings',
            'active' => true,
        ),
        array(
            'name' => array(
                'en' => 'Product',
                'es' => 'Producto',
            ),
            'class_name' => 'Product',
            'module' => 'devrazec',
            'icon'   => 'shopping_basket',
            'active' => true,
        ),
        array(   
            'name' => array(
                'en' => 'Category',
                'es' => 'Categoría',
            ),         
            'class_name' => 'Category',
            'module' => 'devrazec',
            'icon'   => 'store',
            'active' => true,
        ),
        array(   
            'name' => array(
                'en' => 'Test',
                'es' => 'Prueba',
            ),         
            'class_name' => 'Test',
            'module' => 'devrazec',
            'icon'   => 'star',
            'active' => false,
        )
    );

    public function initContent()
    {
        $htm = '<p>
                    Page Setting. 
                </p>';
       
        $this->content = $htm;

        foreach ($this->$menu as $m) {
            $names = array();
            foreach (Language::getLanguages(false) as $lang) {
                $names[(int) $lang['id_lang']] = $this->lang($n['name']);                
            }
        }

        dump($menu);        
        dump($names);
        die();

        return parent::initContent();
    }
}