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
        Schema::create('ticket_booked', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\tickets::class)->constrained();
            $table->foreignIdFor(App\Models\customers::class)->constrained();
            $table->foreignIdFor(App\Models\payment::class)->constrained();
            $table->string('code',9)->index();
            $table->decimal('seats_price',10,2);
            $table->decimal('ticket_quantity',10,2);
            $table->tinyInteger('status')->default(0)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_booked');
    }
};
