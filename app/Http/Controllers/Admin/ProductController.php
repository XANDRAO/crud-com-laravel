<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUpdateProductFormRequest;
use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $products = $this->product->with('category')->paginate(1);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::pluck('title', 'id');
    $product = new Product(); // Creates an empty Product object
    
 
return view('admin.products.create', compact('categories', 'product'));
}

    /**
     * Store a newly created resource in storage.
     */
    
     public function store(StoreUpdateProductFormRequest $request)
    {
       $data = $request->all();
   if (empty($data['url'])) {
       $data['url'] = Str::slug($data['name']);
   }
   $product = $this->product->create($data);
   return redirect()
   ->route('products.index')
   ->withSuccess('Produto cadastrado com sucesso.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->product->with('category')->where('id', $id)->first();
        if (!$product)
             return redirect()->back();
        
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $product = Product::find($id);
    $categories = Category::pluck('title', 'id');
    if (!$product) {
        return redirect()->back()->withErrors('Produto não encontrado.');
    }
    return view('admin.products.edit', compact('product', 'categories'));
}
public function update(StoreUpdateProductFormRequest $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products.index')->withErrors('Produto não encontrado.');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validatedData);
        return redirect()->route('products.index')->withSuccess('Produto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->product->find($id)->delete();

        return redirect()
                     ->route('products.index')
                     ->withSuccess('Deletando com Sucesso!');
    }

    public function search(Request $request)
{
    $paginate = $request->all();

    $products = $this->product
                        ->with('category')
                        ->where(function ($query) use ($request) {
                            if ($request->name) { 
                                $filter = $request->name;
                                $query->where(function ($querySub) use ($filter) {
                                    $querySub->where('name', 'LIKE', "%{$filter}%")
                                             ->orWhere('description', 'LIKE', "%{$filter}%");
                                });
                            }

                            if ($request->price) { 
                                $query->where('price', $request->price);
                            }

                            if ($request->category) { 
                                $query->orWhere('category_id', $request->category);
                            }
                        })
                        ->paginate(1);
    return view('admin.products.index', compact('products', 'paginate'));
}


 }
