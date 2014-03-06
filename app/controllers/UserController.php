<?php
class UserController extends \BaseController {
	public function index() {
		$users = User::all ()->sortBy ( 'id' );
		return View::make ( 'user.index' )->with ( 'users', $users );
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return View::make ( 'user.create' );
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		$user = new User ();
		$user->first_name = Input::get ( 'first_name' );
		$user->last_name = Input::get ( 'last_name' );
		$user->email = Input::get ( 'email' );
		$user->birthday = date ( 'Y-m-d', strtotime ( Input::get ( 'birthday' ) ) );
		$user->created_at = time ();
		$validator = $this->getValidatorForUser ( $user );
		if ($validator->passes ()) {
			$user->save ();
			return Redirect::route ( 'user.index' )->with ( 'flash', 'The new user has been created' );
		} else {
			return Redirect::route ( 'user.create' )->withInput ()->withErrors ( $validator );
		}
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function show($id) {
		$user = User::find ( $id );
		return View::make ( 'user.show' )->with ( 'user', $user );
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function edit($id) {
		$user = User::find ( $id );
		return View::make ( 'user.edit' )->with ( 'user', $user );
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function update($id) {
		$user = User::find ( $id );
		$user->first_name = Input::get ( 'first_name', $user->first_name );
		$user->last_name = Input::get ( 'last_name', $user->last_name );
		$user->email = Input::get ( 'email', $user->email );
		$user->birthday = date ( 'Y-m-d', strtotime ( Input::get ( 'birthday', $user->birthday ) ) );
		$validator = $this->getValidatorForUser ( $user );
		if ($validator->passes ()) {
			$user->save ();
		} else {
			$messages = $validator->messages ();
			$result = '';
			foreach ( $messages->all () as $message ) {
				$result . $message . '<br>';
			}
			return result;
		}
		return $this->index ();
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function destroy($id) {
		$user = User::find ( $id );
		$user->delete ();
		return $this->index ();
	}
	private function getValidatorForUser($user) {
		return $validator = Validator::make ( array (
				'first_name' => $user->first_name,
				'last_name' => $user->last_name,
				'birthday' => $user->birthday,
				'email' => $user->email 
		), array (
				'first_name' => 'required',
				'last_name' => 'required',
				'birthday' => 'date',
				'email' => 'email' 
		) );
	}
}