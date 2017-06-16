<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Navigation\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */

namespace SilverWare\Navigation\Components;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\Tab;
use SilverStripe\ORM\ArrayList;
use SilverWare\Components\BaseComponent;
use SilverWare\Extensions\Style\AlignmentStyle;
use SilverWare\FontIcons\Extensions\FontIconExtension;
use SilverWare\Forms\FieldSection;
use SilverWare\Forms\PageMultiselectField;
use SilverWare\Model\Link;
use Page;

/**
 * An extension of the base component class for inline navigation.
 *
 * @package SilverWare\Navigation\Components
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class InlineNavigation extends BaseComponent
{
    /**
     * Define constants.
     */
    const MODE_LINKS = 'links';
    const MODE_PAGES = 'pages';
    
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Inline Navigation';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Inline Navigation';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A component which shows a series of inline links';
    
    /**
     * Icon file for this object.
     *
     * @var string
     * @config
     */
    private static $icon = 'silverware-navigation/admin/client/dist/images/icons/InlineNavigation.png';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = BaseComponent::class;
    
    /**
     * Defines the default child class for this object.
     *
     * @var string
     * @config
     */
    private static $default_child = Link::class;
    
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'LinkMode' => 'Varchar(8)',
        'ShowIcons' => 'Boolean'
    ];
    
    /**
     * Defines the many-many associations for this object.
     *
     * @var array
     * @config
     */
    private static $many_many = [
        'LinkedPages' => Page::class
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'LinkMode' => 'links',
        'HideTitle' => 1,
        'ShowIcons' => 1
    ];
    
    /**
     * Defines the allowed children for this object.
     *
     * @var array|string
     * @config
     */
    private static $allowed_children = [
        Link::class
    ];
    
    /**
     * Defines the extension classes to apply to this object.
     *
     * @var array
     * @config
     */
    private static $extensions = [
        AlignmentStyle::class,
        FontIconExtension::class
    ];
    
    /**
     * Answers a list of field objects for the CMS interface.
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
                $this->fieldLabel('Links')
            ),
            'Main'
        );
        
        // Add Links Fields:
        
        $fields->addFieldsToTab(
            'Root.Links',
            [
                DropdownField::create(
                    'LinkMode',
                    $this->fieldLabel('LinkMode'),
                    $this->getLinkModeOptions()
                ),
                PageMultiselectField::create(
                    'LinkedPages',
                    $this->fieldLabel('LinkedPages')
                )
            ]
        );
        
        // Create Options Fields:
        
        $fields->addFieldToTab(
            'Root.Options',
            FieldSection::create(
                'InlineNavigationOptions',
                $this->i18n_singular_name(),
                [
                    CheckboxField::create(
                        'ShowIcons',
                        $this->fieldLabel('ShowIcons')
                    )
                ]
            )
        );
        
        // Answer Field Objects:
        
        return $fields;
    }
    
    /**
     * Answers the labels for the fields of the receiver.
     *
     * @param boolean $includerelations Include labels for relations.
     *
     * @return array
     */
    public function fieldLabels($includerelations = true)
    {
        // Obtain Field Labels (from parent):
        
        $labels = parent::fieldLabels($includerelations);
        
        // Define Field Labels:
        
        $labels['Links'] = _t(__CLASS__ . '.LINKS', 'Links');
        $labels['LinkMode'] = _t(__CLASS__ . '.LINKMODE', 'Mode');
        $labels['ShowIcons'] = _t(__CLASS__ . '.SHOWICONS', 'Show icons');
        $labels['LinkedPages'] = _t(__CLASS__ . '.LINKEDPAGES', 'Pages');
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Answers an array of wrapper class names for the HTML template.
     *
     * @return array
     */
    public function getWrapperClassNames()
    {
        $classes = ['inline'];
        
        $this->extend('updateWrapperClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers an array of list class names for the HTML template.
     *
     * @return array
     */
    public function getListClassNames()
    {
        $classes = ['links'];
        
        $classes[] = ($this->ShowIcons ? 'show-icons' : 'hide-icons');
        
        $this->extend('updateListClassNames', $classes);
        
        return $classes;
    }
    
    /**
     * Answers a list of all links within the receiver.
     *
     * @return DataList
     */
    public function getLinks()
    {
        return $this->AllChildren();
    }
    
    /**
     * Answers a list of the enabled links within the receiver.
     *
     * @return ArrayList
     */
    public function getEnabledLinks()
    {
        switch ($this->LinkMode) {
            
            case self::MODE_LINKS:
                
                return $this->getLinks()->filterByCallback(function ($link) {
                    return $link->isEnabled();
                });
            
            case self::MODE_PAGES:
                
                $links = ArrayList::create();
                
                foreach ($this->LinkedPages() as $page) {
                    $link = $page->toLink();
                    $link->setParent($this);
                    $links->push($link);
                }
                
                return $links;
                
        }
    }
    
    /**
     * Answers an array of options for the link mode field.
     *
     * @return array
     */
    public function getLinkModeOptions()
    {
        return [
            self::MODE_LINKS => _t(__CLASS__ . '.LINKS', 'Links'),
            self::MODE_PAGES => _t(__CLASS__ . '.PAGES', 'Pages')
        ];
    }
}