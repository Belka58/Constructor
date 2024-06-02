<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_programs', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('publish');
            $table->text('content');
            $table->foreignId('user_id')->constrained();
            $table->unsignedTinyInteger('type');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_programs');
    }
};
