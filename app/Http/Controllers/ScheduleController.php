<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Docter;
use App\Models\Proficiency;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $schedules = Proficiency::query()
            ->whereHas('docters', function ($query) {
                return $query->whereHas('schedule');
            })
            ->when($request->has("search"), function ($query) use ($request) {
                return $query->with([
                    'docters' => function ($q) use ($request) {
                        return $q->where('name', 'like', "%{$request->search}%");
                    }
                ]);
            })
            ->paginate(2);

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docters = Docter::select('id', 'name')->get();
        return view('schedules.form', compact('docters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleRequest $request)
    {
        $data = $request->validated();
        $data['day'] = json_encode($data['day']);
        $data['time'] = json_encode($data['time']);
        Schedule::create($data);
        return redirect()->route('schedule.index')->with('success', 'Schedule Added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $docters = Docter::select('id', 'name')->get();
        return view('schedules.form', compact('schedule', 'docters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScheduleRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $data = $request->validated();
        $schedule->update($data);
        return redirect()->back()->with('success', 'Schedule Edit Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedule.index')->with('success', 'Schedule Remove');
    }
}
