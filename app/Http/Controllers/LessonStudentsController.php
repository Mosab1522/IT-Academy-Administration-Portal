<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class LessonStudentsController extends Controller
{
    public function store()
    {
       
        $attributes = request()->validate([
            'who' => ['required','in:,1,2'],
        'students' => ['array','required_if:who,2'],
        'students.*' => 'distinct|exists:students,id',
        'lesson_id' => ['required', 'integer', Rule::exists('lessons', 'id' )]
        ]);

        $lesson = Lesson::find($attributes['lesson_id']);
        if ($attributes['who'] == '1')
        {
            
            $class = $lesson->class;
            
            if($class->students->count() > 0)
            {
                
                    $counter =0;
                    
                    foreach ($lesson->class->students as $student){
                    if (!$lesson->students->contains('id', $student->id))
                {
                    $counter ++;
                
                    }
            }if ($counter == 0){
                throw ValidationException::withMessages(['who' => ' Všetci študenti triedy sú už zapísaný ako zúčastnení.']);
            }


                 foreach ($class->students as $student) {
                    if (!$lesson->students->contains('id', $student->id))
                {
                    $lesson->students()->save($student);
                }
            }
            }else{
                throw ValidationException::withMessages(['who' => 'V triede nieje žiaden študent.']);
            }
           
        }else if ($attributes['who'] == '2')
        {
            foreach ($attributes['students'] as $studentID) {
                $student = Student::find($studentID);
                if ($student) {
                    $lesson->students()->save($student);
                }
            }
        
        }

        return back()->with('success_cc', 'Úspešne vytvorené');
        
      
    }

    public function destroy(Student $student, Lesson $lesson)
    {
        $lesson->students()->detach($student['id']);

        return back()->with('success_dd', 'Úspešne vymazané');
    }
}
