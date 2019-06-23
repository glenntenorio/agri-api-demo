<?php

namespace App\Repositories;

use App\Models\ProcessedField;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Jsdecena\Baserepo\BaseRepository;

class ProcessedFieldRepository extends BaseRepository {
    
    public function __construct(ProcessedField $processed_field) 
    {
        parent::__construct($processed_field);
    }

    /**
     * Create a new processed field
     * 
     * @param array $data
     * @param int $user_id
     * @return ProcessedField
     */
    public function createProcessedField(array $data, int $user_id) : ProcessedField
    {
        $data['user_id'] = $user_id;
        return $this->create($data);
    }

    /**
     * List all processed fields report with column filter and sorting.
     * 
     * 
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     *
     * @return Collection
     */
    public function listProcessedFieldsReport(array $filter = []) : Collection
    {
        $processed_field_report = $this->model
                                        ->join('fields', 'fields.id', '=', 'processed_fields.field_id')
                                        ->join('tractors', 'tractors.id', '=', 'processed_fields.tractor_id')
                                        ->whereNotNull('processed_fields.approved_at')
                                        ->where($filter)
                                        ->get([
                                            'processed_fields.id',
                                            'fields.name as field_name',
                                            'fields.crop_type as culture',
                                            'processed_fields.processed_at',
                                            'tractors.name as tractor_name',
                                            'processed_fields.area_processed',
                                        ]);

        $summary = $this->model
                        ->join('fields', 'fields.id', '=', 'processed_fields.field_id')
                        ->join('tractors', 'tractors.id', '=', 'processed_fields.tractor_id')
                        ->whereNotNull('processed_fields.approved_at')
                        ->where($filter)
                        ->groupBy('fields.crop_type')
                        ->selectRaw('fields.crop_type as culture, SUM(processed_fields.area_processed) as total_area_processed')
                        ->get();

        return collect([ 'summary' => $summary, 'processed_fields' => $processed_field_report ]);
    }

    /**
     * Approve a processed field
     * 
     * @param array $data
     * @param int $user_id
     * @return bool
     */
    public function approveProcessedField(array $data) : bool
    {
        return $this->update($data);
    }
}