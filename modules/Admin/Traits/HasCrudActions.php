<?php
 
namespace Modules\Admin\Traits;
 
use Illuminate\Http\Request;
 
trait HasCrudActions
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->model::all();
        return view("{$this->viewPath}.index", compact('model'));
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("{$this->viewPath}.create");
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
 
        $this->model::create($request->all());
 
        return redirect()->route("{$this->viewPath}.index")->with('success', 'Resource created successfully.');
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->model::findOrFail($id);
        return view("{$this->viewPath}.show", compact('model'));
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->model::findOrFail($id);
        return view("{$this->viewPath}.edit", compact('model'));
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
        $this->validateRequest($request);
 
        $model = $this->model::findOrFail($id);
        $model->update($request->all());
 
        return redirect()->route("{$this->viewPath}.index")->with('success', 'Resource updated successfully.');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);
        $model->delete();
 
        return redirect()->route("{$this->viewPath}.index")->with('success', 'Resource deleted successfully.');
    }
 
    /**
     * Validate the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);
    }
}
 