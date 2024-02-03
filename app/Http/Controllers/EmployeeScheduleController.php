<?php

namespace App\Http\Controllers;

use App\Models\employee_schedule;
use Illuminate\Http\Request;
use App\Custom\ResultResponse;

class EmployeeScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employee_schedule=employee_schedule::all();
        $resultResponse=new ResultResponse();
        $resultResponse->setData($employee_schedule);
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
        $this->validateEmployee_schedule($request);    
        $resultResponse=new ResultResponse();
          try{
               $newEmployee_schedule=new employee_schedule([
    
                'employee_id'=>$request->get('employee_id'),
                'schedule_id'=>$request->get('schedule_id'),
               
               ]);

               $newEmployee_schedule->save();
               $resultResponse->setData($newEmployee_schedule);
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
           
             $employee_schedule=employee_schedule::findOrFail($id);
             $resultResponse->setData($employee_schedule);
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
    public function edit(employee_schedule $employee_schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $this->validateEmployee($request);
        $resultResponse=new ResultResponse();
        try{
           
            $employee_schedule=employe_schedule::findOrFail($id);
            $employee_schedule->employee_id=$request->get('employee_id');
            $employee_schedule->schedule_id=$request->get('schedule_id');
          

            $employee_schedule->save();               
            $resultResponse->setData($employee_schedule);
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
           
            $employee_schedule=employee_schedule::findOrFail($id);
            $employee_schedule->delete();               
            $resultResponse->setData($employee_schedule);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exeption $e){
              $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
              $resultResponse->setMessage(ResultResponse::TXT__ELEMENT_NOT_FOUND_CODE);
           }

           return response()->json($resultResponse);
        

    }

    private function validateEmployee_schedule(Request $request){
    }
}
