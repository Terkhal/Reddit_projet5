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

        Schema::table('posts', function (Blueprint $table) {
            // $table->renameColumn('emp_name', 'employee_name'); // Renaming "emp_name" to "employee_name"
            // $table->string('gender', 10)->change(); // Change Datatype length
            // $table->dropColumn('active'); // Remove "active" field
            // $table->boolean('admin')->after('updated_at'); // Add "status" column
            $table->string('image_path')->nullable();
            $table->boolean('is_archived')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
