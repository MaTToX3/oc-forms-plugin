<?php namespace Novelus\Forms\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateNovelusFormsForms extends Migration
{
    public function up()
    {
        Schema::create('novelus_forms_forms', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('novelus_forms_forms');
    }
}
