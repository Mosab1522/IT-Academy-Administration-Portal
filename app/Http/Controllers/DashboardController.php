<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationMail;
use App\Mail\CustomMail;
use App\Models\Application;
use App\Models\Academy;
use App\Models\CourseClass;
use App\Models\CourseType;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Eager load related models to reduce queries
        // $query = Application::with(['academy', 'coursetype', 'student']);

        // // Apply filters based on request parameters using "when"
        // $query->when($request->filled('academy_id'), function ($q) use ($request) {
        //     $q->where('academy_id', $request->academy_id);
        // });

        // $query->when($request->filled('coursetype_id'), function ($q) use ($request) {
        //     $q->where('coursetype_id', $request->coursetype_id);
        // });

        // $query->when($request->filled('search'), function ($q) use ($request) {
        //     $q->whereHas('student', function ($q) use ($request) {
        //         $q->where('name', 'like', "%{$request->search}%")
        //           ->orWhere('lastname', 'like', "%{$request->search}%")
        //           ->orWhere('email', 'like', "%{$request->search}%");
        //     })->orWhereHas('academy', function ($q) use ($request) {
        //         $q->where('name', 'like', "%{$request->search}%");
        //     })->orWhereHas('coursetype', function ($q) use ($request) {
        //         $q->where('name', 'like', "%{$request->search}%");
        //     });
        // });

        // $applications = $query->orderByDesc('created_at')->get();

        // // Group by 'coursetype.name' and 'academy.name' after retrieval
        // $groupedApplications = $applications->groupBy(['coursetype.name', 'academy.name']);

        // $academies = Academy::all();


        $query = CourseType::with(['academy', 'applications']);


        $query->when($request->filled('academy_id'), function ($q) use ($request) {
            $q->where('academy_id', $request->academy_id);
        });

        $query->when($request->filled('coursetype_id'), function ($q) use ($request) {
            $q->where('id', $request->coursetype_id);
        });

        if ($request->input('orderBy') === 'most_applicants' || $request->input('orderBy') === 'less_applicants') {
            $query->withCount('applications')
                ->orderBy('applications_count', $request->input('orderBy') === 'most_applicants' ? 'desc' : 'asc');
        }else if ($request->input('orderBy') === 'latest') {
            $query = $query->orderByDesc(function ($query) {
                $query->select('created_at')
                    ->from('applications')
                    ->whereColumn('coursetype_id', 'course_types.id')
                    ->latest()
                    ->limit(1);
            });
        }else if ($request->input('orderBy') === 'oldest') {
            $query = $query->orderBy(function ($query) {
                $query->select('created_at')
                    ->from('applications')
                    ->whereColumn('coursetype_id', 'course_types.id')
                    ->latest()
                    ->limit(1);
            });
        } else {
            $query = $query->orderByDesc(function ($query) {
                $query->select('created_at')
                    ->from('applications')
                    ->whereColumn('coursetype_id', 'course_types.id')
                    ->latest()
                    ->limit(1);
            });
        }
        $query->when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = "%{$request->search}%";
            $q->where('name', 'like', $searchTerm)  // Search in CourseType name
              ->orWhereHas('academy', function ($query) use ($searchTerm) {
                  $query->where('name', 'like', $searchTerm);  // Search in related Academy name
              });
            
        });
        

     

        $coursetypes = $query->get();

        return view('admin.dashboard-index', [
            'coursetypes' => $coursetypes
        ]);
    }
    public function calendar(Request $request)

    {
        return view('admin.calendar-index', []);
    }

    public function email(Request $request)

    {
        return view('admin.email-index', []);
    }

    public function send(Request $request)

    {
        $attributes = request()->validate([
            'sender' => ['in:on'],
            'sendername' => ['required_if:sender,on','nullable', 'string', 'max:255'],
            'recipients' => ['nullable', 'json'],
            'emailText' => ['required', 'string']
        ]);

        if (isset($_POST['recipients'])) {
            $recipients = json_decode($_POST['recipients'], true);  // Decode the JSON string back into an array
            if(!$recipients)
            {
                throw ValidationException::withMessages(['recipients' => 'Vyberte príjmateľa.']);
            }
            $allId=0;
            $formattedEmailText = nl2br(htmlspecialchars($_POST['emailText']));
            $emails = [];
            // Initialize arrays to hold IDs by type
            $classIds = [];
            $studentsIds = []; // Example for other types
            $instructorsIds = [];
            $academiesIds = [];
            $icoursetypesIds = [];
            $scoursetypesIds = [];

            foreach ($recipients as $recipient) {
                list($id, $type) = explode('-', $recipient);  // Split the string into id and type
                switch ($type) {
                    case 'all_id':
                        $allId= $id;
                        break;
                    case 'class_id':
                        $classIds[] = $id;
                        break;
                    case 'student_id':
                        $studentsIds[] = $id;
                        break;
                    case 'instructor_id':
                        $instructorsIds[] = $id;
                        break;
                    case 'academy_id':
                        $academiesIds[] = $id;
                        break;
                    case 'coursetype_id':
                        $icoursetypesIds[] = $id;
                        break;
                    case 'coursetype_id2':
                        $scoursetypesIds[] = $id;
                        break;
                        // Add more cases as necessary
                }
                if($allId == 3)
                {
                    break;
                }
            }
            if($allId == 3){
                foreach (Instructor::all() as $instructor) {
                    // Correct usage of find method
                    if ($instructor) {  // Check if instructor was found

                        if (!in_array($instructor->email, $emails)) {
                            $emails[] = $instructor->email;  // Add the student's email if it's not already in the array
                        }
                    }
                }
                foreach (Student::all() as $student) {
                    // Correct usage of find method
                    if ($student) {  // Check if student was found

                        if (!in_array($student->email, $emails)) {
                            $emails[] = $student->email;  // Add the student's email if it's not already in the array
                        }
                    }
                }


            }else{ 
                if($allId == 2){
                    foreach (Instructor::all() as $instructor) {
                        // Correct usage of find method
                        if ($instructor) {  // Check if instructor was found
    
                            if (!in_array($instructor->email, $emails)) {
                                $emails[] = $instructor->email;  // Add the student's email if it's not already in the array
                            }
                        }
                    }}
                else if($allId == 1){
                    foreach (Student::all() as $student) {
                        // Correct usage of find method
                        if ($student) {  // Check if student was found
    
                            if (!in_array($student->email, $emails)) {
                                $emails[] = $student->email;  // Add the student's email if it's not already in the array
                            }
                        }
                    }
                }
    
    
                

            if (!empty($classIds) && $allId != 1) {
                foreach ($classIds as $classId) {
                    $class = CourseClass::find($classId);  // Correct usage of find method
                    if ($class) {
                        if ($class->students->count() > 0) { // Check if class was found
                            foreach ($class->students as $student) {
                                if (!in_array($student->email, $emails)) {
                                    $emails[] = $student->email;  // Add the student's email if it's not already in the array
                                }
                            }
                        }
                    }
                }
            }
           
            if (!empty($studentsIds) && $allId != 1) {
                foreach ($studentsIds as $studentId) {
                    $student = Student::find($studentId); 
                    // Correct usage of find method
                    if ($student) {  // Check if student was found

                        if (!in_array($student->email, $emails)) {
                            $emails[] = $student->email;  // Add the student's email if it's not already in the array
                         
                        }
                    }
                }
            }
            if (!empty($instructorsIds) && $allId != 2) {
                foreach ($instructorsIds as $instructorId) {
                    $instructor = Instructor::find($instructorId);  // Correct usage of find method
                    if ($instructor) {  // Check if instructor was found

                        if (!in_array($instructor->email, $emails)) {
                            $emails[] = $instructor->email;  // Add the student's email if it's not already in the array
                        }
                    }
                }
            }
            if (!empty($academiesIds) && $allId != 1) {
                foreach ($academiesIds as $academyId) {
                    $academy = Academy::find($academyId);
                    if ($academy->coursetypes->count() > 0) { // Correct usage of find method
                        foreach ($academy->coursetypes as $coursetype) {
                            if ($coursetype) {  // Check if coursetype was found
                                if ($coursetype->classes->count() > 0) {
                                    foreach ($coursetype->classes as $class) {
                                        if ($class->students->count() > 0) {
                                            foreach ($class->students as $student) {
                                                if (!in_array($student->email, $emails)) {
                                                    $emails[] = $student->email;  // Add the student's email if it's not already in the array
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (!empty($icoursetypesIds) && $allId != 1) {
                foreach ($icoursetypesIds as $coursetypeId) {
                    $coursetype = CourseType::find($coursetypeId);  // Correct usage of find method
                    if ($coursetype) {  // Check if coursetype was found
                        if ($coursetype->classes->count() > 0) {
                            foreach ($coursetype->classes as $class) {
                                if ($class->students->count() > 0) {
                                    foreach ($class->students as $student) {
                                        if (!in_array($student->email, $emails)) {
                                            $emails[] = $student->email;  // Add the student's email if it's not already in the array
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (!empty($scoursetypesIds) && $allId != 1) {
                foreach ($scoursetypesIds as $coursetypeId) {
                    $coursetype = CourseType::find($coursetypeId);  // Correct usage of find method
                    if ($coursetype) {  // Check if coursetype was found
                        if ($coursetype->classes->count() > 0) {
                            foreach ($coursetype->classes as $class) {
                                if ($class->students->count() > 0) {
                                    foreach ($class->students as $student) {
                                        if (!in_array($student->email, $emails)) {
                                            $emails[] = $student->email;  // Add the student's email if it's not already in the array
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
            if ($attributes['sender'] ?? null) {
                $emailData = [
                    'sender' => $attributes['sendername'] . ' - Lektor UCM akadémie',
                    'emailText' => $formattedEmailText
                ];
            } else {
                $emailData = [
                    'sender' => 'UCM akadémie',
                    'emailText' => $formattedEmailText
                ];
            }

            dd($emails);
            if (!empty($emails)) {
                foreach ($emails as $email) {
                    //Mail::to($email)->send(new CustomMail($emailData));
                }
            }else{
                dd($emails);
                throw ValidationException::withMessages(['recipients' => 'Vyberte príjmateľa.']);
            }
            
            return back()->with('success_email', 'Úspešne odoslané emaily.');


            // Now, $items is an array you can iterate over or process

            // Process each item

        } else {
            throw ValidationException::withMessages(['recipients' => 'Vyberte príjmateľa.']);
        }
    }
}
