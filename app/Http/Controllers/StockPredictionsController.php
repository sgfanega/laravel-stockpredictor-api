<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockPredictionStoreRequest;
use App\Http\Requests\StockPredictionUpdateRequest;
use App\Http\Resources\StockPredictionResource;
use App\Models\StockPrediction;
use App\Traits\HttpResponses;

class StockPredictionsController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource depending
     * 
     * @return \App\Http\Resources\StockPredictionsResource
     */
    public function index()
    {
        return StockPredictionResource::collection(StockPrediction::all());
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Resources\StockPredictionResource $request
     * @return \App\Http\Resources\StockPredictionResource
     */
    public function store(StockPredictionStoreRequest $request)
    {
        $request->validated($request->all());

        $stockPrediction = StockPrediction::create([
            'ticker_symbol' => $request->ticker_symbol,
            'company_name' => $request->company_name,
            'confidence' => $request->confidence,
            'predictions' => $request->predictions
        ]);

        return new StockPredictionResource($stockPrediction);
    }

    /**
     * Display a specific resource using its corresponding Ticker Symbol.
     * 
     * @param \App\Model\StockPredictions
     * @return \Illuminate\Http\StockPredictionsResource
     */
    public function show(string $ticker_symbol)
    {   
        return StockPrediction::where('ticker_symbol', $ticker_symbol)->get();
    }

    /**
     * Updates the predictions of a specific stock using its corresponding Ticker Symbol.
     * 
     * @param \App\Http\Requests\StockPredictionsRequest $request
     * @param String $tickerSymbol
     * 
     * @return StockPredictionResource
     */
    public function update(StockPredictionUpdateRequest $request, string $tickerSymbol)
    {
        $stockPrediction = StockPrediction::where('ticker_symbol', $tickerSymbol)->first();

        $stockPrediction->update($request->all());

        return new StockPredictionResource($stockPrediction);
    }

    /**
     * Delete a specific stock using its Ticker Symbol.
     * 
     * @param String $tickerSymbol
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $tickerSymbol)
    {
        $stockPredictions = StockPrediction::where('ticker_symbol', $tickerSymbol)->first();

        $stockPredictions->delete();

        return response('Stock Deleted', 201);
    }
}
