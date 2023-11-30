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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('photo_profile');
            $table->string('npm')->unique();
            $table->string('fullname');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('faculty_id')->unsigned();
            $table->bigInteger('departement_id')->unsigned();
            $table->string('gender');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->text('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->string('exam_value');
            $table->string('title');
            $table->date('exam_date');
            $table->string('size_toga');
            $table->string('photo_ijazah');
            $table->string('photo_ktp');
            $table->string('photo_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
