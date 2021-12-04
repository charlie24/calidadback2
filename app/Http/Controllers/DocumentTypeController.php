<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DocumentType;

class DocumentTypeController extends Controller
{
    public function store(Request $request)
    {
        $document = new DocumentType();

        $document->name = $request->name;
        $document->save();

        return response()->json([
            'message' => 'Successfully created document!',
            'document' => $document
        ], 201);
    }

    public function list()
    {
        $documents = DocumentType::all();

        return response()->json([
            'documents' => $documents
        ], 201);
    }
}
