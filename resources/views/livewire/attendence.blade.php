<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="col-12">
                    <h1>Davomat</h1>
                    <input type="date" class="form-control" wire:change="changeDate($event.target.value)">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-4">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                @foreach ($days as $day)
                                    <th> {{ $day->format('d') }}</th>
                                @endforeach
                            </tr>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->user->name }}</td>
                                    @foreach ($days as $day)
                                        @php
                                            $employeeDavomat = $employee->checks($day->format('Y-m-d'));
                                        @endphp
                                        <td>
                                            @if ($employeeDavomat)
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#exampleModal{{$employeeDavomat->id}}">
                                                    {{ round($employeeDavomat->time, 2) }}
                                                </button>

                                                <div class="modal fade" id="exampleModal{{$employeeDavomat->id}}" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                   Day: {{$employeeDavomat->date}}
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Start time: {{$employee->start_time}} <br>
                                                                Come: {{$employeeDavomat->start_time}} <br>
                                                                End time: {{$employee->end_time}} <br>
                                                                Leave: {{$employeeDavomat->end_time ?? 'not left yet'}} <br>
                                                                Workhours: {{round($employeeDavomat->time, 2) ?? 0}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
