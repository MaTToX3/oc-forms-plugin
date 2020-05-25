<?php namespace Novelus\Forms;

use Novelus\Forms\Components\Form as FormComponent;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            FormComponent::class => 'form'
        ];
    }

    public function registerPageSnippets()
    {
        return [
            FormComponent::class => 'form'
        ];
    }

    public function registerSettings()
    {
        return [
            'config' => [
                'label' => 'Novelus.Forms settings',
                'description' => 'Manage settings',
                'category' => SettingsManager::CATEGORY_CMS,
                'icon' => 'icon-bolt',
                'class' => 'Novelus\Forms\Models\Settings',
                'order' => 500
            ]
        ];
    }
}
