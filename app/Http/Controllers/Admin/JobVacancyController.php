<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    public function index()
    {
        $vacancies = JobVacancy::latest()->get();
        return view('hrd.vacancies.index', compact('vacancies'));
    }

    public function create()
    {
        return view('hrd.vacancies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'prospects' => 'nullable|string',
            'is_open' => 'boolean'
        ]);

        JobVacancy::create([
            'title' => $request->title,
            'division' => $request->division,
            'quota' => $request->quota,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'prospects' => $request->prospects,
            'status' => 'open',
            'is_open' => $request->has('is_open') ? true : false,
        ]);

        return redirect()->route('hrd.vacancies.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(JobVacancy $vacancy)
    {
        return view('hrd.vacancies.edit', compact('vacancy'));
    }

    public function update(Request $request, JobVacancy $vacancy)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'quota' => 'required|integer|min:1',
            'description' => 'required|string',
            'requirements' => 'required|string',
            'prospects' => 'nullable|string',
        ]);

        $vacancy->update([
            'title' => $request->title,
            'division' => $request->division,
            'quota' => $request->quota,
            'description' => $request->description,
            'requirements' => $request->requirements,
            'prospects' => $request->prospects,
            'is_open' => $request->has('is_open') ? true : false,
        ]);

        return redirect()->route('hrd.vacancies.index')->with('success', 'Lowongan berhasil diupdate.');
    }

    public function destroy(JobVacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->route('hrd.vacancies.index')->with('success', 'Lowongan berhasil dihapus.');
    }
}