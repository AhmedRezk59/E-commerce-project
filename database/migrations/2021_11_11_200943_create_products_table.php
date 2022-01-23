<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('photo');
            $table->longText('content');
            $table->foreignId('department_id')->nullable()->constrained('departments')->cascadeOnDelete();
            $table->foreignId('trademark_id')->nullable()->constrained('trademarks')->cascadeOnDelete();
            $table->foreignId('color_id')->nullable()->constrained('colors')->cascadeOnDelete();
            $table->string('size')->nullable();
            $table->foreignId('size_id')->nullable()->constrained('sizes')->cascadeOnDelete();
            $table->decimal('price' , 7 , 2);
            $table->date('start_at')->nullable();
            $table->decimal('price_offer' , 7 , 2)->nullable();
            $table->date('start_offer_at')->nullable();
            $table->date('end_offer_at')->nullable();
            $table->string('weight');
            $table->foreignId('weight_id')->constrained('weights')->cascadeOnDelete();
            $table->integer('stock')->default(0);
            $table->longText('other_data')->nullable();
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
        Schema::dropIfExists('products');
    }
}
