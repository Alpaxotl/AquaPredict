<?php

namespace App\Http\Controllers;

use App\Models\Pond;
use App\Models\WaterLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPonds = Pond::count();
        $totalLogs = WaterLog::count();
        
        // Calculate averages
        $avgPh = WaterLog::avg('ph') ?? 7.0;
        $avgTemp = WaterLog::avg('temperature') ?? 28.0;
        $avgDo = WaterLog::avg('dissolved_oxygen') ?? 5.0;

        // Status distributions
        $optimalCount = WaterLog::where('status', 'Optimal')->count();
        $atensiCount = WaterLog::where('status', 'Atensi')->count();
        $kritisCount = WaterLog::where('status', 'Kritis')->count();

        // Recent logs
        $recentLogs = WaterLog::with('pond')->orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalPonds', 'totalLogs', 'avgPh', 'avgTemp', 'avgDo',
            'optimalCount', 'atensiCount', 'kritisCount', 'recentLogs'
        ));
    }

    public function showAnalyzer()
    {
        $ponds = Pond::all();
        return view('analyzer', compact('ponds'));
    }

    public function processAnalyzer(Request $request)
    {
        $request->validate([
            'ph' => 'required|numeric',
            'temp' => 'required|numeric',
            'do' => 'required|numeric',
            'turbidity' => 'required|numeric',
            'bod' => 'required|numeric',
            'co2' => 'required|numeric',
            'alkalinity' => 'required|numeric',
            'hardness' => 'required|numeric',
            'calcium' => 'required|numeric',
            'ammonia' => 'required|numeric',
            'nitrite' => 'required|numeric',
            'phosphorus' => 'required|numeric',
            'h2s' => 'required|numeric',
            'plankton' => 'required|numeric',
        ]);

        // Request analysis to FastAPI
        $fastapiUrl = env('FASTAPI_URL', 'http://127.0.0.1:8001');
        try {
            $response = Http::timeout(5)->post($fastapiUrl . '/analyze', [
                'ph' => floatval($request->ph),
                'temp' => floatval($request->temp),
                'do' => floatval($request->do),
                'turbidity' => floatval($request->turbidity),
                'bod' => floatval($request->bod),
                'co2' => floatval($request->co2),
                'alkalinity' => floatval($request->alkalinity),
                'hardness' => floatval($request->hardness),
                'calcium' => floatval($request->calcium),
                'ammonia' => floatval($request->ammonia),
                'nitrite' => floatval($request->nitrite),
                'phosphorus' => floatval($request->phosphorus),
                'h2s' => floatval($request->h2s),
                'plankton' => floatval($request->plankton),
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return response()->json($result);
            }
        } catch (\Exception $e) {
            Log::warning('FastAPI offline in analysis sandbox: ' . $e->getMessage());
        }

        // Local fallback
        return response()->json([
            'status' => 'Atensi',
            'recommendation' => 'Peringatan: Layanan backend FastAPI sedang offline atau gagal memproses data (Error: ' . ($e->getMessage() ?? 'Unknown') . '). Menggunakan analisis cadangan lokal.'
        ]);
    }

    public function showConsultation()
    {
        return view('consultation');
    }

    public function processConsultation(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        try {
            $fastapiUrl = env('FASTAPI_URL', 'http://127.0.0.1:8001');
            $response = Http::timeout(3)->post($fastapiUrl . '/consult', [
                'message' => $request->message,
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }
        } catch (\Exception $e) {
            Log::warning('FastAPI offline in consultation: ' . $e->getMessage());
        }

        return response()->json([
            'response' => 'Maaf, layanan konsultasi budidaya (FastAPI) sedang offline. Silakan coba sesaat lagi.'
        ]);
    }
}
