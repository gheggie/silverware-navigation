<?php

/**
 * An extension of the base component class for inline navigation.
 */
class InlineNavigation extends BaseComponent
{
    private static $singular_name = "Inline Navigation";
    private static $plural_name   = "Inline Navigation";
    
    private static $description = "A component to show navigation as a series of inline links";
    
    private static $icon = "silverware-navigation/images/icons/InlineNavigation.png";
    
    private static $hide_ancestor = "BaseComponent";
    
    private static $allowed_children = "none";
    
    private static $db = array(
        'LinkMargin' => 'Varchar(16)',
        'LinkMarginUnit' => "Enum('px, em, rem, pt, cm, in', 'rem')"
    );
    
    private static $has_many = array(
        'Links' => 'SilverWareLink'
    );
    
    private static $defaults = array(
        'HideTitle' => 1,
        'LinkMargin' => 2,
        'LinkMarginUnit' => 'rem'
    );
    
    private static $extensions = array(
        'StyleAlignmentExtension',
        'SilverWareFontIconExtension'
    );
    
    private static $required_themed_css = array(
        'inline-navigation'
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
        
        // Insert Links Tab:
        
        $fields->insertAfter(
            Tab::create(
                'Links',
                _t('InlineNavigation.LINKS', 'Links')
            ),
            'Main'
        );
        
        // Add Links Grid Field to Tab:
        
        $fields->addFieldToTab(
            'Root.Links',
            GridField::create(
                'Links',
                _t('InlineNavigation.LINKS', 'Links'),
                $this->Links(),
                $config = GridFieldConfig_OrderableEditor::create()
            )
        );
        
        // Create Style Fields:
        
        $fields->addFieldToTab(
            'Root.Style',
            ToggleCompositeField::create(
                'InlineNavigationStyle',
                $this->i18n_singular_name(),
                array(
                    FieldGroup::create(
                        _t('InlineNavigation.LINKMARGIN', 'Link margin'),
                        array(
                            TextField::create(
                                'LinkMargin',
                                ''
                            )->setAttribute('placeholder', _t('InlineNavigation.MARGIN', 'Margin')),
                            DropdownField::create(
                                'LinkMarginUnit',
                                '',
                                $this->owner->dbObject('LinkMarginUnit')->enumValues()
                            )
                        )
                    )
                )
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
        $classes = array('links');
        
        $classes[] = $this->getStyleAlignmentWideClass();
        
        $classes[] = $this->getStyleAlignmentNarrowClass();
        
        return $classes;
    }
    
    /**
     * Answers the CSS string for the link margin style.
     *
     * @return string
     */
    public function getLinkMarginCSS()
    {
        if ($this->LinkMargin != '') {
            
            return $this->LinkMargin . $this->LinkMarginUnit;
            
        }
    }
    
    /**
     * Answers the CSS string for the link margin style (half).
     *
     * @return string
     */
    public function getLinkHalfMarginCSS()
    {
        if ($this->LinkMargin != '') {
            
            return round(($this->LinkMargin / 2), 1) . $this->LinkMarginUnit;
            
        }
    }
    
    /**
     * Answers true to use fixed width font icons.
     *
     * @return boolean
     */
    public function getFontIconFixedWidth()
    {
        return true;
    }
    
    /**
     * Answers a list of enabled links for the template.
     *
     * @return DataList
     */
    public function EnabledLinks()
    {
        return $this->Links()->filter('Disabled', 0);
    }
}

/**
 * An extension of the base component controller class for inline navigation.
 */
class InlineNavigation_Controller extends BaseComponent_Controller
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
