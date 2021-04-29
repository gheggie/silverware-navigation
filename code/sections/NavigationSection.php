<?php

/**
 * An extension of the SilverWare section class for a navigation section.
 */
class NavigationSection extends SilverWareSection
{
    private static $singular_name = "Navigation Section";
    private static $plural_name   = "Navigation Sections";
    
    private static $description = "A navigation section within a SilverWare template";
    
    private static $icon = "silverware-navigation/images/icons/NavigationSection.png";
    
    private static $defaults = array(
        'StyleBackgroundColor' => '0b607f'
    );
    
    private static $required_themed_css = array(
        'navigation-section'
    );
}

/**
 * An extension of the SilverWare section controller class for a navigation section.
 */
class NavigationSection_Controller extends SilverWareSection_Controller
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
