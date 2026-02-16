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
        Schema::create('medicines', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // Dorining savdo nomi
    $table->string('generic_name')->nullable(); // Tarkibi (masalan: Paratsetamol) - bu qidiruv uchun juda kerak
    $table->text('description')->nullable(); // Batafsil ma'lumot
    
    // Kategoriyaga bog'lash (Foreign Key)
    $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
    
    $table->string('barcode')->unique()->nullable()->index(); // Index qidiruvni tezlashtiradi
    
    $table->decimal('buy_price', 15, 2);  // Kelish narxi
    $table->decimal('sell_price', 15, 2); // Sotilish narxi
    
    $table->integer('quantity')->default(0); // Ombor dagi soni
    $table->integer('min_stock')->default(10); // Shu sondan kam qolsa, tizim ogohlantiradi
    
    $table->date('expiry_date')->index(); // Muddati o'tayotganlarni tezroq topish uchun index
    
    $table->string('image')->nullable(); // Dori rasmi (professional panelda rasm bo'lgani yaxshi)
    $table->boolean('is_active')->default(true); // Sotuvda bormi yoki yo'q
    $table->softDeletes();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
