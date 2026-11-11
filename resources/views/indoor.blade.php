<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Venue - Indoor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .topbar { background: linear-gradient(90deg, #800080, #ff00ff); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .status-baik { background-color: #d1e7dd; color: #0f5132; }
        .status-rawat { background-color: #fff3cd; color: #664d03; }
        .nav-pills .nav-link.active { background-color: #800080 !important; color: white !important; }
        .nav-pills .nav-link { color: #6c757d; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="topbar p-3 mb-4 text-white d-flex justify-content-between align-items-center px-4">
        <h3 class="fw-bold m-0 text-uppercase" style="letter-spacing: 1px;">Manajemen Venue</h3>
        
        <!-- Bagian ini akan menampilkan Nama, Role, dan Tombol Logout -->
        <div class="d-flex align-items-center gap-3">
            <div class="text-end d-none d-md-block">
                <div class="fw-bold fs-6">{{ auth()->user()->name }}</div>
                <div class="badge bg-light text-dark text-uppercase" style="font-size: 0.7rem;">
                    Role: {{ auth()->user()->role }}
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm fw-bold shadow-sm">Logout</button>
            </form>
        </div>
    </header>

    <div class="container my-4 flex-grow-1"> 
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4 text-dark">Daftar Lapangan & Area</h4>
                        <ul class="nav nav-pills mb-4 bg-light p-1 rounded-3">
                            <li class="nav-item"><a class="nav-link py-2 px-4 rounded-3 fw-semibold" href="/">Semua Lapangan</a></li>
                            <li class="nav-item"><a class="nav-link py-2 px-4 rounded-3 fw-semibold active" href="/indoor">Indoor</a></li>
                            <li class="nav-item"><a class="nav-link py-2 px-4 rounded-3 fw-semibold" href="/outdoor">Outdoor</a></li>
                        </ul>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="py-3 ps-3" style="width: 5%">No</th>
                                        <th class="py-3">Nama Lapangan</th>
                                        <th class="py-3">Kategori</th>
                                        <th class="py-3">Bahan Lantai</th>
                                        <th class="py-3">Panjang</th>
                                        <th class="py-3">Lebar</th>
                                        <th class="py-3 ps-3">Status</th>
                                        <th class="py-3 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lapangans as $index => $row)
                                        @php
                                            $status_class = ($row->status === 'Baik') ? 'status-baik' : 'status-rawat';
                                            $badge_text = ($row->status === 'Baik') ? 'Siap Pakai' : 'Perawatan';
                                        @endphp
                                        <tr>
                                            <td class='fw-semibold ps-3'>{{ $index + 1 }}</td>
                                            <td class='fw-semibold'>{{ $row->nama }}</td>
                                            <td><span class='badge bg-secondary'>{{ $row->kategori }}</span></td>
                                            <td>{{ $row->jenis }}</td>
                                            <td>{{ $row->panjang }} M</td>
                                            <td>{{ $row->lebar }} M</td>
                                            <td><span class='badge rounded-pill px-3 py-2 {{ $status_class }}'>{{ $badge_text }}</span></td>
                                            <td class="text-center">
                                                <a href="/edit/{{ $row->id }}" class="btn btn-sm btn-warning fw-bold text-dark">Edit</a>
                                                
                                                @if(auth()->user()->role === 'admin')
                                                    <a href="/hapus/{{ $row->id }}" class="btn btn-sm btn-danger fw-bold" onclick="return confirm('Yakin ingin menghapus lapangan ini?')">Hapus</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan='8' class='text-center text-muted py-4'>Tidak ada data lapangan Indoor.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Tambah Lapangan -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4 text-dark">Tambah Lapangan Baru</h4>
                        <form action="/tambah" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small">Nama Lapangan</label>
                                <input type="text" name="nama" class="form-control" placeholder="Contoh: Lapangan Futsal A" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small">Kategori Area</label>
                                <select name="kategori" class="form-select" required>
                                    <option value="Indoor" selected>Indoor</option>
                                    <option value="Outdoor">Outdoor</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-muted small">Jenis Lantai</label>
                                <select name="jenis" class="form-select" required>
                                    <option value="">Pilih Jenis Material...</option>
                                    <option value="Sintetis">Rumput Sintetis</option>
                                    <option value="Vinyl">Lantai Vinyl</option>
                                    <option value="Alami">Rumput Alami</option>
                                    <option value="Interlock">Interlock / Matras</option>
                                </select>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label fw-semibold text-muted small">Panjang (Meter)</label>
                                    <input type="number" name="panjang" class="form-control" placeholder="Contoh: 25" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold text-muted small">Lebar (Meter)</label>
                                    <input type="number" name="lebar" class="form-control" placeholder="Contoh: 15" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label d-block fw-semibold text-muted small mb-2">Status Fisik</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="status" id="statusBaik" value="Baik" autocomplete="off" checked required>
                                    <label class="btn btn-outline-success py-2 fw-semibold" for="statusBaik">Baik</label>
                                    <input type="radio" class="btn-check" name="status" id="statusRawat" value="Perawatan" autocomplete="off">
                                    <label class="btn btn-outline-warning py-2 fw-semibold" for="statusRawat">Perawatan</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg w-100 text-white fw-bold py-3" style="background: linear-gradient(90deg, #800080, #ff00ff); border: none;">Simpan Lapangan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-secondary py-4 mt-auto text-center" style="font-size: 14px;">
        <div class="container">
            <p class="m-0 text-white-50 fw-bold">Tugas 1 - PAW</p>
            <p class="m-1">Nama: Dimas Ardiansah | NIM: 102022500137 | Kelas: SI4906</p>
            <p class="m-0">Kelompok 3 | Modul: Individu A - Modul Lapangan & Area</p>
        </div>
    </footer>
</body>
</html>