<?php

use App\Enum\PooColour;
use App\Enum\PooConsistency;
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
        Schema::create('poo_entries', function (Blueprint $table) {
            $table->id();

            $table->dateTime('occurred_at');

            $table->enum('consistency', PooConsistency::values())
                ->nullable();

            $table->enum('colour', PooColour::values())
                ->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poo_entries');
    }
};
