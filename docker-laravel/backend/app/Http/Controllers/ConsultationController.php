<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Validator;
use App\Models\Consultation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $this_year = Carbon::today()->format('Y');
        $data['page_name'] = "受診記録一覧";

        if ($request->has('year')) {
            $selected = $request->get('year');
            $data['default'] = $selected;
        } else {
            $selected = $this_year;
            $data['default'] = $this_year;
        }

        $data['list'] = Consultation::where('consulted_at', 'LIKE', "%{$selected}%")->get();

        $data['years'] = $this->getYearList($this_year);

        if (View::exists('consultation.index')) {
            return view('consultation.index', $data);
        }
    }

    public function register(User $user)
    {
        $data = [];
        $data['page_name'] = "受診記録登録";

        $data['user'] = $user;

        $data['default'] = User::getAge($user->id) >= 35 ? 1 : 0;

        if (View::exists('consultation.register')) {
            return view('consultation.register', $data);
        }
    }

    public function store(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'place' => 'required|max:100',
            'course' => 'required',
            'year' => 'required',
            'month' => 'required',
            'day' => 'required',
        ]);

        $checkItem = [$request->get('year'), $user];
        $validator->after(function ($validator) use ($checkItem) {
            if ($this->searchDuplicateYear($checkItem[0], $checkItem[1])) {
                $validator->errors()->add('year', 'すでに登録のある年度は指定出来ません');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $place = $request->get('place');
        $course = $request->get('course');
        $consulted = $request->get('year') . '-' . $request->get('month') . '-' . $request->get('day');

        Consultation::create(['place' => $place, 'course' => $course, 'consulted_at' => $consulted, 'users_id' => $user->id]);
        return redirect(route('user.detail', ['user' => $user->id]));
    }

    public function searchDuplicateYear($target_year, User $user)
    {
        $dateArr = $user->consultations()->pluck('consulted_at');
        $list = [];
        foreach ($dateArr as $date) {
            list($year, $month, $day) = explode('-', $date);
            $list[] = $year;
        }

        return in_array($target_year, $list);

    }

    private function getYearList($this_year)
    {
        $return = [];
        $list = array_reverse(range(1900, $this_year));

        foreach ($list as $year) {
            $return[$year] = $year;
        }

        return $return;

    }
}
