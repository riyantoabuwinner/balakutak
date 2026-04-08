<?php
use App\Models\Event;
use App\Models\User;

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

$user = User::first();
if (!$user) {
    die("ERROR: No users found.\n");
}

try {
    echo "Attempting to create event...\n";
    $event = new Event();
    $event->user_id = $user->id;
    $event->title = "Diagnostic Event " . time();
    $event->slug = "diagnostic-" . time();
    $event->description = "Test Description";
    $event->location = "Test Location";
    $event->start_date = date('Y-m-d H:i:s');
    $event->is_published = true;
    $event->is_free = true;
    
    // Check for columns that might be cause missing
    echo "Saving...\n";
    $event->save();
    echo "SUCCESS: Event saved with ID " . $event->id . "\n";
} catch (\Exception $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
    echo "Trace: " . substr($e->getTraceAsString(), 0, 500) . "...\n";
}
