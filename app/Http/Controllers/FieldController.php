<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\FieldRepository;
use App\Models\Field;
use Illuminate\Support\Facades\Gate;

/**
 * @group Fields
 *
 */
class FieldController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Show all fields
     * 
     * Display a listing of the Fields.
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
     *          "name": "field1",
     *          "crop_type": "Strawberries",
     *          "area": "150.00",
     *          "created_at": "2019-06-22 13:36:07",
     *          "updated_at": "2019-06-22 13:36:07"
     *      }
     *  ]
     * 
     */
    public function index()
    {
        //
        $field_repository = new FieldRepository(new Field);
        $fields = $field_repository->all();

        return response()->json($fields);
    }

    /**
     * Store a field
     * 
     * Store a newly created Field in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @bodyParam name string required Name of field.
     * @bodyParam crop_type string required Type of crop selected from column enum.
     * @bodyParam area decimal required Land area.
     * 
     * 
     * @response 201 {
     *      
     *          "id": 1,
     *          "user_id": 1,
     *          "name": "field1",
     *          "crop_type": "Strawberries",
     *          "area": "150.00",
     *          "created_at": "2019-06-22 13:36:07",
     *          "updated_at": "2019-06-22 13:36:07"
     *      
     *  
     * }
     * @response 400 {
     *   
     *    "error": "validation_error",
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "area": [
     *            "The area must be a number."
     *        ]
     *    }
     *   
     * }
     */
    public function store(Request $request)
    {
        //
        try {
            $this->validate($request,
                [
                    'name' => 'required',
                    'crop_type' => 'required',
                    'area' => 'required|numeric',
                ]
            );
        
            $field_repository = new FieldRepository(new Field);
            $field = $field_repository->createField($request->all(), $request->user()->id);
    
            return response()->json($field, 201);
        } 
        catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'field_not_created',
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
     * Show a field
     * 
     * Display the specified Field.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @queryParam id Field required ID
     * 
     * @response {
     *          "id": 1,
     *          "user_id": 1,
     *          "name": "field1",
     *          "crop_type": "Strawberries",
     *          "area": "150.00",
     *          "created_at": "2019-06-22 13:36:07",
     *          "updated_at": "2019-06-22 13:36:07"
     * }
     * 
     */
    public function show($id)
    {
        //
        try {
            $field_repository = new FieldRepository(new Field);
            $field = $field_repository->find($id);

            if(is_null($field)){
                return response()->json();
            }
    
            return response()->json($field);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'field_not_found',
                'message' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * Update a field
     * 
     * Update the specified Field in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @queryParam id required Field ID
     * @bodyParam name string required Name of field.
     * @bodyParam crop_type string required Type of crop selected from column enum.
     * @bodyParam area decimal required Land area.
     * 
     * @response 200 {
     *          "id": 1,
     *          "user_id": 1,
     *          "name": "field1",
     *          "crop_type": "Strawberries",
     *          "area": "150.00",
     *          "created_at": "2019-06-22 13:36:07",
     *          "updated_at": "2019-06-22 13:36:07"
     * }
     * 
     * @response 400 {
     *    "error": "validation_error",
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "area": [
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
     *    "error": "field_not_updated",
     *    "message": "...",
     * }
     * 
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $this->validate($request,
                [
                    'name' => 'required',
                    'crop_type' => 'required',
                    'area' => 'required|numeric',
                ]
            );

            $field_repository = new FieldRepository(new Field);
            $field = $field_repository->findOneOrFail($id);

            if(Gate::denies('field update', $field)){
                return response()->json([
                    'error' => 'user_unauthorized'
                ], 401); 
            }

            
            $field_repository = new FieldRepository($field);
            $field_repository->update($request->all());
    
            return response()->json($field);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'field_not_found',
                'message' => $e->getMessage()
            ], 200);            
            
        } catch (\Illuminate\Database\QueryException $e) {
            
            return response()->json([
                'error' => 'field_not_updated',
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
     * Remove a field
     * 
     * Remove the specified Field from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * 
     * @queryParam api_token required API Token
     * @queryParam id required Field ID
     * 
     * @response {
     *  "message": "field_deleted"
     * }
     * 
     * @response 401 {
     *    "error": "user_unauthorized",
     * }
     * 
     * @response 500 {
     *    "error": "field_not_deleted",
     *    "message": "...",
     * }
     * 
     */
    public function destroy($id)
    {
        //
        try {
            $field_repository = new FieldRepository(new Field);
            $field = $field_repository->findOneOrFail($id);

            if(Gate::denies('field delete', $field)){
                return response()->json([
                    'error' => 'user_unauthorized'
                ], 401);
            }

            $field_repository = new FieldRepository($field);
            $field_repository->delete();
    
            return response()->json(['message' => 'field_deleted']);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'field_not_found',
                'message' => $e->getMessage()
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'field_not_deleted',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
