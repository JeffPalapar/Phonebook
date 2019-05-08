<?php

namespace App\Http\Controllers\Contacts;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact = new Contact();
        $this->validate($request,[
            'cname' => 'required|string|max:100',
            'cnumber' => 'required|string|max:100',
            'caddress' => 'required|string|max:100',
        ]);
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $contact->create($data);

        return redirect('home')->with('status', 'Contact Saved');
    }
    
    public function search(Request $request)
    {
        $search = $request->get('search');
        $contacts = Contact::where('cname','like','%'.$search.'%')
                                         ->orWhere('cnumber','like','%'.$search.'%')->paginate(100);

        return view('home')->with('contacts', $contacts);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        if ( $contact->user_id != auth()->user()->id )
        {
            abort('errors.401');
        }
        return view('contacts.edit')->with('contact', $contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $this->validate($request,[
            'cname' => 'required|string|max:150',
            'cnumber'=> 'required|string|max:150',
            'caddress' => 'required|string|max:150',
        ]);

        if ( $contact->user_id != auth()->user()->id )
        {
            return redirect()->back()->with('status','Cannot Update Contact');
        }

        $data = $request->all();
        $contact->update($data);

        return redirect('home')->with('status', 'Contact Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('home')->with('status','Contact Deleted');
    }
}
