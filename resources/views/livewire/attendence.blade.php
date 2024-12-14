<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="col-12">
                    <div class="ms-2 me-2">
                        <h1>Attendence</h1>
                        @foreach ($employees as $employee)
                            <div>
                                <p><strong>Bugungi sana:</strong> {{ $employee->date }}</p>
                                <p><strong>Ish boshlash vaqti:</strong> {{ $employee->start_time }}</p>
                                <p><strong>Ish tugash vaqti:</strong> {{ $employee->end_time }}</p>
                                <p><strong>Ishlangan vaqt:</strong>
                                    {{ $employee->time ? round($employee->time, 2) . ' soat' : 'Hali hisoblanmagan' }}</p>
                            </div>
                        @endforeach

                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </div>
                </div>
            </div>
    </section>
</div>
