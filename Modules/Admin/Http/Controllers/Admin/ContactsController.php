<?php

namespace Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\ContactRequest;

use Modules\Admin\Models\Contact;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'contact_translations.contacts_address' => [request('address'), 'like'], 
            'contacts.contacts_facebook' => [request('facebook'), '=']
        ];
        request()->flash();

        $query = Contact::join('contact_translations', 'contacts.contacts_id', 'contact_translations.contacts_id')
        ->groupBy('contacts.contacts_id');
        
        $searchQuery = $this->searchIndex($query, $searchArray);
        $contacts = $searchQuery->paginate(env('PerPage'));
        // return $contacts ;
        return view('admin::admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 

        return view('admin::admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\ContactReques  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        // Create New Contact
        Contact::create($request->all());

        return redirect()->route('admin.contacts.index')->with('status', __('admin::lang.contactCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Admin\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {   
        if(!$contact){
            $contact = Contact::first();
        }
        request()->flash();
        return view('admin::admin.contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Admin\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        request()->flash();
        // return $contact ;
        return view('admin::admin.contacts.edit', compact('contact'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\ContactReques  $request
     * @param  \Modules\Admin\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {        
        // Update Contact
        $contact->update($request->all());

        return redirect()->route('admin.contacts.index')->with('status', __('admin::lang.contactUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Admin\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        
        $contact->delete();
        
        return back()->with('status', __('admin::lang.contactDeleted'));
    }

   
}
