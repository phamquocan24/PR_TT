@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', 'Users')

    <li class="active">Users</li>
@endcomponent

@section('content')
    <div class="box box-primary">
        <div class="box-body index-table">
            @component('admin::components.table')
                @slot('thead')
                    <tr>
                        <th style="max-width: 20px;">
                            <div class="checkbox">
                                <input type="checkbox" class="select-all" id="users-select-all">
                                <label for="users-select-all"></label>
                            </div>
                        </th>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Đăng nhập lần cuối</th>
                        <th>Ngày tạo</th>
                    </tr>
                @endslot

                @slot('tbody')
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input type="checkbox" class="select-row" value="{{ $user->id }}" id="{{ 'user-' . $user->id }}">
                                    <label for="{{ 'user-' . $user->id }}"></label>
                                </div>
                            </td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->isAdmin())
                                    <span class="badge bg-primary">{{ $roles[$user->role] }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $roles[$user->role] }}</span>
                                @endif
                            </td>
                            <td>
                                @if($user->last_login)
                                    {{ $user->last_login->diffForHumans() }}
                                @else
                                    <span class="text-muted">Chưa đăng nhập</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                @endslot

                @slot('tfoot')
                    <tr>
                        <td colspan="8">

                                <div>
                                    {{ $users->appends(request()->all())->links() }}
                                </div>

                        </td>
                    </tr>
                @endslot
                @slot('ttotal')
                <div>
                    <label class="dt-info" aria-live="polite" id="DataTables_Table_0_info" role="status">
                        {{ "Show $perPage of $totalUsers users" }}
                    </label>
                </div>
            @endslot

            @slot('tchange')
                <div class="row dt-layout-row">
                    <div class="dt-paging">
                        <nav aria-label="pagination">
                            <ul class="pagination">
                                <li class="dt-paging-button page-item">
                                    {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            @endslot
        @endcomponent
    </div>
</div>
@endsection

@push('scripts')
<script type="module">
    document.addEventListener("DOMContentLoaded", function () {
        // Xử lý "select all" checkbox
        const selectAllCheckbox = document.querySelector(".select-all");
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener("change", function () {
                let checkboxes = document.querySelectorAll("input[type='checkbox']:not(.select-all)");
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });
        }

        // Xử lý khi bấm nút Delete
        const deleteButton = document.querySelector(".btn-delete");
        if (deleteButton) {
            deleteButton.addEventListener("click", function () {
                const selectedIds = [];
                const checkboxes = document.querySelectorAll(".select-row:checked");

                // Kiểm tra có mục nào được chọn không
                if (checkboxes.length === 0) {
                    toastr.warning('Vui lòng chọn ít nhất một người dùng để xóa');
                    return;
                }

                // Thu thập ID của các mục được chọn
                checkboxes.forEach(checkbox => {
                    selectedIds.push(checkbox.value);
                });

                // Hiển thị modal xác nhận
                const confirmationModal = document.querySelector("#confirmation-modal");
                if (confirmationModal) {
                    const deleteIdsInput = confirmationModal.querySelector("#delete-ids");
                    if (deleteIdsInput) {
                        deleteIdsInput.value = JSON.stringify(selectedIds);
                    }
                    $(confirmationModal).modal('show');
                }
            });
        }

        // Xử lý nút xóa từng dòng
        document.querySelectorAll('.delete-row').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');

                const confirmationModal = document.querySelector("#confirmation-modal");
                if (confirmationModal) {
                    const deleteIdsInput = confirmationModal.querySelector("#delete-ids");
                    if (deleteIdsInput) {
                        deleteIdsInput.value = JSON.stringify([userId]);
                    }
                    $(confirmationModal).modal('show');
                }
            });
        });

        // Xử lý xác nhận xóa từ modal
        const confirmForm = document.querySelector("#confirmation-modal form");
        if (confirmForm) {
            confirmForm.addEventListener('submit', function(e) {
                // e.preventDefault();
                const deleteIdsInput = this.querySelector("#delete-ids");

                if (deleteIdsInput) {
                    const userIds = JSON.parse(deleteIdsInput.value);
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Nếu là xóa nhiều người dùng
                    if (userIds.length > 1) {
                        fetch('{{ route('admin.users.bulk_delete') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({ user_ids: userIds })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success(data.message);
                                location.reload();
                            } else {
                                toastr.error(data.message);
                            }
                        })
                        .catch(error => {
                            toastr.error('Đã xảy ra lỗi khi xóa người dùng');
                            console.error('Error:', error);
                        });
                    }
                    // Nếu là xóa từng người dùng
                    else {
                        const userId = userIds[0];
                        fetch(`/admin/users/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success(data.message);
                                location.reload();
                            } else {
                                toastr.error(data.message);
                            }
                        })
                        .catch(error => {
                            toastr.error('Đã xảy ra lỗi khi xóa người dùng');
                            console.error('Error:', error);
                        });
                    }
                }
            });
        }

        // Xử lý tìm kiếm
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
            cell.textContent = 'Không tìm thấy người dùng phù hợp';
            row.appendChild(cell);
            tableRows[0].closest('tbody').appendChild(row);
            return row;
        }

        if (searchInput) {
            searchInput.addEventListener("keyup", function () {
                const query = searchInput.value.toLowerCase().trim();
                let visibleRowCount = 0;

                tableRows.forEach(row => {
                    // Lấy các ô cần tìm kiếm
                    const idCell = row.querySelector('td:nth-child(2)'); // Cột ID
                    const nameCell = row.querySelector('td:nth-child(3)'); // Cột Họ tên
                    const emailCell = row.querySelector('td:nth-child(4)'); // Cột Email
                    const roleCell = row.querySelector('td:nth-child(5)'); // Cột Vai trò

                    // Kiểm tra có khớp không
                    const matches =
                        (idCell && containsSearchTerm(idCell.textContent, query)) ||
                        (nameCell && containsSearchTerm(nameCell.textContent, query)) ||
                        (emailCell && containsSearchTerm(emailCell.textContent, query)) ||
                        (roleCell && containsSearchTerm(roleCell.textContent, query));

                    // Hiển thị hoặc ẩn dòng dựa trên kết quả so khớp
                    if (matches) {
                        row.style.display = "";
                        visibleRowCount++;
                    } else {
                        row.style.display = "none";
                    }
                });

                // Hiển thị/ẩn dòng thông báo không có kết quả
                noResultsRow.style.display = visibleRowCount > 0 ? 'none' : '';
            });

            // Hàm hỗ trợ tìm kiếm nâng cao
            function containsSearchTerm(text, query) {
                if (!text) return false;

                const normalizedText = text.toLowerCase().trim();
                const normalizedQuery = query.toLowerCase().trim();

                // Kiểm tra chứa từ khóa
                return normalizedText.includes(normalizedQuery) ||
                    // Kiểm tra từ bắt đầu bằng từ khóa
                    normalizedText.split(/\s+/).some(word => word.startsWith(normalizedQuery));
            }

            // Xử lý tìm kiếm Ajax (tuỳ chọn)
            searchInput.addEventListener('input', debounce(function() {
                const searchTerm = this.value.trim();

                if (searchTerm.length < 2) return; // Tránh search quá ngắn

                fetch(`{{ route('admin.users.index') }}?search=${encodeURIComponent(searchTerm)}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateTableWithSearchResults(data.users);
                })
                .catch(error => {
                    console.error('Lỗi tìm kiếm:', error);
                });
            }, 300));

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

            // Hàm cập nhật bảng kết quả tìm kiếm
            function updateTableWithSearchResults(users) {
                const tbody = document.querySelector('tbody');
                tbody.innerHTML = ''; // Xóa các dòng cũ

                if (users.data.length === 0) {
                    noResultsRow.style.display = '';
                    return;
                }

                users.data.forEach(user => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" class="select-row" value="${user.id}" id="user-${user.id}">
                                <label for="user-${user.id}"></label>
                            </div>
                        </td>
                        <td>${user.id}</td>
                        <td>${user.first_name} ${user.last_name}</td>
                        <td>${user.email}</td>
                        <td>
                            <span class="badge ${user.isAdmin ? 'bg-primary' : 'bg-secondary'}">
                                ${user.role_name}
                            </span>
                        </td>
                        <td>${user.last_login ? user.last_login : 'Chưa đăng nhập'}</td>
                        <td>${user.created_at}</td>
                    `;
                    tbody.appendChild(row);
                });
            }
        }
    });
</script>
@endpush
