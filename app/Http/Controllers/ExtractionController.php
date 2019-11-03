<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtractionStoreRequest;
use App\Models\Extraction\Extraction;
use Illuminate\Http\Request;

class ExtractionController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$extractions = Extraction::all();

		return response([
			'status' => 'success',
			'data' => $extractions,
		], 200);
	}

	public function todayExtractions() {

		$extractions = Extraction::whereDate('date', date('Y-m-d'))->get();

		return response([
			'status' => 'success',
			'data' => $extractions,
		], 200);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function register(ExtractionStoreRequest $request) {
		$extraction = new Extraction();
		$extraction->create($request->except('_token'));

		return response([
			'status' => 'success',
			'data' => $extraction,
		], 200);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Extraction\Extraction  $extraction
	 * @return \Illuminate\Http\Response
	 */
	public function show(Extraction $extraction) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Extraction\Extraction  $extraction
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Extraction $extraction) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Extraction\Extraction  $extraction
	 * @return \Illuminate\Http\Response
	 */
	public function update(ExtractionStoreRequest $request, Extraction $extraction) {
		$extraction->update($request->all());

		return response([
			'status' => 'success',
			'data' => $extraction,
		], 200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Extraction\Extraction  $extraction
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Extraction $extraction) {
		$extraction->delete();

		return response([
			'status' => 'success',
			'data' => $extraction,
		], 200);
	}
}
