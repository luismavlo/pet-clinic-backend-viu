<?php

namespace App\Http\Controllers;

use App\Models\specie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Custom\ResultResponse;

class SpecieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $species=specie::paginate(2);
        $resultResponse=new ResultResponse();
        $resultResponse->setData($species);
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
              
            
            $mensaje=  $this->validateSpecie($request); 
            //   
             if($mensaje['estado']){ 

             
                $newSpecie=new specie([
                'name'=>$request->get('name'),
                'descripcion'=>$request->get('descripcion'),
                'photo'=>$request->get('photo'),
               ]);

               $newSpecie->save();
               $resultResponse->setData($newSpecie);
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
             
               $specie=specie::findOrFail($id);
               $resultResponse->setData($specie);
               $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
               $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);

            
             }catch(\Exception $e){
                $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUNT_CODE);
                $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUNT_CODE);
             }

             return response()->json($resultResponse);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(specie $specie)
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
              

            $mensaje=  $this->validateSpecie($request); 
            //   
             if($mensaje['estado']){ 


               $specie=specie::findOrFail($id);
               $specie->name=$request->get('name');
               $specie->descripcion=$request->get('descripcion');
               $specie->photo=$request->get('photo');

               $specie->save();               
               $resultResponse->setData($specie);
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
           
            $specie=specie::findOrFail($id);
            $specie->delete();               
            $resultResponse->setData($specie);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exception $e){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUNT_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUNT_CODE);
           }

           return response()->json($resultResponse);
    }



    private function validateSpecie(Request $request){

        $rules=[
            'name'=>'required|string',
            'descripcion'=>'required|string',
            'photo'=>'required|string',
                         
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

