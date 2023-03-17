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
    Schema::create('attendances', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->unsignedBigInteger('student_id');
        $table->string('case');
        $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        $table->unsignedBigInteger('section_id');
        $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        $table->unique(['date', 'student_id', 'section_id','case']);
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
