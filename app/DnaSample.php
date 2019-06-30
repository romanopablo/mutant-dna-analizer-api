<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DnaSample extends Model
{
    private $dna;
    public $dna_type; 

    public function __construct(Array $dna)
    {
        $this->dna = $dna;
        $this->dna_type = ( (new DnaAnalyzer($this->dna))->isMutant() ? "M" : "H" );
        //$this->save();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['dna'];
}
