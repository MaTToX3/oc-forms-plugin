<?php namespace Novelus\Forms\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNovelusFormsForms2 extends Migration
{
    public function up()
    {
        Schema::table('novelus_forms_forms', function($table)
        {
            $table->boolean('has_email_notifications_enabled')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('novelus_forms_forms', function($table)
        {
            $table->dropColumn('has_email_notifications_enabled');
        });
    }
}
