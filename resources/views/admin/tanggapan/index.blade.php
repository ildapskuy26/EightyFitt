@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="fw-bold text-gradient mb-2 animate-fade-in">
                        <i class="bi bi-chat-square-text-fill me-3 text-primary"></i>
                        Daftar Tanggapan Pengguna
                    </h2>
                    <p class="text-muted mb-0 animate-fade-in-delay">
                        Kelola dan pantau semua tanggapan yang masuk dari pengguna UKS
                    </p>
                </div>
                <div class="d-flex align-items-center gap-2 animate-slide-in-right">
                    <span class="badge bg-primary fs-6 pulse">
                        <i class="bi bi-envelope me-1"></i>
                        {{ $tanggapans->total() }} Total
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card stat-card bg-warning bg-opacity-10 border-warning animate-card-pop">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-clock-history fs-2 text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="fw-bold text-warning mb-1">{{ $tanggapans->where('status', 'baru')->count() }}</h4>
                            <p class="text-muted mb-0">Tanggapan Baru</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card stat-card bg-info bg-opacity-10 border-info animate-card-pop" style="animation-delay: 0.1s">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-eye fs-2 text-info"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="fw-bold text-info mb-1">{{ $tanggapans->where('status', 'dibaca')->count() }}</h4>
                            <p class="text-muted mb-0">Sudah Dibaca</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden animate-slide-up">
        <div class="card-header bg-gradient-primary text-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0 fw-semibold">
                        <i class="bi bi-list-ul me-2"></i>
                        Daftar Semua Tanggapan
                    </h5>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="fw-semibold text-muted">Pengguna</th>
                        <th class="fw-semibold text-muted">Pesan</th>
                        <th class="fw-semibold text-muted text-center">Status</th>
                        <th class="fw-semibold text-muted text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tanggapans as $index => $t)
                    <tr class="border-bottom animate-row-fade" style="animation-delay: {{ $index * 0.05 }}s">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle bg-primary text-white me-3">
                                    {{ strtoupper(substr($t->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <h6 class="mb-1 fw-semibold">{{ $t->nama }}</h6>
                                    <p class="text-muted mb-0 small">{{ $t->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="message-preview">
                                <p class="mb-1 text-dark fw-medium">{{ Str::limit($t->pesan, 80) }}</p>
                                <small class="text-muted">{{ $t->created_at->diffForHumans() }}</small>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($t->status == 'baru')
                            <span class="badge bg-warning text-dark fs-7 px-3 py-2 animate-pulse">
                                <i class="bi bi-clock me-1"></i>Baru
                            </span>
                            @elseif($t->status == 'dibaca')
                            <span class="badge bg-info text-white fs-7 px-3 py-2">
                                <i class="bi bi-eye me-1"></i>Dibaca
                            </span>
                            @else
                            <span class="badge bg-success text-white fs-7 px-3 py-2">
                                <i class="bi bi-check-circle me-1"></i>Selesai
                            </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                @if($t->status == 'baru')
                                <form action="{{ route('tanggapan.read', $t->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-primary btn-sm px-3 animate-bounce-hover" 
                                            data-bs-toggle="tooltip" title="Tandai sebagai dibaca">
                                        <i class="bi bi-check-lg me-1"></i>Dibaca
                                    </button>
                                </form>
                                @else
                                <span class="text-muted small">Telah Diproses</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="empty-state animate-fade-in">
                                <i class="bi bi-inbox display-1 text-muted"></i>
                                <h4 class="text-muted mt-3">Belum ada tanggapan</h4>
                                <p class="text-muted">Tidak ada tanggapan yang masuk saat ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($tanggapans->hasPages())
        <div class="card-footer bg-white border-0 py-4 animate-fade-in">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan {{ $tanggapans->firstItem() ?? 0 }} - {{ $tanggapans->lastItem() ?? 0 }} dari {{ $tanggapans->total() }} tanggapan
                </div>
                <div>
                    {{ $tanggapans->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
/* Custom Styles */
.text-gradient {
    background: linear-gradient(135deg, #2E7D32, #4CAF50);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #2E7D32, #4CAF50) !important;
}

.stat-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.avatar-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1.1rem;
}

.message-preview {
    max-width: 300px;
}

.fs-7 {
    font-size: 0.85rem;
}

.empty-state {
    opacity: 0.7;
}

.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
}

.card {
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.badge {
    border-radius: 6px;
    font-weight: 500;
}

/* Animations */
.animate-fade-in {
    animation: fadeIn 0.8s ease-out;
}

.animate-fade-in-delay {
    animation: fadeIn 1s ease-out 0.3s both;
}

.animate-slide-in-right {
    animation: slideInRight 0.8s ease-out 0.5s both;
}

.animate-card-pop {
    animation: cardPop 0.6s ease-out both;
}

.animate-slide-up {
    animation: slideUp 0.8s ease-out 0.2s both;
}

.animate-row-fade {
    animation: rowFade 0.6s ease-out both;
}

.animate-pulse {
    animation: pulse 2s infinite;
}

.animate-bounce-hover {
    transition: all 0.3s ease;
}

.animate-bounce-hover:hover {
    transform: translateY(-2px);
}

.pulse {
    animation: pulse 2s infinite;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes cardPop {
    0% {
        opacity: 0;
        transform: scale(0.8) translateY(20px);
    }
    100% {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes rowFade {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

/* Staggered animation for table rows */
.animate-row-fade:nth-child(1) { animation-delay: 0.05s; }
.animate-row-fade:nth-child(2) { animation-delay: 0.1s; }
.animate-row-fade:nth-child(3) { animation-delay: 0.15s; }
.animate-row-fade:nth-child(4) { animation-delay: 0.2s; }
.animate-row-fade:nth-child(5) { animation-delay: 0.25s; }
.animate-row-fade:nth-child(6) { animation-delay: 0.3s; }
.animate-row-fade:nth-child(7) { animation-delay: 0.35s; }
.animate-row-fade:nth-child(8) { animation-delay: 0.4s; }
.animate-row-fade:nth-child(9) { animation-delay: 0.45s; }
.animate-row-fade:nth-child(10) { animation-delay: 0.5s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Add hover effects to cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>
@endsection