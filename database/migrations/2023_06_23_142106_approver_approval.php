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
        Schema::create('approver_approvals', function (Blueprint $table) {
            $table->id();
            $table->string('approval_id');
            $table->string('level_approval');
            $table->string('approver');
            $table->string('comment');
            $table->string('status')->default('belum');
            $table->rememberToken();
            $table->timestamps();
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
