<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{


    public function AdminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }


    public function AdminAddContact(){
        return view('admin.contact.create');
    }



    public function AdminStoreContact(Request $request){
        


        Contact::insert([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now(),
        ]);


        return Redirect()->route('admin.contact')->with('success', 'Contact Inserted Succesfully');
    }


    public function EditContact($id){
        $contacts = Contact::find($id);
        return view('admin.contact.edit', compact('contacts'));
    }


    public function UpdateContact(Request $request, $id)
    {

        $update = Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);


        return Redirect()->route('admin.contact')->with('success', 'Contact Updated Succesfully');
    }

    public function DeleteContact($id){
        $delete = Contact::find($id)->Delete();
        return Redirect()->route('admin.contact')->with('success', 'Contact Deleted Succesfully');
    }
}
