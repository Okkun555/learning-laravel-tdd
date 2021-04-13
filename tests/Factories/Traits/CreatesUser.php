<?php

namespace Tests\Factories\Traits;

use App\Models\User;
use App\Models\UserProfile;

trait CreatesUser
{
  private function createUser(): User
  {
    $user = factory(User::class)->create();
    $user->profile()->save(factory(UserProfile::class)->make());

    return $user;
  }

  // private function createUser(array $options = []): User
  // {
  //   $user = factory(User::class)
  //     ->status(Arr::get($options, 'states.user', []))
  //     ->create(Arr::get($options, 'attributes.user', []));

  // $user->profile()->save(
  //     factory(UserProfile::class)
  //         ->states(Arr::get($options, 'states.user_profile', []))
  //         ->make(Arr::get($options, 'attributes.user_profile', []))
  // );

  //   return $user;
  // }

  // テスト側
  // public function testShow()
  // {
  //   // すべて Faker にお任せする場合
  //   $user = $this->createUser();

  //   // 状態やプロパティを指定したい場合
  //   // テストケースによって変化するならデータプロバイダから渡すといいでしょう
  //   $options = [
  //     'states' => [
  //       'user' => '加入1年未満',
  //       'user_profile' => ['ゴールド会員', 'シニア会員'],
  //     ],
  //     'attributes' => [
  //       // 決まった名前が必要なケースはないと思いますが、あくまで例として
  //       'user' => ['name' => '山田太郎'],
  //       'user_profile' => ['plan' => 'gold'],
  //     ],
  //   ];
  //   $user = $this->createUser($options);
  // }
}
