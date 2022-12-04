<?php

namespace App\Http\Livewire\Admin;

use App\Models\FrontEnd;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class AdminFrontEnd extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $title_persian;
    public $title_english;
    public $delete_id;
    public $front_id;
    public $edit_mode = false;



    protected function rules()
    {
        return [
            'title_persian' => ['required', Rule::unique('front_ends')->ignore($this->front_id), 'min:2', 'max:30'],
            'title_english' => ['required', Rule::unique('front_ends')->ignore($this->front_id), 'min:2', 'max:30']
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

    public function storeFront()
    {
        $this->validate();
        if ($this->edit_mode == false) {
            try {
                FrontEnd::create([
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
            DB::table('front_ends')
                ->where('id', $this->front_id)
                ->update([
                    'title_persian' => $this->title_persian,
                    'title_english' => $this->title_english
                ]);
            $this->title_persian = '';
            $this->title_english = '';
            $this->edit_mode = false;
            session()
                ->flash('success', 'بروز رسانی با موفقیت انجام شذ');
        }
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteFront',
    ];
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }
    public function deleteFront()
    {
        try {
            FrontEnd::destroy($this->delete_id);
            session()->flash('success', 'زبان مورد نظر با موفقیت حذف شد');
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function editFront($id)
    {
        $this->edit_mode = true;
        $front = DB::table('front_ends')->where('id', $id)->first();
        $this->title_persian = $front->title_persian;
        $this->title_english = $front->title_english;
        $this->front_id = $front->id;
    }
    public function render()
    {
        return view('livewire.admin.admin-front-end')
            ->extends('dash.include.master')
            ->section('dash_main_content')
            ->with(['front_ends'=>FrontEnd::paginate(10)]);
    }
}
