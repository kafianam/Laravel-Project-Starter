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
        Schema::create('visa_processing_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services');
            $table->string('name')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('nationality')->nullable();
            $table->string('travel_from')->nullable();
            $table->string('travel_type')->nullable();
            $table->date('expected_travel_date')->nullable();
            $table->string('primary_contact')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('email')->nullable();
            $table->string('passport_copy')->nullable();
            $table->string('ticket_copy')->nullable();
            $table->string('hotel_booking')->nullable();
            $table->string('other_doc')->nullable();
            $table->json('advance_purchase')->nullable(); // to store checkbox array
            $table->timestamp('application_submit_date')->useCurrent();
            $table->enum('application_status', ['Pending', 'Processing', 'On Hold', 'Approved', 'Cancel', 'Reject']);
            $table->enum('payment_status', ['Paid', 'Unpaid']);
            $table->enum('payment_method', ['Cash', 'Bkash', 'Rocket', 'Nagod', 'Cheque', 'Online Bank Transfer']);
            $table->date('payment_date');
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
        Schema::dropIfExists('visa_processing_forms');
    }
};
