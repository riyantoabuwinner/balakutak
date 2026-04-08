<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = Document::with('user')
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->when($request->category, fn($q) => $q->where('category', $request->category));

        $documents = $query->latest()->paginate(15)->withQueryString();

        $categories = Document::select('category')->distinct()->pluck('category');

        return view('admin.documents.index', compact('documents', 'categories'));
    }

    public function create()
    {
        return view('admin.documents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'file' => 'required|file|max:20480', // max 20MB
            'language' => 'nullable|in:id,en',
            'is_public' => 'boolean',
        ]);

        $file = $request->file('file');

        $document = new Document();
        $document->user_id = Auth::id();
        $document->title = $validated['title'];
        $document->description = $validated['description'];
        $document->category = strtolower($validated['category']);
        $document->language = $validated['language'] ?? app()->getLocale();
        $document->is_public = $request->boolean('is_public', true);

        // File details
        $document->file_name = $file->getClientOriginalName();
        $document->file_type = $file->getClientOriginalExtension() ?: 'unknown';
        $document->file_size = $file->getSize();
        $document->file_path = $file->store('documents', 'public');

        $document->save();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diunggah!');
    }

    public function edit(Document $document)
    {
        return view('admin.documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:50',
            'file' => 'nullable|file|max:20480',
            'language' => 'nullable|in:id,en',
            'is_public' => 'boolean',
        ]);

        $document->title = $validated['title'];
        $document->description = $validated['description'];
        $document->category = strtolower($validated['category']);
        $document->language = $validated['language'] ?? $document->language;
        $document->is_public = $request->boolean('is_public', true);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }

            $file = $request->file('file');
            $document->file_name = $file->getClientOriginalName();
            $document->file_type = $file->getClientOriginalExtension() ?: 'unknown';
            $document->file_size = $file->getSize();
            $document->file_path = $file->store('documents', 'public');
        }

        $document->save();

        return redirect()->route('admin.documents.index')->with('success', 'Informasi dokumen berhasil diperbarui!');
    }

    public function destroy(Document $document)
    {
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }
        $document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus!');
    }
}
