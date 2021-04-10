<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Lesson;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @param string $plan
     * @param integer $remainingCount
     * @param integer $reserationCount
     * @param boolean $canReserve
     * @dataProvider dataCanReserve
     */
    public function testCanReserve(
        string $plan,
        int $remainingCount,
        int $reserationCount,
        bool $canReserve
    ) {
        $user = new User();
        $user->plan = $plan;

        $lesson = new Lesson();

        $this->assertSame($canReserve, $user->canReserve($lesson->remainingCount, $reserationCount));
    }

    public function dataCanReserve()
    {
        return [
            '予約可：レギュラー、空きあり、月の上限以下' => [
                'plan' => 'regular',
                'remainingCount' => 1,
                'reservationCount' => 4,
                'canReserve' => true,
            ],
            '予約不可：レギュラー、空きなし、月の上限以下' => [
                'plan' => 'regular',
                'remainingCount' => 0,
                'reservationCount' => 4,
                'canReserve' => false,
            ],
            '予約不可：レギュラー、空きあり、月の上限' => [
                'plan' => 'regular',
                'remainingCount' => 1,
                'reservationCount' => 5,
                'canReserve' => false,
            ],
            '予約可：ゴールド、空きあり' => [
                'plan' => 'gold',
                'remainingCount' => 1,
                'reservationCount' => 5,
                'canReserve' => true,
            ],
            '予約不可：ゴールド、空きなし' => [
                'plan' => 'gold',
                'remainingCount' => 0,
                'reservationCount' => 5,
                'canReserve' => false,
            ],
        ];
    }
}
