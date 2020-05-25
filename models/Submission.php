<?php namespace Novelus\Forms\Models;

use Model;

/**
 * Model
 */
class Submission extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'novelus_forms_submissions';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public function getValueAttribute($value)
    {
        return (array) json_decode($value);
    }
}
