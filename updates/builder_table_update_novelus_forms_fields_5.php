<?php namespace Novelus\Forms\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNovelusFormsFields5 extends Migration
{
    public function up()
    {
        Schema::table('novelus_forms_fields', function($table)
        {
            $table->text('select_data')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('novelus_forms_fields', function($table)
        {
            $table->string('select_data', 191)->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
