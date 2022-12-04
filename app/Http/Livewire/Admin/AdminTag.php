<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTag extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $title_persian;
    public $title_english;
    public $delete_id;
    public $tag_id;
    public $edit_mode = false;



    protected function rules()
    {
        return [
            'title_persian' => ['required', Rule::unique('tags')->ignore($this->tag_id), 'min:2', 'max:30'],
            'title_english' => ['required', Rule::unique('tags')->ignore($this->tag_id), 'min:2', 'max:30']
        ];
    }

    protected $messages = [
        'title_english.required' => 'عنوان تگ را به انگلیسی وارد کنید.',
        'title_english.min' => 'حداقل ۲ کارکتر.',
        'title_english.max' => 'حداکثر ۳۰ کاراکتر.',
        'title_english.unique' => 'عنوان وارد شده تکراری است.',

        'title_persian.required' => 'عنوان تگ را به فارسی وارد کنید.',
        'title_persian.min' => 'حداقل ۲ کارکتر.',
        'title_persian.max' => 'حداکثر ۳۰  کاراکتر.',
        'title_persian.unique' => 'عنوان وارد شده تکراری است.',

    ];

    public function storeTag()
    {
        $this->validate();
        if ($this->edit_mode == false) {
            try {
                Tag::create([
                    'title_persian' => $this->title_persian,
                    'title_english' => $this->title_english]);
                session()
                    ->flash('success', 'تگ مورد نظر با موفقیت ایجاد شد');
                $this->title_persian = '';
                $this->title_english = '';
            } catch (\Exception $ex) {
                return view('errors_custom.model_store_error');
            }
        } elseif ($this->edit_mode == true) {
            DB::table('tags')
                ->where('id', $this->tag_id)
                ->update([
                    'title_persian' => $this->title_persian,
                    'title_english' => $this->title_english
                ]);
            $this->title_persian = '';
            $this->title_english = '';
            $this->edit_mode = false;
            session()
                ->flash('success', 'تگ مورد نظر با موفقیت بروز رسانی شد');
        }
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteTag',
    ];
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    public function deleteTag()
    {
        try {
            Tag::destroy($this->delete_id);
            session()->flash('success', 'تگ مورد نظر با موفقیت حذف شد');
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function editTag($id)
    {
        $this->edit_mode = true;
        $tag = DB::table('tags')->where('id', $id)->first();
        $this->title_persian = $tag->title_persian;
        $this->title_english = $tag->title_english;
        $this->tag_id = $tag->id;
    }

    public function render()
    {
        return view('livewire.admin.admin-tag')
            ->extends('dash.include.master')
            ->section('dash_main_content')
            ->with(['tags' => Tag::paginate(10)]);
    }
}
