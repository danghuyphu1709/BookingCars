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
        Schema::create('road_routes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\area::class)->constrained();
            $table->foreignIdFor(App\Models\area::class)->constrained();
            $table->foreignIdFor(App\Models\cars::class)->constrained();
            $table->string('kilometer',25);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('road_routes');
    }
};
