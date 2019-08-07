@extends('layouts.app')

@section('content')

<h1>タスク一覧</h1>

   
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ステータス</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
   <div class="col-sm-8">
               
                    @include('tasks.tasks', ['tasks' => $tasks])
                
            </div>
    
      {!! link_to_route('tasks.create', '新規タスクの登録', [], ['class' => 'btn btn-primary']) !!}
  
@endsection