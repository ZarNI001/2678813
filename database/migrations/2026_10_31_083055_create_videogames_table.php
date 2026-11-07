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
        Schema::create('videogames', function (Blueprint $table) {
            $table->integer('game_id')->primary();
            $table->string('game_name', 255);
            $table->text('game_description');
            $table->date('released_date');
            $table->decimal('rating', 10, 0);
            $table->timestamps(); // (လိုချင်ရင် ထားနိုင်သည်၊ မလိုလျှင် ဖျက်နိုင်သည်)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videogames');
    }
};
