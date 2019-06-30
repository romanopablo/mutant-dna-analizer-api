<?php

namespace App;

class DnaAnalyzer
{
    const SQ_NEEDED_TO_MUTANT = 2; //How many sequences are needed to be mutant.
    const SQ_MUTANT_LENGHT = 4; //How many equal chars are needed to consider a sequence. 
    private $dnaChains; //Multilevel array representing the dna.
    private $dnaChainLength; //How many chars a chain have.
    private $foundSquences = 0; //Sequences found counter.

    public function __construct(array $dna)
    {
        $this->dnaChains = array_map(
            function ($element) {
                return str_split($element);
            },
            $dna
        );

        $this->dnaChainLength = count($dna);
    }

    public function isMutant(): Bool
    {   echo("\n". "Arranco a analizar: " . "\n");
        switch (true) {
            case ($this->readHorizontalChains()):
                return true;
                break;
            case ($this->readVerticalChains()):
                return true;
                break;
            case ($this->readDiagonalChains()):
                return true;
                break;
            case($this->readDiagonalChains(true)):
                return true;
                break;
            default:
                echo ("No encontre----------");
                return false;
                break;
        }
    }

    private function readHorizontalChains(): Bool
    {   
        foreach ( $this->dnaChains as $chain) {
            $this->searchSequenceInChain($chain);
            if ($this->foundSquences >= $this::SQ_NEEDED_TO_MUTANT)
                return true;
        }
        return false;
    }

    private function readVerticalChains(): Bool
    {
        $dnaChainsTransposed = array_map(null, ...$this->dnaChains); //Transposing the matrix
        foreach ($dnaChainsTransposed as $chain) {
            $this->searchSequenceInChain($chain);
            if ($this->foundSquences >= $this::SQ_NEEDED_TO_MUTANT)
                return true;
        }
        return false;
    }

    private function readDiagonalChains( $inverse = false ):Bool
    {   
        for ($k = 0; $k <= 2 * ( $this->dnaChainLength - 1); $k++) {
            $temp = array();
            for ($y = $this->dnaChainLength - 1; $y >= 0; $y--) {
                $x = $k - ($inverse ? $this->dnaChainLength - $y : $y);
                if ($x >= 0 && $x < $this->dnaChainLength) {
                    array_push( $temp, $this->dnaChains[$y][$x]);
                }
            }
            
            if (count( $temp ) >= $this::SQ_MUTANT_LENGHT) {
                $this->searchSequenceInChain($temp);
                if ($this->foundSquences >= $this::SQ_NEEDED_TO_MUTANT)
                    return true;
            } else {
                echo (implode($temp) . "\n");
            };
        }
        
        return false;
    }

    /**
     * Search if the chain have a valid sequence
     *
     * @param [Array] $chain
     */
    private function searchSequenceInChain(Array $chain){
        echo (implode($chain) . "\n");
        if ( preg_match('/(AAAA|CCCC|GGGG|TTTT)/i', implode( $chain) )){ //preg_match stop searching if the patter is found
            $this->foundSquences++;
            echo ("Match found: " .implode($chain) ."\n");
        }
    }
}
