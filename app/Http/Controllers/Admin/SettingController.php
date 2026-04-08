<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::where('group', 'general')->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function group(string $group)
    {
        $settings = Setting::where('group', $group)->pluck('value', 'key');
        return view('admin.settings.group', compact('settings', 'group'));
    }

    public function update(Request $request)
    {
        $group = $request->input('group', 'general');

        // Handle dynamic Sertifikasi Lainnya (array of name + file)
        if ($request->has('cert_other_name')) {
            $names = $request->input('cert_other_name', []);
            $files = $request->file('cert_other_file', []);
            $keepPaths = $request->input('cert_other_existing', []);

            // Load existing stored certs to preserve unchanged file paths
            $existing = json_decode(Setting::get('cert_others', '[]'), true) ?? [];

            $certs = [];
            foreach ($names as $i => $name) {
                if (empty(trim($name)))
                    continue;

                // New file uploaded for this index?
                if (!empty($files[$i]) && $files[$i]->isValid()) {
                    $path = $files[$i]->store('settings/certs', 'public');
                }
                else {
                    // Keep existing path if available
                    $path = $keepPaths[$i] ?? ($existing[$i]['file'] ?? null);
                }

                $certs[] = ['name' => trim($name), 'file' => $path];
            }

            Setting::set('cert_others', json_encode($certs));
            Setting::where('key', 'cert_others')->update(['group' => $group]);
        }

        // Process all other regular settings (skip cert_other_* arrays)
        $skip = ['_token', 'group', 'cert_other_name', 'cert_other_file', 'cert_other_existing'];
        foreach ($request->except($skip) as $key => $value) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('settings', 'public');
                Setting::set($key, $path);
            }
            else {
                Setting::set($key, $value);
            }
            Setting::where('key', $key)->update(['group' => $group]);
        }

        Cache::forget('site_settings');

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
