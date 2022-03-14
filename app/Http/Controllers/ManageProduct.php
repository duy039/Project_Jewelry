<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class ManageProduct extends Controller
{
    //-------------------------------Product-------------------------------------------
    public function index()
    {
        $allProduct = DB::table('product')->orderBy('Product_id', 'asc')->paginate(10);
        return view('admin.Product.all_product')->with('ap', $allProduct);
    }

    public function viewadd()
    {
        $tag = DB::table('tags')->get();
        return view('admin.Product.add_product')->with(['tag' => $tag]);
    }

    public function store(Request $request)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'required|min:3',
            'product_desc' => 'required',
            'sold_quantity' => 'required',
            'tag' => 'required',
        ], [
            'product_id.required' => 'Product id field is required',
            'product_name.required' => 'Name field is required',
            'product_price.required' => 'Price field is required',
            'product_image.required' => 'Image field is required',
            'product_image.min' => 'Image must be at least 3 Image',
            'product_desc.required' => 'Description field is required',
            'sold_quantity.required' => 'Sold quantity field is required',
            'tag.required' => 'Tag field is required',
        ]);
        $data =  $request->all();
        $path = 'assets/images/product/';
        $file = $request->file('product_image');
        for ($i = 0; $i < count($file); $i++) {
            $extension = $file[$i]->getClientOriginalExtension();
            $new_image_name[] = $file[$i]->getClientOriginalName();
            $upload = $file[$i]->move(public_path($path), $new_image_name[$i]);
        };
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
                    'Avatar' => $new_image_name[0],
                    'Create_Date' => $date,
                    'Update_Date' => $date,
                ];
                $product = DB::table('product')->insert($value);
                if ($product) {
                    for ($i = 0; $i < count($new_image_name); $i++) {
                        $value = [
                            'Product_id' => $data['product_id'],
                            'Image_Name' => $new_image_name[$i]
                        ];
                        $productImage = DB::table('images_product')->insert($value);
                    }
                    if ($productImage) {
                        for ($i = 0; $i < count($data['tag']); $i++) {
                            $value = [
                                'Product_id' => $data['product_id'],
                                'Tag_id' => $data['tag'][$i],
                            ];
                            DB::table('product_tag')->insert($value);
                        }
                        return redirect('admin/manageProduct')
                            ->with('message', 'Product created successfully');
                    }
                }
            } else {
                return redirect()->route('admin.Product.add_product')
                    ->with('errors', 'Image wrong format');
            }
        }
    }

    public function edit($proid)
    {
        $tag = DB::table('tags')->get();
        $product_tag = DB::table('product_tag')->where('Product_id', $proid)->get();
        $image = DB::table('images_product')->where('Product_id', $proid)->get();
        $pro = DB::table('product')->where('Product_id', $proid)->get();
        foreach ($product_tag as $proTag[]) {
            $proTag = $proTag;
        }
        // dd($proTag[0]->Tag_id);
        return view('admin.Product.edit_product')->with(['edit_product' => $pro, 'tag' => $tag, 'image' => $image, 'productTag' => $proTag]);
    }


    public function update(Request $request, $proid)
    {

        $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'product_price' => 'required',
            'product_image' => 'required|min:3',
            'product_desc' => 'required',
            'sold_quantity' => 'required',
            'tag' => 'required',
        ], [
            'product_id.required' => 'Product id field is required',
            'product_name.required' => 'Name field is required',
            'product_price.required' => 'Price field is required',
            'product_image.required' => 'Image field is required',
            'product_image.min' => 'Image must be at least 3 Image',
            'product_desc.required' => 'Description field is required',
            'sold_quantity.required' => 'Sold quantity field is required',
            'tag.required' => 'Tag field is required',
        ]);

        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $product = DB::table('product')->where('Product_id', $proid)->first();
        $imageProduct = DB::table('images_product')->where('Product_id', $proid)->get();
        foreach ($imageProduct as $imgProduct) {
            $imgPro[] = $imgProduct;
        }
        $data =  $request->all();
        $path = 'assets/images/product/';
        $file = $request->file('product_image');
        $oldProAvatar = $path . $product->Avatar;
        //xóa hình trong product
        if (File::exists($oldProAvatar)) {
            File::delete($oldProAvatar);
        }
        //xóa hình trong bảng image_product
        for ($i = 0; $i < count($imgPro); $i++) {
            $oldProImage[] = $path . $imgPro[$i]->Image_Name;
            if (File::exists($oldProImage[$i])) {
                File::delete($oldProImage[$i]);
            }
        }
        //lấy đuôi hình
        for ($i = 0; $i < count($imgPro); $i++) {
            $extension = $file[$i]->getClientOriginalExtension();
        };
        $proAvatar = $request->file('product_Avatar');
        $proAvaName = $proAvatar->getClientOriginalName();
        $avaExtension = $proAvatar->getClientOriginalExtension();

        if ($avaExtension == 'png' || $avaExtension == 'jepg' || $avaExtension == 'jpg') {
            $proAvatar->move(public_path($path), $proAvaName);
            if ($extension == 'png' || $extension == 'jepg' || $extension == 'jpg') {
                for ($i = 0; $i < count($file); $i++) {
                    $new_image_name[] = $file[$i]->getClientOriginalName();
                    $upload = $file[$i]->move(public_path($path), $new_image_name[$i]);
                }
                if ($upload) {
                    $value = [
                        'Product_id' => $data['product_id'],
                        'Name' => $data['product_name'],
                        'Description' => $data['product_desc'],
                        'Price_Root' => $data['product_price'],
                        'Sale_Type' => $data['saleType'],
                        'Price_Sale' => $data['salePercent'],
                        'Quantity' => $data['product_quantity'],
                        'Sold_Product_Quantity' => $data['sold_quantity'],
                        'Avatar' => $proAvaName,
                        'Create_Date' => $date,
                        'Update_Date' => $date,
                    ];
                    $product = DB::table('product')->where('Product_id', $proid)->update($value);
                    if ($product) {
                        $productImage = DB::table('images_product')->where('Product_id', $proid)->delete();
                        for ($i = 0; $i < count($new_image_name); $i++) {
                            $value = [
                                'Product_id' => $data['product_id'],
                                'Image_Name' => $new_image_name[$i]
                            ];
                            $productImage = DB::table('images_product')->where('Product_id', $proid)->insert($value);
                        }
                        if ($productImage) {
                            DB::table('product_tag')->where('Product_id', $proid)->delete();
                            for ($i = 0; $i < count($data['tag']); $i++) {
                                $value = [
                                    'Product_id' => $data['product_id'],
                                    'Tag_id' => $data['tag'][$i],
                                ];
                                DB::table('product_tag')->where('Product_id', $proid)->insert($value);
                            }
                        }
                    }
                    return redirect('admin/manageProduct')
                        ->with('message', 'Update successfully');
                }
            } else {
                return redirect('admin/addProduct')
                    ->with('errors', 'Image wrong format');
            }
        }
    }

    public function searchProduct(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $data = DB::table('product')->where('Product_id', 'like', '%' . $request->search . '%')->get();
            $total_row = count($data);
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '<tr>
                    <td>' . $row->Product_id . '</td>
                    <td>' . $row->Name . '</td>
                    <td>$' . $row->Price_Root . '</td>
                    <td>' . $row->Sale_Type . '</td>
                    <td>' . $row->Price_Sale . '</td>
                    <td>' . $row->Rating . '</td>
                    <td>' . $row->Quantity . '</td>
                    <td><img width="50px" height="50px" src="../assets/images/product/' . $row->Avatar . '"
                            alt=""></td>
                    <td>' . $row->Create_Date . '</td>

                    <td class="td-actions text-right">
                        <button type="button" rel="tooltip" class="btn btn-success">
                            <a class="material-icons"
                                href="' . url('admin/editProduct/' . $row->Product_id) . '"
                                data-original-title="Update">edit</a>
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger">
                            <a class="material-icons"
                                href="' . url('admin/deleteProduct/' . $row->Product_id) . '"
                                onclick="return confirm("Delete this product ?")"
                                data-original-title="Delete">close</a>
                        </button>
                    </td>
                </tr>';
                }
            } else {
                $output = '<tr>
                            <td align="center" colspan="10">No Data Found</td>
                        </tr>';
            }
        }
        return $output;
    }

    public function destroy($proid)
    {
        DB::table('product')->where('Product_id', $proid)->delete();
        return redirect('admin/manageProduct')
            ->with('success', 'Product updated successfully');
    }
    // ----------------------------------------------------Voucher-------------------------------------------

    public function voucherIndex()
    {
        $voucher = DB::table('voucher')->orderBy('Voucher_id', 'asc')->paginate(10);
        return view('admin.Voucher.all_coupon')->with(['all_coupon' => $voucher]);
    }
    public function viewCouponAddForm()
    {
        return view('admin.Voucher.add_coupon');
    }
    public function editVoucherView($voucherId)
    {
        $voucher = DB::table('voucher')->where('Voucher_id', $voucherId)->get();
        return view('admin.Voucher.edit_coupon')->with('voucher', $voucher);
    }
    public function storeCoupon(Request $request)
    {
        $data = $request->all();
        $request->validate(
            [
                'coupon_id' => 'required',
                'coupon_name' => 'required',
                'coupon_sale' => 'required',
                'coupon_limited' => 'required',
                'coupon_status' => 'required',
                'coupon_active' => 'required',
                'coupon_expired' => 'required',
            ],
            [
                'coupon_id.required' => 'Voucher id field is required',
                'coupon_name' => 'Voucher name field is required',
                'coupon_sale' => 'Voucher sale field is required',
                'coupon_limited' => 'Voucher limited field is required',
                'coupon_status' => 'Voucher status field is required',
                'coupon_active' => 'Voucher active field is required',
                'coupon_expired' => 'Voucher expired field is required',
            ]
        );
        $value = [
            'Voucher_id' => $data['coupon_id'],
            'Name' => $data['coupon_name'],
            'Sale' => $data['coupon_sale'],
            'Limited' => $data['coupon_limited'],
            'Status' => $data['coupon_status'],
            'Active_Date' => $data['coupon_active'],
            'Expired_Date' => $data['coupon_expired'],
        ];
        DB::table('voucher')->insert($value);
        return redirect('admin/voucher');
    }
    public function updateVoucher(Request $request, $id)
    {
        $data = $request->all();
        $request->validate(
            [
                'coupon_id' => 'required',
                'coupon_name' => 'required',
                'coupon_sale' => 'required',
                'coupon_limited' => 'required',
                'coupon_status' => 'required',
                'coupon_active' => 'required',
                'coupon_expired' => 'required',
            ],
            [
                'coupon_id.required' => 'Voucher id field is required',
                'coupon_name' => 'Voucher name field is required',
                'coupon_sale' => 'Voucher sale field is required',
                'coupon_limited' => 'Voucher limited field is required',
                'coupon_status' => 'Voucher status field is required',
                'coupon_active' => 'Voucher active field is required',
                'coupon_expired' => 'Voucher expired field is required',
            ]
        );
        $value = [
            'Voucher_id' => $data['coupon_id'],
            'Name' => $data['coupon_name'],
            'Sale' => $data['coupon_sale'],
            'Limited' => $data['coupon_limited'],
            'Status' => $data['coupon_status'],
            'Active_Date' => $data['coupon_active'],
            'Expired_Date' => $data['coupon_expired'],
        ];
        DB::table('voucher')->where('Voucher_id', $id)->update($value);
        return redirect('admin/voucher');
    }
    public function destroyVoucher($voucherId)
    {
        DB::table('voucher')->where('Voucher_id', $voucherId)->delete();
        return redirect('admin/voucher');
    }
    //-------------------------------Order-----------------------------------------

    public function orderIndex(){
        $order = DB::table('orders')->paginate(10);
        return view('admin.Order.all_order')->with('orders',$order);
    }
    public function orderEditView($orderId){
        $order = DB::table('orders')->where('Order_id',$orderId)->get();
        return view('admin.Order.edit_order')->with('orders',$order);
    }
    public function updateOrder(Request $request, $orderId){
        $data = $request->all();
        $value =[
            'Status' => $data['orderStatus'],
        ];
        $query = DB::table('orders')->where('Order_id',$orderId)->update($value);
        if($query){
            return redirect('admin/viewOrder')->with(['message'=>'Updated successful']);
        }
    }
}
