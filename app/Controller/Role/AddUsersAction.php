<?php
declare(strict_types=1);

namespace App\Controller\Role;

use App\Repository\RoleRepository;
use Psr\Http\Message\ServerRequestInterface;

class AddUsersAction
{
    public function __construct(
        private RoleRepository $roleRepository
    ) {
    }

    public function __invoke(ServerRequestInterface $request, array $args): array
    {
        return [
            'success' => true,
            'result'  => $this->roleRepository->addUserByRole((int)$args['id'], $request->getParsedBody()),
        ];
    }
}
