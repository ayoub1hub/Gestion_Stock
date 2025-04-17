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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('CodeArticle', 100); //varchar title
            $table->string('NomArticle', 100); 
            $table->float('puht', 8, 2); // Le deuxième argument est la précision (nombre total de chiffres) et le troisième est l'échelle (nombre de chiffres après la virgule)
            $table->integer('quantite');
            $table->timestamps();// equals to created_at & updated_at
        }); // this code means that the framework will create a table named 'posts' with the following columns ; id , title , desciption and timestamps .
    } // when we migrate migration files with 'php artisan migrate' , this file doesn't make a sense even if we remove the function for example , nothing will chage
      // to add a column in posts table we use the command 'php make:migration name_file' then modify the up function
    
      /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
