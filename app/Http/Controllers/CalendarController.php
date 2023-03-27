<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\GoogleCalendar\Event;


class CalendarController extends BaseController
{
    public function index(){
        $data = [];
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfYear();
       
        $events = Event::get($start,$end);
        foreach($events as $row){
            $data[] = ['id'=>$row->id,'name'=>$row->name,'description'=>$row->description,'startDateTime'=>Carbon::parse($row->startDateTime)->format('Y-m-d H:i:s'),'endDateTime'=>Carbon::parse($row->endDateTime)->format('Y-m-d H:i:s')];
        }
        // looping data calendar
        return $this->sendResponse($data, 'Success get data'); 
    }
    public function store(Request $request){

        $event = new Event;
        $validator = Validator::make($request->all(), [
      
        
            'name'=>'required',
            'start'=>'required',
            'end'=>'required',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        
        $event->name = $request->name;
        $event->description =  $request->description;
        $event->startDateTime = Carbon::createFromFormat('Y-m-d H:i:s',$request->start);
        $event->endDateTime = Carbon::createFromFormat('Y-m-d H:i:s',$request->end);
        
        $new = $event->save();
     
        return $this->sendResponse($new->id, 'Success post data'); 
    }
    public function update(Request $request,$id = null){
        
        try{
            $event = Event::find($id);
            $validator = Validator::make($request->all(), [
      
        
                'name'=>'required',
                'start'=>'required|date',
                'end'=>'required|date',
                
            ]);
    
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors(), 422);
            }
    
            
            $event->name = $request->name;
            $event->description =  $request->description;
            $event->startDateTime = Carbon::createFromFormat('Y-m-d H:i:s',$request->start);
            $event->endDateTime = Carbon::createFromFormat('Y-m-d H:i:s',$request->end);
            
            $new = $event->save();
         
            return $this->sendResponse($new->id, 'Success update data'); 
        }catch(Exception $e){
            return $this->sendError('Not Found.', 'Google Calendar Not Found', 404);
        }
       
       
    }
    public function find($id = null){
        try{
            $event = Event::find($id);
            $data = ['id'=>$event->id,'name'=>$event->name,'startDate'=>$event->startDateTime,'endDate'=>$event->endDateTime,'description'=>$event->description];
            return $this->sendResponse($data, 'Success get data'); 
        }catch(Exception $e){
            return $this->sendError('Not Found.', 'Google Calendar Not Found', 404);
        }
      
      
       
    }
    public function delete($id = null){
        try{
            $event = Event::find($id);
            $event->delete();
            return $this->sendResponse('success', 'Success delete data'); 
        }catch(Exception $e){
            return $this->sendError('Not Found.', 'Google Calendar Not Found', 404);
        }
       
    }
}
