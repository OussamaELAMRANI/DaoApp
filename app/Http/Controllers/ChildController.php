<?php

namespace App\Http\Controllers;

use App\Child;
use App\Educators;
use App\Services\Filters\Children\AccessFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd(Child::with('educators')->get());
        return response()->json(Child::filter($request)->last(), 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $portrait_url = '';
        if ($req->has('photo') && $req->file('photo')) {
            try {
                $portrait_url = Storage::disk('public')->putFile('childen', $req->file('photo'));
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
//        $newChild = request(['first_name_fr', 'first_name_ar', 'last_name_ar', 'last_name_fr',
//            'birthday', 'entree_date', 'leave_date', 'inscription_number', 'rassm_number', 'province_fr',
//            'province_ar', 'judge_number', 'description']);
//        $mergedata = array_merge($newChild, ['photo' => $portrait_url]);


        $child = Child::create(
            [
                'photo' => $portrait_url,
                'cin' => $req->input('cin'),
                'civility' => $req->input('civility'),
                'first_name_fr' => $req->input('first_name_fr'),
                'first_name_ar' => $req->input('first_name_ar'),
                'last_name_ar' => $req->input('last_name_ar'),
                'last_name_fr' => $req->input('last_name_fr'),

                'birthday' => $req->input('birthday'),
                'born_place_fr' => $req->input('born_place_fr'),
                'born_place_ar' => $req->input('born_place_ar'),

                'health_state_fr' => $req->input('health_state_fr'),
                'health_state_ar' => $req->input('health_state_ar'),

                'entree_date' => $req->input('entree_date'),
                'leave_date' => $req->input('leave_date'),

                'inscription_number' => $req->input('inscription_number'),
                'rassm_number' => $req->input('rassm_number'),
                'province_fr' => $req->input('province_fr'),
                'province_ar' => $req->input('province_ar'),
                'judge_number' => $req->input('judge_number'),

                'father_name' => $req->input('father_name'),
                'father_cin' => $req->input('father_cin'),
                'father_place' => $req->input('father_place'),
                'father_phone' => $req->input('father_phone'),
                'father_pro' => $req->input('father_pro'),
                'father_situation' => $req->input('father_situation'),

                'description' => $req->input('description')
            ]);

        $educator = Educators::find($req->input('educators_id'));

        $child->educators()->sync($educator);

        return response()->json($child, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            return response()->json(Child::filter($request)->findOrfail($id));
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Not Found this child !'], 404);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $req
     * @param \App\Child $child
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Child $child)
    {
        $child->update($req->except('updated_at', 'created_at', 'deleted_at'));

        return response()->json([
            'message' => 'Great success! Child infos updated :)',
            'child' => $child
        ]);
    }


    public function destroy(Child $child)
    {
        return response()->json($child->delete());
    }

    public function counts()
    {
        $m = Child::where('civility','m')->count();
        $f = Child::where('civility','f')->count();
        return response()->json(['M' => $m, 'F' => $f], 200);
    }
}
