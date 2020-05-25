<?php namespace Novelus\Forms\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNovelusFormsFields3 extends Migration
{
    public function up()
    {
        Schema::table('novelus_forms_fields', function($table)
        {
            $table->integer('order')->nullable();
            $table->boolean('is_required')->nullable()->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('novelus_forms_fields', function($table)
        {
            $table->dropColumn('order');
            $table->dropColumn('is_required');
        });
    }
}
