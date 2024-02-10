<?php

namespace App\Http\Controllers;

use App\Models\pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Custom\ResultResponse;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pet = pet::with('specie','client')->paginate(10); 
       
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
        
        $resultResponse=new ResultResponse();
          try{


            $mensaje=$this->validatePet($request); 
            //   
             if($mensaje['estado']){ 
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
            }else{

                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage($mensaje['errores']);

            }




             }catch(\Exception $e){
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
           
           
             $pet = Pet::with('specie', 'client')->findOrFail($id);
             $resultResponse->setData($pet);
             $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
             $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exception $e){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUNT_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUNT_CODE);
           }

           return response()->json($resultResponse,$resultResponse->getStatusCode());
        

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
       
        $resultResponse=new ResultResponse();
        try{
           
            $mensaje=$this->validatePet($request); 
            //   
             if($mensaje['estado']){ 
          

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
          
        }else{

            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($mensaje['errores']);

        }




           }catch(\Exception $e){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUNT_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUNT_CODE);
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
          
           }catch(\Exception $e){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUNT_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUNT_CODE);
           }

           return response()->json($resultResponse);
    }

   
    private function validatePet(Request $request){

        $rules=[
          
            'client_id'=>'required|integer|exists:clients,id',
            'photo'=>'required|string',
            'name'=>'required|string',
            'birthdate'=>'required|date',
            'race'=>'required|string',
            'specie_id'=>'required|integer|exists:species,id',
                         
       ];

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'integer' => 'El campo :attribute debe ser entero.',
            'exists' => 'El valor del campo :attribute es invalido.',
           
       ];

       $validator = Validator::make($request->all(), $rules,$messages);

       if ($validator->fails()) {
        return ['estado'=>false,
              'errores'=>$validator->errors()->all()
             ];
       }else{
        
         return ['estado'=>true,
                 ];

       }




    }



}
