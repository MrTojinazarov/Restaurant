<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="col-12">
                    <div class="ms-1">
                        <h2>Employees</h2>
                        <button class="btn btn-primary mt-2" wire:click="CreateModal"
                            style="width: 120px; height: auto;font-size: 20px; border-radius: 10px;">
                            {{ $activeCreate ? 'Cancel' : 'Create' }}
                        </button>

                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                <strong>{{ session('message') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if ($activeCreate)
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <form wire:submit.prevent="store">
                                        @csrf
                                        <div class="form-group">
                                            <label for="section_id">Section:</label>
                                            <select wire:model="section_id" class="form-control"
                                                wire:blur="validateOnBlur('section_id')" required>
                                                <option value="" selected>Select a section</option>
                                                @foreach ($sections as $section)
                                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('section_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="user_id">User:</label>
                                            <select wire:model="user_id" class="form-control"
                                                wire:blur="validateOnBlur('user_id')" required>
                                                <option value="" selected>Select a section</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="salary_type">Salary Type:</label>
                                            <select wire:model="salary_type" class="form-control"
                                                wire:blur="validateOnBlur('salary_type')" required>
                                                <option value="" selected>Select salary type</option>
                                                <option value="Bonus">Bonus</option>
                                                <option value="Fix">Fix</option>
                                            </select>
                                            @error('salary_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="salary">Salary:</label>
                                            <input type="number" wire:model="salary" class="form-control"
                                                placeholder="Salary" wire:blur="validateOnBlur('salary')" required>
                                            @error('salary')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="bonus">Bonus:</label>
                                            <input type="text" wire:model="bonus" class="form-control"
                                                placeholder="Bonus" wire:blur="validateOnBlur('bonus')" required>
                                            @error('bonus')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="workhours">Workhours:</label>
                                            <input type="number" wire:model="workhours" class="form-control"
                                                placeholder="Workhours" wire:blur="validateOnBlur('workhours')" required>
                                            @error('workhours')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="start_time">Start time:</label>
                                            <input type="time" wire:model="start_time" class="form-control"
                                                placeholder="Salary" wire:blur="validateOnBlur('start_time')" required>
                                            @error('start_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="end_time">End time:</label>
                                            <input type="time" wire:model="end_time" class="form-control"
                                                placeholder="End time" wire:blur="validateOnBlur('end_time')" required>
                                            @error('end_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"
                                                style="width: 100px; font-size:19px; border-radius:10px;">Save</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        @endif

                    </div>

                    @if (!$activeCreate)
                        <div class="row mt-4">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 5%;">Id</th>
                                        <th style="width: 10%;">Section</th>
                                        <th style="width: 10%;">User</th>
                                        <th style="width: 10%;">Salary Type</th>
                                        <th style="width: 10%;">Salary</th>
                                        <th style="width: 10%;">Bonus</th>
                                        <th style="width: 10%;">Workhours</th>
                                        <th style="width: 10%;">Start tm</th>
                                        <th style="width: 10%;">End time</th>
                                        <th style="width: 5%;">Hours</th>
                                        <th style="width: 10%;">Options</th>
                                    </tr>
                                    @foreach ($models as $model)
                                        @if ($editFormEmployee != $model->id)
                                            <tr>
                                                <th>{{ $model->id }}</th>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->section->name }}
                                                </td>
                                                <td >
                                                    {{ $model->user->name }}
                                                </td>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->salary_type }}
                                                </td>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->salary }}
                                                </td>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->bonus }} %
                                                </td>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->workhours }} soat
                                                </td>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->start_time }}
                                                </td>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->end_time }}
                                                </td>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->time }} soat
                                                </td>
                                                <td>
                                                    <a class="badge text-bg-warning p-1 mb-1" style="cursor: pointer;"
                                                        wire:click="editForm({{ $model->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-pencil"
                                                            style="color: rgb(25, 53, 80);" viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                                        </svg>
                                                    </a>
                                                    <a class="badge text-bg-danger p-1 mb-1" style="cursor: pointer;"
                                                        wire:click="delete({{ $model->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-trash3"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @elseif ($editFormEmployee == $model->id)
                                            <tr>
                                                <th>{{ $model->id }}</th>
                                                <td>
                                                    <select wire:model.defer="editSection_id"
                                                        wire:keydown.enter="updateEmployee" class="form-control">
                                                        @foreach ($sections as $section)
                                                            <option value="{{ $section->id }}">{{ $section->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td >
                                                    {{ $model->user->name }}
                                                </td>
                                                <td>
                                                    <select wire:model.defer="editSalary_type"
                                                        wire:keydown.enter="updateEmployee" class="form-control">
                                                        <option value="" selected>Select salary type</option>
                                                        <option value="Bonus">Bonus</option>
                                                        <option value="Fix">Fix</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" wire:model.defer="editSalary"
                                                        wire:keydown.enter="updateEmployee" class="form-control"
                                                        placeholder="Salary" required>
                                                </td>
                                                <td>
                                                    <input type="number" wire:model.defer="editBonus"
                                                        wire:keydown.enter="updateEmployee" class="form-control"
                                                        placeholder="Bonus" required>
                                                </td>
                                                <td>
                                                    <input type="number" wire:model.defer="editWorkhours"
                                                        wire:keydown.enter="updateEmployee" class="form-control"
                                                        placeholder="Workhours" required>
                                                </td>
                                                <td>
                                                    <input type="time" wire:model.defer="editStart_time"
                                                        wire:keydown.enter="updateEmployee" class="form-control"
                                                        placeholder="Start time" required>
                                                </td>
                                                <td>
                                                    <input type="time" wire:model.defer="editEnd_time"
                                                        wire:keydown.enter="updateEmployee" class="form-control"
                                                        placeholder="End Time" required>
                                                </td>
                                                <td >
                                                    {{ $model->time }}
                                                </td>
                                                <td>
                                                    <a type="submit" class="badge text-bg-success p-1 mt-2"
                                                        wire:click="updateEmployee">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-check-lg"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <div>
                                    {{ $models->links() }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
