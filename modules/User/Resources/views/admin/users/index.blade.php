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
                        <th>Đăng nhập cuối</th>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Xử lý "select all" checkbox
        const selectAllCheckbox = document.querySelector(".select-all");
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener("change", function () {
                let checkboxes = document.querySelectorAll(".select-row");
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });
        }

        // Xử lý nút xóa
        const deleteButton = document.querySelector(".btn-delete");
        if (deleteButton) {
            deleteButton.addEventListener("click", function () {
                const selectedIds = [];
                const checkboxes = document.querySelectorAll(".select-row:checked");

                // Kiểm tra có mục nào được chọn không
                if (checkboxes.length === 0) {
                    alert('Vui lòng chọn ít nhất một người dùng để xóa');
                    return;
                }

                // Thu thập ID của các mục được chọn
                checkboxes.forEach(checkbox => {
                    selectedIds.push(checkbox.value);
                });

                // Xác nhận trước khi xóa
                if (confirm(`Bạn có chắc chắn muốn xóa ${checkboxes.length} người dùng đã chọn?`)) {
                    // Tạo form động để submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route('admin.users.bulk_delete') }}';
                    form.style.display = 'none';

                    // Thêm CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    // Thêm method DELETE
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    // Thêm ID người dùng đã chọn
                    selectedIds.forEach(id => {
                        const idInput = document.createElement('input');
                        idInput.type = 'hidden';
                        idInput.name = 'user_ids[]';
                        idInput.value = id;
                        form.appendChild(idInput);
                    });

                    // Thêm form vào body và submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Xử lý nút xóa từng dòng
        document.querySelectorAll('.delete-row').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');

                if (confirm('Bạn có chắc chắn muốn xóa người dùng này?')) {
                    // Tạo CSRF token input
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    // Tạo form động để submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/users/${userId}`;
                    form.style.display = 'none';

                    // Thêm CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    // Thêm method DELETE
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    form.appendChild(methodInput);

                    // Thêm form vào body và submit
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
