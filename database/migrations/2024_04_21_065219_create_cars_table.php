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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\type_car::class)->constrained();
            $table->foreignIdFor(App\Models\services::class)->constrained();
            $table->string('code',9)->index();
            $table->string('name',25);
            $table->decimal('seats_price',10,2);
            $table->integer('seats_quantity')->unsigned();
            $table->tinyInteger('status')->default(1)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
