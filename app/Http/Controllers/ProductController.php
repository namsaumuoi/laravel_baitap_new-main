<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Danh sách mẫu + session-based store
    protected function sampleProducts()
    {
        return [
            ['id' => 'p1', 'name' => 'Sản phẩm A', 'price' => 100000],
            ['id' => 'p2', 'name' => 'Sản phẩm B', 'price' => 200000],
            ['id' => 'p3', 'name' => 'Sản phẩm C', 'price' => 300000],
        ];
    }

    public function index(Request $request)
    {
        $products = session('products', $this->sampleProducts());
        return view('product.index', ['products' => $products]);
    }

    public function create()
    {
        return view('product.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|string',
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $products = session('products', $this->sampleProducts());
        // thêm mới (không kiểm tra trùng để đơn giản)
        $products[] = $data;
        session(['products' => $products]);

        return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');
    }

    public function show($id = '123')
    {
        // id kiểu chuỗi, nếu là '123' mặc định trả về thông tin mặc định
        if ($id === null || $id === '') {
            $id = '123';
        }

        // Tìm trong session/samples
        $products = session('products', $this->sampleProducts());
        foreach ($products as $p) {
            if ($p['id'] === $id) {
                return view('product.detail', ['product' => $p]);
            }
        }

        // Nếu không tìm, trả về text đơn giản hoặc 404
        return response("Product with id '{$id}' not found. Default id is 123.", 404);
    }
}