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
       Schema::create('sales', function (Blueprint $table) {
    $table->id();
    
    // Sotuvni amalga oshirgan xodim (Sotuvchi)
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    
  
    // Sotuv raqami (Invoys raqami - masalan: INV-20240001)
    $table->string('invoice_number')->unique();

    // Moliyaviy ma'lumotlar
    $table->decimal('sub_total', 15, 2); // Dorilarning jami narxi (chegirmasiz)
    $table->decimal('discount', 15, 2)->default(0); // Chegirma summasi
    $table->decimal('total_amount', 15, 2); // To'lanishi kerak bo'lgan jami summa

    // To'lov turi
    $table->enum('payment_method', ['cash', 'card', 'transfer'])->default('cash');

    // To'lov holati (agar nasiyaga sotish bo'lsa kerak bo'ladi)
    $table->enum('status', ['paid', 'pending', 'cancelled'])->default('paid');

    $table->text('note')->nullable(); // Qo'shimcha izohlar
    
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
