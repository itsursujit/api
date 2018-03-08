<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * File 2018_03_08_create_api_keys_table.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    ${NAMESPACE}
 * @subpackage 2018_03_08_create_api_keys_table.php
 * @author     Sujit Baniya <sujit@kvsocial.com>
 * @copyright  2018 Instasuite.com. All rights reserved.
 */
class CreateApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->increments('id');
            $table->nullableMorphs('apikeyable');
            $table->string('key', 50);
            $table->string('last_ip_address', 50)->nullable();
            $table->dateTime('last_used_at')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->index('key');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_keys');
    }
}