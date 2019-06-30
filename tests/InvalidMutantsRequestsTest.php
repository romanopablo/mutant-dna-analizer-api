<?php

class InvalidMutantsRequestsTest extends TestCase
{
    /**
     * Test for DNA containing 3 x 3.
     *
     * @return void
     */
    public function test_tooSmallDnaArray()
    {
        $this->post('/mutants', ['dna' => ["ATG", "CAG", "TTA"]]);
        $this->assertResponseStatus(422);
    }

    /**
     * Test for not array dna.
     *
     * @return void
     */
    public function test_tooNotArray()
    {
        $this->post('/mutants', ['dna' => ["ATGCAGTTAAGCT"]]);
        $this->assertResponseStatus(422);
    }

    /**
     * Test for Mutant DNA containing 4 x 3.
     *
     * @return void
     */
    public function test_invalidQntDnaArray()
    {
        $this->post('/mutants', ['dna' => ["ATG", "CAG", "TTA", "TTA"]]);
        $this->assertResponseStatus(422);
    }

    /**
     * Test for Mutant DNA containing invalid chars ("X" in the las two elements).
     *
     * @return void
     */
    public function test_invalidChars()
    {
        $this->post('/mutants', ['dna' => ["ATGTG", "CAGCC", "TTAAT", "TTAGX", "CTAGX"]]);
        $this->assertResponseStatus(422);
    }

}