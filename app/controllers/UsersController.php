<?php

class UsersController extends BaseController {

    /**
     * Display a login form
     *
     * @return Response
     */
    public function login()
    {
        return View::make('users.login');
    }

    public function authenticate()
    {
        $input = Input::all();

        $credentials = array('email' => $input['email'], 'password' => $input['password']);

        try
        {
            $user = Sentry::authenticate($credentials, false);

        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            return 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return 'User was not found.';
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            return 'Wrong password, try again.';
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            return 'User is not activated.';
        }
        
        return Redirect::to('todos');
    }

    public function logout()
    {
        Sentry::logout();

        return Redirect::to('users/login');
    }

}