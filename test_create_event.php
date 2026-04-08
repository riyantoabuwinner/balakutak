<?php

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Str;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = User::first();
if (!$user) {
    echo "No user found!\n";
    exit;
}

try {
    $event = Event::create([
        'title' => 'Test Event ' . time(),
        'slug' => 'test-event-' . time(),
        'description' => 'Test event description',
        'content' => 'Test event content',
        'location' => 'Test location',
        'start_date' => now(),
        'user_id' => $user->id,
        'is_published' => true,
        'is_free' => true,
    ]);

    echo "Event created successfully! ID: " . $event->id . "\n";
} catch (\Exception $e) {
    echo "Failed to create event: " . $e->getMessage() . "\n";
}
