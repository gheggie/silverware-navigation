<?php

/**
 * An extension of the base component class for crumb navigation.
 */
class CrumbNavigation extends BaseComponent
{
    private static $singular_name = "Crumb Navigation";
    private static $plural_name   = "Crumb Navigation";
    
    private static $description = "A component to show breadcrumb navigation for the current page";
    
    private static $icon = "silverware-navigation/images/icons/CrumbNavigation.png";
    
    private static $hide_ancestor = "BaseComponent";
    
    private static $allowed_children = "none";
    
    private static $db = array(
        'HideTopLevel' => 'Boolean'
    );
    
    private static $defaults = array(
        'HideTitle' => 1,
        'HideTopLevel' => 1
    );
    
    private static $required_themed_css = array(
        'crumb-navigation'
    );
    
    /**
     * Answers a collection of field objects for the CMS interface.
     *
     * @return FieldList
     */
    public function getCMSFields()
    {
        // Obtain Field Objects (from parent):
        
        $fields = parent::getCMSFields();
        
        // Create Options Fields:
        
        $fields->addFieldToTab(
            'Root.Options',
            ToggleCompositeField::create(
                'CrumbNavigationOptions',
                $this->i18n_singular_name(),
                array(
                    CheckboxField::create(
                        'HideTopLevel',
                        _t('MenuNavigation.HIDETOPLEVELCRUMBS', 'Hide crumbs on top-level pages')
                    )
                )
            )
        );
        
        // Answer Field Objects:
        
        return $fields;
    }
    
    /**
     * Answers the breadcrumbs from the current controller.
     *
     * @return string
     */
    public function getCrumbs()
    {
        return $this->getCurrentCrumbs();
    }
    
    /**
     * Answers the breadcrumbs from the current controller.
     *
     * @return string
     */
    public function getCurrentCrumbs()
    {
        if ($Controller = $this->getCurrentContentController()) {
            return $Controller->Breadcrumbs();
        }
    }
    
    /**
     * Answers the breadcrumb items from the current controller.
     *
     * @return ArrayList
     */
    public function getCurrentCrumbItems()
    {
        if ($Controller = $this->getCurrentContentController()) {
            return $Controller->getBreadcrumbItems();
        }
    }
    
    /**
     * Answers the number of breadcrumb items from the current controller.
     *
     * @return integer
     */
    public function getCurrentCrumbCount()
    {
        if ($items = $this->getCurrentCrumbItems()) {
            return $items->count();
        }
        
        return 0;
    }
    
    /**
     * Answers true to disable the component depending on component or page settings.
     *
     * @return boolean
     */
    public function Disabled()
    {
        // Handle SiteTree Pages:
        
        if ($Page = $this->getCurrentPage('SiteTree')) {
            
            if (!$Page->CrumbsDisabled) {
                
                // Hide for Top-Level Pages (if enabled):
                
                if ($this->HideTopLevel && $this->getCurrentCrumbCount() == 1) {
                    return true;
                }
                
                // Answer Field Setting:
                
                return $this->getField('Disabled');
                
            }
            
        }
        
        // Answer True to Disable (by default):
        
        return true;
    }
}

/**
 * An extension of the base component controller class for crumb navigation.
 */
class CrumbNavigation_Controller extends BaseComponent_Controller
{
    /**
     * Defines the URLs handled by this controller.
     */
    private static $url_handlers = array(
        
    );
    
    /**
     * Defines the allowed actions for this controller.
     */
    private static $allowed_actions = array(
        
    );
    
    /**
     * Performs initialisation before any action is called on the receiver.
     */
    public function init()
    {
        // Initialise Parent:
        
        parent::init();
    }
}
