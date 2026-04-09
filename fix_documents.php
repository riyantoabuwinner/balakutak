<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Document;
use App\Models\DocumentCategory;

$umum = DocumentCategory::where('slug', 'umum')->first();
if ($umum) {
    Document::whereNull('document_category_id')->update(['document_category_id' => $umum->id]);
    echo "Assigned documents to Umum category.\n";
} else {
    echo "Umum category not found.\n";
}
