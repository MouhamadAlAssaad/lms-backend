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
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('phone');
        $table->string('picture')->nullable();
        $table->unsignedBigInteger('course_id');
        $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        $table->timestamps();
    });

    // Hash the password before saving it to the database
    DB::table('students')->update([
        'password' => Hash::make('password'),
    ]);
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
