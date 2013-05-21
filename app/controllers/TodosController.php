<?php

class TodosController extends BaseController {

    /**
     * Todo Repository
     *
     * @var Todo
     */
    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->beforeFilter('auth');

        $this->todo = $todo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = Sentry::getUser();

        $todos = $user->todos;

        return View::make('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $validation = Validator::make($input, Todo::$rules);

        if ($validation->passes())
        {
            $todo = $this->todo->newInstance($input);

            $user = Sentry::getUser();

            $user->todos()->save($todo);

            return Redirect::route('todos.index');
        }

        return Redirect::route('todos.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $user = Sentry::getUser();

        $todo = $user->todos()->findOrFail($id);

        return View::make('todos.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = Sentry::getUser();
        $todo = $user->todos()->find($id);

        if (is_null($todo))
        {
            return Redirect::route('todos.index');
        }

        return View::make('todos.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Todo::$rules);

        if ($validation->passes())
        {
            $user = Sentry::getUser();

            $todo = $user->todos()->find($id);

            $todo->update($input);

            return Redirect::route('todos.show', $id);
        }

        return Redirect::route('todos.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = Sentry::getUser();
        $user->todos()->find($id)->delete();

        return Redirect::route('todos.index');
    }

}