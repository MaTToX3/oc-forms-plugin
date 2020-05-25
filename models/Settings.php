<?php

namespace Novelus\Forms\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'novelus_forms_settings';
    public $settingsFields = 'fields.yaml';
}
