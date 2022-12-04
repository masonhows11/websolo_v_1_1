<div>
    @section('dash_page_title')
        تخصیص مجوزها
    @endsection
    <div class="container">
        <div class="row admin-list-users d-flex justify-content-center align-content-center align-items-center">

            <div class="col-xl-7 col-lg-7 col-md-7 bg-white rounded-3 list-content">
                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <th>شناسه</th>
                        <th>نام کاربری</th>
                        <th> تخصیص مجوز</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($users)
                        @foreach($users as $user)
                            <tr class="text-center">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td class="mb-3">
                                    <a href="{{ route('admin.perms.assign.form',['user_id'=>$user->id]) }}"
                                       class="btn btn-primary  btn-sm mb-3">
                                        تخصیص مجوز
                                    </a>
                                </td>
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
