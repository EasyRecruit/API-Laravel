<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('mobile_number');
            $table->string('other_names')->nullable();
            $table->string('position');
            $table->string('qualification');
            $table->json('skills');

            $table->boolean('is_employed')->default(false);
            $table->foreignId('company_id')->nullable();

            $table->boolean('is_active')->default(true);
            $table->foreignId('added_by_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
};
