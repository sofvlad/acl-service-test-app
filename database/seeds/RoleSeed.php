<?php

declare(strict_types=1);

use App\Model\Role;
use Phinx\Seed\AbstractSeed;

class RoleSeed extends AbstractSeed
{
    public function run(): void
    {
        $table = $this->table(Role::TABLE_NAME);

        $table->insert([
            [
                'slug'        => 'admin',
                'name'        => 'Admin',
                'description' => 'Admin service role',
            ],
            [
                'slug'        => 'moderator',
                'name'        => 'Moderator',
                'description' => 'Moderator service role',
            ],
            [
                'slug'        => 'user',
                'name'        => 'User',
                'description' => 'User service role',
            ],
        ])->saveData();
    }
}
