<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->increments('id');
            /* slides */
            $table->text('icon');
            $table->text('slide1');
            $table->text('slide2');
            $table->text('slide3');
            $table->text('slide4');
            /* social */
            $table->string('facebook');
            $table->string('twitter');
            $table->string('google');
            $table->string('youtube');
            $table->string('instgram');
            $table->string('skype');
            $table->string('whatsapp');
            $table->string('address');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            /* about us */
            $table->text('aboutimg');
            $table->longText('largedescription');
            $table->string('aboutteam');
            $table->date('articletime');
            /* team */
            $table->text('teammember1picture');
            $table->string('teammember1name');
            $table->string('teammember1postion');
            $table->string('teammember1article');
            $table->string('teammember1facebook');
            $table->string('teammember1twitter');
            $table->string('teammember1google');
            /**/
            $table->text('teammember2picture');
            $table->string('teammember2name');
            $table->string('teammember2postion');
            $table->string('teammember2article');
            $table->string('teammember2facebook');
            $table->string('teammember2twitter');
            $table->string('teammember2google');
            /**/
            $table->text('teammember3picture');
            $table->string('teammember3name');
            $table->string('teammember3postion');
            $table->string('teammember3article');
            $table->string('teammember3facebook');
            $table->string('teammember3twitter');
            $table->string('teammember3google');
            /**/
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
        Schema::dropIfExists('site_settings');
    }
}
