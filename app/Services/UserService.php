<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService   //BO Layer
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        $users = $this->userRepository->getAll();
        if ($users->isNotEmpty()) {
            return $users;
        } else {
            return NULL;
        }
    }

    public function getUser($id)
    {
        return $this->userRepository->get($id);
    }

    public function createUser($data)
    {
        return $this->userRepository->create($data);
    }

    public function updateUser($data)
    {
        return $this->userRepository->update($data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
