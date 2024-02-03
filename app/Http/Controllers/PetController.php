<?php

namespace App\Http\Controllers;

use App\Models\pet;
use Illuminate\Http\Request;
use App\Custom\ResultResponse;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pet=pet::all();
        $resultResponse=new ResultResponse();
        $resultResponse->setData($pet);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
      
        return response()->json($resultResponse);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validatePet($request);    
        $resultResponse=new ResultResponse();
          try{
               $newPet=new pet([
    
                'client_id'=>$request->get('client_id'),
                'photo'=>$request->get('photo'),
                'name'=>$request->get('name'),
                'birthdate'=>$request->get('birthdate'),
                'race'=>$request->get('race'),
                'specie_id'=>$request->get('specie_id'),
    
    

               ]);



               $newPet->save();
               $resultResponse->setData($newPet);
               $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
               $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            
             }catch(\Exeption $e){
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
             }

             return response()->json($resultResponse);


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $resultResponse=new ResultResponse();
        try{
           
             $pet=pet::findOrFail($id);
             $resultResponse->setData($pet);
             $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
             $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exeption $e){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setMessage(ResultResponse::TXT__ELEMENT_NOT_FOUND_CODE);
           }

           return response()->json($resultResponse);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pet $pet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $this->validatePet($request);
        $resultResponse=new ResultResponse();
        try{
           
            $pet=pet::findOrFail($id);
            $pet->client_id=$request->get('client_id');
            $pet->photo=$request->get('photo');
            $pet->name=$request->get('name');
            $pet->birthdate=$request->get('birthdate');
            $pet->race=$request->get('race');
            $pet->specie_id=$request->get('specie_id');

            $pet->save();               
            $resultResponse->setData($pet);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exeption $e){
              $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
              $resultResponse->setMessage(ResultResponse::TXT__ELEMENT_NOT_FOUND_CODE);
           }

           return response()->json($resultResponse);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $resultResponse=new ResultResponse();
        try{
           
            $pet=pet::findOrFail($id);
            $pet->delete();               
            $resultResponse->setData($pet);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exeption $e){
              $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
              $resultResponse->setMessage(ResultResponse::TXT__ELEMENT_NOT_FOUND_CODE);
           }

           return response()->json($resultResponse);
    }

    private function validatePet(Request $request){

    }

}
