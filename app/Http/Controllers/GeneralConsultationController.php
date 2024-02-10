<?php

namespace App\Http\Controllers;

use App\Models\general_consultation;
use App\Models\pet;
use App\Models\employee;
use App\Models\consultation_schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Custom\ResultResponse;

class GeneralConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       
        $general_consultation = general_consultation::with('pets','employes_schenduling_by','medico')->paginate(10); 
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
        
        $resultResponse=new ResultResponse();
          try{

            $mensaje=$this->validateGeneral_consultation($request); 
           //   
            if($mensaje['estado']){ 

               $newGeneral_consultation=new general_consultation([
                'blood_pressure'=>$request->get('blood_pressure'),
                'reason'=>$request->get('reason'),
                'pet_id'=>$request->get('pet_id'),
                'schenduling_by'=>$request->get('schenduling_by'),
                'assigned_to'=>$request->get('assigned_to'),
                'heart_rate'=>$request->get('heart_rate'),
                'observations'=>$request->get('observations'),
                'status'=>$request->get('status'),
                'breathing_frequency'=>$request->get('breathing_frequency'),
                'body_temperatura'=>$request->get('body_temperatura'),
                'history_clinic_url'=>$request->get('history_clinic_url'),
                'appointment_date'=>$request->get('appointment_date'),               
               ]);

               $newGeneral_consultation->save();

               /*$shedule=consultation_schedule::find($request->get('schedule_id'));
               $shedule->status=true;
               $shedule->save();*/

               $resultResponse->setData($newGeneral_consultation);
               $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
               $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
              
            }else{

                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
                $resultResponse->setMessage($mensaje['errores']);

            }
            
             }catch(\Exception $e){
                $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
               // $resultResponse->setMessage(ResultResponse::TXT_ERROR_CODE);
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
             $general_consultation = general_consultation::with('pets','employes_schenduling_by','medico')->findOrFail($id); 
             $resultResponse->setData($general_consultation);
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
            $general_consultation->heart_rate=$request->get('heart_rate');
            $general_consultation->observations=$request->get('observations');
            $general_consultation->status=$request->get('status');
            $general_consultation->breathing_frequency=$request->get('breathing_frequency');
            $general_consultation->body_temperatura=$request->get('body_temperatura');
            $general_consultation->history_clinic_url=$request->get('history_clinic_url');
            $general_consultation->appointment_date=$request->get('appointment_date');

           
            $general_consultation->save();               
            $resultResponse->setData($general_consultation);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
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
           
            $general_consultation=general_consultation::findOrFail($id);
            $general_consultation->delete();               
            $resultResponse->setData($general_consultation);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exception $e){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUNT_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUNT_CODE);
           }

           return response()->json($resultResponse);

    }

    private function validateGeneral_consultation(Request $request){



       $rules=[
            'blood_pressure'=>'required|string',
            'reason'=>'required|string',
            'pet_id'=>'required|integer|exists:pets,id',
            'schenduling_by'=>'required|integer|exists:employees,id',
            'assigned_to'=>'required|integer|exists:employees,id',
            'heart_rate'=>'required|integer',
            'observations'=>'required|string',
            'status'=>'required|integer',
            'breathing_frequency'=>'required|integer',
            'body_temperatura'=>'required|integer',
            'history_clinic_url'=>'required|string',
            'appointment_date'=>'required|date',               
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
