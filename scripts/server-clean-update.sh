#!/usr/bin/env bash
# ==============================================================================
# BalaKutaK CMS - Server Clean, Security Update & Hardening Script
# Usage: bash scripts/server-clean-update.sh
# ==============================================================================
set -e

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$APP_DIR"

echo ">>> [1/5] Membersihkan git lock & mengembalikan file ter-track ke versi bersih GitHub..."
rm -f .git/index.lock
git fetch origin main
git reset --hard origin/main

echo ">>> [2/5] Memindai & menghapus file berbahaya (.php/.phtml/.html/.svg) di folder upload..."
find storage/app/public/ -type f \( -iname "*.php*" -o -iname "*.phtml" -o -iname "*.phar" -o -iname "*.html" -o -iname "*.htm" -o -iname "*.svg" \) -print -delete 2>/dev/null || true

# Hapus file PHP liar di public/ selain public/index.php
find public/ -maxdepth 3 -type f \( -iname "*.php*" -o -iname "*.phtml" \) ! -path "public/index.php" -print -delete 2>/dev/null || true

echo ">>> [3/5] Memeriksa sisa string spam judi di view/public/config..."
grep -rnE "Aurora Toto|MAXI188|Wukong778|slot777|unicorn778" app/ bootstrap/ config/ public/ resources/ routes/ 2>/dev/null || echo "Bersih: tidak ditemukan string spam pada kode aplikasi."

echo ">>> [4/6] Menjalankan migrasi database & pembersihan artefak pentest/spam..."
php artisan migrate --force
php artisan security:cleanup --force

echo ">>> [5/6] Mengatur permission & kepemilikan folder (www:www)..."
if id "www" &>/dev/null; then
    chown -R www:www storage bootstrap/cache
fi
chmod -R 755 storage bootstrap/cache

echo ">>> [6/6] Membersihkan seluruh cache Laravel..."
php artisan optimize:clear

echo ">>> Selesai! Aplikasi telah bersih dan diperbarui ke commit terbaru:"
git log -1 --oneline
