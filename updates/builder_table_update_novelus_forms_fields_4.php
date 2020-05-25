<?php namespace Novelus\Forms\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNovelusFormsFields4 extends Migration
{
    public function up()
    {
        Schema::table('novelus_forms_fields', function($table)
        {
            $table->string('select_data');
        });
    }
    
    public function down()
    {
        Schema::table('novelus_forms_fields', function($table)
        {
            $table->dropColumn('select_data');
        });
    }
}
