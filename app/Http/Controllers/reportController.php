<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Report;
use Illuminate\Http\Request;

class reportController extends Controller
{
    public function getItem($category_id)
    {
        $item = Item::where('category_id',$category_id)->get();
        $text = "";
        foreach($item as $i)
        {
            $text .="<option value='$i->id'>".$i->title."</option>";
        }
        return $text;
    }

    public function report()
    {
        $reports=Report::all();
        return view('admin.report.report',['reports' => $reports]);
    }
    public function add()
    {
        $category = Category::all();
        return view('admin.report.reportAdd',['category' => $category]);
    }
    public function addAction(Request $request)
    {
        $data=$request->validate([
            'title'=>'required|string',
            'description'=>'required|string|min:70',
            'category_id'=>'required',
            'item_id'=>'required',
        ]);
        $data['user_id'] = auth()->user()->id;
        
        Report::create($data);
        return redirect(url("/report"));
    }

    public function update($idReport)
    {
        $category = Category::all();
        $items = Item::all();
        $report=Report::findOrFail($idReport);
        $this->authorize('update',$report);
        return view('admin.report.reportUpdate',['report' => $report,'category' => $category,'items' => $items]);
    }

    public function updateAction($idReport,Request $request)
    {
        $data=$request->validate([ 
            'title'=>'required|string',
            'description'=>'required|string|min:70',
        ]);
        $data['user_id'] = auth()->user()->id;
        $report=Report::findOrFail($idReport);

        $this->authorize('update',$report);

        $data['category_id'] = $report->category_id;
        $data['item_id'] = $report->item_id;
        Report::where('id', $idReport)->update($data);
        return redirect(url('/report'));

    }

    public function delete($idReport)
    {
        $report = Report::findOrFail($idReport);
        $this->authorize('update',$report);
        $report->delete();
        return redirect(url('/report'));
    }

}
