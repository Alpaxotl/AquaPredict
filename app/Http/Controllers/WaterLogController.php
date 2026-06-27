<?php

namespace App\Http\Controllers;

use App\Models\Pond;
use App\Models\WaterLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WaterLogController extends Controller
{
    // Rules validasi 14 parameter (dipakai di store() dan update())
    private function validationRules(): array
    {
        return [
            'ph' => 'required|numeric|between:0,14',
            'temperature' => 'required|numeric|between:0,50',
            'dissolved_oxygen' => 'required|numeric|between:0,20',
            'turbidity' => 'required|numeric|between:0,200',
            'bod' => 'required|numeric|between:0,20',
            'co2' => 'required|numeric|between:0,50',
            'alkalinity' => 'required|numeric|between:0,300',
            'hardness' => 'required|numeric|between:0,300',
            'calcium' => 'required|numeric|between:0,300',
            'ammonia' => 'required|numeric|between:0,5',
            'nitrite' => 'required|numeric|between:0,10',
            'phosphorus' => 'required|numeric|between:0,5',
            'h2s' => 'required|numeric|between:0,2',
            'plankton' => 'required|numeric|between:0,10000',
        ];
    }

    private function validationMessages(): array
    {
        return [
            'ph.required' => 'pH wajib diisi.',
            'ph.between' => 'pH harus bernilai antara 0 - 14.',
            'temperature.required' => 'Suhu wajib diisi.',
            'temperature.between' => 'Suhu harus bernilai antara 0 - 50°C.',
            'dissolved_oxygen.required' => 'DO wajib diisi.',
            'dissolved_oxygen.between' => 'DO harus bernilai antara 0 - 20 mg/L.',
            'turbidity.required' => 'Turbidity wajib diisi.',
            'turbidity.between' => 'Turbidity harus antara 0 - 200 cm.',
            'bod.required' => 'BOD wajib diisi.',
            'bod.between' => 'BOD harus antara 0 - 20 mg/L.',
            'co2.required' => 'CO2 wajib diisi.',
            'co2.between' => 'CO2 harus antara 0 - 50 mg/L.',
            'alkalinity.required' => 'Alkalinity wajib diisi.',
            'alkalinity.between' => 'Alkalinity harus antara 0 - 300 mg/L.',
            'hardness.required' => 'Hardness wajib diisi.',
            'hardness.between' => 'Hardness harus antara 0 - 300 mg/L.',
            'calcium.required' => 'Calcium wajib diisi.',
            'calcium.between' => 'Calcium harus antara 0 - 300 mg/L.',
            'ammonia.required' => 'Ammonia wajib diisi.',
            'ammonia.between' => 'Ammonia harus antara 0 - 5 mg/L.',
            'nitrite.required' => 'Nitrite wajib diisi.',
            'nitrite.between' => 'Nitrite harus antara 0 - 10 mg/L.',
            'phosphorus.required' => 'Phosphorus wajib diisi.',
            'phosphorus.between' => 'Phosphorus harus antara 0 - 5 mg/L.',
            'h2s.required' => 'H2S wajib diisi.',
            'h2s.between' => 'H2S harus antara 0 - 2 mg/L.',
            'plankton.required' => 'Plankton wajib diisi.',
            'plankton.between' => 'Plankton harus antara 0 - 10000 No./L.',
        ];
    }

    public function index(Request $request)
    {
        $query = WaterLog::with(['pond', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('pond', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sortField = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('order', 'desc');

        if (!in_array($sortField, ['created_at', 'ph', 'temperature', 'dissolved_oxygen', 'status'])) {
            $sortField = 'created_at';
        }
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
        }

        $waterLogs = $query->orderBy($sortField, $sortOrder)->paginate(10)->withQueryString();
        $ponds = Pond::all(); // Fetch ponds for the dropdown

        return view('water-logs.index', compact('waterLogs', 'ponds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            array_merge(['pond_id' => 'required|exists:ponds,id'], $this->validationRules()),
            array_merge(['pond_id.required' => 'Kolam wajib dipilih.', 'pond_id.exists' => 'Kolam tidak valid.'], $this->validationMessages())
        );

        $pond = Pond::findOrFail($request->pond_id);

        $analysis = $this->callAnalysisService($validated);

        WaterLog::create(array_merge($validated, [
            'status' => $analysis['status'],
            'recommendation' => $analysis['recommendation'],
            'recorded_by' => Auth::id(),
        ]));

        return redirect()->back()->with('success', 'Catatan kualitas air berhasil disimpan dengan status: ' . $analysis['status']);
    }

    public function update(Request $request, WaterLog $waterLog)
    {
        if (Auth::user()->role !== 'admin' && $waterLog->recorded_by !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk mengubah log kualitas air milik staf lain.');
        }

        $validated = $request->validate(
            array_merge(['pond_id' => 'required|exists:ponds,id'], $this->validationRules()),
            array_merge(['pond_id.required' => 'Kolam wajib dipilih.', 'pond_id.exists' => 'Kolam tidak valid.'], $this->validationMessages())
        );

        $analysis = $this->callAnalysisService($validated);

        $waterLog->update(array_merge($validated, [
            'status' => $analysis['status'],
            'recommendation' => $analysis['recommendation'],
        ]));

        return redirect()->back()->with('success', 'Catatan kualitas air berhasil diperbarui.');
    }

    public function destroy(WaterLog $waterLog)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Akses Ditolak! Hanya administrator yang dapat menghapus log kualitas air secara permanen.');
        }

        $waterLog->delete();
        return redirect()->back()->with('success', 'Catatan kualitas air berhasil dihapus secara permanen.');
    }

    public function edit(WaterLog $waterLog)
    {
        $ponds = Pond::all();
        return view('water-logs.edit', compact('waterLog', 'ponds'));
    }

    /**
     * Call FastAPI analysis service (14 parameter lengkap) dengan local fallback.
     */
    private function callAnalysisService(array $data)
    {
        try {
            $fastapiUrl = env('FASTAPI_URL', 'http://127.0.0.1:8001');
            $response = Http::timeout(5)->post($fastapiUrl . '/analyze', [
                'temp' => floatval($data['temperature']),
                'turbidity' => floatval($data['turbidity']),
                'do' => floatval($data['dissolved_oxygen']),
                'bod' => floatval($data['bod']),
                'co2' => floatval($data['co2']),
                'ph' => floatval($data['ph']),
                'alkalinity' => floatval($data['alkalinity']),
                'hardness' => floatval($data['hardness']),
                'calcium' => floatval($data['calcium']),
                'ammonia' => floatval($data['ammonia']),
                'nitrite' => floatval($data['nitrite']),
                'phosphorus' => floatval($data['phosphorus']),
                'h2s' => floatval($data['h2s']),
                'plankton' => floatval($data['plankton']),
            ]);

            if ($response->successful()) {
                return $response->json();
            }
        } catch (\Exception $e) {
            Log::warning('FastAPI service unreachable, running local fallback analysis: ' . $e->getMessage());
        }

        // Local Fallback analysis jika FastAPI down (hanya pakai pH, suhu, DO sebagai pendekatan kasar)
        $ph = $data['ph'];
        $temp = $data['temperature'];
        $do = $data['dissolved_oxygen'];

        $status = 'Optimal';
        $issues = [];

        $ph_min = 6.5; $ph_max = 8.5; $temp_min = 25.0; $temp_max = 32.0; $do_min = 4.0;

        if ($ph < $ph_min || $ph > $ph_max) {
            $status = ($ph < ($ph_min - 0.5) || $ph > ($ph_max + 0.5)) ? 'Kritis' : 'Atensi';
            $issues[] = 'pH di luar batas';
        }
        if ($temp < $temp_min || $temp > $temp_max) {
            $status = ($status === 'Kritis' || $temp > ($temp_max + 2)) ? 'Kritis' : 'Atensi';
            $issues[] = 'Suhu tidak ideal';
        }
        if ($do < $do_min) {
            $status = ($do < ($do_min - 1.0)) ? 'Kritis' : 'Atensi';
            $issues[] = 'DO rendah';
        }

        $recommendation = "Analisis Lokal (Fallback - ML Service tidak aktif): Status Air " . $status . ". ";
        if ($status !== 'Optimal') {
            $recommendation .= "Terdeteksi fluktuasi parameter: " . implode(', ', $issues) . ". Periksa sirkulasi air dan pertimbangkan penambahan kapur dolomit jika asam.";
        } else {
            $recommendation .= "Kondisi air optimal.";
        }

        return [
            'status' => $status,
            'recommendation' => $recommendation,
        ];
    }
}