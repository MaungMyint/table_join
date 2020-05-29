<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $items = Item::latest()->paginate(5);


        return view('item.index',compact('items'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('item.create',compact('categories'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request ->validate([
            'category' =>'required',
            'name' =>'required|unique:items',
            'price' =>'required',
            'qty' =>'required',
            ]);
    

    Item::create([

        'category_id' => request('category'),
        'name' => request('name'),
        'price' =>  request('price'),
        'qty' => request('qty'),
        
    ]);

    return redirect()->route('item.index');
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $items=Item::find($id);
        $categories=Category::all();
        return view('item.edit',compact('items','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        request()->validate([
          //  'category_id'=>'required',
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ]);
        $items=Item::find($id);
        $items->name=request('name');
        $items->price=request('price');
        $items->qty=request('qty');
        $items->category_id=request('category');
        $items->save();
        return redirect()->route('item.index')
                        ->with('success' ,"Category update success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $item=Item::find($id);
        $item->delete();
        return redirect()->route('item.index')
        ->with('success','Category deleted success');
    }
}
