<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Filters\ThreadFilters;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Channel $channel
     * @param ThreadFilters $filters
     *
     * @return Factory|View
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        if ($channel->exists) {
            $threads = $channel->threads()->latest();
        } else {
            $threads = Thread::query()->latest();
        }

        $threads = $threads->filter($filters)->get();

        if (request()->wantsJson()) {
            return $threads;
        }

        return view('thread.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'body' => ['required'],
            'channel_id' => ['required', 'exists:channels,id'],
        ]);

        $thread = Thread::create([
            'user_id' => auth()->user()->id,
            'channel_id' => $request->input('channel_id'),
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param Channel $channel
     * @param Thread $thread
     *
     * @return Factory|View
     */
    public function show(Channel $channel, Thread $thread)
    {
        return view('thread.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(1)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Thread $thread
     *
     * @return Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Thread $thread
     *
     * @return Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Thread $thread
     *
     * @return Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
