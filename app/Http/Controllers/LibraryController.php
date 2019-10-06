<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.library');
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
        for ($i=1; $i <= request()->get('total'); $i++) {
            DB::table('books')->updateOrInsert(['title'=> request()->get('title-'.$i),'author'=> request()->get('author-'.$i),
                'subject'=> request()->get('subject-'.$i),'volume'=> request()->get('volume-'.$i),'grade'=> request()->get('grade-'.$i)],
                ['total_number'=> DB::raw('total_number +'.request()->get('copies-'.$i)),'user_id'=>auth()->user()->user_id,
                'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now()]);
        }
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
    public function getTable(){
        $book = DB::table('books')->select('book_id','title','author','subject','grade','volume','books_out','total_number')->get();
        return response()->json(['data'=>$book]);
    }
    public function bookInfo($bookid){
        $book = DB::table('books')->select('book_id','title','author','subject','grade','volume','books_out','total_number')->where('book_id',$bookid)->first();
        $teacher_list = DB::table('library')->select(DB::raw('CONCAT(first_name," ",surname )as name'),'copies','library.created_at')
        ->join('users', 'library.client_id', '=', 'users.user_id')->where('client_type','teacher')->where('book_details',$bookid)->get();
        $student_list = DB::table('library')->select('admission_no',DB::raw('CONCAT(first_name," ",surname )as name'),'copies','library.created_at')
        ->join('student', 'library.client_id', '=', 'student.student_id')->where('client_type','student')->where('book_details',$bookid)->get();

        return response()->json(['book'=>$book,'teacher_list'=>$teacher_list,'student_list'=>$student_list]);
    }
    public function saveLibraryTransaction(Request $request,$id){
        DB::transaction(function () use ($id){
            DB::table('library')->insert(['action'=> request()->get('action'), 'copies'=> request()->get('copies'),
            'client_type'=>request()->get('user_type'),'client_id'=>request()->get('user'),'book_details'=>request()->get('book_id'),
            'user_id'=>auth()->user()->user_id,'updated_at' => \Carbon\Carbon::now(),'created_at' => \Carbon\Carbon::now()]);

            DB::table('books')->where('book_id', $id)->update(['books_out' => DB::raw('books_out +'.request()->get('copies'))]);
        });
    }
    public function fillTeacherselect(){
        $teachers = DB::table('users')->select('user_id',DB::raw('CONCAT(users.first_name," ",users.surname )as name'))->where('class','!=',0)->get();
        return response()->json(['teacher' => $teachers]);
    }
    public function getBorrowerBookList($type,$id){
        $list = DB::table('library')->select('library_id','title','copies','returned',DB::raw('copies - returned as remain'),'library.created_at')->join('books', 'library.book_details', '=', 'books.book_id')
        ->where('client_type',$type)->where('client_id',$id)->where('cleared',0)->get();

        return response()->json(['data' => $list]);
    }
    public function updateReturnedBooks($id,$returned,$status){
        DB::table('library')->where('library_id',$id)->update(['returned' => DB::raw('returned +'.$returned),'cleared' => $status]);
    }
}
