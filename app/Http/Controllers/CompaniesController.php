<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Companies::all();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'website' => 'required|max:255',
            'logo_pic' => 'required|image|max:8192',
        ]);

        $original_filename = $request->logo_pic->getClientOriginalName();

        $edited_filename = 'logo_pic_' . date('Y_m_d_His', time()) . '.' . $request->file('logo_pic')->getClientOriginalExtension();

        $document_path = $request->file('logo_pic')->storeAs('logo-pic', $edited_filename, 'public');

        $companies = Companies::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'original_filename' => $original_filename,
            'document_path' => $document_path,
        ]);

        return redirect()->route('companies.index')->with(['status' => true, 'message' => 'Data has been succesfully created.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $companies = Companies::find($id);

        return view('companies.show', compact('companies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $companies = Companies::find($id);

        return view('companies.edit', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $companies = Companies::find($id);

        $request->validate([

            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,' . $companies->id,
            'website' => 'required|max:255|url|ends_with:.com',
            'logo_pic' => 'sometimes|image|max:8192|dimensions:100,100',
        ]);

        if ($request->hasFile('logo_pic')) {

            $original_filename = $request->logo_pic->getClientOriginalName();

            $edited_filename = 'logo_pic_' . date('Y_m_d_His', time()) . '.' . $request->file('logo_pic')->getClientOriginalExtension();

            $document_path = $request->file('logo_pic')->storeAs('logo-pic', $edited_filename, 'public');

            $companies->update([
                'original_filename' => $original_filename,
                'document_path' => $document_path,
            ]);
        };

        $companies->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,



        ]);

        return redirect()->route('companies.index', $companies->id)->with(['status' => true, 'message' => 'Data has been succesfully created.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $companies = Companies::find($id);
        $companies->delete();

        return redirect()->route('companies.index', $companies->id)->with(['status' => true, 'message' => 'Data has been succesfully deleted.']);
    }
}
