<?php

/**
 * An extension of the base component class for level navigation.
 */
class LevelNavigation extends BaseComponent
{
    private static $singular_name = "Level Navigation";
    private static $plural_name   = "Level Navigation";
    
    private static $description = "A component to show navigation for the current page level";
    
    private static $icon = "silverware-navigation/images/icons/LevelNavigation.png";
    
    private static $hide_ancestor = "BaseComponent";
    
    private static $allowed_children = "none";
    
    private static $db = array(
        'UseLevelTitle' => 'Boolean'
    );
    
    private static $defaults = array(
        'UseLevelTitle' => 0
    );
    
    private static $extensions = array(
        'SilverWareFontIconExtension'
    );
    
    private static $required_themed_css = array(
        'level-navigation'
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
        
        // Remove Field Objects:
        
        $fields->removeByName('FontIconSize');
        
        // Create Options Fields:
        
        $fields->fieldByName('Root.Options.TitleOptions')->push(
            CheckboxField::create(
                'UseLevelTitle',
                _t('LevelNavigation.USELEVELTITLE', 'Use title of current level for component title')
            )
        );
        
        // Answer Field Objects:
        
        return $fields;
    }
    
    /**
     * Answers a string of class names for the list element.
     *
     * @return string
     */
    public function getListClass()
    {
        return implode(' ', $this->getListClassNames());
    }
    
    /**
     * Answers an array of class names for the list element.
     *
     * @return array
     */
    public function getListClassNames()
    {
        $classes = array('navigation');
        
        if ($this->HasFontIcon()) {
            $classes[] = "fa-ul";
        }
        
        return $classes;
    }
    
    /**
     * Answers true to use font icon list items.
     *
     * @return boolean
     */
    public function getFontIconListItem()
    {
        return true;
    }
    
    /**
     * Answers the site tree object currently being viewed at the appropriate level.
     *
     * @return SiteTree
     */
    public function getLevel()
    {
        if ($Page = $this->getCurrentPage('SiteTree')) {
            
            if (!$Page->Children()->exists()) {
                return $Page->Parent();
            }
            
            return $Page;
            
        }
    }
    
    /**
     * Answers a list of the child pages within the current level.
     *
     * @return ArrayList
     */
    public function getCurrentLevel()
    {
        if ($Level = $this->getLevel()) {
            return $Level->Children();
        }
    }
    
    /**
     * Answers the title of the component.
     *
     * @return string
     */
    public function Title()
    {
        if ($this->UseLevelTitle) {
            if ($Level = $this->getLevel()) {
                return $Level->MenuTitle ? $Level->MenuTitle : $this->MenuTitle;
            }
        }
        
        return $this->MenuTitle;
    }
    
    /**
     * Answers true if the receiver is disabled within the template.
     *
     * @return boolean
     */
    public function Disabled()
    {
        // Verify Children Present (answer value from field):
        
        if ($Page = $this->getCurrentPage('SiteTree')) {
            
            if ($Page->Children()->exists() || ($Page->ParentID && $Page->Parent()->Children()->exists())) {
                
                return $this->getField('Disabled');
                
            }
            
        }
        
        // Disable Component (by default, if no children are available):
        
        return true;
    }
}

/**
 * An extension of the base component controller class for level navigation.
 */
class LevelNavigation_Controller extends BaseComponent_Controller
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
