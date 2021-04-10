<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Lesson;
use Mockery;
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
        $user = Mockery::mock(User::class)->makePartial();
        $user->shouldReceive('reservationCountThisMonth')->andReturn($reserationCount);
        $user->plan = $plan;

        /** @var Lesson $lesson */
        $lesson = Mockery::mock(Lesson::class);
        $lesson->shouldReceive('remainingCount')->andReturn($remainingCount);

        $this->assertSame($canReserve, $user->canReserve($lesson));
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
