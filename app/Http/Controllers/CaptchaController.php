<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CaptchaController extends Controller
{
    /**
     * Generate a secure, single-use, non-cacheable captcha PNG image.
     */
    public function generate(Request $request)
    {
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $maxIdx = strlen($characters) - 1;
        $captchaText = '';
        for ($i = 0; $i < 6; $i++) {
            $captchaText .= $characters[random_int(0, $maxIdx)];
        }

        session([
            'captcha_answer' => strtolower($captchaText),
            'captcha_expires_at' => now()->addMinutes(5)->timestamp,
        ]);

        $pngData = $this->renderWithIntervention($captchaText) ?? $this->renderWithNativeGd($captchaText);

        return response($pngData, 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }

    private function renderWithIntervention(string $captchaText): ?string
    {
        try {
            $manager = new ImageManager(new Driver());
            $width = 280;
            $height = 80;
            $image = $manager->create($width, $height)->fill('#f8fafc');

            $fontPath = base_path('vendor/dompdf/dompdf/lib/fonts/DejaVuSans-Bold.ttf');
            if (!file_exists($fontPath)) {
                $fontPath = base_path('vendor/dompdf/dompdf/lib/fonts/DejaVuSans.ttf');
            }
            $hasFont = file_exists($fontPath) && function_exists('imagettftext');

            // Background noise lines
            $noiseColors = ['#cbd5e1', '#94a3b8', '#c7d2fe'];
            for ($i = 0; $i < 7; $i++) {
                $color = $noiseColors[random_int(0, count($noiseColors) - 1)];
                $image->drawLine(function ($line) use ($width, $height, $color) {
                    $line->from(random_int(0, 40), random_int(0, $height));
                    $line->to(random_int($width - 40, $width), random_int(0, $height));
                    $line->color($color);
                    $line->width(1);
                });
            }

            if (!$hasFont) {
                return null; // Fall back to native GD if FreeType/font is missing
            }

            $textColors = ['#1e1b4b', '#312e81', '#4338ca', '#3730a3', '#1d4ed8'];
            $x = 38;
            for ($i = 0; $i < strlen($captchaText); $i++) {
                $color = $textColors[random_int(0, count($textColors) - 1)];
                $char = $captchaText[$i];
                $y = random_int(42, 54);
                $image->text($char, $x, $y, function ($font) use ($color, $fontPath) {
                    $font->filename($fontPath);
                    $font->size(random_int(28, 34));
                    $font->color($color);
                    $font->align('center');
                    $font->valign('middle');
                    $font->angle(random_int(-15, 15));
                });
                $x += 40;
            }

            return $image->toPng()->toString();
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function renderWithNativeGd(string $captchaText): string
    {
        $width = 280;
        $height = 80;
        $img = imagecreatetruecolor($width, $height);
        $bg = imagecolorallocate($img, 248, 250, 252);
        imagefill($img, 0, 0, $bg);

        $lineColor = imagecolorallocate($img, 148, 163, 184);
        for ($i = 0; $i < 8; $i++) {
            imageline($img, 0, random_int(0, $height), $width, random_int(0, $height), $lineColor);
        }

        $textColor = imagecolorallocate($img, 30, 27, 75);
        $x = 30;
        for ($i = 0; $i < strlen($captchaText); $i++) {
            imagestring($img, 5, $x, random_int(24, 38), $captchaText[$i], $textColor);
            $x += 38;
        }

        ob_start();
        imagepng($img);
        $data = ob_get_clean();
        imagedestroy($img);

        return $data ?: '';
    }
}
