<?php

namespace App\Http\Controllers;

use App\Models\client;
use Illuminate\Http\Request;
use App\Custom\ResultResponse;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $client=client::all();
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
        $this->validateClient($request);    
        $resultResponse=new ResultResponse();
          try{
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
           
             $client=client::findOrFail($id);
             $resultResponse->setData($client);
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
        $this->validateClient($request);
        $resultResponse=new ResultResponse();
        try{
           
            $client=client::findOrFail($id);
            $client->specie_id=$request->get('user_id');
            $client->race=$request->get('phone');
            $client->email=$request->get('email');
            $client->password=$request->get('password');
           
            $client->save();               
            $resultResponse->setData($client);
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
           
            $client=client::findOrFail($id);
            $client->delete();               
            $resultResponse->setData($client);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exeption $e){
              $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
              $resultResponse->setMessage(ResultResponse::TXT__ELEMENT_NOT_FOUND_CODE);
           }

           return response()->json($resultResponse);

    }

    private function validateEmployee(Request $request){

    }


}
