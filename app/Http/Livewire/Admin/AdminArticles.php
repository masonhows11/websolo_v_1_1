<?php

namespace App\Http\Livewire\Admin;

use App\Models\Article;
use Livewire\Component;

class AdminArticles extends Component
{

    public $delete_id;


    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    protected $listeners = [
        'deleteConfirmed' => 'deleteArticle'
    ];

    public function deleteArticle()
    {

        try {
            $article = Article::findOrFail($this->delete_id);
            if($article->delete()){
                $this->dispatchBrowserEvent('show-delete-success');
            }
        } catch (\Exception $ex) {
            return view('errors_custom.model_not_found');
        }
    }

    public function active($id)
    {
        $article = Article::findOrFail($id);
        try {
            if ($article->approved == 0) {
                $article->approved = 1;
            } elseif ($article->approved == 1) {
                $article->approved = 0;
            }
            $article->save();;
        } catch (\Exception $ex) {
            return view('errors_custom.model_store_error');
        }
    }

    public function render()
    {
        return view('livewire.admin.admin-articles')
            ->extends('dash.include.master')
            ->section('dash_main_content')
            ->with(['articles' => Article::paginate(10)]);
    }
}
