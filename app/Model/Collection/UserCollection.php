<?php
declare(strict_types=1);

namespace App\Model\Collection;

use App\Model\User;
use Cake\Datasource\Exception\RecordNotFoundException;

class UserCollection extends AbstractCollection
{
    public function initialize(array $config): void
    {
        $this->setTable(User::TABLE_NAME);
        $this->setPrimaryKey('id');
        $this->setEntityClass(User::class);

        $this->belongsToMany('roles', [
            'className' => RoleCollection::class,
            'joinTable' => 'role_user',
        ]);
    }

    /**
     * Get entity id by email
     * 
     * @param array|string @email
     * 
     * @return array|int
     * @throws RecordNotFoundException
     */
    public function getIdByEmail(array|string $email): mixed
    {
        $result = $this->find()
            ->select('id')
            ->where(['email IN' => (is_array($email) ? $email : [$email])])
            ->all()
            ->extract('id')
            ->toArray();
        if (empty($result)) {
            throw new RecordNotFoundException('Entity not founds');
        }

        return is_string($email) ? $result[0] : $result;
    }
}
