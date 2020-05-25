<?php namespace Novelus\Forms\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNovelusFormsFields extends Migration
{
    public function up()
    {
        Schema::table('novelus_forms_fields', function($table)
        {
            $table->integer('form_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('novelus_forms_fields', function($table)
        {
            $table->dropColumn('form_id');
        });
    }
}
