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
            Schema::create('produk', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->unsignedBigInteger('category_id');
                $table->unsignedBigInteger('price_buy');
                $table->unsignedBigInteger('price_sell');
                $table->unsignedInteger('stok');
                $table->string('image');
                $table->timestamps();
                $table->foreign('category_id') // Membuat relasi foreign key
                    ->references('id')->on('category')
                    ->onDelete('cascade'); // Jika kategori dihapus, produk yang terkait ikut dihapus
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('produk');
        }
    };
