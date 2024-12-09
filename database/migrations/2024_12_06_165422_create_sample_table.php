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
        Schema::create('sample', function (Blueprint $table) {
             //Primary Key
             $table->id();

             //Base Fields
             $table->string('name');
             $table->string('email')->unique();    //Unique
             $table->integer('age')->nullable();
             $table->text(column: 'description');

             //Boolean Field
             $table->boolean('is_active')->default(true);

             //Date and Time Fields
             $table->date('dob')->nullable();
             $table->timestamps();

             //Enum Fields
             $table->enum('gender',['male','female','other']);
             $table->set('role',['admin','user','guest'])->default('user');
             $table->enum('status',['active','inactive','suspended'])->default('active'); #radio buttons

             $table->string('profile_picture',500)->nullable();
             $table->json('preferences')->nullable(); #for checkbox
             $table->foreignId('user_id')->default(1)->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample');
    }
};
