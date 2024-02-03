<?php

namespace App\Http\Controllers;

use App\Models\consultation_schedule;
use Illuminate\Http\Request;
use App\Custom\ResultResponse;

class ConsultationScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $consultation_schedule=consultation_schedule::all();
        $resultResponse=new ResultResponse();
        $resultResponse->setData($consultation_schedule);
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
        $this->validateconsultation_schedulet($request);    
        $resultResponse=new ResultResponse();
          try{
               $newConsultation_schedule=new consultation_schedule([
                'day_of_week'=>$request->get('day_of_week'),
                'start_time'=>$request->get('start_time'),
                'end_time'=>$request->get('end_time'),
                'appointment_duration'=>$request->get('appointment_duration'),
                'month'=>$request->get('month'),
                'year'=>$request->get('year'),
                'status'=>$request->get('status'),

               ]);

               $newConsultation_schedule->save();
               $resultResponse->setData($newConsultation_schedule);
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
           
             $consultation_schedule=consultation_schedule::findOrFail($id);
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
    public function edit(consultation_schedule $consultation_schedule)
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
           
            $consultation_schedule=consultation_schedule::findOrFail($id);
            $consultation_schedule->day_of_week=$request->get('day_of_week');
            $consultation_schedule->start_time=$request->get('start_time');
            $consultation_schedule->end_time=$request->get('end_time');
            $consultation_schedule->appointment_duration=$request->get('appointment_duration');
            $consultation_schedule->month=$request->get('month');
            $consultation_schedule->year=$request->get('year');
            $consultation_schedule->status=$request->get('status');
     
           
            $consultation_schedule->save();               
            $resultResponse->setData($consultation_schedule);
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
           
            $consultation_schedule=consultation_schedule::findOrFail($id);
            $consultation_schedule->delete();               
            $resultResponse->setData($consultation_schedule);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exeption $e){
              $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
              $resultResponse->setMessage(ResultResponse::TXT__ELEMENT_NOT_FOUND_CODE);
           }

           return response()->json($resultResponse);
    }
}
