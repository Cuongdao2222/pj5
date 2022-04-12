<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreategroupProductRequest;
use App\Http\Requests\UpdategroupProductRequest;
use App\Repositories\groupProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class groupProductController extends AppBaseController
{
    /** @var  groupProductRepository */
    private $groupProductRepository;

    public function __construct(groupProductRepository $groupProductRepo)
    {
        $this->groupProductRepository = $groupProductRepo;
    }

    /**
     * Display a listing of the groupProduct.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $groupProducts = $this->groupProductRepository->paginate(10);

        return view('group_products.index')
            ->with('groupProducts', $groupProducts);
    }

    /**
     * Show the form for creating a new groupProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('group_products.create');
    }

    /**
     * Store a newly created groupProduct in storage.
     *
     * @param CreategroupProductRequest $request
     *
     * @return Response
     */
    public function store(CreategroupProductRequest $request)
    {
        $input = $request->all();

        if(empty($input['link'])){

            $input['link'] = convertSlug($input['name']);
        }

        $groupProduct = $this->groupProductRepository->create($input);

        Flash::success('Group Product saved successfully.');

        return redirect(route('groupProducts.index'));
    }

    /**
     * Display the specified groupProduct.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $groupProduct = $this->groupProductRepository->find($id);

        if (empty($groupProduct)) {
            Flash::error('Group Product not found');

            return redirect(route('groupProducts.index'));
        }

        return view('group_products.show')->with('groupProduct', $groupProduct);
    }

    /**
     * Show the form for editing the specified groupProduct.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $groupProduct = $this->groupProductRepository->find($id);

        if (empty($groupProduct)) {
            Flash::error('Group Product not found');

            return redirect(route('groupProducts.index'));
        }

        return view('group_products.edit')->with('groupProduct', $groupProduct);
    }

    /**
     * Update the specified groupProduct in storage.
     *
     * @param int $id
     * @param UpdategroupProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdategroupProductRequest $request)
    {

        $input = $request->all();

        $groupProduct = $this->groupProductRepository->find($id);

        $input['link'] = convertSlug($input['name']);
       

        if (empty($groupProduct)) {
            Flash::error('Group Product not found');

            return redirect(route('groupProducts.index'));
        }


        $groupProduct = $this->groupProductRepository->update($input, $id);

        Flash::success('Group Product updated successfully.');

        return redirect(route('groupProducts.index'));
    }

    /**
     * Remove the specified groupProduct from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $groupProduct = $this->groupProductRepository->find($id);

        if (empty($groupProduct)) {
            Flash::error('Group Product not found');

            return redirect(route('groupProducts.index'));
        }

        $this->groupProductRepository->delete($id);

        Flash::success('Group Product deleted successfully.');

        return redirect(route('groupProducts.index'));
    }
}
