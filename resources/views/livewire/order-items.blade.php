<div class="content-wrapper kanban">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Order Board</h1>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order Board</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content pb-3">
        <div class="container-fluid h-100">
            <div class="card card-row card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Orders
                    </h3>
                    <div class="card-tools">
                        <a class="me-2">{{$counts['new']}} ta</a>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($models as $model)
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Order: {{ $model->queue }}</h5>
                                <div class="card-tools">
                                    <a class="badge bg-success p-2 me-2" wire:navigate
                                        wire:click="changeOrderStatus({{ $model->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach ($model->orderItem as $food)
                                    <h5 class="ms-2">
                                        {{ $food->food->name }},
                                        {{ $food->count }} ta
                                    </h5>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card card-row card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        In Progress
                    </h3>
                    <div class="card-tools">
                        <a class="me-2">{{$counts['inProgress']}} ta</a>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($progModels as $progModel)
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Order: {{ $progModel->queue }}</h5>
                                <div class="card-tools">
                                    <a class="badge bg-success p-2 me-2" wire:navigate
                                        wire:click="changeOrderItemsStatus({{ $progModel->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach ($progModel->orderItem as $food)
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox"
                                            id="customCheckbox1{{ $food->id }}"
                                            wire:click="toggleItemStatus({{ $progModel->id }}, {{ $food->id }})"
                                            {{ $food->status == 2 ? 'checked' : '' }}>
                                        <label for="customCheckbox1{{ $food->id }}" class="custom-control-label"
                                            style="color: black">
                                            {{ $food->food->name }}, {{ $food->count }} ta
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card card-row card-default">
                <div class="card-header bg-info">
                    <h3 class="card-title">
                        Done
                    </h3>
                    <div class="card-tools">
                        <a class="me-2" style="color: white">{{$counts['done']}} ta</a>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($doneModels as $doneModel)
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Order: {{ $doneModel->queue }}</h5>
                                <div class="card-tools">
                                    <a class="badge bg-success p-2 me-2" wire:navigate
                                        wire:click="getByWaiterChangeStatus({{ $doneModel->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path
                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach ($doneModel->orderItem as $food)
                                    <div class="form-group">
                                        <h5 class="ms-2">{{ $food->food->name }}, {{ $food->count }}<h5>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card card-row card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        In Hand
                    </h3>
                    <div class="card-tools">
                        <a class="me-2">{{$counts['handed']}} ta</a>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($handModels as $model)
                    <div class="card card-info card-outline">
                        <div class="card-header" onclick="toggleOrder({{ $model->id }})" style="cursor: pointer;">
                            <h5 class="card-title">Order: {{ $model->queue }}</h5>
                            <div class="card-tools">
                                <a class="me-2">Touch for view</a>
                            </div>
                        </div>
                        <div id="order-{{ $model->id }}" class="card-body" style="display: none;">
                            @foreach ($model->orderItem as $food)
                                <div class="form-group">
                                    <h5 class="ms-2">{{ $food->food->name }}, {{ $food->count }}</h5>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach                
                </div>
            </div>
        </div>
    </section>
</div>
