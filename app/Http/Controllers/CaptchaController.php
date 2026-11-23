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

        $pngData = $this->renderWithIntervention($captchaText)
            ?? $this->renderWithNativeGd($captchaText)
            ?? $this->renderPurePhpPng($captchaText);

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

    private function renderWithNativeGd(string $captchaText): ?string
    {
        if (!function_exists('imagecreatetruecolor') || !function_exists('imagepng')) {
            return null;
        }

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

        return $data ?: null;
    }

    /**
     * Pure-PHP PNG fallback using zlib (requires no GD extension).
     */
    private function renderPurePhpPng(string $captchaText): string
    {
        $font = [
            'A' => ['01110','10001','10001','11111','10001','10001','10001'],
            'B' => ['11110','10001','10001','11110','10001','10001','11110'],
            'C' => ['01110','10001','10000','10000','10000','10001','01110'],
            'D' => ['11100','10010','10001','10001','10001','10010','11100'],
            'E' => ['11111','10000','10000','11110','10000','10000','11111'],
            'F' => ['11111','10000','10000','11110','10000','10000','10000'],
            'G' => ['01110','10001','10000','10111','10001','10001','01110'],
            'H' => ['10001','10001','10001','11111','10001','10001','10001'],
            'J' => ['00111','00010','00010','00010','10010','10010','01100'],
            'K' => ['10001','10010','10100','11000','10100','10010','10001'],
            'L' => ['10000','10000','10000','10000','10000','10000','11111'],
            'M' => ['10001','11011','10101','10101','10001','10001','10001'],
            'N' => ['10001','11001','10101','10011','10001','10001','10001'],
            'P' => ['11110','10001','10001','11110','10000','10000','10000'],
            'Q' => ['01110','10001','10001','10001','10101','10010','01101'],
            'R' => ['11110','10001','10001','11110','10100','10010','10001'],
            'S' => ['01111','10000','10000','01110','00001','00001','11110'],
            'T' => ['11111','00100','00100','00100','00100','00100','00100'],
            'U' => ['10001','10001','10001','10001','10001','10001','01110'],
            'V' => ['10001','10001','10001','10001','10001','01010','00100'],
            'W' => ['10001','10001','10001','10101','10101','11011','10001'],
            'X' => ['10001','10001','01010','00100','01010','10001','10001'],
            'Y' => ['10001','10001','01010','00100','00100','00100','00100'],
            'Z' => ['11111','00001','00010','00100','01000','10000','11111'],
            '2' => ['01110','10001','00001','00110','01000','10000','11111'],
            '3' => ['11110','00001','00001','01110','00001','00001','11110'],
            '4' => ['00010','00110','01010','10010','11111','00010','00010'],
            '5' => ['11111','10000','11110','00001','00001','10001','01110'],
            '6' => ['01110','10000','11110','10001','10001','10001','01110'],
            '7' => ['11111','00001','00010','00100','01000','01000','01000'],
            '8' => ['01110','10001','10001','01110','10001','10001','01110'],
            '9' => ['01110','10001','10001','01111','00001','00001','01110'],
        ];

        $width = 280;
        $height = 80;
        $scale = 5;
        $raw = '';
        $grid = array_fill(0, $height, array_fill(0, $width, [248, 250, 252]));

        $startX = 24;
        for ($c = 0; $c < strlen($captchaText); $c++) {
            $glyph = $font[$captchaText[$c]] ?? $font['A'];
            $offsetY = random_int(18, 26);
            for ($row = 0; $row < 7; $row++) {
                for ($col = 0; $col < 5; $col++) {
                    if ($glyph[$row][$col] === '1') {
                        for ($sy = 0; $sy < $scale; $sy++) {
                            for ($sx = 0; $sx < $scale; $sx++) {
                                $py = $offsetY + $row * $scale + $sy;
                                $px = $startX + $col * $scale + $sx;
                                if ($py >= 0 && $py < $height && $px >= 0 && $px < $width) {
                                    $grid[$py][$px] = [30, 27, 75];
                                }
                            }
                        }
                    }
                }
            }
            $startX += 40;
        }

        for ($y = 0; $y < $height; $y++) {
            $raw .= "\x00";
            for ($x = 0; $x < $width; $x++) {
                $px = $grid[$y][$x];
                $raw .= chr($px[0]) . chr($px[1]) . chr($px[2]);
            }
        }

        $chunk = function (string $type, string $data): string {
            return pack('N', strlen($data)) . $type . $data . pack('N', crc32($type . $data));
        };

        $ihdr = pack('NNCCCCC', $width, $height, 8, 2, 0, 0, 0);
        $idat = gzcompress($raw, 6);

        return "\x89PNG\r\n\x1a\n"
            . $chunk('IHDR', $ihdr)
            . $chunk('IDAT', $idat)
            . $chunk('IEND', '');
    }
}
