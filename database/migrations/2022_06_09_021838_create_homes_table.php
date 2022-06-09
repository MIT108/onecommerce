<?php

use App\Models\Home;
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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->string('description');
            $table->string('image');
            $table->string('type');
            $table->timestamps();
        });

        Home::create([
            'heading' => 'default',
            'description' => 'default',
            'image' => 'image1.jpg',
            'type' => 'type1'
        ]);
        Home::create([
            'heading' => 'default',
            'description' => 'default',
            'image' => 'image2.jpg',
            'type' => 'type2'
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homes');
    }
};
