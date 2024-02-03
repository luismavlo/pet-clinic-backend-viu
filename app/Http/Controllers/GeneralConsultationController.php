<?php

namespace App\Http\Controllers;

use App\Models\general_consultation;
use Illuminate\Http\Request;
use App\Custom\ResultResponse;

class GeneralConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $general_consultation=general_consultation::all();
        $resultResponse=new ResultResponse();
        $resultResponse->setData($general_consultation);
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
        $this->validateGeneral_consultation($request);    
        $resultResponse=new ResultResponse();
          try{
               $newGeneral_consultation=new general_consultation([
    
                'blood_pressure'=>$request->get('blood_pressure'),
                'reason'=>$request->get('reason'),
                'pet_id'=>$request->get('pet_id'),
                'schenduling_by'=>$request->get('schenduling_by'),
                'assigned_to'=>$request->get('assigned_to'),
                'hear_rate'=>$request->get('hear_rate'),
                'observations'=>$request->get('observations'),
                'status'=>$request->get('status'),
                'breathing_frequency'=>$request->get('breathing_frequency'),
                'body_temperatura'=>$request->get('body_temperatura'),
                'history_clinic_url'=>$request->get('history_clinic_url'),
                'schedule_id'=>$request->get('schedule_id'),
               
   
               
               ]);

               $newGeneral_consultation->save();
               $resultResponse->setData($newGeneral_consultation);
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
           
             $general_consultation=general_consultation::findOrFail($id);
             $resultResponse->setData($general_consultation);
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
    public function edit(general_consultation $general_consultation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $this->validateGeneral_consultation($request);
        $resultResponse=new ResultResponse();
        try{
           
            $general_consultation=general_consultation::findOrFail($id);
            $general_consultation->blood_pressure=$request->get('blood_pressure');
            $general_consultation->reason=$request->get('reason');
            $general_consultation->pet_id=$request->get('pet_id');
            $general_consultation->schenduling_by=$request->get('schenduling_by');
            $general_consultation->assigned_to=$request->get('assigned_to');
            $general_consultation->hear_rate=$request->get('hear_rate');
            $general_consultation->observations=$request->get('observations');
            $general_consultation->observations=$request->get('status');
            $general_consultation->assigned_to=$request->get('breathing_frequenc');
            $general_consultation->hear_rate=$request->get('body_temperatura');
            $general_consultation->observations=$request->get('history_clinic_url');
            $general_consultation->observations=$request->get('schedule_id');

           

            $general_consultation->save();               
            $resultResponse->setData($general_consultation);
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
           
            $general_consultation=general_consultation::findOrFail($id);
            $general_consultation->delete();               
            $resultResponse->setData($general_consultation);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exeption $e){
              $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
              $resultResponse->setMessage(ResultResponse::TXT__ELEMENT_NOT_FOUND_CODE);
           }

           return response()->json($resultResponse);

    }
}
