<?php

namespace App\Http\Repositories\Frontend;

use App\Models\News;
use App\Enums\Status;
use App\Models\Event;
use App\Models\Slider;
use App\Models\Counter;
use App\Models\Gallery;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Models\GalleryCategory;
use App\Models\Academic\ClassSetup;
use App\Models\StudentInfo\Student;
use App\Models\Examination\ExamType;
use App\Models\Examination\MarksGrade;
use App\Models\Examination\MarksRegister;
use App\Models\Academic\ClassSetupChildren;
use App\Http\Interfaces\Frontend\FrontendInterface;
use App\Models\Examination\ExamAssign;
use App\Models\Staff\Staff;
use App\Models\StudentInfo\SessionClassStudent;
use App\Models\WebsiteSetup\About;
use App\Models\WebsiteSetup\Contact;
use App\Models\WebsiteSetup\ContactInfo;
use App\Models\WebsiteSetup\DepartmentContact;
use App\Models\WebsiteSetup\OnlineAdmission;
use App\Models\WebsiteSetup\Subscribe;

class FrontendRepository implements FrontendInterface
{
    public function sliders()
    {
        return Slider::where('status', Status::ACTIVE)->orderBy('serial')->get();
    }
    public function counters()
    {
        return Counter::where('status', Status::ACTIVE)->orderBy('serial')->paginate(4);
    }

    // Abouts
    public function abouts()
    {
        $data['abouts']   = About::where('status', Status::ACTIVE)->orderBy('serial')->get();
        $data['teachers'] = Staff::where('status', Status::ACTIVE)->where('role_id', 5)->take(8)->get();
        return $data;
    }

    // News
    public function news()
    {
        return News::where('status', Status::ACTIVE)->where('publish_date', '<=', date('Y-m-d'))->orderBy('id', 'desc')->paginate(6);
    }
    public function latestNews()
    {
        return News::where('status', Status::ACTIVE)->where('publish_date', '<=', date('Y-m-d'))->orderBy('id', 'desc')->take(4)->get();
    }

    public function newsDetail($id)
    {
        return News::where('status', Status::ACTIVE)->where('id', $id)->first();
    }

    // Events
    public function events()
    {
        return Event::where('session_id', setting('session'))->where('status', Status::ACTIVE)->orderBy('id', 'desc')->paginate(6);
    }

    public function eventDetail($id)
    {
        return Event::where('session_id', setting('session'))->where('status', Status::ACTIVE)->where('id', $id)->first();
    }

    public function comingEvents()
    {
        return Event::where('session_id', setting('session'))->where('status', Status::ACTIVE)->where('date', '>=', date('Y-m-d'))->orderBy('date','DESC')->take(4)->get();
    }

    // Gallery
    public function galleryCategory()
    {
        return GalleryCategory::where('status', Status::ACTIVE)->orderBy('name')->get();
    }
    public function gallery()
    {
        return Gallery::where('status', Status::ACTIVE)->orderBy('id', 'desc')->paginate(12);
    }

    // Result
    public function getClasses($request)
    {
        return ClassSetup::active()->where('session_id', $request->session)->with('class')->get();
    }
    public function getSections($request)
    {
        $result = ClassSetup::active()->where('session_id', $request->session)->where('classes_id', $request->class)->first();
        return ClassSetupChildren::with('section')->where('class_setup_id', @$result->id)->select('section_id')->get();
    }
    public function getExamType($request)
    {
        return ExamAssign::where('session_id', $request->session)
        ->where('classes_id',$request->class)
        ->where('section_id',$request->section)
        ->select('exam_type_id')
        ->distinct()
        ->with('type')
        ->get();
    }
    public function result()
    {
        $data['sessions'] = Session::where('status', Status::ACTIVE)->orderBy('name')->get();
        return $data;
    }
    // end result

    public function searchResult($request)
    {
        $classSection   = SessionClassStudent::where('session_id', $request->session)
            ->where('classes_id', $request->class)
            ->where('section_id', $request->section)
            ->whereHas('student', function ($query) use ($request) {
                return $query->where('admission_no', $request->admission_no);
            })
            ->first();

        $marks_registers    = MarksRegister::where('exam_type_id', $request->exam)
            ->where('classes_id', @$classSection->classes_id)
            ->where('section_id', @$classSection->section_id)
            ->where('session_id', $request->session)
            ->with('marksRegisterChilds', function ($query) use ($classSection) {
                $query->where('student_id', $classSection->student_id);
            })->get();

        $result      = ___('common.Passed');
        $total_marks = 0;

        if ($marks_registers->count() == 0)
            return false;

        foreach ($marks_registers as $marks_register) {
            $total_marks += $marks_register->marksRegisterChilds->sum('mark');
            if ($marks_register->marksRegisterChilds->sum('mark') < examSetting('average_pass_marks')) {
                $result = ___('common.Failed');
            }
        }

        $grades = MarksGrade::where('session_id', $request->session)->get();
        $gpa = '';
        foreach ($grades as $grade) {
            if ($grade->percent_from <= $total_marks / count($marks_registers) && $grade->percent_upto >= $total_marks / count($marks_registers)) {
                $gpa = $grade->point;
            }
        }

        $data = [];
        $data['classSection']    = $classSection;
        $data['marks_registers'] = $marks_registers;
        $data['result']          = $result;
        $data['gpa']             = $gpa;
        $data['avg_marks']       = $total_marks / count($marks_registers);
        return $data;
    }


    // Contact Information

    public function contactInfo(){
        return ContactInfo::where('status', Status::ACTIVE)->get();
    }

    public function depContact(){
        return DepartmentContact::where('status', Status::ACTIVE)->get();
    }

    public function onlineAdmission($request){
        try {
            $row                 = new OnlineAdmission();
            $row->first_name     = $request->first_name;
            $row->last_name      = $request->last_name;
            $row->phone          = $request->phone;
            $row->email          = $request->email;
            $row->session_id     = $request->session;
            $row->classes_id     = $request->classes;
            $row->section_id     = $request->sections;
            $row->dob            = $request->dob;
            $row->gender_id      = $request->gender;
            $row->religion_id    = $request->religion;
            $row->guardian_name  = $request->guardian_name;
            $row->guardian_phone = $request->guardian_phone;
            $row->save();
            return response()->json([___('frontend.Success'), ___('frontend.Submitted successfully'), 'success', ___('frontend.OK')]);
        } catch (\Throwable $th) {
            return response()->json([___('frontend.Error'), ___('frontend.Something went wrong!'), 'error', ___('frontend.OK')]);
        }
    }
    public function contact($request){
        try {
            $row          = new Contact();
            $row->name    = $request->name;
            $row->phone   = $request->phone;
            $row->email   = $request->email;
            $row->subject = $request->subject;
            $row->message = $request->message;
            $row->save();
            return response()->json([___('frontend.Success'), ___('frontend.Send successfully'), 'success', ___('frontend.OK')]);
        } catch (\Throwable $th) {
            return response()->json([___('frontend.Error'), ___('frontend.Something went wrong!'), 'error', ___('frontend.OK')]);
        }
    }

    public function subscribe($request){
        try {
            $row          = Subscribe::where('email', $request->email)->first();
            if($row)
                return response()->json([___('frontend.Attention'), ___('frontend.Already subscribed'), 'warning', ___('frontend.OK')]);

            $row          = new Subscribe();
            $row->email   = $request->email;
            $row->save();

            return response()->json([___('frontend.Success'),___('frontend.Subscribed'), 'success', ___('frontend.OK')]);

        } catch (\Throwable $th) {
            return response()->json([___('frontend.Error'), ___('frontend.Something went wrong!'), 'error', ___('frontend.OK')]);
        }
    }
}
