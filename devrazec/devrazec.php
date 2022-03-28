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

if (!defined('_PS_VERSION_')) {
    exit;
}

class Devrazec extends Module
{
    public function __construct()
    {
        $this->name = 'devrazec';
        $this->tab = 'administration';
        $this->secure_key = Tools::encrypt($this->name);
        $this->version = '1.0.0';
        $this->author = 'Devrazec <https://devrazec.com/>';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Devrazec');
        $this->description = $this->l('Devrazec module helps the business in a way that everything can be kept organized in one place.');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall Devrazec module?');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);

        /**
        * Menu Links
        */
        $this->menu = array(       
            array(  
                'active' => 1,
                'class_name' => 'DevrazecSetting',
                'name' => 'Setting',
                'id_parent' => 'Devrazec',
                'module' => 'devrazec',
                'position' => 1,
                'icon' => 'settings',
            ),
            array(     
                'active' => 1,
                'class_name' => 'DevrazecProduct',
                'name' => 'Product',
                'id_parent' => 'Devrazec',
                'module' => 'devrazec',
                'position' => 2,
                'icon' => 'shopping_basket',
            ),
            array(    
                'active' => 1,
                'class_name' => 'DevrazecCategory',
                'name' => 'Category',
                'id_parent' => 'Devrazec',
                'module' => 'devrazec',
                'position' => 3,
                'icon'   => 'store',
            ),
            array(      
                'active' => 1,
                'class_name' => 'DevrazecTest',
                'name' => 'Test',
                'id_parent' => 'Devrazec',              
                'module' => 'devrazec',
                'position' => 4,
                'icon' => 'star',
            )
        );
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        include(dirname(__FILE__) . '/sql/install.php');

        return parent::install() &&
            $this->addMenu() &&   
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader');         
    }

    public function uninstall()
    {
        include(dirname(__FILE__) . '/sql/uninstall.php');

        return parent::uninstall() &&
            $this->removeMenu();
    }
    
    /**
     * Add Menu when install Module
     */
    public function addMenu()
    {     
        $last_menu = Db::getInstance()->getRow("SELECT position FROM `" . _DB_PREFIX_ . "tab` ORDER BY position DESC");

        $tabid = Tab::getIdFromClassName('Devrazec');
        
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = "Devrazec";        
        $tab->name = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Devrazec';
        }
        $tab->id_parent = 0;
        $tab->module = $this->name;
        $tab->position = (int)$last_menu['position'] += 1;

        if ($tabid !== false) {
            $tab->id = (int)$tabid;
            $tab->save(); 
        } else {
            $tab->add(); 
        } 

        foreach ($this->menu as $link) {

            $tablinkid = Tab::getIdFromClassName($link['class_name']);

            $tablink = new Tab();
            $tablink->active = $link['active'];
            $tablink->class_name = $link['class_name'];        
            $tablink->name = array();
            foreach (Language::getLanguages(true) as $lang) {
                $tablink->name[$lang['id_lang']] = $link['name'];
            }
            $tablink->id_parent = Tab::getIdFromClassName($link['id_parent']);
            $tablink->module = $link['module'];
            $tablink->position = $link['position'];
            $tablink->icon = $link['icon'];                
               
            if ($tablinkid !== false) {
                $tablink->id = (int)$tablinkid;
                $tablink->save(); 
            } else {
                $tablink->add();                
            }                           
        }

        return true;
    }
    
    /**
     * Remove Menu when uninstall Module
     */
    public function removeMenu()
    {       
        $parentTabID = Tab::getIdFromClassName('Devrazec');

        foreach ($this->menu as $link) {
			$id_tab = Tab::getIdFromClassName($link['class_name']);
			$tab = new Tab($id_tab);
			$tab->delete();
		}
       
        $tabCount = Tab::getNbTabs($parentTabID);
        if ($tabCount == 0) {
            $parentTab = new Tab($parentTabID);
            $parentTab->delete();
        }

        return true;             
    }

    /**
     * Add Menu when enabled Module
     */
    public function enable($force_all = false)
    {
        return parent::enable($force_all) && 
        $this->addMenu();
    }

    /**
     * Remove Menu when disabled Module
     */
    public function disable($force_all = false)
    {
        return parent::disable($force_all) && 
        $this->removeMenu();
    }

    /**
     * Load the Module configuration
     */
    public function getContent()
    {       
        $this->context->smarty->assign('module_dir', $this->_path);
        $this->context->smarty->assign('this_path_ssl', Tools::getShopDomainSsl(true, true).__PS_BASE_URI__.'modules/'.$this->name.'/');

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');

        return $output;
    }   

     /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }
      
    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }   
}
