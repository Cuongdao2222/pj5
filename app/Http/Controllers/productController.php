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
use Illuminate\Support\Facades\Auth;
use Session;


use App\Models\searchkey;
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

        $products = product::Orderby('updated_at', 'desc')->paginate(10);
        
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

            $input['Link'] =  str_replace('/', '', convertSlug($input['Name']));
        }

        if(empty($input['Quantily'])){

            $input['Quantily'] = 0;
        }

        if(!empty($input['Price'])){

            $input['Price'] = str_replace(',', '', $input['Price']);
            $input['Price'] = str_replace('.', '', $input['Price']);
        }

        if(empty($input['Group_id'])){

            $input['Group_id'] = 0;

        }    

        // if(!empty($input['Group_id'])){

        //     // tìm sản phẩm cha để add vào 

        //     $add_parent = [];

        //     $parent = groupProduct::find($input['Group_id']);

        //     $level = $parent->level;

        //     if($level>0){

        //         for($i = 0; $i<= $level; $i++){

        //             if($parent->parent_id != 0){

        //                 $parent = (groupProduct::find($parent->parent_id));

        //                 array_push($add_parent, $parent->id);
        //             }

        //         }

        //     }
        //     else{
        //         array_push($add_parent, $parent->id);
        //     }

        //     $input['Price'] = str_replace(',', '', $input['Price']);
        //     $input['Price'] = str_replace('.', '', $input['Price']);
        // }

        if(!empty($input['Group_id'])){

            $input['Group_id'] = 0;

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

        $input['user_id'] =  Auth::user()->id;

        

        $product = $this->productRepository->create($input);

        return redirect()->route('group-product-selected', $product['id']);
        
        // return Redirect()->back()->with('id', $product['id']);

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

        if(empty($product->Link)){

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

        if(!empty($input['Group_id'])){

            $input['Group_id'] = 0;

        }    


        if ($request->hasFile('Image')) {

            $file_upload = $request->file('Image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/product', $name, 'public');

            $input['Image'] = $filePath;
        }

        $input['user_id'] =  Auth::user()->id;
         
        $product = $this->productRepository->update($input, $id);

        Flash::success('Product updated successfully.');

        return redirect()->back();
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

        $data      = strip_tags($clearData);

        $resultProduct = [];

        $find_first = Product::select('id')->where('Name','LIKE', '%'. $data .'%')->OrWhere('ProductSku', 'LIKE', '%' . $data . '%')->OrderBy('id', 'desc')->take(50)->get()->pluck('id');

    
        if(isset($find_first)){

            foreach ($find_first as  $value) {

                array_push($resultProduct, $find_first);
            }


        }

        
        if(isset($resultProduct)){

            $products = Product::whereIn('id', $resultProduct)->paginate(50);

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
       // $products = Product::where('Group_id', $cate_id)->orderBy('id', 'desc')->paginate(10);

        $Group_product = groupProduct::find($cate_id);


        $Group_product = json_decode($Group_product->product_id);


        $products = Product::whereIn('id', $Group_product)->orderBy('id', 'desc')->paginate(10);


        return view('products.index')
            ->with('products', $products);

        if (empty($product)) {

            Flash::error('Product not found');

            return redirect(route('products.index'));
        }


    }

    public function editFastPrice(Request $request)
    {
        $price = $request->price;

        $price = str_replace(',', '', $price);

        $price = str_replace('.', '', $price);

        $product_id = $request->product_id;
        $product = product::find($product_id);
        $product->Price = $price;
        $product->user_id = Auth::user()->id;
    

        $product->save();
        return response('thanh cong');

    }

     public function editFastQualtity(Request $request)
    {

        $qualtity = $request->qualtity;
        $product_id = $request->product_id;
        $product = product::find($product_id);
        $product->Quantily = $qualtity;
         $product->user_id = Auth::user()->id;

        $product->save();
        return response('thanh cong');

    }

    public function FindbyNameOrModelOfFrontend(Request $request)
    {
        $clearData = trim($request->key);

        $datas      = strip_tags($clearData);

        if(empty($datas)){
            return redirect()->route('homeFe');

        }

        // checksearch of client


        $unique = searchkey::where('search', trim($datas))->get()->first();

        if(!empty($unique)){

            searchkey::find($unique->id)->increment('count');
        }
        else{

            $searchkey = new searchkey();

            $searchkey->search = trim($datas);

            $searchkey->save();

        }

        //check client search hơn 200 lần

        $sessionKey = 'userSearch';


        $sessionSearch = Session::get($sessionKey);

        if (!$sessionSearch) { //nếu chưa có session

            Session::put($sessionKey, 1);
        }
        else{

            $sessionSearch +=1;
        }  

        if($sessionSearch>150){

            echo "bạn đang spam phần tìm kiếm?";

            die();
        }



        $resultProduct = [];

        $numberdata = 0;

        $find_first = Product::select('id')->where('Name','LIKE', '%'. $datas .'%')->Where('active', 1)->OrWhere('ProductSku', 'LIKE', '%' . $datas . '%')->Where('active', 1)->OrderBy('id', 'desc')->take(50)->get()->pluck('id');


        if(isset($find_first)){

             $numberdata = count($find_first);

            foreach ($find_first as  $value) {

                array_push($resultProduct, $find_first);
            }

        }

        $page_search = 'filterFe';
        if(isset($resultProduct)){

            $data = Product::whereIn('id', $resultProduct)->paginate(10);

            return view('frontend.category',compact('data','numberdata','page_search'));
           

        }
        else{
            $data = [];
            return view('frontend.category', compact('data', 'numberdata', 'page_search'));
            // Flash::error('Không tìm thấy sản phẩm, vui lòng tìm kiếm lại"');
        }
        
    }

    public function imagecontent($id)
    {
        return view('products.image', compact('id'));
    }

    

    public function search()
    {
        $array['ProductSku'] = 'UA50AU9000KXXVS';

        $array['Price'] = '500';
        $search = product::where($array)->get();
        print_r($search);
    }
}
