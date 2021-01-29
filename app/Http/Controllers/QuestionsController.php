<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{

    public function filterall($id, $qid)
    {
        // dd($id. ' ' .$qid);
        $questions = DB::table('questions')->where('course_id', $id)->get()->all();
        $course = DB::table('courses')->where('id', $id)->get()->first();
        $quiz_id = $qid;
        return view ('quizzes.addquestion', compact('questions', 'course', 'quiz_id'));
    }

    public function filterrecent($id, $qid)
    {
        $questions = DB::table('questions')->where('course_id', $id)->orderBy('created_at', 'desc')->get()->all();
        $course = DB::table('courses')->where('id', $id)->get()->first();
        $quiz_id = $qid;
        return view ('quizzes.addquestion', compact('questions', 'course', 'quiz_id'));
    }

    public function filternotused($id, $qid)
    {
        $qs = DB::table('quiz_questions')->pluck('question_id');
        $questions = DB::table('questions')->where('course_id', $id)->whereNotIn('id', $qs)->get()->all();
        $course = DB::table('courses')->where('id', $id)->get()->first();
        $quiz_id = $qid;
        return view ('quizzes.addquestion', compact('questions', 'course', 'quiz_id'));
    }

    public function mcqcreate($id)
    {
        $user = Auth::user();
        $course = DB::table('courses')->where('id',$id)->first();
        $mcqs = DB::table('questions')->where('type', 'mcq')->where('course_id', $course->id)->get()->all();
        return view ('questions.mcq', compact('user', 'mcqs', 'course'));
    }

    public function mcqstore(Request $request)
    {
        $this->validate($request, [
            'label' => 'required',
            'correct' => 'required',
        ]);

        $user = Auth::user();
        $type = "mcq";
        $carray = $request->input('correct');

        $opts = array(
            'opt1' => $request->input('opt1'),
            'opt2' => $request->input('opt2'),
            'opt3' => $request->input('opt3'),
            'opt4' => $request->input('opt4'),
            'correct' => $carray,
        );

        $mcq = new Question();
        $mcq->label=$request->input('label');
        $mcq->type=$type;
        $mcq->course_id=$request->course_id;
        $mcq->options=serialize($opts);
        $mcq->save();
        Session::flash('message', 'Question create successfully');
        return redirect('/mcq/create/'. $request->course_id);
    }



    public function qcreate($id)
    {
        $user = Auth::user();
        $course = DB::table('courses')->where('id',$id)->first();
        $questions = DB::table('questions')->where('type', 'question/answer')->where('course_id', $course->id)->get()->all();
        return view ('questions.question_answer', compact('user', 'questions', 'course'));
    }

    public function qstore(Request $request)
    {
        $this->validate($request, [
            'label' => 'required',
            'ans' => 'required',
        ]);

        $user = Auth::user();
        $type = "question/answer";

        $q = new Question();
        $q->label=$request->input('label');
        $q->type=$type;
        $q->course_id=$request->course_id;
        $q->options = $request->input('ans');
        $q->save();
        Session::flash('message', 'Question create successfully');
        return redirect('/q/create/'. $request->course_id);
    }


    public function tfcreate($id)
    {
        $user = Auth::user();
        $course = DB::table('courses')->where('id',$id)->first();
        $tfs = DB::table('questions')->where('type', 't/f')->where('course_id', $course->id)->get()->all();
        return view ('questions.tf', compact('user', 'tfs', 'course'));
    }

    public function tfstore(Request $request)
    {
        $user = Auth::user();
        $type = "t/f";

        $carray = $request->input('correct');

        $opts = array(
        	'true' => 'true',
            'false' => 'false',
            'correct' => $carray,
        );

        $tf = new Question();
        $tf->label=$request->input('label');
        $tf->type=$type;
        $tf->course_id=$request->course_id;
        $tf->options=serialize($opts);
        $tf->save();
        Session::flash('message', 'Question create successfully');
        return redirect('/tf/create/'. $request->course_id);
    }

    public function mcq_edit($id, $courseid)
    {
        $courseid = $courseid;
        $mcq = DB::table('questions')->where('id', $id)->get()->first();
        return view('questions.mcq_edit', compact('mcq', 'courseid'));
    }

    public function mcq_update(Request $request, $id)
    {
        $mcq = Question::find($id);
        $this->validate($request, [
            'label' => 'required',
            'ans' => 'required',
        ]);

        $type = "mcq";

        

        $success = $mcq->save();
        if($success){
            Session::flash('message', 'MCQ Updated successfully');
            return redirect('/q/create/'. $request->course_id);
        }else{
            Session::flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function q_edit($id, $courseid)
    {
        $courseid = $courseid;
        $q = DB::table('questions')->where('id', $id)->get()->first();
        return view('questions.q_edit', compact('q', 'courseid'));
    }

    public function q_update(Request $request, $id)
    {

        $q = Question::find($id);
        $this->validate($request, [
            'label' => 'required',
            'ans' => 'required',
        ]);

        $type = "question/answer";

        $q->label=$request->input('label');
        $q->type=$type;
        $q->course_id=$request->input('course_id');
        $q->options=$request->input('ans');

        $success = $q->save();
        if($success){
            Session::flash('message', 'Question Updated successfully');
            return redirect('/q/create/'. $request->course_id);
        }else{
            Session::flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function tf_edit($id, $courseid)
    {
        $courseid = $courseid;
        $tf = DB::table('questions')->where('id', $id)->get()->first();
        return view('questions.tf_edit', compact('tf', 'courseid'));
    }

    public function tf_update(Request $request, $id)
    {
        // dd($request->input('label'));

        $tf = Question::find($id);
        $this->validate($request, [
            'label' => 'required',
            'options' => 'required',
        ]);


        dd($request->input('correct'));
        $opts = array(
            'true' => 'true',
            'false' => 'false',
            'correct' => $request->input('correct'),
        ); 

        dd($opts);
        $type = "t/f";
        $tf->label=$request->input('label');
        $tf->type=$type;
        $tf->course_id=$request->input('course_id');
        $tf->options=serialize($opts);

        $success = $tf->save();
        dd($success);
        if($success){
            Session::flash('message', 'True False Updated successfully');
            return redirect('/q/create/'. $request->course_id);
        }else{
            Session::flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }
}

