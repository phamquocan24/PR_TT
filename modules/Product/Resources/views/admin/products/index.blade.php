@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('product::products.products'))

    <li class="active">{{ trans('product::products.products') }}</li>
@endcomponent

@component('admin::components.page.index_table')
    @slot('buttons', ['create'])
    @slot('resource', 'products')
    @slot('name', trans('product::products.product'))

    @slot('thead')
        @include('product::admin.products.partials.thead', ['name' => 'products-index'])
    @endslot

    @slot('tbody')
        @if (!empty($products))
            @foreach ($products as $product)
                <tr class="clickable-row">
                    <td>
                        <div class="checkbox">
                            <input type="checkbox" class="select-row" name="ids[]" id="product-{{ $product->id }}"
                                value="{{ $product->id }}">
                            <label for="product-{{ $product->id }}"></label>
                        </div>
                    </td>
                    <td class="dt-type-numeric">{{ $product->id }}</td>
                    <td>
                        <div class="thumbnail-holder">
                            <img src="https://demo.fleetcart.envaysoft.com/storage/media/YXFIHEgHF4JOGhBdtehoqGzES93CfS2gaxRpIt1U.jpeg"
                                alt="thumbnail">
                        </div>
                    </td>
                    <td>
                        <a class="name" href="{{ route('admin.products.edit', $product->id) }}">{{ $product->name }}</a>
                    </td>
                    <td class="text-nowrap">
                        @if ($product->special_price && now()->between($product->special_price_start, $product->special_price_end))
                            <span
                                class="m-r-5">{{ isset($product->selling_price) ? product_price_formatted($product->selling_price) : '' }}</span>
                            <del
                                class="text-red">{{ isset($product->price) ? product_price_formatted($product->price) : '' }}</del>
                        @else
                            <span>{{ product_price_formatted($product->price) }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $product->in_stock ? 'badge-primary' : 'badge-danger' }}">
                            {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $product->in_stock ? 'badge-success' : 'badge-danger' }}">
                            {{ $product->is_active ? 'Active' : 'UnActive' }}
                        </span>
                    </td>
                    <td class="sorting_1">
                        <span data-toggle="tooltip"
                            title="{{ $product->updated_at }}">{{ $product->updated_at->diffForHumans() }}</span>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8" class="dt-empty">No data available in table</td>
            </tr>
        @endif
    @endslot

    @slot('tResult')
        {{ request()->get('page', 1) * $perPage - $perPage + 1 }} - {{ request()->get('page', 1) * $perPage }} of
        {{ $totalProducts }} results entries
    @endslot

    @slot('tPagination')
        {!! $products->appends(request()->input())->links('admin::pagination.simple') !!}
    @endslot

@endcomponent

@if (session()->has('exit_flash'))
    @push('notifications')
        <div class="alert alert-success fade in alert-dismissible clearfix">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path
                    d="M12 2C6.49 2 2 6.49 2 12C2 17.51 6.49 22 12 22C17.51 22 22 17.51 22 12C22 6.49 17.51 2 12 2ZM11.25 8C11.25 7.59 11.59 7.25 12 7.25C12.41 7.25 12.75 7.59 12.75 8V13C12.75 13.41 12.41 13.75 12 13.75C11.59 13.75 11.25 13.41 11.25 13V8ZM12.92 16.38C12.87 16.51 12.8 16.61 12.71 16.71C12.61 16.8 12.5 16.87 12.38 16.92C12.26 16.97 12.13 17 12 17C11.87 17 11.74 16.97 11.62 16.92C11.5 16.87 11.39 16.8 11.29 16.71C11.2 16.61 11.13 16.51 11.08 16.38C11.03 16.26 11 16.13 11 16C11 15.87 11.03 15.74 11.08 15.62C11.13 15.5 11.2 15.39 11.29 15.29C11.39 15.2 11.5 15.13 11.62 15.08C11.86 14.98 12.14 14.98 12.38 15.08C12.5 15.13 12.61 15.2 12.71 15.29C12.8 15.39 12.87 15.5 12.92 15.62C12.97 15.74 13 15.87 13 16C13 16.13 12.97 16.26 12.92 16.38Z"
                    fill="#555555" />
            </svg>

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M5.00082 14.9995L14.9999 5.00041" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M14.9999 14.9996L5.00082 5.00049" stroke="#555555" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>

            <span class="alert-text">{{ session('exit_flash') }}</span>
        </div>
    @endpush
@endif

@push('scripts')
<script type="module">
    $(document).ready(function() {
        // Handle the "select all" checkbox
        $(document).on('change', '.select-all', function() {
            const isChecked = $(this).is(':checked');
            $('.index-table').find(".select-row").prop('checked', isChecked);
        });

        $(document).on('click', '#delete-records', function(event) {
            const recordsChecked = $('.index-table').find(".select-row:checked");
            const recordsCheckedAll = $('.index-table').find(".select-all:checked");

            let ids = [];
            let idsAll = [];

            if (recordsCheckedAll.length > 0) {
                // If "select all" is checked, get all record IDs
                idsAll = $('.index-table').find(".select-row").toArray()
                    .map(row => parseInt(row.value))
                    .filter(id => !isNaN(id)); // Filter out invalid values
            } else {
                // Otherwise, get only the checked record IDs
                ids = recordsChecked.toArray()
                    .map(row => parseInt(row.value))
                    .filter(id => !isNaN(id)); // Filter out invalid values
            }

            if (ids.length === 0 && idsAll.length === 0) {
                return;
            }

            const confirmationModal = $("#confirmation-modal");
            confirmationModal.modal('show');
            confirmationModal.find("form").find('input[name="ids"][type="hidden"]').val(JSON.stringify(ids));
            confirmationModal.find("form").find('input[name="idsAll"][type="hidden"]').val(JSON.stringify(idsAll));
            confirmationModal.find("form").attr('action', "{{ route('admin.products.delete') }}");
        });

        @if (session()->has('message'))
            @if (session('status') === \Modules\Admin\Enums\StatusResponse::SUCCESS)
                success("{{ session('message') }}")
            @elseif (session('status') === \Modules\Admin\Enums\StatusResponse::FAILURE)
                error("{{ session('message') }}")
            @endif
        @endif
    });
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.querySelector('.dt-search input[type="search"]');
            const tableRows = document.querySelectorAll('tbody tr');
            const noResultsRow = createNoResultsRow();

            // Thêm hàng thông báo không có kết quả vào cuối bảng
            function createNoResultsRow() {
                const row = document.createElement('tr');
                row.classList.add('no-results');
                row.style.display = 'none';
                const cell = document.createElement('td');
                cell.setAttribute('colspan', tableRows[0].children.length);
                cell.classList.add('text-center', 'text-muted', 'py-3');
                cell.textContent = 'Không tìm thấy kết quả phù hợp';
                row.appendChild(cell);
                tableRows[0].closest('tbody').appendChild(row);
                return row;
            }

            // Hàm tìm kiếm nâng cao
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                let visibleRowCount = 0;

                tableRows.forEach(row => {
                    // Lấy tất cả các ô trong dòng
                    const cells = row.querySelectorAll('td');

                    // Kiểm tra từng ô để tìm kiếm
                    const match = Array.from(cells).some(cell => {
                        // Loại bỏ các thẻ HTML để tìm kiếm
                        const cellText = cell.textContent.replace(/<[^>]*>/g, '').toLowerCase().trim();

                        // Tìm kiếm chính xác và gần đúng
                        return cellText.includes(searchTerm) ||
                               cellText.split(' ').some(word => word.startsWith(searchTerm));
                    });

                    // Hiển thị/ẩn dòng
                    if (match) {
                        row.style.display = '';
                        visibleRowCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Hiển thị/ẩn dòng thông báo không có kết quả
                noResultsRow.style.display = visibleRowCount > 0 ? 'none' : '';
            });

            // Hàm debounce để tránh gọi quá nhiều request
            function debounce(func, delay) {
                let debounceTimer;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => func.apply(context, args), delay);
                }
            }

            // Xử lý tìm kiếm Ajax
            searchInput.addEventListener('input', debounce(function() {
                const searchTerm = this.value.trim();

                if (searchTerm.length < 2) return; // Tránh search quá ngắn

                fetch(`{{ route('admin.products.search') }}?search=${encodeURIComponent(searchTerm)}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateTableWithSearchResults(data.products);
                })
                .catch(error => {
                    console.error('Lỗi tìm kiếm:', error);
                });
            }, 300));

            // Hàm cập nhật bảng kết quả tìm kiếm
            function updateTableWithSearchResults(products) {
                const tbody = document.querySelector('tbody');
                tbody.innerHTML = ''; // Xóa các dòng cũ

                if (products.data.length === 0) {
                    noResultsRow.style.display = '';
                    return;
                }

                products.data.forEach(product => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" class="select-row" value="${product.id}" id="product-${product.id}">
                                <label for="product-${product.id}"></label>
                            </div>
                        </td>
                        <td>${product.id}</td>
                        <td>
                            <img src="${product.thumbnail}" alt="${product.name}" class="img-thumbnail" style="max-width: 100px;">
                        </td>
                        <td>${product.name}</td>
                        <td>${product.formatted_price}</td>
                        <td>${product.in_stock}</td>
                        <td>${product.status}</td>
                        <td>${product.formatted_updated_at}</td>
                    `;
                    tbody.appendChild(row);
                });
            }
        });
    </script>
@endpush
