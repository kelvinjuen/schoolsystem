<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Financecontroller extends Controller
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
        return view('pages.finance');
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

        //create new a new request
        $user_id = auth()->user()->user_id;
        echo $user_id;
        DB::table('finance')->insert(['amount' => request()->get('amount'),'description' => request()->get('description-text'),'requested_by' => $user_id ,'department' => request()->get('department'),
        'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now(),
        ]);

        //reload the datatable

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = DB::table('finance')->join('users',function($join){
        $join->on('finance.requested_by','=','users.user_id');})->where('transaction_id',$id)->first();
        return response()->json(['account'=>$account]);
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
        $validator = \Validator::make($request->all(),[
            'status'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        DB::table('finance')->where('transaction_id',$id)->update(['status' => $request->get('status'),'approved_by'=> auth()->user()->user_id,'updated_at'=> \Carbon\Carbon::now()]);
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

    public function setFinanceTable(){
        $exam = [];
        if(auth()->user()->user_type == 'admin'){
            $exam = DB::table('finance')->select('description',DB::raw('CONCAT(first_name," ",surname )as names'),'amount','status','department','finance.created_at','finance.updated_at','transaction_id')->join('users',function($join){
                $join->on('finance.requested_by','=','users.user_id');
            })->get();
        }else{
            $exam = DB::table('finance')->select('description',DB::raw('CONCAT(first_name," ",surname )as names'),'amount','status','department','finance.created_at','finance.updated_at','transaction_id')->join('users',function($join){
                $join->on('finance.requested_by','=','users.user_id');
            })->where('requested_by',auth()->user()->user_id)->get();
        }

        foreach ($exam as &$value) {
            if($value->status == 'pedding'){
                $value->updated_at = 'pending';
            }
        }
        return response()->json(['data'=>$exam]);
    }
}
