<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreategiftRequest;
use App\Http\Requests\UpdategiftRequest;
use App\Repositories\giftRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\gift;
use Flash;
use Response;
use DB;
use App\Models\priceAutoPromotionActive;

use App\Models\pricePromotionAuto;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class giftController extends AppBaseController
{
    /** @var  giftRepository */
    private $giftRepository;

    public function __construct(giftRepository $giftRepo)
    {
        $this->giftRepository = $giftRepo;
    }

    /**
     * Display a listing of the gift.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $gifts = gift::orderBy('id','desc')->paginate(10);

        return view('gifts.index')
            ->with('gifts', $gifts);
    }

    /**
     * Show the form for creating a new gift.
     *
     * @return Response
     */
    public function create()
    {
        return view('gifts.create');
    }

    /**
     * Store a newly created gift in storage.
     *
     * @param CreategiftRequest $request
     *
     * @return Response
     */
    public function store(CreategiftRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {

            $file_upload = $request->file('image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/gift', $name, 'public');

            $input['image'] = $filePath;
        }

        if(!empty($input['price'])){

            $input['price'] = str_replace(',', '', $request->price);
            $input['price'] = str_replace('.', '', $input['price']);
        }

        $gift = $this->giftRepository->create($input);

        Flash::success('Gift saved successfully.');

        return redirect(route('gifts.index'));
    }

    /**
     * Display the specified gift.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gift = $this->giftRepository->find($id);

        if (empty($gift)) {
            Flash::error('Gift not found');

            return redirect(route('gifts.index'));
        }

        return view('gifts.show')->with('gift', $gift);
    }

    /**
     * Show the form for editing the specified gift.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gift = $this->giftRepository->find($id);

        if (empty($gift)) {
            Flash::error('Gift not found');

            return redirect(route('gifts.index'));
        }

        return view('gifts.edit')->with('gift', $gift);
    }

    /**
     * Update the specified gift in storage.
     *
     * @param int $id
     * @param UpdategiftRequest $request
     *
     * @return Response
     */
    public function update($id, UpdategiftRequest $request)
    {
        $gift = $this->giftRepository->find($id);

        if (empty($gift)) {
            Flash::error('Gift not found');

            return redirect(route('gifts.index'));
        }

         $input = $request->all();

        if ($request->hasFile('image')) {

            $file_upload = $request->file('image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/gift', $name, 'public');

            $input['image'] = $filePath;
        }
        if(!empty($input['price'])){

            $input['price'] = str_replace(',', '', $request->price);
            $input['price'] = str_replace('.', '', $input['price']);
        }

       

        $gift = $this->giftRepository->update($input, $id);

        Flash::success('Gift updated successfully.');

        return redirect(route('gifts.index'));
    }

    /**
     * Remove the specified gift from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gift = $this->giftRepository->find($id);

        if (empty($gift)) {
            Flash::error('Gift not found');

            return redirect(route('gifts.index'));
        }

        $this->giftRepository->delete($id);

        Flash::success('Gift deleted successfully.');

        return redirect(route('gifts.index'));
    }   

    public function destroyGift($id)
    {
      
       $check = DB::table('group_gift')->where('id', $id)->first();
       $now   = Carbon::now();


       $start = Carbon::create($check->start);
       $end   =  Carbon::create($check->end);


       if(!empty($check) && $now->between($start, $end)){

            Flash::error('Không thể xóa vì có khuyến mãi đang chạy');
            return redirect()->back();

       }
       else{
            
             DB::table('group_gift')->where('id', $id)->delete();

            Flash::success('xóa thành công');

            return redirect()->back();
             
       }
    }

    public function updateGiftDate(Request $request)
    {
        $id = $request->id;

        $data_update = $request->data;

        $ar = ['end' => $data_update];

        DB::table('group_gift')->where('id', $id)->update($ar);

        Cache::flush();

        file_get_contents(env('APP_URL'));

        return response($id);

    }

    public function addPromotionAuto(Request $request)
    {

        $price_form = $request->from;

        $price_to   = $request->to;
       
        if($price_to ==='limit'){

            $price_compare =  json_encode([$price_form]);
        }
        else{
           
            $price_compare =  json_encode([$price_form, $price_to]);
        }
        
       
        $input['voucher_name'] = trim($request->voucher_name);

        $input['price_compare'] = $price_compare;


        if ($request->hasFile('image')) {

            $file_upload = $request->file('image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/gift', $name, 'public');

            $input['image'] = $filePath;
        }

        $insert = DB::table('price_promotion_auto')->insert($input);

         return redirect()->back()->with('success-promotion', 'thành công');   

    }

    public function promotionPriceAuto(Request $request)
    {

        $thu = 500;

        $array = [300, 600];

        // đẩy phần tử mới nhập vào mảng cho trước

        array_push($array, $thu);

        // sắp xếp lại mảng theo chiều tăng dần

        sort($array);

        // kiểm tra xem phần tử có phải ở giữa không nếu ở giữa thì in ra đúng

        if($array[1] === 900){

            echo "phần tử này nằm giữa mảng";

        }
        else{
            echo "phần tử này k nằm giữa mảng";
        }

    }
    public function activePromotionPrice(Request $request)
    {
       
        $active = $request->active;

        if($active ==0){

            DB::table('money_promotion')->delete();

            Cache::forget('money_promotion');
        }

        $update =  priceAutoPromotionActive::find(1);

        $update->active = $active;

        $update->save();

        Cache::forget('view-homes');

        return response('thành công');

    }

    public function removeClickActivePromotionPrice(Request $request)
    {
        $id = $request->id;

        $delete = pricePromotionAuto::find($id)->delete();

        return response('thành công!');


    }
}
