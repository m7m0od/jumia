<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class catController extends Controller
{
   
    public function category()
    {
        $cats=Category::all();
        
        return view('admin.cat.category',['cats' => $cats]);
    }

    public function items($idCat)
    {
        $items=Item::where('category_id',$idCat)->get();
        
        return view('admin.cat.items',['items' => $items]);
    }

    public function add()
    {
        return view('admin.cat.catAddForm');
    }
    public function addAction(Request $request)
    {
        $data=$request->validate([
            'title'=>'required|string',
            'description'=>'required|string|min:100',
            'pic'=>'required|image',
        ]);
        $data['user_id'] = auth()->user()->id;
        $immg = Storage::putFile('public/prods', $data['pic']);
        $data['pic']=str_replace('public/','storage/',$immg);
        
        Category::create($data);
        return redirect(url("/category"));
    }

    public function update($idCat)
    {
        $cat=Category::findOrFail($idCat);
        $this->authorize('update',$cat);
        return view('admin.cat.catUpdateForm',['cat' => $cat]);
    }

    public function updateAction($idCat,Request $request)
    {
        $data=$request->validate([
            'title'=>'required|string',
            'description'=>'required|string|min:100',
            'pic'=>'image',
        ]);

        $data['user_id'] = auth()->user()->id;
        $cat=Category::findOrFail($idCat);

        $this->authorize('update',$cat);
        
        $immg=$cat->pic;
        if($request->hasFile('pic'))
        {
            $immg=Storage::putFile('public/prods',$data['pic']);
            $data['pic']=str_replace('public/','storage/',$immg);
        }
        Category::where('id', $idCat)->update($data);
        return redirect(url('/category'));

    }

    public function delete($idCat)
    {
        $cat = Category::findOrFail($idCat);
        $this->authorize('delete',$cat);
        $imgD=str_replace('storage/','public/',$cat->pic);
        Storage::delete($imgD);
        $cat->delete();
        return redirect(url('/category'));
    }
}
