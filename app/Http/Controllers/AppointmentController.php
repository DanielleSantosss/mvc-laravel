<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('appointments.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $appointment = Appointment::create($request->all());

        if ($request->ajax()) {
            return response()->json(['message' => 'Agendamento criado com sucesso!', 'appointment' => $appointment], 200);
        }

        return redirect()->route('appointments.index')->with('success', 'Agendamento criado com sucesso!');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        if (request()->ajax()) {
            return response()->json(['message' => 'Agendamento excluído com sucesso!'], 200);
        }

        return redirect()->route('appointments.index')->with('success', 'Agendamento excluído com sucesso!');
    }

    public function pendents()
    {
        $appointments = Appointment::where('start_time', '>', now())->get();
        return view('appointments.pendents', compact('appointments'));
    }
}
