<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Obat;
use App\Models\Kunjungan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class KunjunganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan daftar kunjungan.
     */
    public function index(Request $request)
{
    $query = Kunjungan::with('obat');

    // Filter pencarian
    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('nis', 'like', "%{$request->keyword}%")
              ->orWhere('nama', 'like', "%{$request->keyword}%");
        });
    }

    // Filter kelas
    if ($request->filled('kelas')) {
        $query->where('kelas', 'like', "%{$request->kelas}%");
    }

    // Filter jurusan
    if ($request->filled('jurusan')) {
        $query->where('jurusan', 'like', "%{$request->jurusan}%");
    }

    // Filter rentang tanggal
    if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
        $query->whereBetween('waktu_kedatangan', [
            $request->tanggal_mulai . ' 00:00:00',
            $request->tanggal_selesai . ' 23:59:59'
        ]);
    }

    $kunjungan = $query->latest()->get();

        // 🏫 Filter kelas dan jurusan
        if ($request->filled('kelas')) {
            $query->where('kelas', 'like', '%' . $request->kelas . '%');
        }

        if ($request->filled('jurusan')) {
            $query->where('jurusan', 'like', '%' . $request->jurusan . '%');
        }

        // 📅 Filter tanggal (rentang waktu)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = $request->start_date . ' 00:00:00';
            $end   = $request->end_date . ' 23:59:59';
            $query->whereBetween('waktu_kedatangan', [$start, $end]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('waktu_kedatangan', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('waktu_kedatangan', '<=', $request->end_date);
        }

        // ⏰ Urutkan dari terbaru + pagination
        $kunjungan = $query->latest()->paginate(15)->withQueryString();

        return view('kunjungan.index', compact('kunjungan'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $obat  = Obat::all();

        return view('kunjungan.create', compact('siswa', 'obat'));
    }

    /**
     * Simpan data kunjungan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis'              => 'required|exists:siswa,nis',
            'waktu_kedatangan' => 'required|date',
            'waktu_keluar'     => 'nullable|date|after_or_equal:waktu_kedatangan',
            'keluhan'          => 'nullable|string',
            'obat_id'          => 'nullable|exists:obat,id',
            'diagnosis'        => 'required|string|max:255',
            'tempat'           => 'required|in:UKS,Upacara',
        ]);

        $siswa = Siswa::where('nis', $validated['nis'])->firstOrFail();

        $kunjungan = Kunjungan::create([
            'nis'              => $siswa->nis,
            'nama'             => $siswa->nama,
            'kelas'            => $siswa->kelas,
            'jurusan'          => $siswa->jurusan,
            'waktu_kedatangan' => $validated['waktu_kedatangan'],
            'waktu_keluar'     => $validated['waktu_keluar'] ?? null,
            'keluhan'          => $validated['keluhan'] ?? null,
            'obat_id'          => $validated['obat_id'] ?? null,
            'diagnosis'        => $validated['diagnosis'],
            'tempat'           => $validated['tempat'],
             'petugas_id'       => Auth::id(), // <-- ini penting
        ]);

        // Hitung kunjungan minggu ini
        $kunjunganCount = Kunjungan::where('nis', $siswa->nis)
            ->whereBetween('waktu_kedatangan', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();

        if ($kunjunganCount >= 5) {
            Session::flash('alert', [
                'type' => 'danger',
                'message' => "⚠️ Siswa sudah berkunjung 5 kali minggu ini. Perlu dirujuk ke pusat layanan kesehatan!"
            ]);
        } elseif ($kunjunganCount >= 3) {
            Session::flash('alert', [
                'type' => 'warning',
                'message' => "⚠️ Siswa sudah berkunjung 3 kali minggu ini."
            ]);
        }

        return redirect()->route('kunjungan.index')->with('success', 'Data kunjungan berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail kunjungan.
     */
    public function show(Kunjungan $kunjungan)
    {
        return view('kunjungan.show', compact('kunjungan'));
    }

    /**
     * Form edit kunjungan.
     */
    public function edit(Kunjungan $kunjungan)
    {
        $siswa = Siswa::all();
        $obat  = Obat::all();

        return view('kunjungan.edit', compact('kunjungan', 'siswa', 'obat'));
    }

    /**
     * Update data kunjungan.
     */
    public function update(Request $request, Kunjungan $kunjungan)
    {
        $validated = $request->validate([
            'nis'              => 'required|exists:siswa,nis',
            'waktu_kedatangan' => 'required|date',
            'waktu_keluar'     => 'nullable|date|after_or_equal:waktu_kedatangan',
            'keluhan'          => 'nullable|string',
            'obat_id'          => 'nullable|exists:obat,id',
            'diagnosis'        => 'required|string|max:255',
            'tempat'           => 'required|in:UKS,Upacara',
        ]);

        $siswa = Siswa::where('nis', $validated['nis'])->firstOrFail();

        $kunjungan->update([
            'nis'              => $siswa->nis,
            'nama'             => $siswa->nama,
            'kelas'            => $siswa->kelas,
            'jurusan'          => $siswa->jurusan,
            'waktu_kedatangan' => $validated['waktu_kedatangan'],
            'waktu_keluar'     => $validated['waktu_keluar'] ?? null,
            'keluhan'          => $validated['keluhan'] ?? null,
            'obat_id'          => $validated['obat_id'] ?? null,
            'diagnosis'        => $validated['diagnosis'],
            'tempat'           => $validated['tempat'],
             'petugas_id'       => Auth::id(), // <-- ini penting
        ]);

        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil diperbarui.');
    }

    /**
     * Hapus data kunjungan.
     */
    public function destroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();

        return redirect()->route('kunjungan.index')
            ->with('success', 'Data kunjungan berhasil dihapus.');
    }

    /**
     * Ekspor data ke CSV
     */
    public function exportCsv(Request $request)
    {
        $filterType = $request->input('filter_type');
        $query = Kunjungan::with('obat');

        if ($filterType === 'week') {
            $start = $request->input('start_date');
            $end   = $request->input('end_date');
            if ($start && $end) {
                $query->whereBetween('waktu_kedatangan', [
                    Carbon::parse($start)->startOfDay(),
                    Carbon::parse($end)->endOfDay(),
                ]);
            }
        } elseif ($filterType === 'month') {
            $month = (int) $request->input('month_only');
            $year  = (int) $request->input('year_only');
            if ($month && $year) {
                $query->whereYear('waktu_kedatangan', $year)
                      ->whereMonth('waktu_kedatangan', $month);
            }
        } elseif ($filterType === 'year') {
            $year = (int) $request->input('year_filter');
            if ($year) {
                $query->whereYear('waktu_kedatangan', $year);
            }
        }

        $kunjungan = $query->orderBy('waktu_kedatangan', 'desc')->get();

        $fileName = 'kunjungan_' . ($filterType ?? 'semua') . '_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$fileName}",
        ];

        $columns = ['No', 'NIS', 'Nama', 'Kelas', 'Jurusan', 'Waktu Kedatangan', 'Waktu Keluar', 'Keluhan', 'Diagnosis', 'Obat'];

        $callback = function () use ($kunjungan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            $no = 1;
            foreach ($kunjungan as $k) {
                fputcsv($file, [
                    $no++,
                    $k->nis,
                    $k->nama,
                    $k->kelas,
                    $k->jurusan,
                    $k->waktu_kedatangan,
                    $k->waktu_keluar ?? '-',
                    $k->keluhan ?? '-',
                    $k->diagnosis ?? '-',
                    optional($k->obat)->nama ?? '-',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Halaman laporan kunjungan
     */
    public function laporan(Request $request)
    {
        $filter = $request->get('filter', 'mingguan');

        $data = match ($filter) {
            'mingguan' => Kunjungan::selectRaw('YEARWEEK(waktu_kedatangan, 1) as periode, COUNT(*) as total')
                            ->groupBy('periode')
                            ->orderBy('periode', 'desc')
                            ->take(10)
                            ->get(),
            'bulanan'  => Kunjungan::selectRaw('DATE_FORMAT(waktu_kedatangan, "%Y-%m") as periode, COUNT(*) as total')
                            ->groupBy('periode')
                            ->orderBy('periode', 'desc')
                            ->take(12)
                            ->get(),
            'tahunan'  => Kunjungan::selectRaw('YEAR(waktu_kedatangan) as periode, COUNT(*) as total')
                            ->groupBy('periode')
                            ->orderBy('periode', 'desc')
                            ->take(5)
                            ->get(),
            default    => collect(),
        };

        return view('kunjungan.laporan', compact('data', 'filter'));
    }
}
