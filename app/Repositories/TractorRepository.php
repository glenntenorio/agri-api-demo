<?php

namespace App\Repositories;

use App\Models\Tractor;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Jsdecena\Baserepo\BaseRepository;

class TractorRepository extends BaseRepository {
    
    public function __construct(Tractor $tractor) 
    {
        parent::__construct($tractor);
    }

    /**
     * Create a new tractor
     * 
     * @param array $data
     * @param int $user_id
     * @return Tractor
     */
    public function createTractor(array $data, int $user_id) : Tractor
    {
        $data['user_id'] = $user_id;
        return $this->create($data);
    }
}