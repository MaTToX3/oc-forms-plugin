<?php namespace Novelus\Forms\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateNovelusFormsFields extends Migration
{
    public function up()
    {
        Schema::create('novelus_forms_fields', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('label');
            $table->string('type');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('novelus_forms_fields');
    }
}
