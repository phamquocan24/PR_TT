@extends('admin::layout')

@section('content')
    <h1>Thêm Variation</h1>

    <form action="{{ route('admin.variations.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Tên Variation:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="type">Loại:</label>
            <input type="text" id="type" name="type" value="{{ old('type') }}" required>
            @error('type')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Thêm</button>
    </form>
@endsection
