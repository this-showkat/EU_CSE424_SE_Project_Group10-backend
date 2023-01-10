<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;

use App\Models\Newsletter;
use App\Http\Resources\NewsletterResource as NewsletterResource;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;

class NewsletterController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsletters = Newsletter::all();
        return $this->sendResponse(NewsletterResource::collection($newsletters), 'newsletter contacts fetched.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewsletterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsletterRequest $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
        ]);
        if($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $contact = Newsletter::create($input);
        return $this->sendResponse(new NewsletterResource($contact), 'Succesfully Subscribed.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Newsletter::find($id);
        if(is_null($contact)) {
            return $this->sendError('email does not exist');
        }
        return $this->sendResponse(new NewsletterResource($contact), 'Contact Fetched.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsletterRequest  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return $this->sendResponse([], 'Email removed from newsletter.');
    }
}
