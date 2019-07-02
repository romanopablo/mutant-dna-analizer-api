<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DnaSample;

class MutantController extends Controller
{   
    public function postMutant(Request $request)
    {   
        $validator = $this->validateMutantRequest($request);

        if ( $validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        try {
            $dnaSample = DnaSample::where('dna', json_encode($request->dna))->first();

            if ($dnaSample === null){
                $dnaSample = DnaSample::make(['dna' => $request->dna]);
                $dnaSample->analize();
                $dnaSample->save();
            }
            
            if ( $dnaSample->dna_type === "M" )
                return response(null, 200);
            else
                return response(null, 403);

        } catch (\Throwable $th) {
            return response($th->getMessage(), 422);
        }
    }


    /**
     * Validation rules for the request:
     * DNA: 
     *    If has a dna attr
     *    If is an array of 4 elements minimum
     * DNA Items: 
     *    If each item is a string of min 4 chars
     *    If the size of the string is equal to the quantity of items (for the NxN rule) 
     *    If the chars are any combination of A, T, C or G
     */
    protected function validateMutantRequest(Request $request){
        
        $validator = Validator::make($request->all(), [
            'dna'  => 'required|array|min:4',
            'dna.*' => array(
                'required',
                'string',
                'size:' . ( $request->has('dna') ? count($request->dna) : 0),
                'regex:/^[atcg]+$/i'
            )
        ]);
        
        return $validator;
    }
}