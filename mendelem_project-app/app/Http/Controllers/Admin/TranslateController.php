<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Article, Product, Project, Gallery, ContactMessage, Slider, TeamMember};
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; use Illuminate\Http\Request;
class TranslateController extends Controller
{
    /**
     * Auto-translate Indonesian text to English.
     * Uses MyMemory free API (no key required, 5000 words/day free).
     * Falls back gracefully if quota exceeded.
     */
    public function translate(Request $request)
    {
        $request->validate(['text' => 'required|string|max:5000']);

        $text = $request->input('text');

        // Try MyMemory API (free, no key needed)
        try {
            $url = 'https://api.mymemory.translated.net/get?' . http_build_query([
                'q'        => $text,
                'langpair' => 'id|en',
                'de'       => config('mail.from.address', 'mendelemproject@gmail.com'),
            ]);

            $response = file_get_contents($url);
            $data     = json_decode($response, true);

            if ($data && $data['responseStatus'] == 200) {
                return response()->json([
                    'success'    => true,
                    'translated' => $data['responseData']['translatedText'],
                    'source'     => 'mymemory',
                ]);
            }
        } catch (\Exception $e) {
            // log and fall through to fallback
            \Log::warning('MyMemory translation failed: ' . $e->getMessage());
        }

        // Fallback: LibreTranslate (public instance)
        try {
            $ch = curl_init('https://libretranslate.de/translate');
            curl_setopt_array($ch, [
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => json_encode(['q'=>$text,'source'=>'id','target'=>'en','format'=>'text']),
                CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 10,
            ]);
            $result = curl_exec($ch);
            curl_close($ch);
            $decoded = json_decode($result, true);

            if (isset($decoded['translatedText'])) {
                return response()->json([
                    'success'    => true,
                    'translated' => $decoded['translatedText'],
                    'source'     => 'libretranslate',
                ]);
            }
        } catch (\Exception $e) {
            \Log::warning('LibreTranslate failed: ' . $e->getMessage());
        }

        return response()->json([
            'success' => false,
            'message' => 'Terjemahan otomatis tidak tersedia saat ini. Silakan isi versi Inggris secara manual.',
        ], 503);
    }
}
