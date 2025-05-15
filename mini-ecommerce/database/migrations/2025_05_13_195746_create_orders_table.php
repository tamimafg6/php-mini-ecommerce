<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
    public function up(){
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('email');
            $table->text('address');
            $table->string('payment_type');
            $table->decimal('total_amount',10,2);
            $table->timestamps();
        });
    }
    public function down(){ Schema::dropIfExists('orders'); }
}