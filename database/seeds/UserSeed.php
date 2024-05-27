<?php

declare(strict_types=1);

use App\Model\User;
use Phinx\Seed\AbstractSeed;

class UserSeed extends AbstractSeed
{
    public function run(): void
    {
        $table = $this->table(User::TABLE_NAME);

        $table->insert([
            ['email' => 'user1@test.local'],
            ['email' => 'user2@test.local'],
            ['email' => 'user3@test.local']
        ])->saveData();
    }
}
