<?php namespace Novelus\Forms\Models;

use Model;

/**
 * Model
 */
class Form extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    public $jsonable = ['send_notification_to'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'novelus_forms_forms';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    // region Relations

    public $hasMany = [
        'fields' => [ Field::class ]
    ];

    // endregion
}
