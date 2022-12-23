<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = Table::where('status', TableStatus::Available)->get();
        return view('admin.reservations.create', compact('tables'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        $reservations = $request->all();
        $tables['first_name'] = $request->first_name;
        $tables['last_name'] = $request->last_name;
        $tables['email'] = $request->email;
        $tables['tel_number'] = $request->tel_number;
        $tables['res_date'] = $request->res_date;
        $tables['table_id'] = $request->table_id;
        $tables['guest_number'] = $request->guest_number;
        $table = Table::findOrfail($request->table_id);
        if($request->guest_number > $table->guest_number)
        {
            return back()->with('warning', 'Please choose table according to number of guests.');
        }
        $request_date = Carbon::parse($request->res_date);
        foreach ($table->reservation as $res) {
            if ($res->res_date == $request_date) {
                return back()->with('warning', 'This table is reserved for this date.');
            }
        }
        Reservation::create($reservations);
        return to_route('admin.reservation.index')->with('success', 'Reservation Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        $tables = Table::where('status', TableStatus::Available)->get();
        return view('admin.reservations.edit', compact('reservation', 'tables'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, Reservation $reservation)
    {
        $table = Table::findOrfail($request->table_id);
        if($request->guest_number > $table->guest_number)
        {
            return back()->with('warning', 'Please choose table according to number of guests.');
        }
        $request_date = Carbon::parse($request->res_date);
        $reservations = $table->reservation()->where('id', '!=', $reservation->id)->get();
        foreach ($reservations as $res) {
            if ($res->res_date == $request_date) {
                return back()->with('warning', 'This table is reserved for this date.');
            }
        }
        $reservation->update($request->validated());
        return to_route('admin.reservation.index')->with('success', 'Reservation Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return to_route('admin.reservation.index')->with('danger', 'Reservation Deleted Successfully');
    }
}
