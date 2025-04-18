<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use App\Models\SupportMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupportController extends Controller
{
	public function overview()
	{
	    $query = SupportTicket::query();
	
	    if (auth()->user()->isAdmin()) {
	        $query->with('user');
	    } else {
	        $query->where('user_uuid', auth()->user()->uuid);
	    }
	
	    if (request()->filled('status') && in_array(request('status'), ['open', 'closed', 'pending'])) {
	        if (request('status') === 'open') {
	            $query->whereIn('status', ['open', 'pending']);
	        } else {
	            $query->where('status', request('status'));
	        }
	    }
	
	    $tickets = $query->latest('updated_at')->paginate(10);
	
	    return view('support.overview', compact('tickets'));
	}
	
	
	public function overview2() // old overview
	{
	    if (auth()->user()->isAdmin()) {
	        $tickets = \App\Models\SupportTicket::with('user')->latest('updated_at')->paginate(10);
	    } else {
	        $tickets = \App\Models\SupportTicket::where('user_uuid', auth()->user()->uuid)->latest('updated_at')->paginate(10);
	    }
	
	    return view('support.overview2', compact('tickets'));
	}

	
	public function view(SupportTicket $ticket)
	{
			
	    if (!auth()->user()->isAdmin() && $ticket->user_uuid !== auth()->user()->uuid) {
	        abort(403);
	    }
	
	    return view('support.view', ['ticket' => $ticket->load('messages.user'), 'messages' => $ticket->messages]);
	}
	
	public function sendMessage(Request $request, SupportTicket $ticket)
	{
	    if (!auth()->user()->isAdmin() && $ticket->user_uuid !== auth()->user()->uuid) {
	        abort(403);
	    }
	
	    $request->validate([
	        'message' => 'required|string|max:10000',
	    ]);
	
	    $ticket->messages()->create([
	        'message' => $request->message,
	        'user_uuid' => auth()->user()->uuid,
	        'ticket_uuid' => $ticket->uuid,  
	    ]);
	
	    $ticket->touch();
	
	    return redirect()->back()->with('success', __('support.message_sent'));
	}
	
    public function create()
    {
        return view('support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'theme' => 'nullable|string',
        ]);

        $ticket = SupportTicket::create([
            'uuid' => Str::uuid(),
            'user_uuid' => auth()->user()->uuid,
            'subject' => $request->subject,
            'theme' => $request->theme,
            'status' => 'open',
        ]);

        return redirect()->route('support.view', $ticket->uuid)->with('success', 'Ticket created successfully');
    }
	
	public function updateStatus(SupportTicket $ticket, $status)
	{
	    if (auth()->user()->uuid !== $ticket->user_uuid && !auth()->user()->isAdmin()) {
	        return view('errors.custom', ['error' => 403]);
	    }
	
	    $validStatuses = ['open', 'closed', 'pending'];
	    if (!in_array($status, $validStatuses)) {
	        return view('errors.custom', ['error' => 400]);
	    }
	
	    $ticket->status = $status;
	    $ticket->save();
	
	    return redirect()->route('support.view', $ticket->uuid)->with('success', __('support.status_updated'));
	}
}
