<?php

namespace App\Http\Controllers;

use App\Models\CourseType;
use App\Models\Instructor;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CourseType_InstructorController extends Controller
{
    public function store()
    {
        $attributes = request()->validateWithBag( 'createCI',
            [
                'type' => ['required', 'integer', 'in:0,1,2'],
                'academy_id' => ['required_if:type,1', 'integer', Rule::exists('academies', 'id')],
                'coursetype_id' => ['required_if:type,1', 'integer', Rule::exists('course_types', 'id')],
                'academy_id2' => ['required_if:type,0', 'integer', Rule::exists('academies', 'id')],
                'coursetype_id2' => ['required_if:type,0', 'integer', Rule::exists('course_types', 'id')],
                'instructor_id' => ['integer','required', Rule::exists('instructors', 'id')]
            ],$this->messages()
        );
        if ($attributes['type'] == 0) {
            $attributes['academy_id'] = $attributes['academy_id2'];
            $attributes['coursetype_id'] = $attributes['coursetype_id2'];
        }

        $instructor = Instructor::find($attributes['instructor_id']);

        foreach ($instructor->coursetypes as $coursetype) {

            if ($coursetype->id == $attributes['coursetype_id']) {
                if ($coursetype->type == 1)
                {
                     throw ValidationException::withMessages(['type' => 'Tento kurz je už v správe tohto inštruktora.','academy_id' => 'Tento kurz je už v správe tohto inštruktora.','coursetype_id' => 'Tento kurz je už v správe tohto inštruktora.'])->errorBag('createCI');
                }
                if ($coursetype->type == 0)
                {
                    throw ValidationException::withMessages(['type' => 'Tento kurz je už v správe tohto inštruktora.','academy_id2' => 'Tento kurz je už v správe tohto inštruktora.','coursetype_id2' => 'Tento kurz je už v správe tohto inštruktora.'])->errorBag('createCI');
                }
            }
        }
        // dd($coursetypes);
        $coursetype = CourseType::find($attributes['coursetype_id']);
        $instructor->coursetypes()->save($coursetype);


        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_cc', 'Úspešne vytvorené');
        }
        if (Str::endsWith(url()->previous(), '?vytvorit'))
        {
            $trimmedUrl = substr(url()->previous(), 0, -9);
            return redirect($trimmedUrl)->with('success_cc', 'Úspešne vytvorené');
        }
        if (Str::endsWith(url()->previous(), '?zmenit'))
        {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_cc', 'Úspešne vytvorené');
        }

        return back()->with('success_cc', 'Úspešne pridané');
    }

    public function destroy(Instructor $instructor, CourseType $coursetype)
    {
        //     dd($coursetype);
        //     $attributes = request()->validate(
        //     [
        //         'coursetype_id' => ['nullable', Rule::exists('course_types', 'id')],
        //         'instructor_id' => ['nullable', Rule::exists('instructors','id')]
        //     ]
        // );
        // $instructor ? $instructor->coursetypes()->detach($attributes['coursetype_id']) : $coursetype->instructors()->detach($attributes['instructor_id']);
        $instructor->coursetypes()->detach($coursetype['id']);
        // if ($instructor){

        // }
        // else if ($coursetype){
        if (Str::endsWith(url()->previous(), '?pridat')) {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_dd', 'Úspešne vymazané');
        }
        if (Str::endsWith(url()->previous(), '?vytvorit'))
        {
            $trimmedUrl = substr(url()->previous(), 0, -9);
            return redirect($trimmedUrl)->with('success_dd', 'Úspešne vymazané');
        }
        if (Str::endsWith(url()->previous(), '?zmenit'))
        {
            $trimmedUrl = substr(url()->previous(), 0, -7);
            return redirect($trimmedUrl)->with('success_dd', 'Úspešne vymazané');
        }
        // }
        return back()->with('success_dd', 'Úspešne vymazané');
    }
    protected function messages()
    {
        return 
    [
        'type.required' => 'Typ je povinný.',
            'type.integer' => 'Typ musí byť celé číslo.',
            'type.in' => 'Typ musí byť jedno z: :values.',
            'academy_id.required_if' => 'Akadémia je povinná, keď je typ inštruktorský.',
            'academy_id.integer' => 'Akadémia musí byť celé číslo.',
            'academy_id.exists' => 'Vybraná akadémia neexistuje.',
            'coursetype_id.required_if' => 'Typ kurzu je povinný, keď je typ inštruktorský.',
            'coursetype_id.integer' => 'Typ kurzu musí byť celé číslo.',
            'coursetype_id.exists' => 'Vybraný typ kurzu neexistuje.',
            'academy_id2.required_if' => 'Akadémia je povinná, keď je typ študentský.',
            'academy_id2.integer' => 'Akadémia musí byť celé číslo.',
            'academy_id2.exists' => 'Vybraná akadémia neexistuje.',
            'coursetype_id2.required_if' => 'Typ kurzu je povinný, keď je typ študentský.',
            'coursetype_id2.integer' => 'Typ kurzu musí byť celé číslo.',
            'coursetype_id2.exists' => 'Vybraný typ kurzu neexistuje.',
        'instructor_id.required' => 'Inštruktor je poviný.',
        'instructor_id.integer' => 'ID inštruktora musí byť číslo.',
        'instructor_id.exists' => 'Zvolený inštruktor neexistuje v databáze.'
    ];
}
}
