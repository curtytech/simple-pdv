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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('barcode')->notNull();
            $table->string('name')->index();
            $table->longText('description');
            $table->string('image')->nullable();
            $table->decimal('sell_price', 8, 2); // Melhor precisão para valores monetários
            // $table->unsignedTinyInteger('attempts');
            $table->timestamp('reserved_at')->nullable();
            $table->timestamp('available_at')->nullable(); // Permite 'null'
            $table->timestamps(); // Cria 'created_at' e 'updated_at'
        });

        Schema::create('buys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Deleta as compras associadas quando o usuário for excluído
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Deleta compras associadas quando o produto for excluído
            $table->integer('quantity')->index();
            $table->decimal('buy_price', 8, 2)->index(); // Usar decimal para valores monetários
            // $table->unsignedTinyInteger('attempts');
            $table->timestamp('reserved_at')->nullable();
            $table->timestamp('available_at')->nullable();
            $table->timestamps(); // Cria 'created_at' e 'updated_at'
        });

        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Deleta as vendas associadas quando o usuário for excluído
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Deleta vendas associadas quando o produto for excluído
            $table->integer('quantity')->index();
            $table->decimal('discount', 8, 2)->index(); // Usar decimal para valores monetários
            // $table->unsignedTinyInteger('attempts');
            $table->timestamp('reserved_at')->nullable();
            $table->timestamp('available_at')->nullable();
            $table->timestamps(); // Cria 'created_at' e 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sells');
        Schema::dropIfExists('buys');
        Schema::dropIfExists('products');
    }
};
