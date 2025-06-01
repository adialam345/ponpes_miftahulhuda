@extends('layouts.admin')

@section('title', 'Kelola Kegiatan - Admin')

@push('styles')
<style>
    .activity-row {
        transition: all 0.3s ease;
    }

    .activity-row:hover {
        background-color: #f8fafc;
    }

    .activity-row.ui-sortable-helper {
        background-color: #f0fdf4;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
    }

    .sortable-handle {
        cursor: grab;
    }

    .sortable-handle:active {
        cursor: grabbing;
    }

    .thumbnail-container {
        position: relative;
        overflow: hidden;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .thumbnail-container:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .thumbnail-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .thumbnail-container:hover .thumbnail-overlay {
        opacity: 1;
    }

    .status-badge {
        transition: all 0.3s ease;
    }

    .status-badge:hover {
        transform: translateY(-2px);
    }

    .action-button {
        transition: all 0.3s ease;
    }

    .action-button:hover {
        transform: translateY(-2px);
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .search-container {
        position: relative;
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .search-input {
        padding-left: 2.5rem;
    }

    .filter-dropdown {
        position: relative;
    }

    .filter-menu {
        position: absolute;
        right: 0;
        top: 100%;
        width: 200px;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        z-index: 50;
    }

    .empty-state {
        background: linear-gradient(135deg, #f0fdf4 0%, #e0f2fe 100%);
        border-radius: 1rem;
        padding: 3rem 2rem;
        text-align: center;
    }

    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        background-color: #f8fafc;
        border-top: 1px solid #e2e8f0;
        border-bottom-left-radius: 0.5rem;
        border-bottom-right-radius: 0.5rem;
    }

    .page-info {
        color: #64748b;
        font-size: 0.875rem;
    }

    .pagination-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .page-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #64748b;
        background-color: white;
        border: 1px solid #e2e8f0;
        transition: all 0.2s;
    }

    .page-button:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    .page-button.active {
        background-color: #10b981;
        color: white;
        border-color: #10b981;
    }

    .page-button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
        initSortable();
        setupSearchAndFilters();

        // Show success message if exists
        @if(session('success'))
            showAlert('success', "{{ session('success') }}");
        @endif

        @if(session('error'))
            showAlert('error', "{{ session('error') }}");
        @endif
    });

    // Initialize sortable
    function initSortable() {
        $("#sortable-activities").sortable({
            handle: ".sortable-handle",
            placeholder: "bg-emerald-50 border-2 border-dashed border-emerald-500",
            helper: function(e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index) {
                    $(this).width($originals.eq(index).width());
                });
                return $helper;
            },
            update: function(event, ui) {
                let items = [];
                $("#sortable-activities tr").each(function(index) {
                    items.push({
                        id: $(this).data("id"),
                        order: index + 1
                    });
                });

                // Show loading
                Swal.fire({
                    title: 'Menyimpan...',
                    text: 'Sedang menyimpan urutan kegiatan',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: "{{ route('admin.activities.update-order') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        items: items
                    },
                    success: function(response) {
                        Swal.close();
                        if (response.success) {
                            showAlert('success', 'Urutan kegiatan berhasil diperbarui');
                        }
                    },
                    error: function() {
                        Swal.close();
                        showAlert('error', 'Gagal memperbarui urutan kegiatan');
                    }
                });
            }
        });
    }

    // Setup search and filters
    function setupSearchAndFilters() {
        const searchInput = document.getElementById('search-input');
        const statusFilter = document.getElementById('status-filter');
        const dateFilter = document.getElementById('date-filter');
        const rows = document.querySelectorAll('#sortable-activities tr');

        // Search functionality
        searchInput.addEventListener('input', filterRows);

        // Status filter
        if (statusFilter) {
            statusFilter.addEventListener('change', filterRows);
        }

        // Date filter
        if (dateFilter) {
            dateFilter.addEventListener('change', filterRows);
        }

        function filterRows() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusValue = statusFilter ? statusFilter.value : 'all';
            const dateValue = dateFilter ? dateFilter.value : 'all';

            rows.forEach(row => {
                const title = row.querySelector('[data-title]').getAttribute('data-title').toLowerCase();
                const status = row.querySelector('[data-status]').getAttribute('data-status');
                const date = row.querySelector('[data-date]').getAttribute('data-date');

                // Check if row matches all filters
                const matchesSearch = title.includes(searchTerm);
                const matchesStatus = statusValue === 'all' || status === statusValue;
                const matchesDate = dateValue === 'all' || matchesDate(date, dateValue);

                // Show/hide row based on filters
                if (matchesSearch && matchesStatus && matchesDate) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Show/hide empty state
            const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
            document.getElementById('empty-filter-state').style.display = visibleRows.length === 0 ? 'block' : 'none';
        }

        function matchesDate(rowDate, filterValue) {
            if (!rowDate || rowDate === '-') return filterValue === 'no-date';

            const date = new Date(rowDate);
            const now = new Date();

            switch (filterValue) {
                case 'today':
                    return isSameDay(date, now);
                case 'this-week':
                    const weekStart = new Date(now);
                    weekStart.setDate(now.getDate() - now.getDay());
                    const weekEnd = new Date(weekStart);
                    weekEnd.setDate(weekStart.getDate() + 6);
                    return date >= weekStart && date <= weekEnd;
                case 'this-month':
                    return date.getMonth() === now.getMonth() && date.getFullYear() === now.getFullYear();
                case 'this-year':
                    return date.getFullYear() === now.getFullYear();
                case 'past':
                    return date < now;
                case 'future':
                    return date > now;
                default:
                    return true;
            }
        }

        function isSameDay(date1, date2) {
            return date1.getDate() === date2.getDate() &&
                   date1.getMonth() === date2.getMonth() &&
                   date1.getFullYear() === date2.getFullYear();
        }
    }

    // Toggle filter dropdown
    function toggleFilterDropdown() {
        const dropdown = document.getElementById('filter-dropdown');
        dropdown.classList.toggle('hidden');
    }

    // Handle delete confirmation
    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            html: `Apakah Anda yakin ingin menghapus kegiatan <strong>"${title}"</strong> dan semua foto terkait?<br><br>Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Sedang menghapus kegiatan',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit the form
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }

    // Toggle activity status
    function toggleStatus(id, currentStatus) {
        const newStatus = currentStatus === '1' ? '0' : '1';
        const statusText = newStatus === '1' ? 'mengaktifkan' : 'menonaktifkan';

        Swal.fire({
            title: 'Konfirmasi',
            text: `Apakah Anda yakin ingin ${statusText} kegiatan ini?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Ubah Status',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                Swal.fire({
                    title: 'Memproses...',
                    text: `Sedang ${statusText} kegiatan`,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Submit form to update status
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('admin/activities') }}/${id}/toggle-status`;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PATCH';

                const statusInput = document.createElement('input');
                statusInput.type = 'hidden';
                statusInput.name = 'is_active';
                statusInput.value = newStatus;

                form.appendChild(csrfToken);
                form.appendChild(methodInput);
                form.appendChild(statusInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Show alert
    function showAlert(type, message) {
        const icons = {
            success: 'success',
            error: 'error',
            warning: 'warning',
            info: 'info'
        };

        Swal.fire({
            icon: icons[type],
            title: type === 'success' ? 'Berhasil!' : type === 'error' ? 'Error!' : 'Informasi',
            text: message,
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }

    // View thumbnail in modal
    function viewThumbnail(src, alt) {
        Swal.fire({
            html: `<img src="${src}" alt="${alt}" class="max-h-[70vh] max-w-full mx-auto">`,
            showConfirmButton: false,
            width: 'auto',
            padding: '1rem',
            background: '#ffffff',
            showCloseButton: true
        });
    }
</script>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-3xl font-bold text-slate-900 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                            <i data-lucide="images" class="w-5 h-5 text-white"></i>
                        </div>
                        Kelola Kegiatan
                    </h1>
                    <p class="text-slate-600 mt-1">Kelola kegiatan dan foto-foto untuk ditampilkan di website</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.activities.create') }}"
                       class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-blue-600 text-white font-medium rounded-lg shadow-sm hover:from-emerald-700 hover:to-blue-700 hover:shadow-md transition-all duration-200">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Tambah Kegiatan Baru
                    </a>
                </div>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white rounded-t-xl shadow-md p-4 mb-0 fade-in">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="search-container flex-grow">
                    <i data-lucide="search" class="search-icon w-4 h-4"></i>
                    <input
                        type="text"
                        id="search-input"
                        placeholder="Cari kegiatan..."
                        class="search-input w-full px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                    >
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <select
                        id="status-filter"
                        class="px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                    >
                        <option value="all">Semua Status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>

                    <select
                        id="date-filter"
                        class="px-3 py-2 border border-slate-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                    >
                        <option value="all">Semua Tanggal</option>
                        <option value="today">Hari Ini</option>
                        <option value="this-week">Minggu Ini</option>
                        <option value="this-month">Bulan Ini</option>
                        <option value="this-year">Tahun Ini</option>
                        <option value="past">Masa Lalu</option>
                        <option value="future">Masa Depan</option>
                        <option value="no-date">Tanpa Tanggal</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Activities Table -->
        <div class="bg-white shadow-md rounded-b-xl overflow-hidden fade-in">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">
                                <span class="flex items-center">
                                    <i data-lucide="move-vertical" class="w-4 h-4 mr-1"></i>
                                    No
                                </span>
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Thumbnail</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Judul</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Foto</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-activities" class="bg-white divide-y divide-slate-200">
                        @forelse($activities as $index => $activity)
                        <tr data-id="{{ $activity->id }}" data-order="{{ $activity->order }}" class="activity-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 sortable-handle">
                                <div class="flex items-center">
                                    <i data-lucide="grip-vertical" class="w-4 h-4 mr-2 text-slate-400"></i>
                                    {{ $loop->iteration }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($activity->thumbnailGallery)
                                <div class="thumbnail-container cursor-pointer" onclick="viewThumbnail('{{ asset('storage/' . $activity->thumbnailGallery->image) }}', '{{ $activity->thumbnailGallery->alt_text }}')">
                                    <img src="{{ asset('storage/' . $activity->thumbnailGallery->image) }}"
                                         alt="{{ $activity->thumbnailGallery->alt_text }}"
                                         class="h-16 w-24 object-cover rounded-lg">
                                    <div class="thumbnail-overlay">
                                        <i data-lucide="zoom-in" class="w-5 h-5 text-white"></i>
                                    </div>
                                </div>
                                @else
                                <div class="h-16 w-24 bg-slate-200 rounded-lg flex items-center justify-center">
                                    <i data-lucide="image-off" class="w-5 h-5 text-slate-400"></i>
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900" data-title="{{ $activity->title }}">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ $activity->title }}</span>
                                    @if($activity->description)
                                    <span class="text-xs text-slate-500 mt-1 max-w-xs truncate">{{ $activity->description }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500" data-date="{{ $activity->activity_date ? $activity->activity_date->format('Y-m-d') : '-' }}">
                                @if($activity->activity_date)
                                <div class="flex items-center">
                                    <i data-lucide="calendar" class="w-4 h-4 mr-1 text-slate-400"></i>
                                    {{ $activity->activity_date->format('d/m/Y') }}
                                </div>
                                @else
                                <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" data-status="{{ $activity->is_active }}">
                                <button
                                    onclick="toggleStatus('{{ $activity->id }}', '{{ $activity->is_active }}')"
                                    class="status-badge px-3 py-1 rounded-full text-xs font-medium flex items-center justify-center w-24 cursor-pointer"
                                    style="background-color: {{ $activity->is_active ? '#dcfce7' : '#fee2e2' }}; color: {{ $activity->is_active ? '#166534' : '#b91c1c' }};"
                                >
                                    <i data-lucide="{{ $activity->is_active ? 'check-circle' : 'x-circle' }}" class="w-3 h-3 mr-1"></i>
                                    {{ $activity->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                <div class="flex items-center">
                                    <i data-lucide="images" class="w-4 h-4 mr-1 text-slate-400"></i>
                                    <span class="bg-slate-100 text-slate-700 px-2 py-0.5 rounded-full text-xs font-medium">
                                        {{ $activity->galleries->count() }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.activities.edit', $activity->id) }}"
                                       class="action-button inline-flex items-center px-3 py-1.5 bg-blue-50 border border-blue-300 rounded-lg text-xs font-medium text-blue-700 hover:bg-blue-100 transition-all duration-200">
                                        <i data-lucide="edit" class="w-3 h-3 mr-1"></i> Edit
                                    </a>
                                    <form id="delete-form-{{ $activity->id }}" method="POST" action="{{ route('admin.activities.destroy', $activity->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="button"
                                            onclick="confirmDelete('{{ $activity->id }}', '{{ $activity->title }}')"
                                            class="action-button inline-flex items-center px-3 py-1.5 bg-red-50 border border-red-300 rounded-lg text-xs font-medium text-red-700 hover:bg-red-100 transition-all duration-200"
                                        >
                                            <i data-lucide="trash-2" class="w-3 h-3 mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10">
                                <div class="empty-state">
                                    <div class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="image-off" class="w-8 h-8 text-slate-400"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-slate-900 mb-1">Belum Ada Kegiatan</h3>
                                    <p class="text-slate-500 mb-4">Belum ada data kegiatan yang tersedia.</p>
                                    <a href="{{ route('admin.activities.create') }}"
                                       class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-600 to-blue-600 text-white font-medium rounded-lg shadow-sm hover:from-emerald-700 hover:to-blue-700 transition-all duration-200">
                                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                                        Tambah Kegiatan Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Empty Filter State (Hidden by default) -->
                <div id="empty-filter-state" class="px-6 py-10 hidden">
                    <div class="empty-state">
                        <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="filter-x" class="w-8 h-8 text-amber-500"></i>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900 mb-1">Tidak Ada Hasil</h3>
                        <p class="text-slate-500 mb-4">Tidak ada kegiatan yang sesuai dengan filter yang dipilih.</p>
                        <button
                            onclick="document.getElementById('search-input').value = ''; document.getElementById('status-filter').value = 'all'; document.getElementById('date-filter').value = 'all'; setupSearchAndFilters();"
                            class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 text-slate-700 font-medium rounded-lg shadow-sm hover:bg-slate-50 transition-all duration-200"
                        >
                            <i data-lucide="refresh-cw" class="w-4 h-4 mr-2"></i>
                            Reset Filter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            @if($activities->hasPages())
            <div class="pagination-container">
                <div class="page-info">
                    Menampilkan {{ $activities->firstItem() }} - {{ $activities->lastItem() }} dari {{ $activities->total() }} kegiatan
                </div>
                <div class="pagination-buttons">
                    @if($activities->onFirstPage())
                        <span class="page-button disabled">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </span>
                    @else
                        <a href="{{ $activities->previousPageUrl() }}" class="page-button">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </a>
                    @endif

                    @foreach($activities->getUrlRange(max($activities->currentPage() - 2, 1), min($activities->currentPage() + 2, $activities->lastPage())) as $page => $url)
                        <a href="{{ $url }}" class="page-button {{ $activities->currentPage() == $page ? 'active' : '' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if($activities->hasMorePages())
                        <a href="{{ $activities->nextPageUrl() }}" class="page-button">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    @else
                        <span class="page-button disabled">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </span>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
