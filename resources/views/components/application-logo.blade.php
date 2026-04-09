<img src="{{ \App\Models\Setting::get('site_logo') ? asset('storage/' . \App\Models\Setting::get('site_logo')) : asset('images/logo.png') }}" {{ $attributes }}>

