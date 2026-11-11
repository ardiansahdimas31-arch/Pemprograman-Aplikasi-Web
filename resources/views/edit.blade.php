<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lapangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .topbar { background: linear-gradient(90deg, #800080, #ff00ff); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="topbar p-3 mb-4 text-center text-white">
        <h2 class="fw-bold m-0 text-uppercase">Sistem Manajemen Venue</h2>
    </header>

    <div class="container my-4 flex-grow-1 d-flex justify-content-center"> 
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold text-dark m-0">Edit Data Lapangan</h4>
                        <a href="/" class="btn btn-secondary btn-sm fw-bold">Kembali</a>
                    </div>
                    
                    <form action="/update/{{ $lapangan->id }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">Nama Lapangan</label>
                            <input type="text" name="nama" class="form-control" value="{{ $lapangan->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">Kategori Area</label>
                            <select name="kategori" class="form-select" required>
                                <option value="Indoor" {{ $lapangan->kategori == 'Indoor' ? 'selected' : '' }}>Indoor</option>
                                <option value="Outdoor" {{ $lapangan->kategori == 'Outdoor' ? 'selected' : '' }}>Outdoor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small">Jenis Lantai</label>
                            <select name="jenis" class="form-select" required>
                                <option value="Sintetis" {{ $lapangan->jenis == 'Sintetis' ? 'selected' : '' }}>Rumput Sintetis</option>
                                <option value="Vinyl" {{ $lapangan->jenis == 'Vinyl' ? 'selected' : '' }}>Lantai Vinyl</option>
                                <option value="Alami" {{ $lapangan->jenis == 'Alami' ? 'selected' : '' }}>Rumput Alami</option>
                                <option value="Interlock" {{ $lapangan->jenis == 'Interlock' ? 'selected' : '' }}>Interlock / Matras</option>
                            </select>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label fw-semibold text-muted small">Panjang (Meter)</label>
                                <input type="number" name="panjang" class="form-control" value="{{ $lapangan->panjang }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold text-muted small">Lebar (Meter)</label>
                                <input type="number" name="lebar" class="form-control" value="{{ $lapangan->lebar }}" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label d-block fw-semibold text-muted small mb-2">Status Fisik</label>
                            <div class="btn-group w-100" role="group">
                                <input type="radio" class="btn-check" name="status" id="statusBaik" value="Baik" {{ $lapangan->status == 'Baik' ? 'checked' : '' }} required>
                                <label class="btn btn-outline-success py-2 fw-semibold" for="statusBaik">Baik</label>
                                <input type="radio" class="btn-check" name="status" id="statusRawat" value="Perawatan" {{ $lapangan->status == 'Perawatan' ? 'checked' : '' }}>
                                <label class="btn btn-outline-warning py-2 fw-semibold" for="statusRawat">Perawatan</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg w-100 text-white fw-bold py-3" style="background: linear-gradient(90deg, #800080, #ff00ff); border: none;">Update Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>