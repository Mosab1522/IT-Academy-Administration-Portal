<?php

namespace App\Http\Controllers;

use App\Mail\CustomMail;
use App\Models\Academy;
use App\Models\CourseClass;
use App\Models\CourseType;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Gate::denies('admin')) {
            $authInstructorId = auth()->user()->user_id;
            $query = CourseType::with(['academy', 'applications'])
                ->whereHas('instructors', function ($query) use ($authInstructorId) {
                    $query->where('instructors.id', $authInstructorId);
                });
        } else {
            $query = CourseType::with(['academy', 'applications']);
        }

        $query->when($request->filled('academy_id'), function ($q) use ($request) {
            $q->where('academy_id', $request->academy_id);
        });

        $query->when($request->filled('coursetype_id'), function ($q) use ($request) {
            $q->where('id', $request->coursetype_id);
        });

        if ($request->input('orderBy') === 'most_applicants' || $request->input('orderBy') === 'less_applicants') {
            $query->withCount('applications')
                ->orderBy('applications_count', $request->input('orderBy') === 'most_applicants' ? 'desc' : 'asc');
        } else if ($request->input('orderBy') === 'latest') {
            $query = $query->orderByDesc(function ($query) {
                $query->select('created_at')
                    ->from('applications')
                    ->whereColumn('coursetype_id', 'course_types.id')
                    ->latest()
                    ->limit(1);
            });
        } else if ($request->input('orderBy') === 'oldest') {
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
            $q->where('name', 'like', $searchTerm)
                ->orWhereHas('academy', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', $searchTerm);
                });
        });

        $coursetypes = $query->get();

        return view('admin.dashboard-index', [
            'coursetypes' => $coursetypes
        ]);
    }
    public function calendar()

    {
        return view('admin.calendar-index', []);
    }

    public function email()
    {
        return view('admin.email-index', []);
    }

    public function send()
    {
        $attributes = request()->validate([
            'sender' => ['in:on'],
            'sendername' => ['required_if:sender,on', 'nullable', 'string', 'max:255'],
            'recipients' => ['nullable', 'json', 'required_without:recipient'],
            'recipient' => ['nullable', 'string', 'required_without:recipients'],
            'who' => ['nullable', 'in:1,2'],
            'emailText' => ['required', 'string']
        ], $this->messages());

        if (isset($_POST['who'])) {
            if (isset($_POST['recipient'])) {
                if (!preg_match('/^\d+\-(coursetype_id|academy_id)$/', $attributes['recipient'])) {
                    throw ValidationException::withMessages(['recipient' => 'Zlý typ prijímateľa.']);
                }
            } else {
                throw ValidationException::withMessages(['recipients' => 'Zlý typ prijímateľa.', 'recipient' => 'Vyberte prijímateľa.']);
            }
        }

        if (isset($_POST['recipients']) || isset($_POST['recipient'])) {
            if (isset($_POST['recipients'])) {
                $recipients = json_decode($_POST['recipients'], true);  // Decode the JSON string back into an array
                if (!$recipients) {
                    throw ValidationException::withMessages(['recipients' => 'Vyberte príjmateľa.']);
                }
            }
            if ($attributes['who']) {
                if ($attributes['who'] == '2') {
                    if (preg_match('/^\d+\-(coursetype_id)$/', $attributes['recipient'])) {
                        $attributes['recipient'] = $attributes['recipient'] . '3';
                    } else if (preg_match('/^\d+\-(academy_id)$/', $attributes['recipient'])) {
                        $attributes['recipient'] = $attributes['recipient'] . '2';
                    }
                }
            }
            if (isset($_POST['recipient'])) {
                $recipients[] = $attributes['recipient'];
            }

            $allId = 0;
            $formattedEmailText = nl2br(htmlspecialchars($_POST['emailText']));
            $emails = [];
            $classIds = [];
            $studentsIds = [];
            $instructorsIds = [];
            $academiesIds = [];
            $coursetypesIds = [];
            $academiesIds2 = [];
            $coursetypesIds2 = [];
            $coursetypesIds2 = [];

            foreach ($recipients as $recipient) {
                list($id, $type) = explode('-', $recipient);  // Split the string into id and type
                switch ($type) {
                    case 'all_id':
                        $allId = $id;
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
                    case 'academy_id2':
                        $academiesIds2[] = $id;
                        break;
                    case 'coursetype_id':
                        $coursetypesIds[] = $id;
                        break;
                    case 'coursetype_id2':
                        $coursetypesIds[] = $id;
                        break;
                    case 'coursetype_id3':
                        $coursetypesIds2[] = $id;
                        break;
                    case 'coursetype_id4':
                        $coursetypesIds2[] = $id;
                        break;
                }
                if ($allId == 3) {
                    break;
                }
            }
            if ($allId == 3) {
                foreach (Instructor::all() as $instructor) {
                    if ($instructor) {

                        if (!in_array($instructor->email, $emails)) {
                            $emails[] = $instructor->email;
                        }
                    }
                }
                foreach (Student::all() as $student) {
                    if ($student) {

                        if (!in_array($student->email, $emails)) {
                            $emails[] = $student->email;
                        }
                    }
                }
            } else {
                if ($allId == 2) {
                    foreach (Instructor::all() as $instructor) {
                        if ($instructor) {

                            if (!in_array($instructor->email, $emails)) {
                                $emails[] = $instructor->email;
                            }
                        }
                    }
                } else if ($allId == 1) {
                    foreach (Student::all() as $student) {
                        if ($student) {

                            if (!in_array($student->email, $emails)) {
                                $emails[] = $student->email;
                            }
                        }
                    }
                }




                if (!empty($classIds) && $allId != 1) {
                    foreach ($classIds as $classId) {
                        $class = CourseClass::find($classId);
                        if ($class) {
                            if ($class->students->count() > 0) {
                                foreach ($class->students as $student) {
                                    if (!in_array($student->email, $emails)) {
                                        $emails[] = $student->email;
                                    }
                                }
                            }
                        }
                    }
                }

                if (!empty($studentsIds) && $allId != 1) {
                    foreach ($studentsIds as $studentId) {
                        $student = Student::find($studentId);
                        if ($student) {
                            if (!in_array($student->email, $emails)) {
                                $emails[] = $student->email;
                            }
                        }
                    }
                }
                if (!empty($instructorsIds) && $allId != 2) {
                    foreach ($instructorsIds as $instructorId) {
                        $instructor = Instructor::find($instructorId);
                        if ($instructor) {
                            if (!in_array($instructor->email, $emails)) {
                                $emails[] = $instructor->email;
                            }
                        }
                    }
                }
                if (!empty($academiesIds) && $allId != 1) {
                    foreach ($academiesIds as $academyId) {
                        $academy = Academy::find($academyId);
                        if ($academy->coursetypes->count() > 0) {
                            foreach ($academy->coursetypes as $coursetype) {
                                if ($coursetype) {
                                    if ($coursetype->classes->count() > 0) {
                                        foreach ($coursetype->classes as $class) {
                                            if ($class->students->count() > 0) {
                                                foreach ($class->students as $student) {
                                                    if (!in_array($student->email, $emails)) {
                                                        $emails[] = $student->email;
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
                if (!empty($academiesIds2) && $allId != 1) {
                    foreach ($academiesIds2 as $academyId) {
                        $academy = Academy::find($academyId);
                        if ($academy->applications->count() > 0) {
                            foreach ($academy->applications as $application) {

                                if (!in_array($application->student->email, $emails)) {
                                    $emails[] = $application->student->email;
                                }
                            }
                        }
                    }
                }
                if (!empty($coursetypesIds) && $allId != 1) {
                    foreach ($coursetypesIds as $coursetypeId) {
                        $coursetype = CourseType::find($coursetypeId);
                        if ($coursetype) {
                            if ($coursetype->classes->count() > 0) {
                                foreach ($coursetype->classes as $class) {
                                    if ($class->students->count() > 0) {
                                        foreach ($class->students as $student) {
                                            if (!in_array($student->email, $emails)) {
                                                $emails[] = $student->email;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                if (!empty($coursetypesIds2) && $allId != 1) {
                    foreach ($coursetypesIds2 as $coursetypeId) {
                        $coursetype = CourseType::find($coursetypeId);
                        if ($coursetype) {
                            if ($coursetype->applications->count() > 0) {
                                foreach ($coursetype->applications as $application) {
                                    if (!in_array($application->student->email, $emails)) {
                                        $emails[] = $application->student->email;
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

            if (!empty($emails)) {
                foreach ($emails as $email) {
                    Mail::to($email)->send(new CustomMail($emailData));
                }
            } else {
                throw ValidationException::withMessages(['recipients' => 'Vyberte príjmateľa.', 'recipient' => 'Vyberte príjmateľa.']);
            }

            return back()->with('success_email', 'Úspešne odoslané emaily.');
        } else {
            throw ValidationException::withMessages(['recipients' => 'Vyberte príjmateľa.', 'recipient' => 'Vyberte príjmateľa.']);
        }
    }
    public function messages()
    {
        return [
            'sendername.required_if' => 'Pole :attribute je povinné, ak je odosielateľ zapnutý.',
            'sendername.string' => 'Pole :attribute musí byť reťazec.',
            'sendername.max' => 'Pole :attribute môže mať maximálne :max znakov.',
            'recipients.json' => 'Pole :attribute musí byť vo formáte JSON.',
            'recipients.required_without' => 'Pole :attribute je povinné, ak nie je zadaný prijímateľ.',
            'recipient.required_without' => 'Pole :attribute je povinné, ak nie sú zadaní príjemcovia.',
            'who.in' => 'Pole :attribute musí byť jedna z hodnôt: 1, 2.',
            'emailText.required' => 'Pole :attribute je povinné.',
            'emailText.string' => 'Pole :attribute musí byť reťazec.',
        ];
    }
}
