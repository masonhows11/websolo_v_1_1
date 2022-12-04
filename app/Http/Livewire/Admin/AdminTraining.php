<?php

namespace App\Http\Livewire\Admin;

use App\Models\Training;
use Livewire\Component;

class AdminTraining extends Component
{
    public $delete_id;


    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteTraining'
    ];

    public function deleteTraining()
    {

        try {
            $article = Training::findOrFail($this->delete_id);
            if($article->delete()){
                $this->dispatchBrowserEvent('show-delete-success');
            }
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function active($id)
    {
        $training = Training::findOrFail($id);
        try {
            if ($training->approved == 0) {
                $training->approved = 1;
            } elseif ($training->approved == 1) {
                $training->approved = 0;
            }
            $training->save();
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
    }
    public function render()
    {
        return view('livewire.admin.admin-training')
            ->with(['trainings'=> Training::paginate(10)]);
    }
}
