<?php

class StatsTest extends TestCase
{
    /**
     * Test for /stats endPoint
     *
     * @return void
     */
    public function test_tooSmallDnaArray()
    {
        $this->get('/stats');
        $this->assertResponseStatus(200);
    }
}
