<?php

/**
 * This file is part of SilverWare.
 *
 * PHP version >=5.6.0
 *
 * For full copyright and license information, please view the
 * LICENSE.md file that was distributed with this source code.
 *
 * @package SilverWare\Navigation\Items
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */

namespace SilverWare\Navigation\Items;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\View\ArrayData;
use SilverWare\Forms\FieldSection;
use SilverWare\Navigation\Model\BarItem;
use SilverWare\Tools\ViewTools;
use PageController;

/**
 * An extension of the bar item class for a navigation item.
 *
 * @package SilverWare\Navigation\Items
 * @author Colin Tucker <colin@praxis.net.au>
 * @copyright 2017 Praxis Interactive
 * @license https://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @link https://github.com/praxisnetau/silverware-navigation
 */
class NavigationItem extends BarItem
{
    /**
     * Human-readable singular name.
     *
     * @var string
     * @config
     */
    private static $singular_name = 'Navigation Item';
    
    /**
     * Human-readable plural name.
     *
     * @var string
     * @config
     */
    private static $plural_name = 'Navigation Items';
    
    /**
     * Description of this object.
     *
     * @var string
     * @config
     */
    private static $description = 'A bar item which shows the main navigation';
    
    /**
     * Defines an ancestor class to hide from the admin interface.
     *
     * @var string
     * @config
     */
    private static $hide_ancestor = BarItem::class;
    
    /**
     * Maps field names to field types for this object.
     *
     * @var array
     * @config
     */
    private static $db = [
        'ShowSubMenus' => 'Boolean'
    ];
    
    /**
     * Defines the default values for the fields of this object.
     *
     * @var array
     * @config
     */
    private static $defaults = [
        'ShowSubMenus' => 1
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
        
        // Create Options Fields:
        
        $fields->addFieldsToTab(
            'Root.Options',
            [
                FieldSection::create(
                    'NavigationOptions',
                    $this->fieldLabel('NavigationOptions'),
                    [
                        CheckboxField::create(
                            'ShowSubMenus',
                            $this->fieldLabel('ShowSubMenus')
                        )
                    ]
                )
            ]
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
        
        $labels['ShowSubMenus'] = _t(__CLASS__ . '.SHOWSUBMENUS', 'Show sub-menus');
        $labels['NavigationOptions'] = _t(__CLASS__ . '.NAVIGATION', 'Navigation');
        
        // Answer Field Labels:
        
        return $labels;
    }
    
    /**
     * Answers an array of class names for the HTML template.
     *
     * @return array
     */
    public function getClassNames()
    {
        // Obtain Class Names:
        
        $classes = $this->styles('navbar.nav');
        
        // Answer Class Names:
        
        return array_merge(
            parent::getClassNames(),
            $classes
        );
    }
    
    /**
     * Answers the template data for the current list item.
     *
     * @param string $mode Linking mode of the current item.
     * @param string $segment URL segment of the current item.
     * @param boolean $children If true, current item has children.
     *
     * @return ArrayData
     */
    public function getListItemData($mode, $segment, $children = false)
    {
        // Define Data Array:
        
        $data = ['Dropdown' => false];
        
        // Define Initial Styles:
        
        $itemStyles = ['navbar.nav-item'];
        $linkStyles = ['navbar.nav-link'];
        $menuStyles = ['navbar.dropdown-menu'];
        
        // Is Link Active?
        
        if ($this->isActive($mode)) {
            $linkStyles[] = 'navbar.active';
        }
        
        // Are Sub-Menus Shown?
        
        if ($children && $this->ShowSubMenus) {
            
            // Add Dropdown Styles:
            
            $itemStyles[] = 'navbar.dropdown';
            $linkStyles[] = 'navbar.dropdown-toggle';
            
            // Add Dropdown Data:
            
            $data['Dropdown']   = true;
            $data['DropdownID'] = $this->getDropdownID($segment);
        }
        
        // Define Style Classes:
        
        $data['ItemClass'] = $this->styles($itemStyles, true);
        $data['LinkClass'] = $this->styles($linkStyles, true);
        $data['MenuClass'] = $this->styles($menuStyles, true);
        
        // Answer Data:
        
        return ArrayData::create($data);
    }
    
    /**
     * Answers an array of class names for a menu link.
     *
     * @param string $mode Linking mode of the current item.
     *
     * @return array
     */
    public function getMenuLinkClass($mode)
    {
        $styles = ['navbar.dropdown-item'];
        
        if ($this->isActive($mode)) {
            $styles[] = 'navbar.active';
        }
        
        return $this->styles($styles, true);
    }
    
    /**
     * Answers the menu list with the specified level from the current controller.
     *
     * @param integer $level
     *
     * @return ArrayList
     */
    public function getMenu($level = 1)
    {
        if ($controller = $this->getCurrentController(PageController::class)) {
            return $controller->getMenu($level);
        }
    }
    
    /**
     * Answers true if the given mode is considered to be active.
     *
     * @param string $mode Linking mode of the current item.
     *
     * @return boolean
     */
    protected function isActive($mode)
    {
        return in_array($mode, ['current', 'section']);
    }
    
    /**
     * Answers a dropdown ID for the given URL segment.
     *
     * @param string $segment URL segment of the current item.
     *
     * @return string
     */
    protected function getDropdownID($segment)
    {
        return sprintf('dropdown-%s', $segment);
    }
}
