<?php namespace Novelus\Forms\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNovelusFormsForms extends Migration
{
    public function up()
    {
        Schema::table('novelus_forms_forms', function($table)
        {
            $table->boolean('has_recaptcha');
        });
    }
    
    public function down()
    {
        Schema::table('novelus_forms_forms', function($table)
        {
            $table->dropColumn('has_recaptcha');
        });
    }
}
