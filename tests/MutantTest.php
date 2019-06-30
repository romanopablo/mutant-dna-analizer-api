<?php

class MutantTest extends TestCase
{
    /**
     * Test for Mutant DNA containin sequences on vertical and horizontal chains.
     *
     * @return void
     */
    public function test_mutantDnaOnVerticalAndHorizontal()
    {
        $this->post('/mutants', ['dna' => ["ATGCGA", "CAGTGC", "TTATGT", "AGAAGG", "CCCCTA", "TCACTG"]]);
        $this->assertResponseStatus(200);
    }

    /**
     * A for human (non-mutant) DNA.
     *
     * @return void
     */
    public function test_humanDna()
    {
        $this->post('/mutants', ['dna' => ["ATGCGA", "CAGTGC", "TTATTT", "AGACGG", "GCGTCA", "TCACTG"]]);
        $this->assertResponseStatus(403);
    }

    /**
     * Test for Mutant DNA on diagonal chains.
     *
     * @return void
     */
    public function test_mutantDnaOnDiagonal()
    {
        $this->post('/mutants', ['dna' => ["CTATGT", "CAAATG", "ACATGT", "CCTAAA", "ACGTAG", "GGATTA"]]);
        $this->assertResponseStatus(200);
    }

    /**
     * Test for Mutant DNA on diagonal chains in a 8x8.
     *
     * @return void
     */
    public function test_mutantDnaOnDiagonal8()
    {
        $this->post('/mutants', ['dna' => ["TCCTATGT", "ATCAAATG", "TGACATGT", "CACCTAAA", "CAACGTAG", "CTGGATTA", "TAACGTCT", "GAACGTCG"]]);
        $this->assertResponseStatus(200);
    }
}
