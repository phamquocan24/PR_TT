<?php

namespace Modules\Variation\Http\Controllers\Admin;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Variation\Models\Variation;

class VariationController
{
    /**
     * Hiển thị danh sách dữ liệu.
     *
     * @return View
     */
    public function index()
    {
        $variations = Variation::all(); // Lấy tất cả dữ liệu từ bảng
        return view('variation::admin.variations.index', compact('variations')); // Trả về view cùng dữ liệu
    }

    /**
     * Hiển thị form thêm dữ liệu mới.
     *
     * @return View
     */
    public function create()
    {
        return view('variation::admin.variations.create'); // Hiển thị form thêm
    }

    /**
     * Lưu dữ liệu mới vào cơ sở dữ liệu.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        // Tạo bản ghi mới
        Variation::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        // Chuyển hướng về danh sách với thông báo
        return redirect()->route('admin.variations.index')->with('success', 'Dữ liệu đã được thêm thành công!');
    }

    /**
     * Hiển thị chi tiết dữ liệu (nếu cần).
     *
     * @param int $id
     * @return View
     */
    public function show($id)
    {
        $variation = Variation::findOrFail($id); // Lấy dữ liệu theo ID
        return view('variation::admin.variations.show', compact('variation')); // Trả về view hiển thị chi tiết
    }

    /**
     * Hiển thị form sửa dữ liệu.
     *
     * @param int $id
     * @return View
     */
    public function edit($id)
    {
        $variation = Variation::findOrFail($id); // Lấy dữ liệu theo ID
        return view('variation::admin.variations.edit', compact('variation')); // Trả về form chỉnh sửa
    }

    /**
     * Cập nhật dữ liệu vào cơ sở dữ liệu.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        // Tìm và cập nhật bản ghi
        $variation = Variation::findOrFail($id);
        $variation->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        // Chuyển hướng về danh sách với thông báo
        return redirect()->route('admin.variations.index')->with('success', 'Dữ liệu đã được cập nhật thành công!');
    }

    /**
     * Xóa bản ghi khỏi cơ sở dữ liệu.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $variation = Variation::findOrFail($id); // Lấy dữ liệu theo ID
        $variation->delete(); // Xóa bản ghi

        // Chuyển hướng về danh sách với thông báo
        return redirect()->route('admin.variations.index')->with('success', 'Dữ liệu đã được xóa thành công!');
    }
}
