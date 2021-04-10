<?php

namespace Tests\Unit\Models;

use App\Models\VacancyLevel;
use PHPUnit\Framework\TestCase;

class VacancyLevelTest extends TestCase
{
    /**
     * @param integer $remainingCount
     * @param string $expectMark
     * @dataProvider dataTestMark
     */
    public function testMark(int $remainingCount, string $expectMark)
    {
        $level = new VacancyLevel($remainingCount);
        $this->assertSame($expectMark, $level->mark());
    }

    public function dataTestMark()
    {
        return [
            '空きなし' => [
                'remainingCount' => 0,
                'expectMark' => '×'
            ],
            '残りわずか' => [
                'remainingCount' => 4,
                'expectMark' => '△'
            ],
            '空き十分' => [
                'remainingCount' => 5,
                'expectMark' => '◎'
            ]
        ];
    }

    /**
     * @param integer $remainingCount
     * @param string $expectSlug
     * @dataProvider dataTestSlug
     */
    public function testSlug(int $remainingCount, string $expectSlug)
    {
        $level = new VacancyLevel($remainingCount);
        $this->assertSame($expectSlug, $level->slug());
    }

    public function dataTestSlug()
    {
        return [
            '空きなし' => [
                'remainingCount' => 0,
                'expectSlug' => 'empty'
            ],
            '残りわずか' => [
                'remainingCount' => 4,
                'expectSlug' => 'few'
            ],
            '空き十分' => [
                'remainingCount' => 5,
                'expectSlug' => 'enough'
            ]
        ];
    }
}
