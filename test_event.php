<?php

use App\Models\Event;
use Illuminate\Support\Str;
use App\Models\User;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

$user = User::first();
if (!$user) {
    echo "No user found to assign event to.\n";
    exit;
}

auth()->login($user);

try {
    $data = [
        'title' => 'Test Event ' . Str::random(5),
        'description' => 'Test description',
        'location' => 'Test location',
        'start_date' => now()->addDays(7),
        'end_date' => now()->addDays(8),
        'is_free' => true,
        'is_published' => true,
        'user_id' => $user->id,
    ];
    
    $data['slug'] = Str::slug($data['title']);
    
    $event = Event::create($data);
    echo "Event created successfully with ID: " . $event->id . "\n";
} catch (\Exception $e) {
    echo "FAILED to create event: " . $e->getMessage() . "\n";
}
