<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AcademicServiceController extends Controller
{
    public function index()
    {
        $services = AcademicService::orderBy('order')->orderBy('title')->get();
        return view('admin.academic_services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.academic_services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'url' => 'nullable|string|max:500',
            'is_external' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['is_external'] = $request->boolean('is_external', true);
        $validated['is_active'] = $request->boolean('is_active', true);

        AcademicService::create($validated);

        return redirect()->route('admin.academic-services.index')
            ->with('success', 'Layanan akademik berhasil ditambahkan!');
    }

    public function edit(AcademicService $academicService)
    {
        return view('admin.academic_services.edit', compact('academicService'));
    }

    public function update(Request $request, AcademicService $academicService)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'url' => 'nullable|string|max:500',
            'is_external' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($request->title);
        $validated['is_external'] = $request->boolean('is_external', true);
        $validated['is_active'] = $request->boolean('is_active', true);

        $academicService->update($validated);

        return redirect()->route('admin.academic-services.index')
            ->with('success', 'Layanan akademik berhasil diperbarui!');
    }

    public function destroy(AcademicService $academicService)
    {
        $academicService->delete();
        return back()->with('success', 'Layanan akademik berhasil dihapus!');
    }
}
