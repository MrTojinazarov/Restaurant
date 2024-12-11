<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row pt-3">
                <div class="col-12">
                    <div class="ms-1">
                        <h2>Foods</h2>
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
                                            <label for="category_id">Category:</label>
                                            <select wire:model="category_id" class="form-control"
                                                wire:blur="validateOnBlur('category_id')" required>
                                                <option value="" selected>Select a Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" wire:model="name" class="form-control"
                                                placeholder="name" wire:blur="validateOnBlur('name')" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price:</label>
                                            <input type="number" wire:model="price" class="form-control"
                                                placeholder="Price" wire:blur="validateOnBlur('price')" required>
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="img">Image:</label>
                                            <input type="file" wire:model="img" class="form-control"
                                                placeholder="Image" wire:blur="validateOnBlur('img')" required>
                                            @if ($img)
                                                <img src="{{ $img->temporaryUrl() }}" width="100px" alt="">
                                            @endif
                                            @error('img')
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
                                        <th style="width: 25%;">Name</th>
                                        <th style="width: 20%;">Category</th>
                                        <th style="width: 15%;">Price</th>
                                        <th style="width: 25%;">Image</th>
                                        <th style="width: 10%;">Options</th>
                                    </tr>
                                    @foreach ($models as $model)
                                        @if ($editFormFood != $model->id)
                                            <tr>
                                                <th>{{ $model->id }}</th>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->name }}
                                                </td>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->category->name }}
                                                </td>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $model->price }}
                                                </td>
                                                <td wire:click="editForm({{ $model->id }})"
                                                    style="cursor: pointer;">
                                                    <img src="{{ asset('storage/' . $model->img) }}" width="100px;"
                                                        alt="No image">
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
                                        @elseif ($editFormFood == $model->id)
                                            <tr>
                                                <th>{{ $model->id }}</th>
                                                <td>
                                                    <input type="text" wire:model.defer="editName"
                                                        wire:keydown.enter="updateFood" class="form-control"
                                                        placeholder="Name" required>
                                                </td>
                                                <td>
                                                    <select wire:model.defer="editCategory_id"
                                                        wire:keydown.enter="updateFood" class="form-control">
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" wire:model.defer="editPrice"
                                                        wire:keydown.enter="updateFood" class="form-control"
                                                        placeholder="Price" required>
                                                </td>
                                                <td>
                                                    <input type="file" wire:model.defer="editImg"
                                                        wire:keydown.enter="updateFood" class="form-control"
                                                        placeholder="Image" required>
                                                </td>
                                                <td>
                                                    <a type="submit" class="badge text-bg-success p-1 mt-2"
                                                        wire:click="updateFood">
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
