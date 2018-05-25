<?php

namespace PesquisaProjeto;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
	protected $table = 'professores';
	
    public function pesquisas(){
    	return $this->belongsToMany('PesquisaProjeto\Pesquisa','vinculo_pesquisas')
    		->withPivot('professor_papel_id','aluno_id');
    }
}
