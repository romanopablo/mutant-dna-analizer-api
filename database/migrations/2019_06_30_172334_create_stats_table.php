<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->bigInteger('count_mutant_dna')->default(0);
            $table->bigInteger('count_human_dna')->default(0);
            $table->float('ratio', 8, 2)->default(0);
        });

        DB::unprepared(
            'CREATE TRIGGER tr_update_count_stats
                AFTER INSERT ON `dna_samples` FOR EACH ROW BEGIN
                    IF NEW.dna_type = "M" THEN
                        UPDATE stats set count_mutant_dna = count_mutant_dna + 1;
                    END IF;
                    IF NEW.dna_type = "H" THEN
                        UPDATE stats set count_human_dna = count_human_dna + 1;
                    END IF;
                    
                    UPDATE stats set ratio = count_mutant_dna / (count_mutant_dna + count_human_dna);
            END'
        );

        DB::unprepared('INSERT INTO `stats` (`count_mutant_dna`, `count_human_dna`, `ratio`) VALUES(0, 0, 0); ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        DB::unprepared( 'DROP TRIGGER `tr_update_count_stats`');
        Schema::dropIfExists('stats');
    }
}
