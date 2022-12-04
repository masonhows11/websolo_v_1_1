<div>
    @section('dash_page_title')
        مدیریت کاربران
    @endsection
    <div class="container">

        <div class="row d-flex justify-content-center admin-user-alert">
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

        <div class="row admin-list-users d-flex justify-content-center align-content-center align-items-center">

            <div class="col-xl-7 col-lg-7 col-md-7 bg-white rounded-3 list-content">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th>شناسه</th>
                        <th>نام کاربری</th>
                        <th>حذف</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($users)
                        @foreach($users as $user)

                            <tr class="text-center">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                @if($user->hasRole('admin'))
                                @else
                                    <td class="mb-3">
                                        <a href="#" wire:click.prevent="deleteUser({{ $user->id }})">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <td class="mb-3">
                                        <a href="#" wire:click.prevent="activeUser({{ $user->id }})"
                                           class="btn
                                        {{ $user->banned == 0 ? 'btn-success' : 'btn-danger' }} btn-sm mb-3">
                                            {{ $user->banned == 0 ? 'فعال' : 'غیر فعال' }}
                                        </a>
                                    </td>
                                @endif
                            </tr>

                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>

            <div class="col-xl-7 col-lg-7 col-md-7 mt-5">
                {{ $users->links() }}
            </div>

        </div>
    </div>

</div>
