<?php

namespace App\Http\Controllers;

use App\Models\Exception;
use Illuminate\Http\Request;

class ExceptionController extends Controller
{
    public function index()
    {
        $exceptions = Exception::all();
    return view('dashboard.exception', compact('exceptions'));
    }

    public function create()
    {
        return view('dashboard.tambah-exception', compact('exceptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'holiday_date' => 'required|date|unique:exceptions',
            'note' => 'required|string|max:255',
        ]);

        Exception::create($request->all());

        return redirect()->route('dashboard.exception', compact('exceptions'))->with('success', 'Exception created successfully.');
    }

    public function edit(Exception $exception)
    {
        return view('dashboard.edit-exception', compact('exception'));
    }

    public function update(Request $request, Exception $exception)
    {
        $request->validate([
            'holiday_date' => 'required|date|unique:exceptions,holiday_date,' . $exception->id,
            'note' => 'required|string|max:255',
        ]);

        $exception->update($request->all());

        return redirect()->route('exceptions.index')->with('success', 'Exception updated successfully.');
    }

    public function destroy(Exception $exception)
    {
        $exception->delete();

        return redirect()->route('dashboard.exception')->with('success', 'Exception deleted successfully.');
    }
}
