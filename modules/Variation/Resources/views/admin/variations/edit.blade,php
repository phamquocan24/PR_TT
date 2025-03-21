@extends('admin::layout')

@section('content')
    <h1>Chỉnh Sửa Variation</h1>

    <form action="{{ route('admin.variations.update', $variation->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Phương thức HTTP PUT để cập nhật -->

        <div>
            <label for="name">Tên Variation:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $variation->name) }}" required>
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="type">Loại:</label>
            <input type="text" id="type" name="type" value="{{ old('type', $variation->type) }}" required>
            @error('type')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Cập nhật</button>
    </form>
@endsection
