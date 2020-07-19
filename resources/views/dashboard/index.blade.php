@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('All events') }}</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Created by') }}</th>
                            <th>{{ __('Start at') }}</th>
                            <th>{{ __('End at') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->category->name }}</td>
                            <td>{{ $event->user->name }}</td>
                            <td>{{ $event->starts_at }}</td>
                            <td>{{ $event->ends_at }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
