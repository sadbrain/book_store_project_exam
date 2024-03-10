<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends AdminController
{  
    public function index() {
        return view('admin/product/index');
    }
    public function getAll(){
        $products = $this->_unitOfWork->product()->get_all();
        foreach($products as $product){
            $product["category"] = $product->category;
        }
        return response()->json(["data" => $products]);

    }
    public function create(){
        $categories = $this->_unitOfWork->category()->get_all();
        return view('admin/product/create', compact('categories'));
    }
    public function createPost(Request $request){
        $data = $request->all();
        $product = $this->_unitOfWork->product()->add($data);

        if($request -> has("files")){
            $file = $request->file('files');
            $originalFilename = $file->getClientOriginalName();  // Get the original filename
            $extension = $file->getClientOriginalExtension();  
            $filename = time() . '_' . pathinfo($originalFilename, PATHINFO_FILENAME) . '.' . $extension;
            $foldername = "/images/product/product-".$product->id;
            $folderpath  = public_path($foldername);

            if(!file_exists($folderpath)){
                mkdir($folderpath, 0777, true);
            }

            $file->move($folderpath, $filename);
            $product -> image_url = $foldername . $filename;
            $this->_unitOfWork->product()->update($product);

        }
        session()->flash("message.success", "Product created successfully");
        return redirect("/admin/product");
    }

    public function update(int $id){
        $product = $this->_unitOfWork->product()->get("id = $id");
        $categories = $this->_unitOfWork->category()->get_all();
        return view('admin/product/update', compact('product' ,'categories'));
    }

    public function updatePost(Request $request){
        $product_id = $request->input("id");
        $product = $this->_unitOfWork->product()->get("id = $product_id");
        if (!$product) {
            abort(404, 'Product not found');
        }

        $product->fill($request->all());
        $this->_unitOfWork->product()->update($product);


        if($request -> has("files")){
            $file = $request->file('files');
            $originalFilename = $file->getClientOriginalName();  // Get the original filename
            $extension = $file->getClientOriginalExtension();  
            $filename = time() . '_' . pathinfo($originalFilename, PATHINFO_FILENAME) . '.' . $extension;
            $foldername = "/images/product/product-".$product->id;
            $folderpath  = public_path($foldername);

            if(!file_exists($folderpath)){
                mkdir($folderpath, 0777, true);
            }else{
                $existingFiles = File::files($folderpath);
                foreach ($existingFiles as $existingFile) {
                    File::delete($existingFile);
                }
            }

            $file->move($folderpath, $filename);
            $product -> image_url = $foldername . "/". $filename;
            $this->_unitOfWork->product()->update($product);

        }
        session()->flash("message.success", "Product updated successfully");
        return redirect("/admin/product");
    }

    public function deletePost(int $id){
        $product = $this->_unitOfWork->product()->get("id = $id");
        if (!$product) {
            abort(404, 'Product not found');
        }
        $this->_unitOfWork->product()->delete($product);
        return response() -> json([ "success" => true, "message" => "Product deleted successfully" ]);
    }
}
