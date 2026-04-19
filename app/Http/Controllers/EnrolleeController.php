<?php

namespace App\Http\Controllers;

use App\Models\Enrollee;
use App\Http\Requests\StoreEnrolleeRequest;
use Illuminate\Http\Request;

class EnrolleeController extends Controller
{
    public function index() {
        $enrollees = Enrollee::all();
        return view('dashboard', compact('enrollees'));
    }

    public function store(StoreEnrolleeRequest $request) {
        Enrollee::create($request->validated());
        return redirect()->route('dashboard');
    }

    public function update(Request $request, Enrollee $enrollee)
    {
        $enrollee->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Student updated successfully!');
    }

    public function destroy(Enrollee $enrollee)
    {
        $enrollee->delete();
        return redirect()->route('dashboard')->with('success', 'Student removed.');
    }    
}
