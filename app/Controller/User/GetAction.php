<?php
declare(strict_types=1);

namespace App\Controller\User;

use App\Repository\UserRepository;
use Psr\Http\Message\ServerRequestInterface;

class GetAction
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function __invoke(ServerRequestInterface $request, array $args): array
    {
        return [
            'success' => true,
            'result'  => $this->userRepository->getById((int)$args['id']),
        ];
    }
}
