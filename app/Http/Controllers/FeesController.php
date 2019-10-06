<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FeesController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fee = DB::table('fees')->join('student',function($join){
        $join->on('fees.admission_no','=','student.admission_no');})->get();

        return view('pages.fees')->with(['fees'=>$fee]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'amount'=> 'numeric',
        ]);


        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        $adm = request()->get('admission');

        if(!DB::table('student')->where('admission_no', $adm)->exists()){
            return response()->json(['errors'=>'the admission does not exist']);
        }



        //create new a new request
        $user_id = auth()->user()->user_id;
        DB::table('fees')->insert(['amount_paid' => request()->get('amount'),'description' => request()->get('description'),'admission_no' => request()->get('admission'),
        'receiver_id' => $user_id,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showName($id){
        $users = DB::table('student')->select(DB::raw('CONCAT(first_name," ",surname )as names'))->where('student_id',$id)->first();

        return response()->json(['name'=>$users]);

    }

    public function getFeeTable(){
        $fee = DB::table('fees')->join('student','fees.admission_no','=','student.admission_no')->select('fees.admission_no',DB::raw('CONCAT(first_name," ",surname )as names'),'amount_paid','description','fees.created_at')->get();

        return response()->json(['data'=>$fee]);
    }
}
