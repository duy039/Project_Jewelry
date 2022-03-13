<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ManageProduct extends Controller
{

    public function index(Request $request,)
    {

        $allProduct = DB::table('product')->orderBy('Product_id', 'asc')->paginate(10);

        return view('admin.Product.all_product')->with('ap', $allProduct);
    }

    public function viewadd()
    {
        return view('admin.Product.add_product');
    }
    public function addcoupon()
    {
        return view('admin.Coupon.add_coupon');
    }
    public function showcoupon()
    {
        return view('admin.Coupon.all_coupon');
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'required',
            'createDate' => 'required',
            'updateDate' => 'required',
            'product_desc' => 'required',
            'sold_quantity' => 'required'
        ], [
            'product_id.required' => 'Product id field is required',
            'product_name.required' => 'Name field is required',
            'product_price.required' => 'Price field is required',
            'product_image.required' => 'Image field is required',
            'createDate.required' => 'Create date field is required',
            'updateDate.required' => 'Update date field is required',
            'product_desc.required' => 'Description field is required',
            'sold_quantity.required' => 'Sold quantity field is required',
        ]);
        $data =  $request->all();

        $path = 'assets/images/product/';
        $file = $request->file('product_image');
        $new_image_name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        // $oldimage = $path . $new_image_name;
        // if (File::exists($oldimage)) {
        //     File::delete($oldimage);
        // }
        $upload = $file->move(public_path($path), $new_image_name);
        if ($upload) {
            if ($extension == 'png' || $extension == 'jepg' || $extension == 'jpg') {
                $value = [
                    'Product_id' => $data['product_id'],
                    'Name' => $data['product_name'],
                    'Description' => $data['product_desc'],
                    'Price_Root' => $data['product_price'],
                    'Sale_Type' => $data['saleType'],
                    'Price_Sale' => $data['salePercent'],
                    'Quantity' => $data['product_quantity'],
                    'Sold_Product_Quantity' => $data['sold_quantity'],
                    'Avatar' => $new_image_name,
                    'Create_Date' => $data['createDate'],
                    'Update_Date' => $data['updateDate'],
                ];
                $query = DB::table('product')->insert($value);
                if ($query) {
                    return redirect('admin/manageProduct')
                        ->with('message', 'Product created successfully');
                }
            } else {
                return redirect()->route('admin.Product.add_product')
                    ->with('errors', 'Image wrong format');
            }
        }
    }

    //    public function show(manageProduct $product)
    //    {
    //        return view('admin.Product.all_product',compact('product'));
    //    }

    //    public function edit(manageProduct $product)
    //    {
    //        return view('admin.Product.edit_product',compact('product'));
    //    }


    //    public function update(Request $request, manageProduct $product)
    //    {
    //     $request->validate([
    //         'Name'=> 'required',
    //         'Price_Sale' =>'required',
    //         'Quantity' =>'required'
    //        ]);
    //        $product->update($request->params['Name'],$request->params['Price_Sale'],$request->params['Quantity']);
    //        return redirect()->route('admin.Product.all_product')
    //        ->with('success','Product updated successfully');
    //    }

    //    public function destroy(manageProduct $product)
    //    {
    //        $product->delete();
    //        return redirect()->route('admin.Product.all_product')
    //        ->with('success','Product updated successfully');
    //    }
}
