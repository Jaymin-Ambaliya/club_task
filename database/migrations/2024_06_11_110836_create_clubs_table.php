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
        Schema::create('clubs', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->unsignedInteger('group_id');
            $table->string('business_name',150);
            $table->string('club_number',30);
            $table->string('club_name',200);
            $table->string('club_state',50);
            $table->text('club_description');
            $table->string('club_slug',200);
            $table->string('website_title',255);
            $table->string('website_link',100);
            $table->string('club_logo',65);
            $table->string('club_banner',65);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubs');
    }
};
