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

class TestController extends ModuleAdminController
{
    public function __construct()   {
        $this->bootstrap = true;
        parent::__construct();
    }

    public function initToolbar() {
        parent::initToolbar();
    }

    public function initContent()
    {
        $htm = '<p>
                    Page Test. 
                </p>';
       
        $this->content = $htm;

        return parent::initContent();
    }
}