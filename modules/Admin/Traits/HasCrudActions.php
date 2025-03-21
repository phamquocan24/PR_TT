<?php
<<<<<<< HEAD
 
namespace Modules\Admin\Traits;
 
use Illuminate\Http\Request;
 
=======

namespace Modules\Admin\Traits;

use Illuminate\Http\Request;

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
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
<<<<<<< HEAD
 
=======

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("{$this->viewPath}.create");
    }
<<<<<<< HEAD
 
=======

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);
<<<<<<< HEAD
 
        $this->model::create($request->all());
 
        return redirect()->route("{$this->viewPath}.index")->with('success', 'Resource created successfully.');
    }
 
=======

        $this->model::create($request->all());

        return redirect()->route("{$this->viewPath}.index")->with('success', 'Resource created successfully.');
    }

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
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
<<<<<<< HEAD
 
=======

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
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
<<<<<<< HEAD
 
=======

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
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
<<<<<<< HEAD
 
        $model = $this->model::findOrFail($id);
        $model->update($request->all());
 
        return redirect()->route("{$this->viewPath}.index")->with('success', 'Resource updated successfully.');
    }
 
=======

        $model = $this->model::findOrFail($id);
        $model->update($request->all());

        return redirect()->route("{$this->viewPath}.index")->with('success', 'Resource updated successfully.');
    }

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
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
<<<<<<< HEAD
 
        return redirect()->route("{$this->viewPath}.index")->with('success', 'Resource deleted successfully.');
    }
 
=======

        return redirect()->route("{$this->viewPath}.index")->with('success', 'Resource deleted successfully.');
    }

>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
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
<<<<<<< HEAD
}
 
=======
}
>>>>>>> 107ea20b73064cac3ce194c2f67a6d41b37b3674
