<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Exception;

class CategoryController extends AdminController
{
    public function index()
    {
        return view("admin/category/index");
    }

    public function edit(int $id)
    {
        $category = $this->_unitOfWork->category()->get("id = $id");
        return view("admin/category/edit", compact("category"));
    }

    public function getAll()
    {
        $categories = $this->_unitOfWork->category()->get_all()->get()->all();
        return response()->json(["data" => $categories]);
    }

    public function get(?int $id)
    {
        if ($id == null || $id == 0) {
            return response()->json(["error" => "Id is not found"]);
        }

        $category = $this->_unitOfWork->category()->get("id = $id");

        if ($category == null) {
            return response()->json(["error" => "Category not found"]);
        }

        return response()->json(["data" => $category]);
    }
    public function add()
    {
        return view('admin/category/create');
    }

    public function create(Request $request)
    {
        $data = $request->all();
        try {
            $this->_unitOfWork->category()->add($data);
            return redirect()->route("categoryIndex")->with('msg', 'Update status account successful');
        } catch (Exception $e) {
            return back()->with('msg', $e);
        }
    }

    public function update(Request $request, int $id)
    {
        if ($id == null || $id == 0) {
            return response()->json(["error" => "Id is not found"]);
        }

        $category = $this->_unitOfWork->category()->get("id = $id");

        if ($category == null) {
            return response()->json(["error" => "Category not found"]);
        }

        $data = $request->all();
        try {
            $this->_unitOfWork->category()->update($data);
            return redirect()->route("categoryIndex")->with('msg', 'Update status account successful');
        } catch (Exception $e) {
            return back()->with('msg', $e);
        }
    }

    public function delete(?int $id)
    {
        if ($id == null || $id == 0) {
            return response()->json(["error" => "Id is not found"]);
        }

        $category = $this->_unitOfWork->category()->get("id = $id");

        if ($category == null) {
            return response()->json(["error" => "Category not found"]);
        }

        try {
            $this->_unitOfWork->category()->delete($category);
            return response()->json(['success' => true, 'message' => 'Category deleted']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Exception: ' . $e->getMessage()]);
        }
    }
}
