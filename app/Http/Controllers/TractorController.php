<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TractorRepository;
use App\Models\Tractor;
use Illuminate\Support\Facades\Gate;

/**
 * @group Tractors
 *
 */
class TractorController extends Controller
{
    /**
     * Show all tractors
     * 
     * Display a listing of the Tractor.
     *
     * @return \Illuminate\Http\Response
     * 
     * @response 
     *  [
     *      {
     *          "id": 1,
     *          "user_id": 1,
     *          "name": "tractor1",
     *          "created_at": "2019-06-22 13:36:07",
     *          "updated_at": "2019-06-22 13:36:07"
     *      }
     *  ]
     * 
     * 
     */
    public function index()
    {
        //
        $tractor_repository = new TractorRepository(new Tractor);
        $tractor = $tractor_repository->all();

        return response()->json($tractor);
    }

    /**
     * Store a tractor
     * 
     * Store a newly created Tractor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @bodyParam name string required Name of tractor.
     * 
     * @response 201 {
     *          "id": 1,
     *          "user_id": 1,
     *          "name": "tractor1",
     *          "created_at": "2019-06-22 13:36:07",
     *          "updated_at": "2019-06-22 13:36:07"
     * }
     * @response 400 {
     *   
     *    "error": "validation_error",
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "name": [
     *            "The name is required."
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
                    'name' => 'required'
                ]
            );
        
            $tractor_repository = new TractorRepository(new Tractor);
            $tractor = $tractor_repository->createTractor($request->all(), $request->user()->id);
    
            return response()->json($tractor, 201);
        } 
        catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'tractor_not_created',
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
     * Show a tractor
     * 
     * Display the specified Tractor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @queryParam id required Tractor ID
     * 
     * @response {
     *          "id": 1,
     *          "user_id": 1,
     *          "name": "tractor1",
     *          "created_at": "2019-06-22 13:36:07",
     *          "updated_at": "2019-06-22 13:36:07"
     * }
     * 
     */
    public function show($id)
    {
        //
        try {
            $tractor_repository = new TractorRepository(new Tractor);
            $tractor = $tractor_repository->findOneOrFail($id);
    
            return response()->json($tractor);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'tractor_not_found',
                'message' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * Update a field
     * 
     * Update the specified Tractor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @bodyParam name string required Name of tractor.
     * 
     * @response 200 {
     *          "id": 1,
     *          "user_id": 1,
     *          "name": "tractor1",
     *          "created_at": "2019-06-22 13:36:07",
     *          "updated_at": "2019-06-22 13:36:07"
     * }
     * 
     * @response 400 {
     *    "error": "validation_error",
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "name": [
     *            "The name is required."
     *        ]
     *    }
     * }
     * 
     * @response 401 {
     *    "error": "user_unauthorized",
     * }
     * 
     * @response 500 {
     *    "error": "tractor_not_updated",
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
                ]
            );

            $tractor_repository = new TractorRepository(new Tractor);
            $tractor = $tractor_repository->findOneOrFail($id);

            if(Gate::denies('tractor update', $tractor)){
                return response()->json([
                    'error' => 'user_unauthorized'
                ], 401); 
            }

            $tractor_repository = new TractorRepository($tractor);
            $tractor_repository->update($request->all());
    
            return response()->json($tractor);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'error' => 'tractor_not_found',
                'message' => $e->getMessage()
            ], 200);            
            
        } catch (\Illuminate\Database\QueryException $e) {
            
            return response()->json([
                'error' => 'tractor_not_updated',
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
     * Remove a tractor
     * 
     * Remove the specified Tractor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * @queryParam api_token required API Token
     * @queryParam id required Tractor ID
     * 
     * @response {
     *  "message": "tractor_deleted"
     * }
     * 
     * @response 401 {
     *    "error": "user_unauthorized",
     * }
     * 
     * @response 500 {
     *    "error": "tractor_not_updated",
     *    "message": "...",
     * }
     */
    public function destroy($id)
    {
        //
        try {
            $tractor_repository = new TractorRepository(new Tractor);
            $tractor = $tractor_repository->findOneOrFail($id);

            if(Gate::denies('tractor delete', $tractor)){
                return response()->json([
                    'error' => 'user_unauthorized'
                ], 401); 
            }

            $tractor_repository = new TractorRepository($tractor);
            $tractor_repository->delete();
    
            return response()->json(['message' => 'tractor_deleted']);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'tractor_not_found',
                'message' => $e->getMessage()
            ], 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'error' => 'tractor_not_deleted',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
