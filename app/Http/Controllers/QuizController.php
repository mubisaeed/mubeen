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
        $cdate = \Carbon\Carbon::now();
        $date = $cdate->toDateString();
        $quizzes = DB::table('quizzes')->where('course_id', $id)->where('quiz_date', $date)->whereNotIn('id', $quizzes)->orderBy('id', 'desc')->get()->all();
        
        $ctime = \Carbon\Carbon::now();
        $time = $ctime->toTimeString();

        return view('quizzes.student_quizzes', compact('quizzes', 'time', 'date'));
    }

    public function show_quiz_to_student($id)
    {
        $id = $id;
        $questions = DB::table('quiz_questions')->where('quiz_id', $id)->orderBy('sort_order', 'desc')->get()->all();
        
        $quiz_details  = DB::table('quizzes')->where('id', $id)->orderBy('id', 'desc')->get()->first();        
        return view ('quizzes.show_quiz_to_student', compact('questions', 'id', 'quiz_details'));
    }
    public function solved_quiz_by_student(Request $request)
    {
        $quiz_id = $request->quiz_id;
        $no_of_questions = $request->question_id;
        foreach($no_of_questions as $q)
        {    
            $question = DB::table('questions')->where('id', $q)->get()->first();
            
            if( $question->type == 'question/answer' )
            {
                $correct = $request->ans;
            }
            
            elseif($question->type == 't/f')
            {
                $correct = $request->input('correcttf'.$question->id);
            }
            
            elseif($question->type == 'mcq')
            {
                $crct = $request->input('correct'.$question->id);
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

        $quiz_questions = DB::table('solved_quizzes')->where('solved_quizzes.quiz_id', $quiz_id)->where('student_id', Auth::user()->id)->join('questions', 'questions.id', 'solved_quizzes.question_id')->get()->unique();

            $qstn_marks = DB::table('obtained_marks_quiz')->where('s_u_id', Auth::user()->id)->where('quiz_id', $quiz_id)->get()->first();
            
            if($qstn_marks == null)
            {
                $obtained_marks = array(
                    's_u_id' => Auth::user()->id,
                    'quiz_id' => $quiz_id,
                    'mcq_marks' => 0,
                    'tf_marks' => 0,
                    'questions_marks' => 0,
                );
                $success = DB::table('obtained_marks_quiz')->insert($obtained_marks);

                foreach($quiz_questions as $qq)
                {
                    if($qq->type == 'question/answer' )
                    {
                        $correct = $qq->options;
                        $correct_option = $qq->correct;
                        if($correct == $correct_option)
                        {
                            
                            $qmarks = $obtained_marks['questions_marks'];
                            $marks = DB::table('quizzes')->where('id', $quiz_id)->get()->first();
                            $qa_marks = $marks->mr_per_qa;
                            $final_q_marks = $qmarks + $qa_marks;

                            $success = DB::table('obtained_marks_quiz')->where('s_u_id', Auth::user()->id)->where('quiz_id', $quiz_id)->update([
                                's_u_id' => Auth::user()->id,
                                'quiz_id' => $quiz_id,
                                'questions_marks' => $final_q_marks,
                            ]);
                        }
                        else
                        {
                            $qmarks = $obtained_marks['questions_marks'];
                            $success = DB::table('obtained_marks_quiz')->where('s_u_id', Auth::user()->id)->where('quiz_id', $quiz_id)->update([
                                    'questions_marks' => $qmarks,
                                ]);

                        }
                    }
                    elseif($qq->type == 'mcq')
                    {
                        $q_type = $qq->type;
                            
                        $qstn_option = unserialize($qq->options);

                        $correct_option = unserialize($qq->correct);  
                        foreach($qstn_option['correct'] as $corr)
                        {
                            $correct = $qstn_option[$corr];
                            foreach($correct_option as $cp)
                            {

                                if($correct == $cp)
                                {
                                    $q_type = $qq->type;
                                    $mcqmarks = $obtained_marks['mcq_marks'];
                                    $marks = DB::table('quizzes')->where('id', $quiz_id)->get()->first();
                                    $mcq_marks = $marks->mr_per_mcq;
                                    $final_m_marks = $mcqmarks + $mcq_marks;

                                    $success = DB::table('obtained_marks_quiz')->where('s_u_id', Auth::user()->id)->where('quiz_id', $quiz_id)->update([
                                        's_u_id' => Auth::user()->id,
                                        'quiz_id' => $quiz_id,
                                        'mcq_marks' => $final_m_marks,
                                    ]);
                                }
                    
                                else
                                {
                                    $q_type = $qq->type;
                                    $mcqmarks = $obtained_marks['mcq_marks'];
                                    $success = DB::table('obtained_marks_quiz')->where('s_u_id', Auth::user()->id)->where('quiz_id', $quiz_id)->update([
                                            'mcq_marks' => $mcqmarks,
                                        ]);

                                }
                            }
                        }
                    }
                    else
                    {

                        $qstn_option = unserialize($qq->options);
                        $correct_option = $qq->correct;
                          if($qstn_option['correct'] == $correct_option)
                            {
                                $tfmarks = $obtained_marks['tf_marks'];
                                $marks = DB::table('quizzes')->where('id', $quiz_id)->get()->first();
                                $tf_marks = $marks->mr_per_tf;
                                $final_tf_marks = $tfmarks + $tf_marks;

                                $success = DB::table('obtained_marks_quiz')->where('s_u_id', Auth::user()->id)->where('quiz_id', $quiz_id)->update([
                                    's_u_id' => Auth::user()->id,
                                    'quiz_id' => $quiz_id,
                                    'tf_marks' => $final_tf_marks,
                                ]);
                            }
                
                            else
                            {
                                $tfmarks = $obtained_marks['tf_marks'];
                                $success = DB::table('obtained_marks_quiz')->where('s_u_id', Auth::user()->id)->where('quiz_id', $quiz_id)->update([
                                        'tf_marks' => $tfmarks,
                                    ]);

                            }
                    } 
                }
            }

            $quiz = DB::table('obtained_marks_quiz')->where('s_u_id', Auth::user()->id)->where('quiz_id', $quiz_id)->get()->first();
        
            $mcq_marks = $quiz->mcq_marks;
            $tf_marks = $quiz->tf_marks;
            $qa_marks = $quiz->questions_marks;

            $total_marks = $mcq_marks + $tf_marks + $qa_marks;

            $original_quiz_marks = DB::table('quizzes')->where('id', $quiz_id)->get()->first();
            $original_mcq_marks = $original_quiz_marks->mr_per_mcq; 
            $original_tf_marks = $original_quiz_marks->mr_per_tf; 
            $original_qa_marks = $original_quiz_marks->mr_per_qa; 

            
            $no_of_qa = 0;
            $no_of_mcq = 0;
            $no_of_tf = 0;
            foreach ($quiz_questions as $q) 
            {


                if($q->type == 'question/answer')
                {
                    $no_of_qa = $no_of_qa + 1;
                }

                elseif($q->type == 'mcq')
                {
                    $no_of_mcq = $no_of_mcq + 1;
                }

                else
                {
                    $no_of_tf = $no_of_tf + 1;
                }
            }

            $original_qa_marks = $no_of_mcq * $original_qa_marks;
            $original_mcq_marks = $no_of_mcq * $original_mcq_marks;
            $original_tf_marks = $no_of_mcq * $original_tf_marks;

            $original_marks = $original_qa_marks + $original_mcq_marks + $original_tf_marks;

            $percntage = $total_marks/$original_marks * 100;

             $success = DB::table('obtained_marks_quiz')->where('s_u_id', Auth::user()->id)->where('quiz_id', $quiz_id)->update([
                        'total_marks' => $total_marks,
                        'percentage' => $percntage,
                    ]);
        
            Session::flash('message', 'Quiz submitted successfully');
            return redirect('/classes');
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
        $coursequiz = DB::table('quizzes')->where('course_id', $id)->pluck('id');
        $quizzes = DB::table('solved_quizzes')->whereIn('quiz_id', $coursequiz)->where('student_id', Auth::user()->id)->orderBy('id', 'desc')->pluck('quiz_id')->unique();
        return view('quizzes.solved_quizzes', compact('quizzes'));
    }

    public function solved_quiz_result($id)
    {
        $quiz = DB::table('obtained_marks_quiz')->where('s_u_id', Auth::user()->id)->where('quiz_id', $id)->get()->first();
        
        $total_marks = $quiz->total_marks;

        $percentage = $quiz->percentage;

        return view('quizzes.solved_quizzes_obtained_marks', compact('total_marks', 'percentage'));
    }



    public function addquestion_to_quiz($insid, $cid, $week, $qid)
    {
        $quiz_id = $qid;
        $qs = DB::table('quiz_questions')->pluck('question_id');
        $questions = DB::table('questions')->whereNotIn('id', $qs)->where('instructor_id', $insid)->where('course_id', $cid)->where('week', $week)->get()->all();
        $coursequiz = DB::table('quizzes')->where('id', $qid)->get()->first();
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
