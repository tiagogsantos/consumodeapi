<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // Metodo get que retorna a listagem de estudantes na API
    public function getAllStudentes ()
    {
        $studant = Student::all();

        if (!empty($studant)) {
            return response()->json($studant,201);
        }
    }

    // Metodo post para realizar a criação do estudante na API
    public function createStudant (Request $request)
    {
        $nome       = $request->input('name');
        $last_name  = $request->input('last_name');
        $email      = $request->input('email');
        $profession = $request->input('profession');

        $consultUser = Student::where('email', $email)->count();

        if (!empty($consultUser)) {
            return response()->json(['message' => 'Não possível cadastrar o estudante, esse e-mail já está em uso'],500);
        }

        $createStudant = Student::insert([
            'name'       => $nome,
            'last_name'  => $last_name,
            'email'      => $email,
            'profession' => $profession
        ]);

        if ($createStudant) {
            return response()->json([$createStudant, "message" => "Estudante cadastrado com sucesso!"],201);
        } else {
            return response()->json(['message' => 'Não possível cadastrar o estudante'],500);
        }
    }

    // Metodo get para retornar um unico estudante na API
    public function getStudant ($id)
    {
        $studant = Student::where('id', $id)->first();

        if (!empty($studant)) {
            return response()->json([$studant, 200]);
        } else {
            return response()->json(['message' => 'Não foi encontrado esse estudante'],500);
        }
    }

    // Metodo put para realizar a atualização de um estudante na API
    public function updateStudant (Request $request, $id)
    {
        $nome       = $request->input('name');
        $last_name  = $request->input('last_name');
        $email      = $request->input('email');
        $profession = $request->input('profession');

        $updateStudant = Student::where('id', $id)->update([
            'name'       => $nome,
            'last_name'  => $last_name,
            'email'      => $email,
            'profession' => $profession
        ]);

        if ($updateStudant) {
            return response()->json([$updateStudant, 200]);
        } else {
            return response()->json(['message' => 'Não foi possível realizar a alteração'], 500);
        }
    }

    // Metodo delete para realizar a exclusão de um estudante
    public function deleteStudant ($id)
    {
        if(Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->delete();

            return response()->json([
                "message" => "Estudante deletado"
            ], 202);
        } else {
            return response()->json([
                "message" => "Estudante não deletado"
            ], 404);
        }
    }
}
