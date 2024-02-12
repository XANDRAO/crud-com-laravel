<?php


namespace App\Http\Controllers\Admin;
use App\Http\Requests\StoreUpdateCategoryFormRequest;
use DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table('categories')
                            ->orderBy('id', 'desc')
                            ->paginate();
        return view ('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category(); // or fetch a default category
        return view('admin.categories.create', compact('category'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateCategoryFormRequest $request)
    {
       DB::table('categories')->insert([
        'title'        => $request->title,
        'url'          => $request->url,
        'description'  => $request->description,
       ]);

       return redirect()
                   ->route('categories.index')
                   ->withSuccess('Cadastro realizado com sucesso');
    }

    /**
     * Display the specified resource.
     */

     public function show($id)
     {
        $category = Category::find($id);
        if (!$category) {
            // Redirect or handle the error if the category is not found
            return redirect()->route('categories.index')->with('error', 'Category not found.');
        }
        return view('admin.categories.show', compact('category'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('admin.categories.edit', compact('category'));
}

    /**
     * Update the specified resource in storage.
     */
   
        public function update(StoreUpdateCategoryFormRequest $request, string $id)
        {
            DB::table('categories')
            ->where('id', $id)
            ->update([
                'title'        => $request->title,
                'url'          => $request->url,
                'description'  => $request->description,
            ]);
            return redirect()->route('categories.index');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('categories')->where('id', $id)->delete();

        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {
        $data = $request->except('_token');
        /*
        $categories = DB::table('categories')
                    ->where('title', $search)
                    ->orWhere('url', $search)
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->get();
                    */
            $categories = DB::table('categories')
                 ->where(function ($query) use ($data){
                    if (isset($data['title'])){
                        $query->where('title', $data['title']);
                    }

                    if (isset($data['url'])){
                        $query->orWhere('url', $data['url']);
                    }

                    if (isset($data['description'])) {
                        $desc = $data['description'];
                        $query->where('description', 'LIKE', "%{$desc}%");
                    }

                 })
                 ->orderBy('id', 'desc')
                 ->paginate();

                 return view('admin.categories.index', compact('categories', 'data'));
    }

}
