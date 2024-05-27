<?php

declare(strict_types=1);

use App\Model\User;
use Phinx\Migration\AbstractMigration;

final class UsersTableCreate extends AbstractMigration
{
    public function up(): void
    {
        $this->table(User::TABLE_NAME)
            ->addColumn('email', 'string', ['limit' => 100])
            ->addTimestamps()
            ->addIndex('email', ['unique' => true])
            ->create();
    }

    public function down(): void
    {
        $this->table(User::TABLE_NAME)->drop();
    }
}
