<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;

use App\Models\Contact;
use App\Http\Resources\ContactResource as ContactResource;

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();
        return $this->sendResponse(ContactResource::collection($contacts), 'Contacts fetched.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'details' => 'required'
        ]);
        if($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $contact = Contact::create($input);
        return $this->sendResponse(new ContactResource($contact), 'Messaged Sent.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        if(is_null($contact)) {
            return $this->sendError('Contact does not exist');
        }
        return $this->sendResponse(new ContactResource($contact), 'Contact Fetched.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'details' => 'required'
        ]);
        if($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $contact->name = $input['name'];
        $contact->email = $input['email'];
        $contact->org_name = $input['org_name'];
        $contact->subject = $input['subject'];
        $contact->details = $input['details'];
        $contact->status = $input['status'];
        $contact->save();

        return  $this->sendResponse(new ContactResource($contact), 'Contact Status Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->sendResponse([], 'Contact Deleted.');
    }
}
