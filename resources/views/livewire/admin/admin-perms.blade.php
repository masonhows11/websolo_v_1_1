<div>
    @section('dash_page_title')
        مجوزها
    @endsection
        <div class="container">

            <div class="row d-flex justify-content-center admin-role-alert">
                @if(session()->has('success'))
                    <div
                        class="col-xl-7 col-lg-7 col-md-7 alert alert-success alert-dismissible alert-component text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div
                        class="col-xl-7 col-lg-7 col-md-7 alert alert-danger alert-dismissible alert-component text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
            </div>

            <div class="row d-flex justify-content-center admin-create-new-role">
                <div class="col-xl-7 col-lg-7 col-md-7">
                    <form wire:submit.prevent="storePerm">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">نام مجوز :</label>
                            <input type="text" wire:model.lazy="name"
                                   class="form-control"
                                   id="name">
                        </div>
                        @error('name')
                        <div class="alert alert-danger my-2">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">ذخیره</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row d-flex justify-content-center admin-list-roles">
                <div class="col-xl-7 col-lg-7 col-md-7 bg-white rounded-3 list-content">
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th>شناسه</th>
                            <th>نام نقش</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($perms)
                            @foreach($perms as $perm)
                                <tr class="text-center">
                                    <td>{{ $perm->id }}</td>
                                    <td>{{ $perm->name }}</td>
                                    <td class="mb-3">
                                        <a href="#" wire:click.prevent="deletePerm({{ $perm->id }})">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td class="mb-3">
                                        <a href="#" wire:click="editPerm({{ $perm->id }})" class="btn btn-sm mb-3">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
