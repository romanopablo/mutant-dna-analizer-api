<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DnaSample extends Model
{
    protected $fillable = ['dna', 'dna_type'];
    protected $casts = ['dna' => 'array'];

    public function __construct(array $dna)
    {
        $this->dna = $dna;
        $this->dna_type = ((new DnaAnalyzer($this->dna))->isMutant() ? "M" : "H");
        parent::__construct(['dna' => $dna, 'dna_type' => $this->dna_type]); //This is for not override the "Model" class contructor
    }
}
