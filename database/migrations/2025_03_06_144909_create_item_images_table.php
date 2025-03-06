<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('item_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->unique()->constrained('items')->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('item_images');
    }
};
