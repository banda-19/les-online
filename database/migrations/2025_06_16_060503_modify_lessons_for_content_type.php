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
    Schema::table('lessons', function (Blueprint $table) {
        // Hapus kolom lama
        $table->dropColumn('video_url');
        $table->dropColumn('description');

        // Tambahkan kolom baru setelah 'slug'
        $table->string('type')->default('video')->after('slug'); // Tipe konten: 'video' atau 'artikel'
        $table->text('content')->after('type'); // Isi konten: bisa URL video atau teks artikel
    });
}

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('lessons', function (Blueprint $table) {
        $table->string('video_url');
        $table->text('description')->nullable();
        $table->dropColumn('type');
        $table->dropColumn('content');
    });
}
};
