<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Credential::class);
            $table->boolean('status')->nullable();
            $table->integer('amount');
            $table->string('description');
            $table->string('destination_firstname');
            $table->string('destination_lastname');
            $table->string('destination_number');
            $table->string('payment_number',30)->nullable();
            $table->string('reason_description')->nullable();
            $table->string('deposit')->nullable();
            $table->string('source_firstname')->nullable();
            $table->string('source_lastname')->nullable();
            $table->string('second_password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
};
