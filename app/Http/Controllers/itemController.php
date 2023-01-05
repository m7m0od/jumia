<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class itemController extends Controller
{
    public function health()
    {
        $item=Item::all();
        
        return view('admin.item.item',['item' => $item]);
    }
    public function add()
    {
        $categories = Category::all();
        return view('admin.item.itemAddForm',['categories' => $categories]);
    }
    public function addAction(Request $request)
    {
        $data=$request->validate([
            'title'=>'required|string',
            'description'=>'required|string|min:70',
            'pic'=>'required|image',
            'price'=>'required|numeric',
            'category_id'=>'required',
        ]);
        $data['user_id'] = auth()->user()->id;
        $immg = Storage::putFile('public/prods', $data['pic']);
        $data['pic']=str_replace('public/','storage/',$immg);
        
        Item::create($data);
        return redirect(url("/item"));
    }

    public function update($idItem)
    {
        $categories = Category::all();
        $item=Item::findOrFail($idItem);
        $this->authorize('update',$item);
        return view('admin.item.itemUpdateForm',['item' => $item,'categories' => $categories]);
    }

    public function updateAction($idItem,Request $request)
    {
        $data=$request->validate([
            'title'=>'required|string',
            'description'=>'required|string|min:100',
            'pic'=>'image',
            'price'=>'required|numeric',
            'category_id'=>'required',
        ]);
        $data['user_id'] = auth()->user()->id;
        $item=Item::findOrFail($idItem);

        $this->authorize('update',$item);
        
        $immg=$item->pic;
        if($request->hasFile('pic'))
        {
            $immg=Storage::putFile('public/prods',$data['pic']);
            $data['pic']=str_replace('public/','storage/',$immg);
        }
        Item::where('id', $idItem)->update($data);
        return redirect(url('/item'));

    }

    public function delete($idItem)
    {
        $item = Item::findOrFail($idItem);
        $this->authorize('update',$item);
        $imgD=str_replace('storage/','public/',$item->pic);
        Storage::delete($imgD);
        $item->delete();
        return redirect(url('/item'));
    }
}
