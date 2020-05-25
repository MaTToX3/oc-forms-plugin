<?php namespace Novelus\Forms\Models;

use Model;

/**
 * Model
 */
class Field extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    public $jsonable = ['select_data'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'novelus_forms_fields';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    // region Relations

    public $belongsTo = [
        'form' => [Form::class]
    ];

    // endregion
}
