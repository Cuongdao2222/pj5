<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproductRequest;
use App\Http\Requests\UpdateproductRequest;
use App\Repositories\productRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\groupProduct;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\hotProduct;
use Flash;
use Response;

use App\Models\metaSeo ;

class productController extends AppBaseController
{
    /** @var  productRepository */
    private $productRepository;

    public function __construct(productRepository $productRepo)
    {
        $this->productRepository = $productRepo;
    }

    /**
     * Display a listing of the product.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $products = product::Orderby('id', 'desc')->paginate(10);
        
        return view('products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return Response
     */
    public function create()
    {
        return view('products.create');
    }

    

    /**
     * Store a newly created product in storage.
     *
     * @param CreateproductRequest $request
     *
     * @return Response
     */
    public function store(CreateproductRequest $request)
    {
        $input = $request->all();

        if(empty($input['Link'])){

            $input['Link'] = convertSlug($input['Name']);
        }

        if(empty($input['Quantily'])){

            $input['Quantily'] = 0;
        }

        if(!empty($input['Price'])){

            $input['Price'] = str_replace(',', '', $input['Price']);
            $input['Price'] = str_replace('.', '', $input['Price']);
        }

        if(!empty($input['Group_id'])){

            // tìm sản phẩm cha để add vào 

            $add_parent = [];

            $parent = groupProduct::find($input['Group_id']);

            $level = $parent->level;

            if($level>0){

                for($i = 0; $i<= $level; $i++){

                    if($parent->parent_id != 0){

                        $parent = (groupProduct::find($parent->parent_id));

                        array_push($add_parent, $parent->id);
                    }

                }

            }
            else{
                array_push($add_parent, $parent->id);
            }

            $input['Price'] = str_replace(',', '', $input['Price']);
            $input['Price'] = str_replace('.', '', $input['Price']);
        }
        if ($request->hasFile('Image')) {

            $file_upload = $request->file('Image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/product', $name, 'public');

            $input['Image'] = $filePath;
        }

        //add meta seo cho product

        $meta_title = $input['ProductSku'].', '.$input['Name'].' giá rẻ, Trả góp 0%';

        $meta_content = 'Mua '.$input['Name'].' giá rẻ. Miễn phí giao hàng & Lắp đặt. Đổi lỗi trong 7 ngày đầu. Liên hệ hotline 0247.303.6336 để mua hàng và biết thêm thông tin chi tiết'; 

        $meta_model = new metaSeo();

        $meta_model->meta_title =$meta_title;

        $meta_model->meta_content =$meta_content;

        $meta_model->meta_og_content =$meta_content;

        $meta_model->meta_og_title =$meta_title;

        $meta_model->meta_key_words =$meta_title;

        $meta_model->save();

        $input['Meta_id'] = $meta_model['id'];

        foreach($add_parent as $val){
           
           
            $input['Group_id'] = $val;
            $product = $this->productRepository->create($input);

        }
        
        return Redirect()->back()->with('id', $product['id']);

    }

    /**
     * Display the specified product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified product in storage.
     *
     * @param int $id
     * @param UpdateproductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproductRequest $request)
    {
        $product = $this->productRepository->find($id);

        $input  = $request->all();

        if(empty($input['Link'])){

            $input['Link'] = convertSlug($input['Name']);
        }

        if(empty($input['Quantily'])){

            $input['Quantily'] = 0;
        }


        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        if(!empty($input['Price'])){

            $input['Price'] = str_replace(',', '', $request->Price);
            $input['Price'] = str_replace('.', '', $input['Price']);
        }

        

        if($product->Group_id != $input['Group_id']){

            $hot = hotProduct::where('product_id', $id)->first();

            $hot = hotProduct::find($hot->id);

            $hot->group_id = $input['Group_id'];

            $hot->save();
        }

        if ($request->hasFile('Image')) {

            $file_upload = $request->file('Image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/product', $name, 'public');

            $input['Image'] = $filePath;
        }

         
        $product = $this->productRepository->update($input, $id);

        Flash::success('Product updated successfully.');

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified product from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }

    public function FindbyNameOrModel(Request $request)
    {
        $clearData = trim($request->search);

        $data      = $clearData;

        $resultProduct = Product::select('id')->where('Name', $data)->OrWhere('ProductSku', $data)->first();

        if(!empty($resultProduct)){


            $products = Product::where('id', $resultProduct->id)->paginate(10);

            return view('products.index')
            ->with('products', $products);

        }
        else{
            Flash::error('Không tìm thấy sản phẩm, vui lòng tìm kiếm lại"');

            return redirect(route('products.index'));
            
        }
        
    }

    public function selectProductByCategory($cate_id)
    {
       $products = Product::where('Group_id', $cate_id)->orderBy('id', 'desc')->paginate(10);

       return view('products.index')
            ->with('products', $products);

        if (empty($product)) {

            Flash::error('Product not found');

            return redirect(route('products.index'));
        }


    }

    public function FindbyNameOrModelOfFrontend(Request $request)
    {
        $clearData = trim($request->key);

        $data      = $clearData;

        $resultProduct = Product::select('id')->where('Name', $data)->OrWhere('ProductSku', $data)->first();

        if(!empty($resultProduct)){

            $products = Product::where('id', $resultProduct->id)->paginate(10);

    
            return view('frontend.category')
            ->with('data', $products);

        }
        else{
            $data = [];
            return view('frontend.category', compact('data'));
            // Flash::error('Không tìm thấy sản phẩm, vui lòng tìm kiếm lại"');
        }
        
    }

    public function search()
    {
        $array['ProductSku'] = 'UA50AU9000KXXVS';

        $array['Price'] = '500';
        $search = product::where($array)->get();
        print_r($search);
    }
}
