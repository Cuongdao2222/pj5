<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreategiftRequest;
use App\Http\Requests\UpdategiftRequest;
use App\Repositories\giftRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

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
        $gifts = $this->giftRepository->paginate(10);

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

        if ($request->hasFile('image')) {

            $file_upload = $request->file('image');

            $name = time() . '_' . $file_upload->getClientOriginalName();

            $filePath = $file_upload->storeAs('uploads/gift', $name, 'public');

            $input['image'] = $filePath;
        }

        $input = $request->all();

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
}
