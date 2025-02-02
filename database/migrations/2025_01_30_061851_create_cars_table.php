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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            // ข้อมูลรถยนต์
            $table->string('name')->comment('ชื่อรถ');
            $table->string('license_plate')->unique()->comment('ทะเบียนรถ');
            $table->string('brand')->comment('ยี่ห้อรถ');
            $table->string('model')->comment('รุ่นรถ');
            $table->integer('seat_count')->comment('จำนวนที่นั่ง');
            $table->string('vin')->comment('เลขตัวถัง (Vehicle Identification Number)');
        
            // วันหมดอายุ
            $table->date('warranty_expiration_date')->comment('วันหมดอายุประกัน');
            $table->date('tax_act_expiration_date')->comment('วันหมดอายุภาษี/พรบ.');
        
            // สถานะรถ
            $table->enum('status', ['available', 'in_use', 'maintenance'])->default('available')->comment('สถานะรถ');
        
            // หมายเหตุเพิ่มเติม
            $table->text('note')->nullable()->comment('หมายเหตุ');
        
            // รูปภาพรถ
            $table->json('images')->nullable()->comment('รายการรูปภาพของรถ');
        
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
