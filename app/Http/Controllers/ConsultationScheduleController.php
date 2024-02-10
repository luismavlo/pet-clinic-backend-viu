<?php

namespace App\Http\Controllers;

use App\Models\consultation_schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Custom\ResultResponse;

class ConsultationScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $consultation_schedule = consultation_schedule::with('employees')->paginate(10); 
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
          
        $resultResponse=new ResultResponse();
          try{

             

            $mensaje=$this->validateConsultation_schedulet($request);
            //   
             if($mensaje['estado']){ 

               $newConsultation_schedule=new consultation_schedule([
                'start_date'=>$request->get('start_date'),
                'end_date'=>$request->get('end_date'),
                'appointment_duration'=>$request->get('appointment_duration'),
                'start_hour'=>$request->get('start_hour'),
                'shift_duration'=>$request->get('shift_duration'),
                'end_hour'=>$request->get('end_hour'),
                'employee_id'=>$request->get('employee_id'),


               ]);

            
               $newConsultation_schedule->save();
               $resultResponse->setData($newConsultation_schedule);
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
           
            
             $consultation_schedule = consultation_schedule::with('employees')->findOrFail($id);
             $resultResponse->setData($consultation_schedule);
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
      
        $resultResponse=new ResultResponse();
        try{
           

            $mensaje=$this->validateConsultation_schedulet($request);
            //   
             if($mensaje['estado']){ 

                $consultation_schedule=consultation_schedule::findOrFail($id);
                $consultation_schedule->start_date=$request->get('start_date');
                $consultation_schedule->end_date=$request->get('end_date');
                $consultation_schedule->appointment_duration=$request->get('appointment_duration');
                $consultation_schedule->start_hour=$request->get('start_hour');
                $consultation_schedule->shift_duration=$request->get('shift_duration');
                $consultation_schedule->end_hour=$request->get('end_hour');
                $consultation_schedule->employee_id=$request->get('employee_id');
    
                $consultation_schedule->save();               
                $resultResponse->setData($consultation_schedule);
    

        }else{

            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($mensaje['errores']);

        }

          
           }catch(\ExCeption $e){
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
           
            $consultation_schedule=consultation_schedule::findOrFail($id);
            $consultation_schedule->delete();               
            $resultResponse->setData($consultation_schedule);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exception $e){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUNT_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUNT_CODE);
           }

           return response()->json($resultResponse);
    }



    private function validateConsultation_schedulet(Request $request){
     
        $rules=[
            
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'appointment_duration'=>'required|integer',
            'start_hour'=>'required|string',
            'shift_duration'=>'required|integer',
            'end_hour'=>'required|string',
            'employee_id'=>'required|integer|exists:employees,id',           


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
