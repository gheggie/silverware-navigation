<?php

/**
 * An extension of the data extension class which adds navigation settings to pages.
 */
class NavigationPageExtension extends DataExtension
{
    private static $db = array(
        'CrumbsDisabled' => 'Boolean'
    );
    
    private static $defaults = array(
        'CrumbsDisabled' => 0
    );
    
    /**
     * Updates the CMS settings fields of the extended object.
     *
     * @param FieldList $fields
     */
    public function updateSettingsFields(FieldList $fields)
    {
        // Update Field Objects:
        
        $fields->addFieldToTab(
            'Root.Settings',
            $settings = ToggleCompositeField::create(
                'NavigationSettings',
                _t('NavigationPageExtension.NAVIGATION', 'Navigation'),
                array(
                    CheckboxField::create(
                        'CrumbsDisabled',
                        _t('NavigationPageExtension.CRUMBSDISABLED', 'Crumbs disabled')
                    )
                )
            )
        );
        
        // Check Permissions and Modify Fields:
        
        if (!Permission::check('ADMIN') && !Permission::check('SILVERWARE_PAGE_SETTINGS_CHANGE')) {
            
            foreach ($settings->getChildren() as $field) {
                $settings->makeFieldReadonly($field);
            }
            
        }
    }
}
