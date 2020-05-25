<?php namespace Novelus\Forms\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateNovelusFormsForms3 extends Migration
{
    public function up()
    {
        Schema::table('novelus_forms_forms', function($table)
        {
            $table->string('send_notification_to');
        });
    }
    
    public function down()
    {
        Schema::table('novelus_forms_forms', function($table)
        {
            $table->dropColumn('send_notification_to');
        });
    }
}
