<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 
	 
	 /* ===open file ===
		app\AppServiceProvider.php   and write this code
		
			use Illuminate\Support\Facades\Schema;
			
		====make new method====
		
		public function boot()
	{
		Schema::defaultStringLength(100);
	}
	
	*/
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('api_token');//stateless application 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
