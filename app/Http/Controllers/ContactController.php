<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Jobs\TestQueueJob;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function __construct()
    // {
    //     // apply auth middleware where contact details (email/number) need to be visible:
    //     $this->middleware('auth')->only(['create','store','edit','update','destroy','toggleActive','trashed','restore','forceDelete']);
    // }

        public function index(Request $request)
    {
        $query = Contact::query();

        // search
        if ($search = $request->input('q')) {
            $query->where(function($q) use ($search) {
                $q->where('name','like',"%{$search}%")
                  ->orWhere('email','like',"%{$search}%")
                  ->orWhere('number','like',"%{$search}%");
            });
        }

        // filter by status
        if (!is_null($request->input('status'))) {
            if ($request->input('status') === 'active') $query->where('is_active', true);
            if ($request->input('status') === 'inactive') $query->where('is_active', false);
        }

        // filter by date range (date is created_at)
        if ($from = $request->input('from_date')) {
            $query->whereDate('created_at','>=', $from);
        }
        if ($to = $request->input('to_date')) {
            $query->whereDate('created_at','<=', $to);
        }

         // QUEUE JOB (background)
    TestQueueJob::dispatch([
        'q'      => $request->input('q'),
        'status' => $request->input('status'),
        'from'   => $request->input('from_date'),
        'to'     => $request->input('to_date'),
        'ip'     => $request->ip(),
    ]);
        $contacts = $query->orderBy('id','desc')->paginate(20)->withQueryString();

        return view('contacts.index', compact('contacts'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all(); // for user_id selection
        return view('contacts.create', compact('users'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('contacts', 'public');
            $data['profile_image'] = $path;
        }

        Contact::create($data);

        return redirect()->route('contacts.index')->with('success','Contact created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $users = User::all();
        return view('contacts.edit', compact('contact','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function update(UpdateContactRequest $request, Contact $contact)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            // delete old
            if ($contact->profile_image) Storage::disk('public')->delete($contact->profile_image);
            $data['profile_image'] = $request->file('profile_image')->store('contacts', 'public');
        }

        $contact->update($data);
        return redirect()->route('contacts.index')->with('success','Contact updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success','Contact moved to trash.');
    }

    // trashed list
    public function trashed(Request $request)
    {
        $contacts = Contact::onlyTrashed()->orderBy('deleted_at','desc')->paginate(20);
        return view('contacts.trashed', compact('contacts'));
    }

    // restore
    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();
        return redirect()->route('contacts.trashed')->with('success','Contact restored.');
    }

    // permanent delete
    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        // delete image from storage
        if ($contact->profile_image) Storage::disk('public')->delete($contact->profile_image);
        $contact->forceDelete();
        return redirect()->route('contacts.trashed')->with('success','Contact permanently deleted.');
    }

    // AJAX toggle is_active
    public function toggleActive(Request $request, Contact $contact)
    {
        $contact->is_active = !$contact->is_active;
        $contact->save();

        return response()->json([
            'success' => true,
            'is_active' => $contact->is_active
        ]);
    }
}
