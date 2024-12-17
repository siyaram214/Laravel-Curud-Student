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
        Schema::create('student_informatios', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('rollNumber')->nullable();
        $table->string('batchNo')->nullable();
        $table->string('age')->nullable();
        $table->enum('gender',['male','female']);
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('address')->nullable();
        $table->string('fatherName')->nullable();
        $table->string('motherName')->nullable();
        $table->date('date')->nullable();
        $table->date('admissionDate')->nullable();
        $table->string('class')->nullable();
        $table->string('section')->nullable();
        $table->string('collegeName')->nullable();
        $table->string('department')->nullable();
        $table->string('guardiaName')->nullable();
        $table->string('guardianContact')->nullable();
        $table->text('attachment')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_informatios');
    }
};
