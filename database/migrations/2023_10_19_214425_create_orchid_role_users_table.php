<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

		$tableNames = config('permission.table_names');
		Schema::create('role_users', function (Blueprint $table) use ($tableNames)  {
			$table->unsignedBigInteger('role_id');
			$table->unsignedBigInteger('user_id');
			$table->primary(['role_id', 'user_id']);

			$table->foreign('role_id')
				  ->references('id')
				  ->on($tableNames['roles'])
				  ->onDelete('cascade')
				  ->onUpdate('cascade');

			$table->foreign('user_id')
				  ->references('id')
				  ->on('users')
				  ->onDelete('cascade')
				  ->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists(config('permission.table_names.role_has_users'));
	}
};
