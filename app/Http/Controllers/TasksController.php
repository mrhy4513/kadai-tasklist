<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = Task::all();
            
            $data = [
                'user' => $user,
                'tasks' => $user->tasks,
            ];
        }
        
        return view('tasks.tasks', $data);
    }
    
    /**
    {
        $tasks = Task::all();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }
*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:10',
            'content' => 'required|max:191',
        ]);
        
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        
    /**    $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
    */   
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = Task::all();
            
            $data = [
                'user' => $user,
                'tasks' => $user->tasks,
            ];
        }
        
        return view('tasks.tasks', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        
        return view('tasks.show', [
            'task'=> $task,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
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
        $this->validate($request, [
            'status' => 'required|max:10',
            'content' => 'required|max:191',
        ]);
        
        $task = Task::find($id);
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();

        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = Task::all();
            
            $data = [
                'user' => $user,
                'tasks' => $user->tasks,
            ];
        }
        
        return view('tasks.tasks', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = Task::all();
            
            $data = [
                'user' => $user,
                'tasks' => $user->tasks,
            ];
        }
        
        return view('tasks.tasks', $data);
    }
}
