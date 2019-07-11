<?php

namespace PesquisaProjeto;

use Illuminate\Database\Eloquent\Model;
use PesquisaProjeto\Traits\MestradoEventsTrait;

class Mestrado extends Model
{
    use MestradoEventsTrait;
    
    protected $fillable = [
		'titulo',
		'resumo',
		'ano_inicio',
		'semestre_inicio',
		'semestre_defesa',
		'status_id',
		'sisbin',
		'abordagem_id',
		'area_id',
		'natureza_id',
		'objetivo_id',
		'procedimentos_id',
		'sub_area_id',
		'orientador_id',
		'coorientador_id',
		'aluno_id'
		];

	public function orientador(){
		return $this->belongsTo('PesquisaProjeto\MinhaUfopUser','orientador_id');
	}

	public function coorientador(){
		return $this->belongsTo('PesquisaProjeto\MinhaUfopUser','coorientador_id');
	}

    public function aluno(){
    	return $this->belongsTo('PesquisaProjeto\MinhaUfopUser','aluno_id');
    }

	public function abordagem(){
    	return $this->belongsTo('PesquisaProjeto\AbordagemPesquisa','abordagem_id');
    }


    public function area(){
    	return $this->belongsTo('PesquisaProjeto\AreaPesquisa','area_id');
    }

    public function natureza(){
    	return $this->belongsTo('PesquisaProjeto\NaturezaPesquisa','natureza_id');
    }

    public function objetivo(){
    	return $this->belongsTo('PesquisaProjeto\ObjetivoPesquisa','objetivo_id');
    }

    public function procedimento(){
    	return $this->belongsTo('PesquisaProjeto\ProcedimentosPesquisa','procedimentos_id');
    }

    public function status(){
    	return $this->belongsTo('PesquisaProjeto\StatusPesquisa','status_id');
    }

    public function subarea(){
    	return $this->belongsTo('PesquisaProjeto\SubAreaPesquisa','sub_area_id');
    }
}
