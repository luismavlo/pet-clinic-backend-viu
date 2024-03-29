<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Custom\ResultResponse;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
      
        $employee = employee::with('users')->paginate(10); 
        $resultResponse=new ResultResponse();
        $resultResponse->setData($employee);
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

            $mensaje=$this->validateEmployee($request); 
            //   
             if($mensaje['estado']){ 

                $newUser=new User([
                    'name'=>$request->get('name'),
                    'surname'=>$request->get('surname'),
                    'dni'=>$request->get('dni'),
                    'genre'=>$request->get('genre'),
                    'photo'=>$request->get('photo'),
                     ]);

                $newUser->save(); 

                
                $newEmployee=new employee([
                    'occupation'=>$request->get('occupation'),
                     'gross_salary'=>$request->get('gross_salary'),
                     'email'=>$request->get('email'),
                     'password'=>$request->get('password'),
                     'phone'=>$request->get('phone'),
                     'user_id'=>$newUser->id,
                     ]);

                $newEmployee->save();
               $resultResponse->setData($newEmployee);
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
           
             $employee = employee::with('users')->findOrFail($id);
             $resultResponse->setData($employee);
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
    public function edit(employee $employee)
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
           
            $mensaje=$this->validateEmployee($request); 
            //   
             if($mensaje['estado']){ 


            $employee=employee::findOrFail($id);
            $employee->occupation=$request->get('occupation');
            $employee->gross_salary=$request->get('gross_salary');
            $employee->email=$request->get('email');
            $employee->password=$request->get('password');
            $employee->phone=$request->get('phone');
            $employee->user_id=$request->get('user_id');

            $employee->save();               
            $resultResponse->setData($employee);
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
           
            $employee=employee::findOrFail($id);
            $employee->delete();               
            $resultResponse->setData($employee);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
          
           }catch(\Exception $e){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUNT_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUNT_CODE);
           }

           return response()->json($resultResponse);

    }

    private function validateEmployee(Request $request){


        $rules=[

            'name'=>'required|string',
            'surname'=>'required|string',
            'dni'=>'required|string',
            'genre'=>'required|string',
            'photo'=>'required|string',
         
            'occupation'=>'required|string',
            'gross_salary'=>'required',
            'email'=>'required|string',
            'password'=>'required|string',
            'phone'=>'required|string',
           
                                    
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
