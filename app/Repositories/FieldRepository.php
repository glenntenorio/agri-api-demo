<?php

namespace App\Repositories;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Jsdecena\Baserepo\BaseRepository;

class FieldRepository extends BaseRepository {
    
    public function __construct(Field $field) 
    {
        parent::__construct($field);
    }

    /**
     * Create a new field
     * 
     * @param array $data
     * @param int $user_id
     * @return Field
     */
    public function createField(array $data, int $user_id) : Field
    {
        $data['user_id'] = $user_id;
        return $this->create($data);
    }
}