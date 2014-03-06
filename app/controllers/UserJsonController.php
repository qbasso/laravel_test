<?php

class UserJsonController extends \BaseController {

    public function index() {
        $withItems = Input::get('with_items', false);
        if ($withItems) {
            $users = User::with('items')->get();
        } else {
            $users = User::all()->sortBy('id');
        }
        return Response::json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $user = new User();
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->email = Input::get('email');
        $user->birthday = date('Y-m-d', strtotime(Input::get('birthday')));
        $user->created_at = time();
        $validator = $this->getValidatorForUser($user);
        if ($validator->passes()) {
            $user->save();
            return Response::json('{"result" : "ok"}');
        } else {
            return Response::json('{"result" : "errors" : "' . $validator->messages()->toJson() . '"}');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function show($id) {
        $user = User::find($id);
        return View::make('user.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function edit($id) {
        $user = User::find($id);
        return View::make('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id            
     * @return Response
     */
    public function update($id) {
        $user = User::find($id);
        if (is_null($user)) {
            return Response::json('{"result" : "not_exist"}');
        }
        $user->first_name = Input::get('first_name', $user->first_name);
        $user->last_name = Input::get('last_name', $user->last_name);
        $user->email = Input::get('email', $user->email);
        $user->birthday = date('Y-m-d', strtotime(Input::get('birthday', $user->birthday)));
        $validator = $this->getValidatorForUser($user);
        try {
            if ($validator->passes()) {
                $user->save();
                return Response::json('{"result" : "ok"}');
            } else {
                return Response::json('{"result" : "errors" : "' . $validator->messages()->toJson() . '"}');
            }
        } catch (Exception $e) {
            return Response::json('{"result" : "errors" : "'.$e->getMessage().'"}');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return Response
     */
    public function destroy($id) {
        $user = User::find($id);
        if (! is_null($user) && $user->delete() == true) {
            return Response::json('{"result" : "ok"}');
        } else {
            return Response::json('{"result" : "not_exist"}');
        }
    }

    private function getValidatorForUser($user) {
        return $validator = Validator::make(array(
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'birthday' => $user->birthday,
            'email' => $user->email
        ), array(
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'date',
            'email' => 'email'
        ));
    }
}