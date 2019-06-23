<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProcessedFieldRepository;
use App\Repositories\FieldRepository;
use App\Repositories\TractorRepository;
use App\Models\ProcessedField;
use App\Models\Field;
use App\Models\Tractor;
use Illuminate\Support\Facades\Gate;
use \Carbon\Carbon;

/**
 * @group Processed Fields
 *
 */
class ProcessedFieldController extends Controller
{
    /**
     * Show all processed fields
     * 
     * Display a listing of the processed fields.
     *
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * 
     * @response 
     *  [
     *      {
     *          "id": 1,
     *          "user_id": 1,
     *          "tractor_id": 1,
     *          "field_id": 1,
     *          "processed_at": "2019-06-20 00:00:00",
     *          "approved_by_user_id": 1,
     *          "approved_at": "2019-06-22 00:00:00",
     *          "area_processed": "149.00",
     *          "created_at": "2019-06-22 13:55:35",
     *          "updated_at": "2019-06-22 14:08:47"
     *       }
     *  ]
     * 
     */
    public function index()
    {
        //
        $processed_field_repository = new ProcessedFieldRepository(new ProcessedField);
        $processed_fields = $processed_field_repository->all();

        return response()->json($processed_fields);
    }

    /**
     * Store a processed field
     * 
     * Store a newly created processed field in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @bodyParam tractor_id int required Tractor ID.
     * @bodyParam field_id int required Field ID.
     * @bodyParam area_processed int required Processed land area which is not greater than the selected field.
     * @bodyParam processed_at timestamp required Timestamp of processing.
     * 
     * 
     * @response 201
     *      {
     *          "id": 1,
     *          "user_id": 1,
     *          "tractor_id": 1,
     *          "field_id": 1,
     *          "processed_at": "2019-06-20 00:00:00",
     *          "area_processed": "149.00",
     *          "created_at": "2019-06-22 13:55:35",
     *          "updated_at": "2019-06-22 14:08:47"
     *       }
     * 
     * @response 400 {
     *   
     *    "error": "validation_error",
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "processed_area": [
     *            "The area must be a number."
     *        ]
     *    }
     *   
     * }
     * 
     */
    public function store(Request $request)
    {
        //
        try {
            $this->validate($request,
                [
                    'tractor_id' => 'required|integer',
                    'field_id' => 'required|integer',
                    'processed_at' => 'required|date',
                    'area_processed' => 'required|numeric',
                ]
            );

            $field_repository = new FieldRepository(new Field);
            $field = $field_repository->findOneOrFail($request->field_id);

            $field_area = $field->area;

            $this->validate($request,
                [
                    'area_processed' => "required|numeric|max:$field_area",
                ]
            );

            $tractor_repository = new TractorRepository(new Tractor);
            $tractor = $tractor_repository->findOneOrFail($request->tractor_id);
        
            $processed_field_repository = new ProcessedFieldRepository(new ProcessedField);
            $processed_fields = $processed_field_repository->createProcessedField($request->all(), $request->user()->id);
    
            return response()->json($processed_fields, 201);
        } 
        catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'processed_field_not_created',
                'message' => $e->getMessage()
            ], 500);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'validation_error',
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 400);
        }
    }

    /**
     * Show a processed field
     * 
     * Display the specified processed field.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @queryParam id required Processed Field ID
     * 
     * @response 
     *      {
     *          "id": 1,
     *          "user_id": 1,
     *          "tractor_id": 1,
     *          "field_id": 1,
     *          "processed_at": "2019-06-20 00:00:00",
     *          "approved_by_user_id": null,
     *          "approved_at": null,
     *          "area_processed": "149.00",
     *          "created_at": "2019-06-22 13:55:35",
     *          "updated_at": "2019-06-22 14:08:47"
     *       }
     *  
     * 
     */
    public function show($id)
    {
        //
        try {
            $processed_field_repository = new ProcessedFieldRepository(new ProcessedField);
            $processed_field = $processed_field_repository->findOneOrFail($id);
    
            return response()->json($processed_field);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'processed_field_not_found',
                'message' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * Update a processed field
     * 
     * Update the specified processed field in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @queryParam id required Processed Field ID
     * @bodyParam tractor_id int required Tractor ID.
     * @bodyParam field_id int required Field ID.
     * @bodyParam area_processed int required Processed land area which is not greater than the selected field.
     * @bodyParam processed_at timestamp required Timestamp of processing.
     * 
     * @response 
     *      {
     *          "id": 1,
     *          "user_id": 1,
     *          "tractor_id": 1,
     *          "field_id": 1,
     *          "processed_at": "2019-06-20 00:00:00",
     *          "approved_by_user_id": null,
     *          "approved_at": null,
     *          "area_processed": "149.00",
     *          "created_at": "2019-06-22 13:55:35",
     *          "updated_at": "2019-06-22 14:08:47"
     *       }
     * 
     * @response 400 {
     *    "error": "validation_error",
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "processed_area": [
     *            "The area must be a number."
     *        ]
     *    }
     * }
     * 
     * @response 401 {
     *    "error": "user_unauthorized",
     * }
     * 
     * @response 500 {
     *    "error": "processed_field_not_updated",
     *    "message": "...",
     * }
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $this->validate($request,
                [
                    'tractor_id' => 'required|integer',
                    'field_id' => 'required|integer',
                    'processed_at' => 'required|date',
                    'area_processed' => 'required|numeric',
                ]
            );

            $processed_field_repository = new ProcessedFieldRepository(new ProcessedField);
            $processed_field = $processed_field_repository->findOneOrFail($id);

            if(Gate::denies('processed_field update', $processed_field)){
                return response()->json([
                    'error' => 'user_unauthorized'
                ]); 
            }

            $field_repository = new FieldRepository(new Field);
            $field = $field_repository->findOneOrFail($request->field_id);

            $field_area = $field->area;

            $this->validate($request,
                [
                    'area_processed' => "required|numeric|max:$field_area",
                ]
            );

            $tractor_repository = new TractorRepository(new Tractor);
            $tractor = $tractor_repository->findOneOrFail($request->tractor_id);
            
            $processed_field_repository = new ProcessedFieldRepository($processed_field);
            $processed_field_repository->update($request->all());
    
            return response()->json($processed_field);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'model_not_found',
                'message' => $e->getMessage()
            ], 200);            
            
        } catch (\Illuminate\Database\QueryException $e) {
            
            return response()->json([
                'error' => 'processed_field_not_updated',
                'message' => $e->getMessage()
            ], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'validation_error',
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 400);
        }
    }

    /**
     * Remove a processed field
     * 
     * Remove the specified processed field from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @queryParam id required Processed Field ID
     * 
     * @response {
     *  "message": "processed_field_deleted"
     * }
     * 
     * @response 401 {
     *    "error": "user_unauthorized",
     * }
     * 
     * @response 500 {
     *    "error": "processed_field_not_deleted",
     *    "message": "...",
     * }
     * 
     */
    public function destroy($id)
    {
        //
        try {
            $processed_field_repository = new ProcessedFieldRepository(new ProcessedField);
            $processed_field = $processed_field_repository->findOneOrFail($id);

            if(Gate::denies('processed_field delete', $processed_field)){
                return response()->json([
                    'error' => 'user_unauthorized'
                ], 401); 
            }

            $processed_field_repository = new ProcessedFieldRepository($processed_field);
            $processed_field_repository->delete();
    
            return response()->json(['message' => 'processed_field_deleted']);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'processed_field_not_found',
                'message' => $e->getMessage()
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'processed_field_not_deleted',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Approve a processed field
     * 
     * Approve the specified processed field by the administrator/supervisor
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @queryParam id required Processed Field ID
     * 
     * @response 
     *      {
     *          "id": 1,
     *          "user_id": 1,
     *          "tractor_id": 1,
     *          "field_id": 1,
     *          "processed_at": "2019-06-20 00:00:00",
     *          "approved_by_user_id": 1,
     *          "approved_at": "2019-06-22 00:00:00",
     *          "area_processed": "149.00",
     *          "created_at": "2019-06-22 13:55:35",
     *          "updated_at": "2019-06-22 14:08:47"
     *       }
     * 
     * @response 401 {
     *    "error": "user_unauthorized",
     * }
     * 
     * @response 500 {
     *    "error": "processed_field_not_approved",
     *    "message": "...",
     * }
     */
    public function approve(Request $request, $id)
    {
        //
        if(Gate::denies('processed_field approve')){
            return response()->json([
                'error' => 'user_unauthorized'
            ], 401); 
        }

        try {
            $processed_field_repository = new ProcessedFieldRepository(new ProcessedField);
            $processed_field = $processed_field_repository->findOneOrFail($id);
            
            $processed_field_repository = new ProcessedFieldRepository($processed_field);
            $processed_field_repository->approveProcessedField([
                'approved_by_user_id' => $request->user()->id,
                'approved_at' => Carbon::today()->format('Y-m-d H:i:s')
            ]);
    
            return response()->json($processed_field);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'processed_field_not_found',
                'message' => $e->getMessage()
            ], 200);            
            
        } catch (\Illuminate\Database\QueryException $e) {
            
            return response()->json([
                'error' => 'processed_field_not_approved',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create report
     * 
     * Create report of processed fields with summary of processed areas grouped by culture.
     * HTTP get parameters:
     * field_name [e.g. field1],
     * culture [e.g. Wheat],
     * date_from [e.g. 2019-01-01],
     * date_to [e.g. 2019-01-01]
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @queryParam field_name Field name for filtering
     * @queryParam culture Culture/Crop Type for filtering
     * @queryParam date_from Date from for filtering
     * @queryParam date_to Date to for filtering
     * 
     * 
     * @response
     * {
     *       "summary": [
     *           {
     *               "culture": "Wheat",
     *               "total_area_processed": "299.00"
     *           }
     *       ],
     *       "processed_fields": [
     *           {
     *               "id": 2,
     *               "field_name": "field2",
     *               "culture": "Wheat",
     *               "processed_at": "2019-06-22 00:00:00",
     *               "tractor_name": "My Tractor 2",
     *               "area_processed": "150.00"
     *           },
     *           {
     *               "id": 11,
     *               "field_name": "field2",
     *               "culture": "Wheat",
     *               "processed_at": "2019-06-22 00:00:00",
     *               "tractor_name": "My Tractor 2",
     *               "area_processed": "149.00"
     *           }
     *       ]
     *   }
     */
    public function report(Request $request)
    {
        //
        $field_name = is_null($request->field_name) ? null : $request->field_name;
        $culture = is_null($request->culture) ? null : $request->culture;
        $date_from = is_null($request->date_from) ? null : $request->date_from;
        $date_to = is_null($request->date_to) ? null : $request->date_to;

        $filters = [];

        if(!is_null($field_name))
        {
            $filters[] = [
                'fields.name',
                'like',
                "%$field_name%"
            ];
        }

        if(!is_null($culture))
        {
            $filters[] = [
                'fields.crop_type',
                '=',
                $culture
            ];
        }

        if(!is_null($date_from) && !is_null($date_to))
        {
            $filters[] = [
                'processed_fields.processed_at',
                '>=',
                $date_from . ' 00:00:00'
            ];

            $filters[] = [
                'processed_fields.processed_at',
                '<=',
                $date_to . ' 23:59:59'
            ];
        }

        $processed_field_repository = new ProcessedFieldRepository(new ProcessedField);
        $processed_fields = $processed_field_repository->listProcessedFieldsReport($filters);


        return response()->json($processed_fields);
    }
}
