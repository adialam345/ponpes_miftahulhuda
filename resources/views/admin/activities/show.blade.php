@extends('layouts.admin')

@section('title', 'Detail Kegiatan')

@section('content')
<div class="py-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Detail Kegiatan</h1>
                <p class="text-sm text-gray-600">Kelola informasi dan galeri foto kegiatan</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.activities.edit', $activity->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-edit mr-2"></i> Edit
                </a>
                <a href="{{ route('admin.activities.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-md overflow-hidden mb-6">
            <div class="border-b border-gray-200 px-4 py-4">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Informasi Kegiatan</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Kolom Informasi -->
                    <div class="md:col-span-2">
                        <dl class="divide-y divide-gray-200">
                            <div class="py-3 grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Judul</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $activity->title }}</dd>
                            </div>
                            <div class="py-3 grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{!! nl2br(e($activity->description)) !!}</dd>
                            </div>
                            <div class="py-3 grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Tanggal Kegiatan</dt>
                                <dd class="text-sm text-gray-900 col-span-2">
                                    {{ $activity->activity_date ? $activity->activity_date->format('d F Y') : 'Tidak ada tanggal' }}
                                </dd>
                            </div>
                            <div class="py-3 grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="text-sm col-span-2">
                                    @if($activity->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="py-3 grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Dibuat pada</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $activity->created_at->format('d F Y, H:i') }}</dd>
                            </div>
                            <div class="py-3 grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Terakhir diupdate</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $activity->updated_at->format('d F Y, H:i') }}</dd>
                            </div>
                        </dl>
                    </div>
                    
                    <!-- Kolom Thumbnail -->
                    <div class="md:col-span-1">
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Thumbnail</h4>
                        @if($activity->thumbnail)
                            <img src="{{ asset('storage/'.$activity->thumbnail) }}" alt="{{ $activity->alt_text }}" class="w-full h-auto rounded-md shadow">
                            <p class="mt-2 text-xs text-gray-500">{{ $activity->alt_text }}</p>
                        @else
                            <div class="border border-gray-200 rounded-md p-4 text-center text-gray-400">
                                <i class="fas fa-image text-3xl mb-2"></i>
                                <p>Tidak ada thumbnail</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Galeri Foto -->
        <div class="bg-white shadow-sm rounded-md overflow-hidden mb-6">
            <div class="border-b border-gray-200 px-4 py-4 flex justify-between items-center">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Galeri Foto</h3>
                <button type="button" data-toggle="modal" data-target="#addPhotosModal" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-plus mr-2"></i> Tambah Foto
                </button>
            </div>
            <div class="p-6">
                @if($activity->galleries->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4" id="sortable-gallery">
                        @foreach($activity->galleries->sortBy('order') as $gallery)
                            <div class="relative group gallery-item" data-id="{{ $gallery->id }}">
                                <div class="relative h-40 overflow-hidden rounded-md shadow-sm border border-gray-200">
                                    <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->alt_text }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <div class="flex space-x-2">
                                            <button type="button" onclick="openImageModal('{{ asset('storage/'.$gallery->image) }}', '{{ $gallery->title }}', '{{ $gallery->description }}')" class="p-2 bg-white rounded-full text-gray-700 hover:text-blue-500">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button type="button" onclick="deleteImage({{ $gallery->id }})" class="p-2 bg-white rounded-full text-gray-700 hover:text-red-500">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1 text-sm text-gray-700 truncate">{{ $gallery->title ?: 'Tanpa Judul' }}</div>
                                <div class="text-xs text-gray-500">Urutan: {{ $gallery->order }}</div>
                                <div class="absolute top-1 left-1 cursor-move handle">
                                    <i class="fas fa-grip-lines text-white drop-shadow-md"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-4 text-sm text-gray-500"><i class="fas fa-info-circle mr-1"></i> Anda dapat mengatur urutan foto dengan drag and drop.</p>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-images text-gray-300 text-5xl mb-3"></i>
                        <p class="text-gray-500">Belum ada foto di galeri ini</p>
                        <p class="text-sm text-gray-400 mt-1">Klik tombol "Tambah Foto" untuk menambahkan foto</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Foto -->
<div class="modal fade" id="addPhotosModal" tabindex="-1" role="dialog" aria-labelledby="addPhotosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPhotosModalLabel">Tambah Foto ke Galeri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.activities.add-images', $activity->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="images">Pilih Foto <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="modalImages" name="images[]" multiple required>
                            <label class="custom-file-label" for="modalImages">Pilih file...</label>
                            <small class="form-text text-muted">Format: JPG, PNG, GIF. Maks: 2MB per file.</small>
                        </div>
                        <div id="modal-preview-container" class="row mt-3"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lihat Gambar -->
<div class="modal fade" id="viewImageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewImageTitle">Detail Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="viewImageSrc" src="" alt="Detail foto" class="img-fluid rounded mb-3">
                </div>
                <div id="viewImageDescription" class="text-muted"></div>
            </div>
        </div>
    </div>
</div>

<!-- Form Hapus Gambar -->
<form id="delete-image-form" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script>
    // Preview gambar untuk modal tambah foto
    document.getElementById('modalImages').addEventListener('change', function(event) {
        var files = event.target.files;
        var previewContainer = document.getElementById('modal-preview-container');
        previewContainer.innerHTML = '';
        
        for (var i = 0; i < files.length; i++) {
            if (i >= 10) {
                var moreDiv = document.createElement('div');
                moreDiv.className = 'col-md-2 mb-2 d-flex justify-content-center align-items-center bg-light rounded';
                moreDiv.style.height = '100px';
                moreDiv.innerHTML = '<span>+' + (files.length - 10) + ' lainnya</span>';
                previewContainer.appendChild(moreDiv);
                break;
            }
            
            var reader = new FileReader();
            reader.onload = (function(file) {
                return function(e) {
                    var col = document.createElement('div');
                    col.className = 'col-md-2 mb-2';
                    
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid rounded';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    
                    col.appendChild(img);
                    previewContainer.appendChild(col);
                };
            })(files[i]);
            
            reader.readAsDataURL(files[i]);
        }
    });
    
    // Fungsi untuk sortable gallery
    var sortableGallery = document.getElementById('sortable-gallery');
    if (sortableGallery) {
        new Sortable(sortableGallery, {
            handle: '.handle',
            animation: 150,
            onEnd: function(evt) {
                updateGalleryOrder();
            }
        });
    }
    
    // Fungsi untuk update urutan galeri
    function updateGalleryOrder() {
        var items = document.querySelectorAll('.gallery-item');
        var orderData = [];
        
        items.forEach(function(item, index) {
            orderData.push({
                id: item.getAttribute('data-id'),
                order: index + 1
            });
        });
        
        // Kirim update ke server
        fetch('{{ route('admin.galleries.update-order') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ items: orderData })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update urutan yang ditampilkan
                items.forEach(function(item, index) {
                    item.querySelector('.text-xs.text-gray-500').textContent = 'Urutan: ' + (index + 1);
                });
                
                toastr.success('Urutan berhasil diperbarui');
            } else {
                toastr.error('Gagal memperbarui urutan');
            }
        })
        .catch(error => {
            toastr.error('Terjadi kesalahan saat memperbarui urutan');
            console.error('Error:', error);
        });
    }
    
    // Fungsi untuk melihat detail gambar
    function openImageModal(src, title, description) {
        document.getElementById('viewImageSrc').src = src;
        document.getElementById('viewImageTitle').textContent = title || 'Detail Foto';
        document.getElementById('viewImageDescription').textContent = description || '';
        $('#viewImageModal').modal('show');
    }
    
    // Fungsi untuk menghapus gambar
    function deleteImage(id) {
        if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
            var form = document.getElementById('delete-image-form');
            form.action = '/admin/galleries/' + id;
            form.submit();
        }
    }
</script>
@endsection