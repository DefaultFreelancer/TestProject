<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventCategory;
use App\Http\Requests\NewEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('dashboard/index', ['events' => Event::all()]);
    }


    public function calendar()
    {
        return view('dashboard/calendar', ['events' => Event::all(), 'categories' => EventCategory::all()]);
    }


    /**
     * @param NewEventRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createEvent(NewEventRequest $request)
    {
        try{
            $event = Event::create([
                'name'          => $request['name'],
                'description'   => $request['description'],
                'category_id'   => $request['category_id'],
                'starts_at'     => $request['starts_at'],
                'ends_at'       => $request['ends_at'],
                'user_id'       => Auth::user()->id
            ]);

        } catch (\Exception $exception){
            return response()->json(['error', __('Event cannot be created!')]);
        }
        return response()->json(['success' => __('Event is created!'), 'event' => json_encode($event)], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEventById($id)
    {
        try{
            $event = Event::findOrFail($id);
        } catch (\Exception $exception){
            return response()->json(['error', __('Event cannot be found!')]);
        }
        return response()->json(['success' => json_encode($event)]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteEvent(Request $request)
    {
        try {
            $event = Event::findOrFail($request['id']);
            $event->delete();
        } catch (\Exception $exception){
            return response()->json(['error', __('Event cannot be deleted!')]);
        }
        return response()->json(['success' => __('Event is deleted!')], 200);
    }


    /**
     * @param UpdateEventRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateEvent(UpdateEventRequest $request, $id)
    {
        try {
            $event = Event::findOrFail($request['id']);
            $event->name = $request['name'];
            $event->description = $request['description'];
            $event->category_id = $request['category_id'];
            $event->starts_at = $request['starts_at'];
            $event->ends_at = $request['ends_at'];
            $event->save();

        } catch (\Exception $exception){
            return response()->json(['error', __("Event {$request['name']} cannot be updated!")]);
        }
        return response()->json(['success' => __("Event {$event->name} is updated!")], 200);
    }

}
