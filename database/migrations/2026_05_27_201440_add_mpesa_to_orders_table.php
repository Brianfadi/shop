<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMpesaToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Modify payment_method enum to include mpesa
        \DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('cod','paypal','mpesa') DEFAULT 'cod'");

        Schema::table('orders', function (Blueprint $table) {
            $table->string('mpesa_transaction_id')->nullable()->after('payment_status');
            $table->string('mpesa_phone')->nullable()->after('mpesa_transaction_id');
            $table->string('mpesa_checkout_request_id')->nullable()->after('mpesa_phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('cod','paypal') DEFAULT 'cod'");

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['mpesa_transaction_id', 'mpesa_phone', 'mpesa_checkout_request_id']);
        });
    }
}
