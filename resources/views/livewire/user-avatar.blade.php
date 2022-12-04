<div>
    <div class="row user-avatar d-flex flex-column">

        <form wire:submit.prevent="save">
            <div class="user-img mt-2 d-flex justify-content-center">
                @if($avatar)
                    <img src="{{ $avatar->temporaryUrl() }}" alt="user-avatar" class="rounded avatar-previewer">
                    @else
                    <img src="{{ $user->image_path ?  asset('storage/users/'.$user->image_path)  : asset('images/users/no-image-icon-23494.png') }}"
                         class="rounded avatar-previewer" alt="user-avatar">
                @endif
            </div>

            <div class="user-name">
                <p class="text-center">{{ $user->name }}</p>
                <p class="text-center">{{ $user->first_name }} {{ $user->last_name }} </p>
            </div>


            <div class="d-flex  flex-column my-2 userAvatarFile">
                <div class="my-3 text-center mx-auto">
                    <label for="avatarFile" class="text-center">
                        انتخاب عکس
                    </label>
                    <input type="file" class="" name="avatarFile" wire:model="avatar">
                </div>

                <div class="mx-auto  text-center my-3">
                    <button type="submit">آپلود عکس</button>
                </div>

                @error('avatar')
                <span class="alert alert-danger">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </form>
    </div>
</div>
