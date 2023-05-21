<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Listing;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Listing::class, 'listing_id')->constrained('listings');
            $table->foreignIdFor(User::class, 'bidder_id')->constrained('users');
            $table->unsignedInteger('amount');
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
};
