<?php

namespace PesquisaProjeto\Http\Controllers;

use Illuminate\Http\Request;
use PesquisaProjeto\Pesquisa;
use PesquisaProjeto\Professor;
use PesquisaProjeto\ProfessorPapel;
use PesquisaProjeto\Aluno;

class PesquisaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesquisas = Pesquisa::all();

        return view('templates.pesquisa.index')->with('pesquisas',$pesquisas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $professores = Professor::all();
        $alunos = Aluno::all();
        return view('templates.pesquisa.create')->with([
            'professores' => $professores,
            'alunos'    => $alunos
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pesquisa = $this->validate(request(),[
            'pesquisa_titulo'=>'required',
            'pesquisa_resumo'=>'required',
            'pesquisa_ano_inicio'=>'required',
            'pesquisa_semestre_inicio'=>'required',
            'pesquisa_status'=>'required'
            ]);

        $orientador = $request->input('orientador');
        $coorientador = $request->input('coorientador');
        $discentes = $request->input('discentes');

        $resultPesquisa = Pesquisa::create($pesquisa);

        foreach($discentes as $discente){
           $resultPesquisa->professores()->attach($orientador,
            [
                'professor_papel_id'=>ProfessorPapel::ORIENTADOR,
                'aluno_id'=>$discente
            ]);
           $resultPesquisa->professores()->attach($coorientador,
            [
                'professor_papel_id'=>ProfessorPapel::COORIENTADOR,
                'aluno_id'=>$discente
            ]);     
        }
        

        return back()->with('success','Cadastro realizado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$pesquisa = Pesquisa::find($id);
		$result = $pesquisa->professores()->get();
        return view('templates.pesquisa.edit')->with([
            'professores' => $result,
            'pesquisa'    => $pesquisa
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
