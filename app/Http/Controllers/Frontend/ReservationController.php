<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Table;
use App\Enums\TableStatus;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function stepOne(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        return view('frontend.reservations.step_one', compact('reservation'));
    }

    public function stepOneStore(Request $request)
    {
        $request['res_date'] = Carbon::parse($request->res_date);
        $validated = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'tel_number' => 'required',
        'res_date' => ['required', 'date', new DateBetween, new TimeBetween],
        'guest_number' => 'required'
        ]);
        if(empty($request->session()->get('reservation')))
        {
            $reservation = new Reservation();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }else {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }
        return to_route('reservation.steptwo');
    }
    public function stepTwo(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        $res_table_ids = Reservation::orderBy('res_date')->get()->filter(function ($value) use ($reservation) {
            return $value->res_date == $reservation->res_date;
        })->pluck('table_id');
        $tables = Table::where('status', TableStatus::Available)
            ->where('guest_number', '>=', $reservation->guest_number)
            ->whereNotIn('id', $res_table_ids)->get();
        return view('frontend.reservations.step_two', compact('reservation', 'tables'));
    }
    public function stepTwoStore(Request $request)
    {
        $validated = $request->validate([
            'table_id' => ['required']
        ]);
        $reservation = $request->session()->get('reservation');
        $reservation->fill($validated);
        $reservation->save();
        $request->session()->forget('reservation');

        return to_route('thankyou');
    }
}
