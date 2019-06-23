<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Jsdecena\Baserepo\BaseRepository;

class UserRepository extends BaseRepository {
    
    public function __construct(User $user) 
    {
        parent::__construct($user);
    }

    /**
     * Find user by email address
     * 
     * @param string $email
     * @return User
     * @throws ModelNotFoundException
     */
    public function findUserByEmailOrFail(string $email) : User
    {
        return $this->findOneByOrFail(['email' => $email]);
    }

    /**
     * Find user by email address
     * 
     * @param string $email
     * @return User|null
     */
    public function findUserByEmail(string $email)
    {
        return $this->findOneBy(['email' => $email]);
    }

}