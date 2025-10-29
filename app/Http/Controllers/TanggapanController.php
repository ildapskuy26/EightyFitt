<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class TanggapanController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'pesan'  => 'required|string',
            'priority' => 'nullable|string|in:normal,segera,tinggi,medium',
        ];

        // If the database has the 'subjek' column, validate it; otherwise ignore
        if (Schema::hasColumn((new Tanggapan)->getTable(), 'subjek')) {
            $rules['subjek'] = 'nullable|string|max:255';
        }

        $request->validate($rules);

        $data = [
            'nama'   => $request->nama,
            'email'  => $request->email,
            'pesan'  => $request->pesan,
            'status' => 'baru',
        ];

        // Determine priority: explicit request takes precedence, otherwise infer from subjek
        $inferredPriority = 'normal';
        if ($request->filled('subjek')) {
            $sub = $request->subjek;
            if ($sub === 'konsultasi') {
                $inferredPriority = 'segera';
            } else {
                $inferredPriority = 'normal';
            }
        }

        $data['priority'] = $request->priority ?? $inferredPriority;

        if (Schema::hasColumn((new Tanggapan)->getTable(), 'subjek') && $request->filled('subjek')) {
            $data['subjek'] = $request->subjek;
        }

        Tanggapan::create($data);

        return redirect()->back()->with('success', 'Tanggapan berhasil dikirim!');
    }

    // Tampilkan semua tanggapan (untuk admin/petugas)
    public function index()
    {
        $query = Tanggapan::query();

        // Filters: date range and priority and search
        $dateFrom = request('date_from');
        $dateTo = request('date_to');
        $priority = request('priority');
        $q = request('q');

        if (!empty($dateFrom)) {
            try {
                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($dateFrom)));
            } catch (\Exception $e) {
                // ignore invalid date
            }
        }

        if (!empty($dateTo)) {
            try {
                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($dateTo)));
            } catch (\Exception $e) {
                // ignore invalid date
            }
        }

        if (!empty($priority)) {
            $query->where('priority', $priority);
        }

        if (!empty($q)) {
            $query->where(function($sub) use ($q) {
                $sub->where('nama', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('pesan', 'like', "%{$q}%");
            });
        }

        $tanggapans = $query->latest()->paginate(10)->withQueryString();
        return view('admin.tanggapan.index', compact('tanggapans'));
    }

    // Hapus tanggapan
    public function destroy($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->delete();
        return redirect()->back()->with('success', 'Tanggapan dihapus.');
    }

    // Ubah status jadi dibaca
    public function markAsRead($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->update(['status' => 'dibaca']);
        return redirect()->back()->with('success', 'Tanggapan telah ditandai sebagai dibaca.');
    }

    // Update status or priority from admin panel
    public function updateStatus(Request $request, $id)
    {
        $tanggapan = Tanggapan::findOrFail($id);

        $data = [];
        if ($request->filled('status')) {
            $data['status'] = $request->status;
        }
        if ($request->filled('priority')) {
            $data['priority'] = $request->priority;
        }

        if (!empty($data)) {
            $tanggapan->update($data);
        }

        return redirect()->back()->with('success', 'Tanggapan diperbarui.');
    }
}
