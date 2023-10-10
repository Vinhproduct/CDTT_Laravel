<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Link;
use Illuminate\Support\Str;
class BrandController extends Controller
{
    public function index(){
        $list_brand = Brand::where('status','!=',0)->orderBy('created_at')->get();
        return view('backend.brand.index',compact('list_brand'));
    }
    public function trash(){
        $list_brand = Brand::where('status','=',0)->orderBy('created_at')->get();
        return view('backend.brand.trash',compact('list_brand'));
    }

    public function create(){
       
        $list_brand = Brand::where('status','!=',0)->get();
        $html_parent_id='';
        $html_sort_order='';
        foreach($list_brand as $item){
            $html_parent_id .='<option value="' .$item->id . '">' . $item->name . '</option>';
            $html_sort_order .='<option value="' .$item->sort_order . '">Sau: ' . $item->name . '</option>';

        }
        return view('backend.brand.create',compact('html_parent_id','html_sort_order'));
    }
    public function edit($id){

        $brand = Brand::find($id);
        $list_brand = Brand::where('status','!=',0)->get();
        $html_parent_id='';
        $html_sort_order='';
        foreach($list_brand as $item){
            $html_parent_id .='<option value="' .$item->id . '">' . $item->name . '</option>';
            $html_sort_order .='<option value="' .$item->sort_order . '">Sau: ' . $item->name . '</option>';

        }
        return view('backend.brand.edit',compact('brand','html_parent_id','html_sort_order'));


    }
    public function store(BrandStoreRequest $request){
        $brand=new brand;
        $brand->name = $request->name;
        $brand->slug=Str::slug( $brand->name = $request->name,'-');
        $brand->metakey = $request->metakey;
        $brand->metadesc = $request->metadesc;
        $brand->parent_id = $request->parent_id;
        $brand->sort_order = $request->sort_order;
        $brand->status = $request->status;
        $brand->created_at=date('Y-m-d H:i:s');
        $brand->created_by = 1;
        if($brand->save())
        {
            $link=new Link();
            $link->slug=$brand->slug;
            $link->table_id=$brand->id;
            $link->type='brand';
            $link->save();
            return redirect()->route('brand.index')->with('message',['type'=>'success','msg'=>'Thêm mẫu tin thành công!']);

        }
        else{
           return redirect()->route('brand.index')->with('message',['type'=>'danger','msg'=>'Thêm không thành công!']);

        }

    }
    public function show($id){
        $brand=Brand::find($id);
        if($brand == null){
            return redirect()->route('brand.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại!']);

        }
        else{
            return view('backend.brand.show',compact('brand'));
        }
    }
    public function update(brandUpdateRequest $request, $id ){
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->slug=Str::slug( $brand->name = $request->name,'-');
        $brand->metakey = $request->metakey;
        $brand->metadesc = $request->metadesc;
        $brand->parent_id = $request->parent_id;
        $brand->sort_order = $request->sort_order;
        $brand->status = $request->status;
        $brand->updated_at=date('Y-m-d H:i:s');
        $brand->updated_by = 1;
        if($brand->save())
        {
            $link = Link::where([['type','=','brand'],['table_id','=',$id]])->first();
            $link->slug=$brand->slug;
       
            $link->save();
            return redirect()->route('brand.index')->with('message',['type'=>'success','msg'=>'Thêm mẫu tin thành công!']);
        }
        return redirect()->route('brand.index')->with('message',['type'=>'danger','msg'=>'Thêm không thành công!']);

    }


    public function destroy($id){
        $brand=Brand::find($id);
        if($brand == null){
            return redirect()->route('brand.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại!']);

        }
        if($brand->delete())
        {
            $link = Link::where([['type','=','brand'],['table_id','=',$id]])->first();      
            $link->delete();
            return redirect()->route('brand.trash')->with('message',['type'=>'success','msg'=>'Thêm mẫu tin thành công!']);
        }
        return redirect()->route('brand.trash')->with('message',['type'=>'danger','msg'=>'Xóa không thành công!']);


    }
    public function status($id){
        $brand=Brand::find($id);
        if($brand == null){
            return redirect()->route('brand.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại!']);

        }
        $brand->status=($brand->status==1)?2:1;
        $brand->updated_at=date('Y-m-d H:i:s');
        $brand->updated_by = 1;
        $brand->save();
        return redirect()->route('brand.index')->with('message',['type'=>'success','msg'=>'Thay đổi trạng thái thành công!']);

    }
    public function delete($id){
        $brand=Brand::find($id);
        if($brand == null){
            return redirect()->route('brand.index')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại!']);

        }
        $brand->status=0;
        $brand->updated_at=date('Y-m-d H:i:s');
        $brand->updated_by = 1;
        $brand->save();
        return redirect()->route('brand.index')->with('message',['type'=>'success','msg'=>'Chuyển vào thùng rác thành công!']);

    }

    public function restore($id){
        $brand=Brand::find($id);
        if($brand == null){
            return redirect()->route('brand.trash')->with('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại!']);

        }
        $brand->status=2;
        $brand->updated_at=date('Y-m-d H:i:s');
        $brand->updated_by = 1;
        $brand->save();
        return redirect()->route('brand.trash')->with('message',['type'=>'success','msg'=>'Thay đổi trạng thái thành công!']);

    }}
