<?php

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex(){
		$users = User::all()->sortBy('id');
		return View::make('users')->with('users', $users);
	}
	
	public function deleteUser($id) {
		$user = User::find($id);
		$user->delete();
		return $this->getIndex();
	}
	
	public function showUser($id) {
		$user = User::find($id);
		return View::make('userDetail')->with('user', $user);
	}
	
	public function createUser() {
		return View::make('userNew');
	}
	
	public function saveUser() {
		$user = new User();
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->email = Input::get('email');
		$user->birthday = date('Y-m-d', strtotime(Input::get('birthday')));
		$user->created_at = time();
		$user->save();	
		return Redirect::to('users');
	}
	
	public function updateUser($id) {
		$user = User::find($id);
		$user->first_name = Input::get('first_name', $user->first_name);
		$user->last_name = Input::get('last_name', $user->last_name);
		$user->email = Input::get('email', $user->email);
		$user->birthday = date('Y-m-d', strtotime(Input::get('birthday', $user->birthday)));
		$user->save();
		return Redirect::to('users');
	}
	
}