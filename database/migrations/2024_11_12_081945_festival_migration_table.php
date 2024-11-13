<?php

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
        Schema::create('Artist', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->integer('showId')->change();
            $table->foreignId('showId')->constrained('Show')->onDelete('cascade');;
            $table->timestamps();
        });

        Schema::create('Command', function (Blueprint $table){
            $table->id();
            $table->string('clientMail')->change();
            $table->dateTime('dateCommande');
            $table->integer('etat');
            $table->integer('montantTotal')->change();
            $table->foreignId('clientMail')->constrained('User')->onDelete('cascade');;
            $table->timestamps();
        });
        Schema::create('Evening', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('date');
            $table->integer('price')->change();
            $table->integer('reducedPrice')->change();
            $table->integer('spotId')->change();	
            $table->string('thematic');
            $table->foreignId('spotId')->constrained('Spot')->onDelete('cascade');;
            $table->timestamps();
        });
        Schema::create('Show', function (Blueprint $table){
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->date('time')->change();
            $table->string('video')->change();
            $table->integer('eveningId')->change();
            $table->foreignId('eveningId')->constrained('Evening')->onDelete('cascade');;
            $table->timestamps();
        });
        Schema::create('Show_Image', function (Blueprint $table){
            $table->id();
            $table->string('path');
            $table->integer('showId')->change();
            $table->foreignId('showId')->constrained('Show')->onDelete('cascade');;
            $table->timestamps();
        });
        Schema::create('Spot', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('address')->change();
            $table->integer('nbStanding')->change();
            $table->integer('nbSitting')->change();
            $table->timestamps();
        });
        Schema::create('SpotImage', function (Blueprint $table){
            $table->id();
            $table->string('path');
            $table->integer('spotId')->change();
            $table->foreignId('spotId')->constrained('Spot')->onDelete('cascade');;
            $table->timestamps();
        });
        Schema::create('Ticket', function (Blueprint $table){
            $table->id();
            $table->date('date');
            $table->string('barcode');
            $table->string('clientMail')->change();
            $table->integer('eveningId')->change();
            $table->integer('price')->change();
            $table->string('idCommand')->change();
            $table->foreignId('clientMail')->constrained('User')->onDelete('cascade');;
            $table->foreignId('eveningId')->constrained('Evening')->onDelete('cascade');;
            $table->timestamps();
        });
        Schema::create('User', function (Blueprint $table){
            $table->id();
            $table->string('clientMail');
            $table->string('password');
            $table->string('lastName');
            $table->string('firstName');
            $table->integer('active');
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Artist');
        Schema::dropIfExists('Command');
        Schema::dropIfExists('Evening');
        Schema::dropIfExists('Show');
        Schema::dropIfExists('Show_Image');
        Schema::dropIfExists('Spot');
        Schema::dropIfExists('SpotImage');
        Schema::dropIfExists('Ticket');
        Schema::dropIfExists('User');
    }
};
