<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Document;
use App\Models\DocumentCategory;

$docs = Document::all();
echo "Total Documents: " . $docs->count() . "\n";
foreach($docs as $doc) {
    echo "ID: " . $doc->id . " - Title: " . $doc->title . " - Category ID: " . ($doc->document_category_id ?? 'NULL') . "\n";
}

$cats = DocumentCategory::all();
echo "Total Categories: " . $cats->count() . "\n";
foreach($cats as $cat) {
    echo "ID: " . $cat->id . " - Name: " . $cat->name . "\n";
}
