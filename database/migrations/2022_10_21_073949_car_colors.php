<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CarColors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        $colors = ['Белый','Черный','Серебристый','Темно-серый','Красный','Синий','Коричневый','Желтый'];
        foreach($colors as $color){
            $c = new \App\CarColor();
            $c->name = $color;
            $c->save();
        }
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_colors');
    }
}
