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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid();

            $table->foreignId('authenticatable_id');
            $table->string('authenticatable_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_names')->nullable();
            $table->string('mobile_number')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('last_login')->nullable();

            $table->boolean('is_active')->default(true);
            $table->foreignId('added_by_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        // create user(Admin) for testing
        App\Models\User::create([
            'authenticatable_id' => 1,
            'authenticatable_type' => 'App\Models\Administrator',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'mobile_number' => '0542092800',
            'email' => 'kofibusy@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
        ]);
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
};
