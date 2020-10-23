<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Candidato;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Portfolio.index')->with('portfolios',Portfolio::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Candidato $candidato)
    {
        $this->authorize('adicionarPortfolioCheck',$candidato);
        return view('Portfolio.create')->with('candidato', $candidato);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            \App\Validator\PortfolioValidator::validate($request->all());

            $portfolio = new Portfolio();
            $portfolio->candidato_id = \Auth::user()->candidato()->get()->first()->id;
            $portfolio->link = $request->input('link');
            $portfolio->save();
            return view('Portfolio.show')->with('portfolio', $portfolio);


        }catch (\App\Validator\ValidationException $e) {
            return redirect(route('portfolios.create', \Auth::user()->candidato()->get()->first()->id))->withErrors($e->getValidator())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        return view('Portfolio.show')->with('portfolio',$portfolio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio, Candidato $candidato)
    {
        // $this->authorize('update',$candidato);
        return view('Portfolio.edit')->with('portfolio',$portfolio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        try{
            \App\Validator\PortfolioValidator::validate($request->all());;

            $portfolio->update(['link' => $request->input('link'),
                               ]);

            return view('Portfolio.show')->with('portfolio', $portfolio);

        }catch(\App\Validator\ValidationException $exception){
            return redirect(route('portfolios.edit', $portfolio->id))
            ->withErrors($exception->getValidator())
            ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}
