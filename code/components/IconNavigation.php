<?php

/**
 * An extension of the base component class for icon navigation.
 */
class IconNavigation extends BaseComponent
{
    private static $singular_name = "Icon Navigation";
    private static $plural_name   = "Icon Navigation";
    
    private static $description = "A component to show navigation as a series of inline icons";
    
    private static $icon = "silverware-navigation/images/icons/IconNavigation.png";
    
    private static $hide_ancestor = "BaseComponent";
    
    private static $allowed_children = "none";
    
    private static $db = array(
        'IconSize' => "Enum('16, 24, 32, 48, 64, 96, 128', '32')",
        'IconColor' => 'Color',
        'IconHoverColor' => 'Color',
        'IconActiveColor' => 'Color',
        'IconBackgroundColor' => 'Color',
        'IconHoverBackgroundColor' => 'Color',
        'IconActiveBackgroundColor' => 'Color',
        'IconMarginTop' => 'Varchar(16)',
        'IconMarginLeft' => 'Varchar(16)',
        'IconMarginRight' => 'Varchar(16)',
        'IconMarginBottom' => 'Varchar(16)',
        'RoundedIcons' => 'Boolean'
    );
    
    private static $has_many = array(
        'Links' => 'SilverWareIconLink'
    );
    
    private static $defaults = array(
        'HideTitle' => 1,
        'IconSize' => '32',
        'IconColor' => 'aaaaaa',
        'IconHoverColor' => 'ffffff',
        'IconActiveColor' => 'ffffff',
        'IconBackgroundColor' => 'ffffff',
        'IconHoverBackgroundColor' => 'aaaaaa',
        'IconActiveBackgroundColor' => '888888',
        'IconMarginBottom' => 4,
        'IconMarginRight' => 4,
        'RoundedIcons' => 0
    );
    
    private static $extensions = array(
        'StyleAlignmentExtension'
    );
    
    private static $required_themed_css = array(
        'icon-navigation'
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
        
        // Insert Icons Tab:
        
        $fields->insertAfter(
            Tab::create(
                'Icons',
                _t('IconNavigation.ICONS', 'Icons')
            ),
            'Main'
        );
        
        // Add Icons Grid Field to Tab:
        
        $fields->addFieldToTab(
            'Root.Icons',
            GridField::create(
                'Icons',
                _t('IconNavigation.ICONS', 'Icons'),
                $this->Links(),
                GridFieldConfig_MultiClassEditor::create()->useSubclassesOf('SilverWareIconLink')
            )
        );
        
        // Create Style Fields:
        
        $fields->addFieldToTab(
            'Root.Style',
            ToggleCompositeField::create(
                'IconNavigationStyle',
                $this->i18n_singular_name(),
                array(
                    FieldGroup::create(
                        _t('IconNavigation.ICONCOLORS', 'Icon colors'),
                        array(
                            ColorField::create(
                                'IconColor',
                                ''
                            )->setAttribute(
                                'placeholder',
                                _t('IconNavigation.ICON', 'Icon')
                            ),
                            ColorField::create(
                                'IconHoverColor',
                                ''
                            )->setAttribute(
                                'placeholder',
                                _t('IconNavigation.HOVER', 'Hover')
                            ),
                            ColorField::create(
                                'IconActiveColor',
                                ''
                            )->setAttribute(
                                'placeholder',
                                _t('IconNavigation.ACTIVE', 'Active')
                            )
                        )
                    ),
                    FieldGroup::create(
                        _t('IconNavigation.ICONBACKGROUNDCOLORS', 'Icon background colors'),
                        array(
                            ColorField::create(
                                'IconBackgroundColor',
                                ''
                            )->setAttribute(
                                'placeholder',
                                _t('IconNavigation.ICON', 'Icon')
                            ),
                            ColorField::create(
                                'IconHoverBackgroundColor',
                                ''
                            )->setAttribute(
                                'placeholder',
                                _t('IconNavigation.HOVER', 'Hover')
                            ),
                            ColorField::create(
                                'IconActiveBackgroundColor',
                                ''
                            )->setAttribute(
                                'placeholder',
                                _t('IconNavigation.ACTIVE', 'Active')
                            )
                        )
                    ),
                    FieldGroup::create(
                        _t('IconNavigation.ICONMARGIN', 'Icon margin (in pixels)'),
                        array(
                            TextField::create('IconMarginTop', '')->setAttribute(
                                'placeholder',
                                _t('IconNavigation.TOP', 'Top')
                            )->setMaxLength(5),
                            TextField::create('IconMarginLeft', '')->setAttribute(
                                'placeholder',
                                _t('IconNavigation.LEFT', 'Left')
                            )->setMaxLength(5),
                            TextField::create('IconMarginRight', '')->setAttribute(
                                'placeholder',
                                _t('IconNavigation.RIGHT', 'Right')
                            )->setMaxLength(5),
                            TextField::create('IconMarginBottom', '')->setAttribute(
                                'placeholder',
                                _t('IconNavigation.BOTTOM', 'Bottom')
                            )->setMaxLength(5)
                        )
                    ),
                    CheckboxField::create(
                        'RoundedIcons',
                        _t('IconNavigation.ROUNDEDICONS', 'Rounded icons')
                    )
                )
            )
        );
        
        // Create Options Fields:
        
        $fields->addFieldToTab(
            'Root.Options',
            ToggleCompositeField::create(
                'IconNavigationOptions',
                $this->i18n_singular_name(),
                array(
                    OptionsetField::create(
                        'IconSize',
                        _t('IconNavigation.ICONSIZE', 'Icon size (in pixels)'),
                        $this->dbObject('IconSize')->enumValues()
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
        
        if ($this->RoundedIcons) {
            $classes[] = "rounded";
        }
        
        return $classes;
    }
    
    /**
     * Answers the CSS string for the icon margin-top style.
     *
     * @return string
     */
    public function getIconMarginTopCSS()
    {
        if ($this->owner->IconMarginTop != '') {
            return $this->owner->IconMarginTop . 'px';
        }
    }

    /**
     * Answers the CSS string for the icon margin-left style.
     *
     * @return string
     */
    public function getIconMarginLeftCSS()
    {
        if ($this->owner->IconMarginLeft != '') {
            return $this->owner->IconMarginLeft . 'px';
        }
    }

    /**
     * Answers the CSS string for the icon margin-right style.
     *
     * @return string
     */
    public function getIconMarginRightCSS()
    {
        if ($this->owner->IconMarginRight != '') {
            return $this->owner->IconMarginRight . 'px';
        }
    }

    /**
     * Answers the CSS string for the icon margin-bottom style.
     *
     * @return string
     */
    public function getIconMarginBottomCSS()
    {
        if ($this->owner->IconMarginBottom != '') {
            return $this->owner->IconMarginBottom . 'px';
        }
    }
    
    /**
     * Answers a list of enabled links for the template.
     *
     * @return ArrayList
     */
    public function EnabledLinks()
    {
        $links = $this->Links()->filter('Disabled', 0)->toArray();
        
        foreach ($links as $link) {
            $link->addExtraClass('size-' . $this->IconSize);
        }
        
        return ArrayList::create($links);
    }
}

/**
 * An extension of the base component controller class for icon navigation.
 */
class IconNavigation_Controller extends BaseComponent_Controller
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
