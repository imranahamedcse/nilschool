<?php

namespace App\Http\Repositories;

use App\Enums\AttendanceType;
use App\Http\Interfaces\DashboardInterface;
use App\Models\Academic\ClassSetup;
use App\Models\Accounts\Expense;
use App\Models\Accounts\Income;
use App\Models\Attendance\Attendance;
use App\Models\Fees\FeesCollect;
use App\Models\HumanResource\Staff;
use App\Models\Event;
use App\Models\User;

class DashboardRepository implements DashboardInterface
{

    public function index()
    {
        $income   = Income::where('session_id', setting('session'))->sum('amount');
        $expense  = Expense::where('session_id', setting('session'))->sum('amount');
        $staffs   = Staff::count();
        $students = Attendance::where('session_id', setting('session'))
            ->whereDay('date', date('d'))
            ->whereIn('attendance', [AttendanceType::PRESENT, AttendanceType::LATE, AttendanceType::HALFDAY])
            ->count();
        $data['total']   = [
            [
                "title" => "Income for this year",
                "value" => $income,
                "icon"  => "money-bill",
                "color" => "primary"
            ],
            [
                "title" => "Expense for this year",
                "value" => $expense,
                "icon"  => "money-check",
                "color" => "secondary"
            ],
            [
                "title" => "Staff present today",
                "value" => $staffs,
                "icon"  => "user-tie",
                "color" => "info"
            ],
            [
                "title" => "Student present today",
                "value" => $students,
                "icon"  => "user-graduate",
                "color" => "success"
            ],
        ];

        $data['users'] = User::groupBy('role_id')
            ->selectRaw('count(*) as total, role_id')
            ->get();

        $data['events'] = Event::where('session_id', setting('session'))->active()->where('date', '>=', date('Y-m-d'))->orderBy('date')->take(5)->get();

        return $data;
    }

    public function feesCollectionYearly()
    {
        $data          = [];
        $data['title'] = 'Income & Expenses For This Year(' . date('Y') . ')';
        for ($i = 1; $i <= 12; $i++) {
            $data['income'][]  = Income::where('session_id', setting('session'))->whereMonth('date', $i)->sum('amount');
            $data['expense'][] = Expense::where('session_id', setting('session'))->whereMonth('date', $i)->sum('amount');
            $data['revenue'][] = $data['income'][$i - 1] - $data['expense'][$i - 1];
        }
        return $data;
    }

    public function feesCollection()
    {
        $data          = [];
        $data['title'] = 'Fees Collection For ' . date('F') . '(' . date('Y') . ')';
        for ($i = 1; $i <=  date('t'); $i++) {
            $data['collection'][] = FeesCollect::where('session_id', setting('session'))->whereMonth('date', date('m'))->whereDay('date', $i)->sum('amount');
            $data['dates'][]      = str_pad($i, 2, '0', STR_PAD_LEFT);
        }
        return response()->json($data, 200);
    }

    public function incomeExpense()
    {
        $data          = [];
        $data['title'] = 'Income & Expenses For ' . date('F') . '(' . date('Y') . ')';
        for ($i = 1; $i <=  date('t'); $i++) {
            $data['incomes'][]  = Income::where('session_id', setting('session'))->whereMonth('date', date('m'))->whereDay('date', $i)->sum('amount');
            $data['expenses'][] = Expense::where('session_id', setting('session'))->whereMonth('date', date('m'))->whereDay('date', $i)->sum('amount');
            $data['dates'][]    = str_pad($i, 2, '0', STR_PAD_LEFT);
        }
        return response()->json($data, 200);
    }

    public function attendance()
    {
        $items = ClassSetup::active()->where('session_id', setting('session'))->get();

        $data['title']   = "Today's Attendance (" . date('d M Y') . ")";
        $data['classes'] = [];
        $data['present'] = [];
        $data['absent']  = [];
        $data['classes'] = [];

        foreach ($items as $value) {
            $data['classes'][] = $value->class->name;
            $data['present'][] = Attendance::where('session_id', setting('session'))
                ->where('classes_id', $value->classes_id)
                ->whereDay('date', date('d'))
                ->whereIn('attendance', [AttendanceType::PRESENT, AttendanceType::LATE, AttendanceType::HALFDAY])
                ->count();
            $data['absent'][]  = Attendance::where('session_id', setting('session'))
                ->where('classes_id', $value->classes_id)
                ->whereDay('date', date('d'))
                ->where('attendance', AttendanceType::ABSENT)
                ->count();
        }
        return $data;
    }

    public function eventsCurrentMonth()
    {
        $events = Event::where('session_id', setting('session'))->active()->whereMonth('date', date('m'))->orderBy('date')->get();
        $data = [];
        foreach ($events as $value) {
            $data[] = [
                'title' => $value->title,
                'start' => $value->date . 'T' . $value->start_time,
                'end'   => $value->date . 'T' . $value->end_time,
            ];
        }
        return response()->json($data, 200);
    }
}
