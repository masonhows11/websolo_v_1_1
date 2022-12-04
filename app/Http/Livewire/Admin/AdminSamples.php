<?php

namespace App\Http\Livewire\Admin;

use App\Models\Sample;
use Livewire\Component;

class AdminSamples extends Component
{
    public $delete_id;


    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteSample'
    ];

    public function deleteSample()
    {
        try {
            $sample = Sample::find($this->delete_id);
            if($sample->delete()){
                $this->dispatchBrowserEvent('show-delete-success');
            }
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function active($id)
    {
        $sample = Sample::findOrFail($id);
        try {
            if ($sample->approved == 0) {
                $sample->approved = 1;
            } elseif ($sample->approved == 1) {
                $sample->approved = 0;
            }
            $sample->save();
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-samples')
            ->with(['samples' => Sample::paginate(10)]);
    }
}
