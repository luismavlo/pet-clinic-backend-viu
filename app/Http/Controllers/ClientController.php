<?php

namespace App\Http\Controllers;

use App\Models\client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Custom\ResultResponse;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $client=client::paginate(2);
        $resultResponse=new ResultResponse();
        $resultResponse->setData($client);
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

            
            $mensaje=$this->validateClient($request); 
            //   
             if($mensaje['estado']){ 

                $newClient=new client([
                'user_id'=>$request->get('user_id'),
                'phone'=>$request->get('phone'),
                'email'=>$request->get('email'),
                'password'=>$request->get('password'),               
               ]);
               
               $newClient->save();
               $resultResponse->setData($newClient);
               $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
               $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
            }else{

                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage($mensaje['errores']);

            }

             }catch(\Exception $e){
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
              //  $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
                $resultResponse->setMessage($e);
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
           
             $client=client::findOrFail($id);
             $resultResponse->setData($client);
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
    public function edit(client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
       // $this->validateClient($request);
        $resultResponse=new ResultResponse();
        try{
           

            $mensaje=$this->validateClient($request); 
            
             if($mensaje['estado']){ 

            $client=client::findOrFail($id);
            $client->user_id=$request->get('user_id');
            $client->phone=$request->get('phone');
            $client->email=$request->get('email');
            $client->password=$request->get('password');
           
            $client->save();               
            $resultResponse->setData($client);
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
           
            $client=client::findOrFail($id);            
            $client->delete();               
            $resultResponse->setData($client);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exception $e){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUNT_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUNT_CODE);
           }

           return response()->json($resultResponse);

    }

    private function validateClient(Request $request){
     
        $rules=[
            'user_id'=>'required|integer|exists:users,id',
            'phone'=>'required|string',
            'email'=>'required|string',
            'password'=>'required|string',
                         
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
