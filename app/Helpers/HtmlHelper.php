<?php

namespace App\Helpers;

class HtmlHelper
{
    /**
     * Sanitize and fix unclosed HTML tags in an HTML fragment.
     *
     * Strips dangerous tags (<script>, <object>, <embed>, <applet>, <base>, <meta>, <link>, <form>),
     * removes inline event handlers (on*), blocks javascript:/vbscript:/data: URIs,
     * and restricts <iframe> to trusted embed origins (YouTube / Google).
     *
     * @param string|null $html
     * @return string
     */
    public static function fixHtmlTags($html)
    {
        if (empty($html) || empty(trim($html))) {
            return (string) $html;
        }

        // 1. Strip <script> blocks completely (never preserve executable JS)
        $html = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $html);
        $html = preg_replace('/<script\b[^>]*\/?>/is', '', $html);

        // 2. Preserve safe <style> blocks (for Page Builder CSS) while stripping any embedded scripts/expressions
        $preservedStyles = [];
        $counter = 0;

        $htmlProcessed = preg_replace_callback(
            '/<style\b[^>]*>(.*?)<\/style>/si',
            function ($matches) use (&$preservedStyles, &$counter) {
                $css = $matches[1];
                // Strip dangerous CSS expressions or javascript urls
                $css = preg_replace('/expression\s*\(/i', '/*blocked*/(', $css);
                $css = preg_replace('/javascript\s*:/i', '/*blocked*/:', $css);
                $css = str_ireplace('</style', '', $css);
                $placeholder = "<!--PRESERVED_STYLE_{$counter}-->";
                $preservedStyles[$placeholder] = '<style>' . $css . '</style>';
                $counter++;
                return $placeholder;
            },
            $html
        );

        // 3. Parse with DOMDocument to sanitize attributes & dangerous elements
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML(
            '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><div>' . $htmlProcessed . '</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();

        $dangerousTags = ['script', 'object', 'embed', 'applet', 'base', 'meta', 'link', 'form', 'svg'];
        $xpath = new \DOMXPath($dom);

        foreach ($dangerousTags as $tag) {
            foreach ($xpath->query('//' . $tag) as $node) {
                $node->parentNode?->removeChild($node);
            }
        }

        // Validate iframes: only allow trusted YouTube / Google Maps / Google Drive embeds
        foreach ($xpath->query('//iframe') as $iframe) {
            $src = $iframe->getAttribute('src');
            if (!self::isTrustedEmbedUrl($src)) {
                $iframe->parentNode?->removeChild($iframe);
            }
        }

        // Strip all on* event handlers and dangerous URI schemes
        foreach ($xpath->query('//*') as $el) {
            if (!$el->hasAttributes()) {
                continue;
            }
            $toRemove = [];
            foreach ($el->attributes as $attr) {
                $name = strtolower($attr->name);
                $val = trim(html_entity_decode($attr->value, ENT_QUOTES | ENT_HTML5, 'UTF-8'));

                if (str_starts_with($name, 'on') || $name === 'srcdoc') {
                    $toRemove[] = $attr->name;
                    continue;
                }

                if (in_array($name, ['href', 'src', 'action', 'formaction', 'xlink:href', 'poster'], true)) {
                    $normalized = preg_replace('/[\x00-\x20]+/', '', strtolower($val));
                    if (
                        str_starts_with($normalized, 'javascript:') ||
                        str_starts_with($normalized, 'vbscript:') ||
                        (str_starts_with($normalized, 'data:') && !preg_match('/^data:image\/(png|jpeg|jpg|gif|webp);base64,/i', $normalized))
                    ) {
                        $toRemove[] = $attr->name;
                    }
                }
            }
            foreach ($toRemove as $attrName) {
                $el->removeAttribute($attrName);
            }
        }

        // 4. Retrieve the inner HTML of our wrapper div
        $output = '';
        $wrapper = $dom->getElementsByTagName('div')->item(0);
        if ($wrapper) {
            foreach ($wrapper->childNodes as $child) {
                $output .= $dom->saveHTML($child);
            }
        } else {
            $output = $dom->saveHTML();
        }

        // 5. Restore preserved <style> blocks
        foreach ($preservedStyles as $placeholder => $original) {
            $output = str_replace($placeholder, $original, $output);
        }

        return $output;
    }

    private static function isTrustedEmbedUrl(?string $url): bool
    {
        if (empty($url)) {
            return false;
        }
        $parts = parse_url(trim($url));
        if (!$parts || !in_array(strtolower($parts['scheme'] ?? ''), ['https', 'http'], true)) {
            return false;
        }
        $host = strtolower($parts['host'] ?? '');
        $allowedHosts = [
            'www.youtube.com',
            'youtube.com',
            'www.youtube-nocookie.com',
            'youtu.be',
            'www.google.com',
            'maps.google.com',
            'drive.google.com',
            'docs.google.com',
        ];
        return in_array($host, $allowedHosts, true);
    }
}
