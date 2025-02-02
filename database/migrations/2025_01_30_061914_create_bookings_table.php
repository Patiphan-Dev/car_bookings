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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('รหัสผู้ใช้');
            $table->unsignedBigInteger('car_id')->comment('รหัสรถยนต์');
        
            // สร้าง Foreign Key Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            
            // รายละเอียดการจอง
            $table->string('usage_type')->comment('ประเภทการใช้งาน');
            $table->string('purpose')->comment('เพื่อ');
            $table->string('subject')->comment('เรื่อง');
            $table->string('location')->comment('สถานที่');
        
            // วันที่และเวลา
            $table->date('start_date')->comment('วันที่เริ่มต้นการจอง');
            $table->date('end_date')->comment('วันที่สิ้นสุดการจอง');
            $table->integer('count_days')->comment('จำนวนวัน');
            $table->time('start_time')->comment('เวลาเริ่มต้นการจอง');
            $table->time('end_time')->comment('เวลาสิ้นสุดการจอง');
            $table->integer('count_hours')->comment('จำนวนชั่วโมง');
            $table->integer('count_minutes')->comment('จำนวนนาที');
        
            // รายละเอียดอื่น ๆ
            $table->integer('count_people')->comment('จำนวนคน');
            $table->text('note')->nullable()->comment('หมายเหตุ');
        
            // สถานะการจอง
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->comment('สถานะการจอง');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
