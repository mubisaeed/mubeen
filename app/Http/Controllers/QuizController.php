<?php

namespace App\Http\Controllers;


use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function student_quizzes($id)
    {
        $quizzes = DB::table('solved_quizzes')->pluck('quiz_id');
        $quizzes = DB::table('quizzes')->where('course_id', $id)->whereNotIn('id', $quizzes)->orderBy('id', 'desc')->get()->all();
        return view('quizzes.student_quizzes', compact('quizzes'));
    }

    public function show_quiz_to_student($id)
    {
        $id = $id;
        $questions = DB::table('quiz_questions')->where('quiz_id', $id)->orderBy('sort_order', 'desc')->get()->all();
        $quiz_details  = DB::table('quizzes')->where('id', $id)->get()->first();        
        return view ('quizzes.show_quiz_to_student', compact('questions', 'id', 'quiz_details'));
    }
    public function solved_quiz_by_student(Request $request)
    {
        $quiz_id = $request->quiz_id;
        $no_of_questions = $request->question_id;
        foreach($no_of_questions as $q)
        {    
            $question = DB::table('questions')->where('id', $q)->get()->first();
            if($question->type == 'question/answer')
            {
                $correct = $request->ans;
            }
            elseif($question->type == 't/f')
            {
                $correct = $request->correcttf;
            }
            elseif($question->type == 'mcq')
            {
                $crct = $request->correct1;
                $correct = serialize($crct);
            }
            $data = array(
                'quiz_id' => $quiz_id,
                'question_id' => $q,
                'correct' => $correct,
                'student_id' => Auth::user()->id,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            );
            $success = DB::table('solved_quizzes')->insert($data);
        }
        if($success){
            Session::flash('message', 'Quiz submitted successfully');
            return redirect('/course');
        }else{
            Session::flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function index($id)
    {
        $quizzes = DB::table('quizzes')->where('instructor_id', Auth::user()->id)->where('course_id', $id)->orderBy('id', 'desc')->get();
        $course_id = $id;
        $instructor_id =  Auth::user()->id;
        return view('quizzes.index', compact('quizzes', 'course_id', 'instructor_id'));
    }

    public function show_solved_quiz($id)
    {
        // dd('sddsf');
        $coursequiz = DB::table('quizzes')->where('course_id', $id)->pluck('id');
        $quizzes = DB::table('solved_quizzes')->whereIn('quiz_id', $coursequiz)->where('student_id', Auth::user()->id)->pluck('quiz_id')->unique();
        return view('quizzes.solved_quizzes', compact('quizzes'));
    }

    public function solved_quiz_result($id)
    {
        // dd($id);
        // $quiz_questions = DB::table('solved_quizzes')->where('quiz_id', $id)->get()->pluck('question_id');
        $quiz_questions = DB::table('solved_quizzes')->select('question_id','correct')->where('quiz_id', $id)->get()->unique();
        dd($quiz_questions);
        $qstn = DB::table('questions')->whereIn('id', $quiz_questions)->get()->first();
        $qstn_options = $qstn->options;
        if($qstn->type == 'question/answer')
        {
            $correct = $qstn_options;
        }
        else
        {
            $qstn_option = unserialize($qstn_options);
            foreach($qstn_option['correct'] as $corr)
            {
                $correct = $qstn_option[$corr];
            }
        }
        
    }

    public function addquestion_to_quiz($id)
    {
        $quiz_id = $id;
        $qs = DB::table('quiz_questions')->pluck('question_id');
        $questions = DB::table('questions')->whereNotIn('id', $qs)->get()->all();
        $coursequiz = DB::table('quizzes')->where('id', $id)->get()->first();
        $course = DB::table('courses')->where('id', $coursequiz->course_id)->get()->first();
        // dd($course);
        return view ('quizzes.addquestion', compact('questions', 'quiz_id', 'course'));
    }

    public function storequestion_to_quiz(Request $request)
    {
        if(!empty($request->question_id))
        {
             $so = '1';
            foreach( $request->question_id  as $question_id)
            {
                $quiz_questions = array(
                    'quiz_id' => $request->quiz_id,
                    'question_id' => $question_id,
                    'sort_order' => $so,
                );
                $so++;
                DB::table('quiz_questions')->insert($quiz_questions);
            }
          Session::flash('message', 'Selected questions added to quiz.');
          return redirect()->back();
        }
       else
        {
           Session::flash('message', 'No Question Selected');

            return back();
        }
    }

    public function show_quiz($id)
    {
        $questions = DB::table('quiz_questions')->where('quiz_id', $id)->orderBy('sort_order', 'desc')->get()->all();
        $quiz_details  = DB::table('quizzes')->where('id', $id)->get()->first();        
        return view ('quizzes.show_quiz', compact('questions', 'id', 'quiz_details'));
    }

    public function create($insid, $cid, $week)
    {
            // $quiz= new Quiz;
    
            // $table = $quiz->getTable();
            
            // $columns  = \Schema::getColumnListing($table);

            // dd($columns);
        $instructor_id = $insid;
        $week = $week;

        $course = DB::table('courses')->where('id',$cid)->first();
        return view ('quizzes.create', compact('course', 'instructor_id', 'week'));
    }


    public function store(Request $request)
    {
        $quiz = array(
            'quiz_date' => $request->date,
            'negative_marking' => $request->nm,
            'name' => $request->name,
            'duration' => $request->duration,
            'start_time' => $request->stime,
            'end_time' => $request->etime,
            'mr_per_mcq' => $request->mcqmarks,
            'mr_per_qa' => $request->qmarks,
            'mr_per_tf' => $request->tfmarks,
            'week' => $request->week,
            'instructor_id' => Auth::user()->id,
            'course_id' => $request->course_id,
        );
        $success = DB::table('quizzes')->insert($quiz);
        if($success){
            Session::flash('message', 'Quiz created successfully');
            return redirect('/course/show_week_details/'. $request->instructor_id .'/'. $request->course_id .'/'. $request->week);
        }else{
            Session::flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $quiz = DB::table('quizzes')->where('id', $id)->get()->first();

        $week = $quiz->week;
        $course = DB::table('quizzes')->where('instructor_id', Auth::user()->id)->where('id', $id)->pluck('course_id');
        $qcourse = DB::table('courses')->where('id', $course)->get()->first();

        $instructor_id = Auth::user()->id;

        return view('quizzes.edit', compact('quiz', 'qcourse', 'instructor_id', 'week'));
    }

    public function update(Request $request, $id)
    {
        $success = DB::table('quizzes')->where('id', $id)->update([
            'quiz_date' => $request->input('date'),
            'negative_marking' => $request->input('nm'),
            'name' => $request->input('name'),
            'week' => $request->week,
            'duration' => $request->input('duration'),
            'start_time' => $request->input('stime'),
            'end_time' => $request->input('etime'),
            'mr_per_mcq' => $request->input('mcqmarks'),
            'mr_per_qa' => $request->input('qmarks'),
            'mr_per_tf' => $request->input('tfmarks'),
        ]);
        if($success){
            Session::flash('message', 'Quiz Updated successfully');
            return redirect('/course/show_week_details/'. $request->instructor_id .'/'. $request->course_id .'/'. $request->week);
        }else{
            Session::flash('message', 'Something went wrong');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        DB::table('quizzes')->where('id',$id)->delete();

        Session::flash('message', 'Quiz deleted successfully');
    }

    public function search_by_week($insid, $courseid, $week)
    {
        $week = $week;
        $course_id = $courseid;
        $instructor_id = $insid;

        $quizzes = DB::table('quizzes')->where('instructor_id', $instructor_id)->where('course_id', $course_id)->where('week', $week)->orderBy('id', 'desc')->get();
        return view('quizzes.index', compact('quizzes', 'course_id', 'instructor_id'));

    }
}
