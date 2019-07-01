<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DnaSample extends Model
{
    protected $fillable = ['dna', 'dna_type'];
    protected $casts = ['dna' => 'array'];

    public function analize(){
        $this->dna_type = ((new DnaAnalyzer($this->dna))->isMutant() ? "M" : "H");
    }
}
