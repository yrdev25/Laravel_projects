<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name_1');
            $table->string('middle_name_1');
            $table->string('last_name_1');
            $table->string('first_name_2');
            $table->string('middle_name_2');
            $table->string('last_name_2');
            $table->string('line_1');
            $table->string('line_2');
            $table->string('landmark');
            $table->foreignId('country_id')->constrained('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('state_id')->constrained('states')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('pincode');
            $table->string('mobile_1');
            $table->string('mobile_2');
            $table->string('res_no');
            $table->string('office_no');
            $table->string('email');
            $table->date('dob')->nullable();
            $table->date('marriage_anniversary')->nullable();
            $table->text('like');
            $table->text('dislike');
            $table->enum('is_verified', ['0', '1'])->default('0');
            $table->text('remarks');
            $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
}
