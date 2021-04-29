<?php

/**
 * An extension of the base component class for menu navigation.
 */
class MenuNavigation extends BaseComponent
{
    private static $singular_name = "Menu Navigation";
    private static $plural_name   = "Menu Navigation";
    
    private static $description = "A component to show site navigation as a dropdown menu";
    
    private static $icon = "silverware-navigation/images/icons/MenuNavigation.png";
    
    private static $hide_ancestor = "BaseComponent";
    
    private static $allowed_children = "none";
    
    private static $db = array(
        'HideTimeout' => 'Int',
        'ShowTimeout' => 'Int',
        'HideDuration' => 'Int',
        'ShowDuration' => 'Int',
        'ShowOnClick' => 'Boolean',
        'ShowSubMenus' => 'Boolean',
        'HideEffect' => 'Varchar(32)',
        'ShowEffect' => 'Varchar(32)',
        'ButtonType' => 'Varchar(64)',
        'ThemeClass' => 'Varchar(128)',
        'ButtonLabel' => 'Varchar(32)',
        'ShowMenuShadow' => 'Boolean',
        'ShowButtonLabel' => 'Boolean',
        'MenuAlignment' => "Enum('Left, Right', 'Left')",
        'ButtonAlignment' => "Enum('Left, Right', 'Left')",
        'ButtonForegroundColor' => 'Color',
        'ButtonForegroundAlpha' => 'Decimal(3,2,1)',
        'ButtonBackgroundColor' => 'Color',
        'ButtonBackgroundAlpha' => 'Decimal(3,2,1)',
        'ButtonBackgroundHoverColor' => 'Color',
        'ButtonBackgroundHoverAlpha' => 'Decimal(3,2,1)',
        'ButtonBackgroundActiveColor' => 'Color',
        'ButtonBackgroundActiveAlpha' => 'Decimal(3,2,1)',
        'MenuBackgroundColor' => 'Color',
        'MenuBackgroundAlpha' => 'Decimal(3,2,1)',
        'SubMenuBackgroundColor' => 'Color',
        'SubMenuBackgroundAlpha' => 'Decimal(3,2,1)',
        'SubMenuBorderWidth' => 'Varchar(16)',
        'SubMenuBorderUnit' => "Enum('px, em, rem, pt, cm, in', 'px')",
        'SubMenuBorderStyle' => "Enum('none, solid, dashed, dotted, double', 'solid')",
        'SubMenuBorderColor' => 'Color',
        'SubMenuBorderAlpha' => 'Decimal(3,2,1)',
        'TopLevelForegroundColor' => 'Color',
        'TopLevelForegroundAlpha' => 'Decimal(3,2,1)',
        'TopLevelBackgroundActiveColor' => 'Color',
        'TopLevelBackgroundActiveAlpha' => 'Decimal(3,2,1)',
        'SubLevelForegroundColor' => 'Color',
        'SubLevelForegroundAlpha' => 'Decimal(3,2,1)',
        'SubLevelBackgroundActiveColor' => 'Color',
        'SubLevelBackgroundActiveAlpha' => 'Decimal(3,2,1)',
        'MobileForegroundColor' => 'Color',
        'MobileForegroundAlpha' => 'Decimal(3,2,1)',
        'MobileBackgroundActiveColor' => 'Color',
        'MobileBackgroundActiveAlpha' => 'Decimal(3,2,1)',
        'TopLevelFontSize' => 'Varchar(16)',
        'TopLevelFontSizeUnit' => "Enum('px, em, rem, pt, cm, in', 'rem')",
        'SubLevelFontSize' => 'Varchar(16)',
        'SubLevelFontSizeUnit' => "Enum('px, em, rem, pt, cm, in', 'rem')",
        'MobileFontSize' => 'Varchar(16)',
        'MobileFontSizeUnit' => "Enum('px, em, rem, pt, cm, in', 'rem')",
        'ButtonFontSize' => 'Varchar(16)',
        'ButtonFontSizeUnit' => "Enum('px, em, rem, pt, cm, in', 'rem')"
    );
    
    private static $has_one = array(
        'MenuFont' => 'SilverWareFont',
        'ButtonFont' => 'SilverWareFont'
    );
    
    private static $defaults = array(
        'HideTitle' => 1,
        'ShowOnClick' => 0,
        'ShowSubMenus' => 1,
        'HideTimeout' => 500,
        'ShowTimeout' => 250,
        'HideDuration' => 250,
        'ShowDuration' => 250,
        'HideEffect' => 'hide',
        'ShowEffect' => 'show',
        'ThemeClass' => 'sm-default',
        'MenuAlignment' => 'Left',
        'ButtonType' => 'squeeze',
        'ButtonAlignment' => 'Left',
        'ButtonLabel' => 'Menu',
        'ShowMenuShadow' => 1,
        'ShowButtonLabel' => 0,
        'ButtonForegroundColor' => 'ffffff',
        'ButtonForegroundAlpha' => 1,
        'ButtonBackgroundColor' => 'ffffff',
        'ButtonBackgroundAlpha' => 0.2,
        'ButtonBackgroundHoverColor' => 'ffffff',
        'ButtonBackgroundHoverAlpha' => 0.3,
        'ButtonBackgroundActiveColor' => '000000',
        'ButtonBackgroundActiveAlpha' => 0.3,
        'MenuBackgroundColor' => '0b607f',
        'MenuBackgroundAlpha' => 1,
        'SubMenuBackgroundColor' => 'ffffff',
        'SubMenuBackgroundAlpha' => 1,
        'SubMenuBorderWidth' => 2,
        'SubMenuBorderUnit' => 'px',
        'SubMenuBorderStyle' => 'solid',
        'SubMenuBorderColor' => '888888',
        'SubMenuBorderAlpha' => 1,
        'TopLevelForegroundColor' => 'ffffff',
        'TopLevelForegroundAlpha' => 1,
        'TopLevelBackgroundActiveColor' => '000000',
        'TopLevelBackgroundActiveAlpha' => 0.2,
        'SubLevelBackgroundActiveColor' => '000000',
        'SubLevelBackgroundActiveAlpha' => 0.15,
        'SubLevelForegroundColor' => '666666',
        'SubLevelForegroundAlpha' => 1,
        'MobileForegroundColor' => 'ffffff',
        'MobileForegroundAlpha' => 1,
        'MobileBackgroundActiveColor' => '000000',
        'MobileBackgroundActiveAlpha' => 0.2,
        'TopLevelFontSize' => '1.5',
        'TopLevelFontSizeUnit' => 'rem',
        'SubLevelFontSize' => '1.3',
        'SubLevelFontSizeUnit' => 'rem',
        'MobileFontSize' => '1.5',
        'MobileFontSizeUnit' => 'rem',
        'ButtonFontSize' => '1.4',
        'ButtonFontSizeUnit' => 'rem'
    );
    
    private static $required_css = array(
        'silverware-navigation/thirdparty/smartmenus/css/sm-core-css.css',
        'silverware-navigation/thirdparty/hamburgers/hamburgers.min.css'
    );
    
    private static $required_themed_css = array(
        'menu-navigation.base',
        'menu-navigation.theme',
        'menu-navigation.button'
    );
    
    private static $required_js = array(
        'silverware-navigation/thirdparty/smartmenus/jquery.smartmenus.min.js',
        'silverware-navigation/thirdparty/smartmenus/addons/keyboard/jquery.smartmenus.keyboard.min.js'
    );
    
    private static $required_js_templates = array(
        'silverware-navigation/javascript/smartmenus/smartmenus.init.js'
    );
    
    private static $custom_styles = array(
        'MenuBar' => array(
            'type' => 'MenuBar'
        ),
        'MenuButton' => array(
            'type' => 'MenuButton'
        ),
        'MenuToggle' => array(
            'type' => 'MenuToggle'
        ),
        'TopLevelMenus' => array(
            'type' => 'Menu',
            'prefix' => 'nav >'
        ),
        'TopLevelItems' => array(
            'type' => 'MenuItem',
            'prefix' => 'nav >',
            'mappings' => array(
                'arrow' => 'border-top-color'
            )
        ),
        'SubLevelMenus' => array(
            'type' => 'Menu',
            'prefix' => 'nav > ul'
        ),
        'SubLevelItems' => array(
            'type' => 'MenuItem',
            'prefix' => 'nav > ul',
            'mappings' => array(
                'arrow' => 'border-left-color'
            )
        )
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
        
        // Obtain Alpha Options:
        
        $alpha = SilverWareTools::percentage_options(100, 0, 5);
        
        // Create Style Fields:
        
        $fields->addFieldsToTab(
            'Root.Style',
            array(
                ToggleCompositeField::create(
                    'MenuNavigationFontStyle',
                    _t('MenuNavigation.FONTS', 'Fonts'),
                    array(
                        DropdownField::create(
                            'ButtonFontID',
                            _t('MenuNavigation.BUTTONFONT', 'Button font'),
                            SilverWareFont::get()->map()
                        )->setEmptyString(' '),
                        DropdownField::create(
                            'MenuFontID',
                            _t('MenuNavigation.MENUFONT', 'Menu font'),
                            SilverWareFont::get()->map()
                        )->setEmptyString(' '),
                        FieldGroup::create(
                            _t('MenuNavigation.BUTTONFONTSIZE', 'Button font size'),
                            array(
                                TextField::create(
                                    'ButtonFontSize',
                                    ''
                                )->setAttribute(
                                    'placeholder',
                                    _t('MenuNavigation.SIZE', 'Size')
                                ),
                                DropdownField::create(
                                    'ButtonFontSizeUnit',
                                    '',
                                    $this->dbObject('ButtonFontSizeUnit')->enumValues()
                                )
                            )
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.MOBILEFONTSIZE', 'Mobile font size'),
                            array(
                                TextField::create(
                                    'MobileFontSize',
                                    ''
                                )->setAttribute(
                                    'placeholder',
                                    _t('MenuNavigation.SIZE', 'Size')
                                ),
                                DropdownField::create(
                                    'MobileFontSizeUnit',
                                    '',
                                    $this->dbObject('MobileFontSizeUnit')->enumValues()
                                )
                            )
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.TOPLEVELFONTSIZE', 'Top-level font size'),
                            array(
                                TextField::create(
                                    'TopLevelFontSize',
                                    ''
                                )->setAttribute(
                                    'placeholder',
                                    _t('MenuNavigation.SIZE', 'Size')
                                ),
                                DropdownField::create(
                                    'TopLevelFontSizeUnit',
                                    '',
                                    $this->dbObject('TopLevelFontSizeUnit')->enumValues()
                                )
                            )
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.SUBLEVELFONTSIZE', 'Sub-level font size'),
                            array(
                                TextField::create(
                                    'SubLevelFontSize',
                                    ''
                                )->setAttribute(
                                    'placeholder',
                                    _t('MenuNavigation.SIZE', 'Size')
                                ),
                                DropdownField::create(
                                    'SubLevelFontSizeUnit',
                                    '',
                                    $this->dbObject('SubLevelFontSizeUnit')->enumValues()
                                )
                            )
                        )
                    )
                ),
                ToggleCompositeField::create(
                    'MenuNavigationColorStyle',
                    _t('MenuNavigation.COLORS', 'Colors'),
                    array(
                        HeaderField::create(
                            'ButtonHeader',
                            _t('MenuNavigation.BUTTON', 'Button')
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.BUTTONFOREGROUNDCOLOR', 'Button foreground color'),
                            array(
                                ColorField::create('ButtonForegroundColor', ''),
                                DropdownField::create('ButtonForegroundAlpha', '', $alpha)
                            )
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.BUTTONBACKGROUNDCOLOR', 'Button background color'),
                            array(
                                ColorField::create('ButtonBackgroundColor', ''),
                                DropdownField::create('ButtonBackgroundAlpha', '', $alpha)
                            )
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.BUTTONBACKGROUNDCOLORHOVER', 'Button background color (hover)'),
                            array(
                                ColorField::create('ButtonBackgroundHoverColor', ''),
                                DropdownField::create('ButtonBackgroundHoverAlpha', '', $alpha)
                            )
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.BUTTONBACKGROUNDCOLORACTIVE', 'Button background color (active)'),
                            array(
                                ColorField::create('ButtonBackgroundActiveColor', ''),
                                DropdownField::create('ButtonBackgroundActiveAlpha', '', $alpha)
                            )
                        ),
                        HeaderField::create(
                            'MenuHeader',
                            _t('MenuNavigation.MENU', 'Menu')
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.MENUBACKGROUNDCOLOR', 'Menu background color'),
                            array(
                                ColorField::create('MenuBackgroundColor', ''),
                                DropdownField::create('MenuBackgroundAlpha', '', $alpha)
                            )
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.SUBMENUBACKGROUNDCOLOR', 'Sub-menu background color'),
                            array(
                                ColorField::create('SubMenuBackgroundColor', ''),
                                DropdownField::create('SubMenuBackgroundAlpha', '', $alpha)
                            )
                        ),
                        HeaderField::create(
                            'MobileHeader',
                            _t('MenuNavigation.MOBILE', 'Mobile')
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.MOBILEFOREGROUNDCOLOR', 'Mobile foreground color'),
                            array(
                                ColorField::create('MobileForegroundColor', ''),
                                DropdownField::create('MobileForegroundAlpha', '', $alpha)
                            )
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.MOBILEBACKGROUNDCOLORACTIVE', 'Mobile background color (active)'),
                            array(
                                ColorField::create('MobileBackgroundActiveColor', ''),
                                DropdownField::create('MobileBackgroundActiveAlpha', '', $alpha)
                            )
                        ),
                        HeaderField::create(
                            'TopLevelHeader',
                            _t('MenuNavigation.TOPLEVEL', 'Top-level')
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.TOPLEVELFOREGROUNDCOLOR', 'Top-level foreground color'),
                            array(
                                ColorField::create('TopLevelForegroundColor', ''),
                                DropdownField::create('TopLevelForegroundAlpha', '', $alpha)
                            )
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.TOPLEVELBACKGROUNDCOLORACTIVE', 'Top-level background color (active)'),
                            array(
                                ColorField::create('TopLevelBackgroundActiveColor', ''),
                                DropdownField::create('TopLevelBackgroundActiveAlpha', '', $alpha)
                            )
                        ),
                        HeaderField::create(
                            'SubLevelHeader',
                            _t('MenuNavigation.SUBLEVEL', 'Sub-level')
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.SUBLEVELFOREGROUNDCOLOR', 'Sub-level foreground color'),
                            array(
                                ColorField::create('SubLevelForegroundColor', ''),
                                DropdownField::create('SubLevelForegroundAlpha', '', $alpha)
                            )
                        ),
                        FieldGroup::create(
                            _t('MenuNavigation.SUBLEVELBACKGROUNDCOLORACTIVE', 'Sub-level background color (active)'),
                            array(
                                ColorField::create('SubLevelBackgroundActiveColor', ''),
                                DropdownField::create('SubLevelBackgroundActiveAlpha', '', $alpha)
                            )
                        )
                    )
                ),
                ToggleCompositeField::create(
                    'MenuNavigationButtonStyle',
                    _t('MenuNavigation.BUTTON', 'Button'),
                    array(
                        OptionsetField::create(
                            'ButtonType',
                            _t('MenuNavigation.BUTTONTYPE', 'Button type'),
                            $this->config()->button_types
                        ),
                        DropdownField::create(
                            'ButtonAlignment',
                            _t('MenuNavigation.BUTTONALIGNMENT', 'Button alignment'),
                            $this->dbObject('ButtonAlignment')->enumValues()
                        ),
                        CheckboxField::create(
                            'ShowButtonLabel',
                            _t('MenuNavigation.SHOWBUTTONLABEL', 'Show button label')
                        ),
                        TextField::create(
                            'ButtonLabel',
                            _t('MenuNavigation.BUTTONLABEL', 'Button label')
                        )->displayIf('ShowButtonLabel')->isChecked()->end()
                    )
                ),
                ToggleCompositeField::create(
                    'MenuNavigationMenuStyle',
                    _t('MenuNavigation.MENUS', 'Menus'),
                    array(
                        FieldGroup::create(
                            _t("MenuNavigation.SUBLEVELBORDER", "Sub-menu border"),
                            array(
                                TextField::create("SubMenuBorderWidth", '')->setAttribute(
                                    'placeholder',
                                    _t('MenuNavigation.WIDTH', 'Width')
                                )->setMaxLength(8),
                                DropdownField::create(
                                    "SubMenuBorderUnit",
                                    '',
                                    $this->dbObject("SubMenuBorderUnit")->enumValues()
                                ),
                                DropdownField::create(
                                    "SubMenuBorderStyle",
                                    '',
                                    $this->dbObject("SubMenuBorderStyle")->enumValues()
                                ),
                                ColorField::create("SubMenuBorderColor", '')->setAttribute(
                                    'placeholder',
                                    _t('MenuNavigation.COLOR', 'Color')
                                ),
                                DropdownField::create("SubMenuBorderAlpha", '', $alpha)
                            )
                        ),
                        DropdownField::create(
                            'MenuAlignment',
                            _t('MenuNavigation.MENUALIGNMENT', 'Menu alignment'),
                            $this->dbObject('MenuAlignment')->enumValues()
                        ),
                        CheckboxField::create(
                            'ShowMenuShadow',
                            _t('MenuNavigation.SHOWMENUSHADOW', 'Show menu shadow')
                        )
                    )
                )
            )
        );
        
        // Create Options Fields:
        
        $fields->addFieldToTab(
            'Root.Options',
            ToggleCompositeField::create(
                'MenuNavigationOptions',
                $this->i18n_singular_name(),
                array(
                    NumericField::create(
                        'ShowTimeout',
                        _t('MenuNavigation.SHOWTIMEOUT', 'Show timeout (in milliseconds)')
                    ),
                    NumericField::create(
                        'HideTimeout',
                        _t('MenuNavigation.HIDETIMEOUT', 'Hide timeout (in milliseconds)')
                    ),
                    NumericField::create(
                        'ShowDuration',
                        _t('MenuNavigation.SHOWDURATION', 'Show duration (in milliseconds)')
                    ),
                    NumericField::create(
                        'HideDuration',
                        _t('MenuNavigation.HIDEDURATION', 'Hide duration (in milliseconds)')
                    ),
                    DropdownField::create(
                        'ShowEffect',
                        _t('MenuNavigation.SHOWEFFECT', 'Show effect'),
                        $this->config()->show_effects
                    ),
                    DropdownField::create(
                        'HideEffect',
                        _t('MenuNavigation.HIDEEFFECT', 'Hide effect'),
                        $this->config()->hide_effects
                    ),
                    TextField::create(
                        'ThemeClass',
                        _t('MenuNavigation.THEMECLASS', 'Theme class')
                    ),
                    CheckboxField::create(
                        'ShowOnClick',
                        _t('MenuNavigation.SHOWONCLICK', 'Show on click')
                    ),
                    CheckboxField::create(
                        'ShowSubMenus',
                        _t('MenuNavigation.SHOWSUBMENUS', 'Show sub-menus')
                    )
                )
            )
        );
        
        // Answer Field Objects:
        
        return $fields;
    }
    
    /**
     * Answers a unique ID for the list element.
     *
     * @return string
     */
    public function getListID()
    {
        return $this->getHTMLID() . "_List";
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
        $classes = array('sm', 'sm-base');
        
        if ($theme = $this->getThemeName()) {
            $classes[] = $theme;
        }
        
        if ($this->MenuAlignment == 'Right') {
            $classes[] = "sm-right";
        }
        
        if ($this->ShowMenuShadow) {
            $classes[] = "sm-shadow";
        }
        
        return $classes;
    }
    
    /**
     * Answers a string of class names for the button element.
     *
     * @return string
     */
    public function getButtonClass()
    {
        return implode(' ', $this->getButtonClassNames());
    }
    
    /**
     * Answers a array of class names for the button element.
     *
     * @return array
     */
    public function getButtonClassNames()
    {
        $classes = array('sm-button', 'hamburger');
        
        if ($type = $this->ButtonTypeClass) {
            $classes[] = $type;
        }
        
        if ($this->ButtonAlignment == 'Right') {
            $classes[] = "sm-right";
        }
        
        return $classes;
    }
    
    /**
     * Answers the CSS class for the button type.
     *
     * @return string
     */
    public function getButtonTypeClass()
    {
        if ($type = $this->ButtonType) {
            return "hamburger--{$type}";
        }
    }
    
    /**
     * Answers the CSS string for the menu font-family style.
     *
     * @return string
     */
    public function getMenuFontFamilyCSS()
    {
        if ($this->MenuFontID) {
            return $this->MenuFont()->getStyleFontFamily();
        }
    }
    
    /**
     * Answers the CSS string for the button font-family style.
     *
     * @return string
     */
    public function getButtonFontFamilyCSS()
    {
        if ($this->ButtonFontID) {
            return $this->ButtonFont()->getStyleFontFamily();
        }
    }
    
    /**
     * Answers the CSS string for the menu background-color style.
     *
     * @return string
     */
    public function getMenuBackgroundColorCSS()
    {
        return $this->getColorCSS('MenuBackground');
    }
    
    /**
     * Answers the CSS string for the sub-menu background-color style.
     *
     * @return string
     */
    public function getSubMenuBackgroundColorCSS()
    {
        return $this->getColorCSS('SubMenuBackground');
    }
    
    /**
     * Answers the CSS string for the button color style.
     *
     * @return string
     */
    public function getButtonForegroundColorCSS()
    {
        return $this->getColorCSS('ButtonForeground');
    }
    
    /**
     * Answers the CSS string for the button background-color style.
     *
     * @return string
     */
    public function getButtonBackgroundColorCSS()
    {
        return $this->getColorCSS('ButtonBackground');
    }
    
    /**
     * Answers the CSS string for the button hover background-color style.
     *
     * @return string
     */
    public function getButtonBackgroundHoverColorCSS()
    {
        return $this->getColorCSS('ButtonBackgroundHover');
    }
    
    /**
     * Answers the CSS string for the button active background-color style.
     *
     * @return string
     */
    public function getButtonBackgroundActiveColorCSS()
    {
        return $this->getColorCSS('ButtonBackgroundActive');
    }
    
    /**
     * Answers the CSS string for the top-level color style.
     *
     * @return string
     */
    public function getTopLevelForegroundColorCSS()
    {
        return $this->getColorCSS('TopLevelForeground');
    }
    
    /**
     * Answers the CSS string for the top-level active background-color style.
     *
     * @return string
     */
    public function getTopLevelBackgroundActiveColorCSS()
    {
        return $this->getColorCSS('TopLevelBackgroundActive');
    }
    
    /**
     * Answers the CSS string for the sub-level color style.
     *
     * @return string
     */
    public function getSubLevelForegroundColorCSS()
    {
        return $this->getColorCSS('SubLevelForeground');
    }
    
    /**
     * Answers the CSS string for the sub-level active background-color style.
     *
     * @return string
     */
    public function getSubLevelBackgroundActiveColorCSS()
    {
        return $this->getColorCSS('SubLevelBackgroundActive');
    }
    
    /**
     * Answers the CSS string for the mobile color style.
     *
     * @return string
     */
    public function getMobileForegroundColorCSS()
    {
        return $this->getColorCSS('MobileForeground');
    }
    
    /**
     * Answers the CSS string for the mobile active background-color style.
     *
     * @return string
     */
    public function getMobileBackgroundActiveColorCSS()
    {
        return $this->getColorCSS('MobileBackgroundActive');
    }
    
    /**
     * Answers the CSS string for the sub-menu border style.
     *
     * @return string
     */
    public function getSubMenuBorderCSS()
    {
        $css = array();
        
        if ($this->SubMenuBorderWidth != '') {
            
            $css[] = $this->SubMenuBorderWidth . $this->SubMenuBorderUnit;
            $css[] = $this->SubMenuBorderStyle;
            
            if ($this->SubMenuBorderColor != '') {
                $css[] = $this->dbObject('SubMenuBorderColor')->CSSColor($this->SubMenuBorderAlpha);
            } else {
                $css[] = "transparent";
            }
            
        }
        
        return implode(' ', $css);
    }
    
    /**
     * Answers the CSS string for the button font-size style.
     *
     * @return string
     */
    public function getButtonFontSizeCSS()
    {
        if ($this->ButtonFontSize) {
            
            return $this->ButtonFontSize . $this->ButtonFontSizeUnit;
            
        }
    }
    
    /**
     * Answers the CSS string for the mobile font-size style.
     *
     * @return string
     */
    public function getMobileFontSizeCSS()
    {
        if ($this->MobileFontSize) {
            
            return $this->MobileFontSize . $this->MobileFontSizeUnit;
            
        }
    }
    
    /**
     * Answers the CSS string for the top-level font-size style.
     *
     * @return string
     */
    public function getTopLevelFontSizeCSS()
    {
        if ($this->TopLevelFontSize) {
            
            return $this->TopLevelFontSize . $this->TopLevelFontSizeUnit;
            
        }
    }
    
    /**
     * Answers the CSS string for the sub-level font-size style.
     *
     * @return string
     */
    public function getSubLevelFontSizeCSS()
    {
        if ($this->SubLevelFontSize) {
            
            return $this->SubLevelFontSize . $this->SubLevelFontSizeUnit;
            
        }
    }
    
    /**
     * Answers an array of variables required by the initialisation script.
     *
     * @return array
     */
    public function getJSVars()
    {
        $vars = parent::getJSVars();
        
        $vars['ListID'] = $this->getListID();
        
        $vars['ShowTimeout'] = $this->ShowTimeout;
        $vars['HideTimeout'] = $this->HideTimeout;
        
        $vars['ShowDuration'] = $this->ShowDuration;
        $vars['HideDuration'] = $this->HideDuration;
        
        $vars['ShowFunction'] = $this->ShowFunction();
        $vars['HideFunction'] = $this->HideFunction();
        
        $vars['ShowOnClick'] = $this->dbObject('ShowOnClick')->NiceAsBoolean();
        
        return $vars;
    }
    
    /**
     * Answers the show function for the menu script.
     *
     * @return string
     */
    public function ShowFunction()
    {
        return $this->getAnimationFunction($this->ShowEffect, $this->ShowDuration);
    }

    /**
     * Answers the hide function for the menu script.
     *
     * @return string
     */
    public function HideFunction()
    {
        return $this->getAnimationFunction($this->HideEffect, $this->HideDuration);
    }
    
    /**
     * Answers true if the button label should be shown.
     *
     * @return boolean
     */
    public function ButtonLabelShown()
    {
        return ($this->ButtonLabel && $this->ShowButtonLabel);
    }
    
    /**
     * Answers the name of the menu theme.
     *
     * @return string
     */
    public function getThemeName()
    {
        return trim($this->ThemeClass);
    }
    
    /**
     * Loads the CSS and scripts required by the receiver.
     */
    public function getRequirements()
    {
        // Load Parent Requirements:
        
        parent::getRequirements();
        
        // Load Theme CSS:
        
        if (Director::fileExists($this->getThemeCSSPath())) {
            Requirements::css($this->getThemeCSSPath());
        } else {
            Requirements::themedCSS($this->getThemeName(), SILVERWARE_NAVIGATION_DIR);
        }
    }
    
    /**
     * Answers an animation function for the menu script.
     *
     * @param string $effect jQuery effect name.
     * @param integer $duration Duration of effect in milliseconds.
     * @return string
     */
    protected function getAnimationFunction($effect, $duration)
    {
        return "function(\$ul, complete) { \$ul.{$effect}({$duration}, complete); }";
    }
    
    /**
     * Answers the CSS string for the specified property.
     *
     * @return string
     */
    protected function getColorCSS($name)
    {
        $cname = "{$name}Color";
        $aname = "{$name}Alpha";
        
        if ($this->{$cname} != '') {
            
            $alpha = $this->{$aname};
            $color = $this->dbObject($cname);
            
            return ($alpha == 1) ? '#' . $color->getValue() : $color->CSSColor($alpha);
            
        }
    }
    
    /**
     * Answers the path for the theme CSS file.
     *
     * @return string
     */
    protected function getThemeCSSPath()
    {
        $theme = $this->getThemeName();
        
        return SILVERWARE_NAVIGATION_DIR . "/thirdparty/smartmenus/css/{$theme}/{$theme}.css";
    }
}

/**
 * An extension of the base component controller class for menu navigation.
 */
class MenuNavigation_Controller extends BaseComponent_Controller
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
