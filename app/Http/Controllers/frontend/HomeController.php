<?php

namespace App\Http\Controllers\frontend;


use Akuren\Cookies\Cookie;
use Akuren\Cookies\Cookies;
use Akuren\File\File;
use Akuren\Query\Query;
use Akuren\Session\Flash;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;



class HomeController extends  Controller
{
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
      return   $this->view->render($response, 'welcome');
   }


    public function User(ServerRequestInterface $request, ResponseInterface $response)
    {

        $users = Query::table('users')->get();

        $count =Query::table('users')->count();

        return   $this->view->render($response,'home/add_user.html.', compact('users', 'count'));
    }


    public function addUser(ServerRequestInterface $request, ResponseInterface $response)
    {

        if($request->getMethod() === "POST"){

        $params = $this->getParams($request);

            $name = $params['name'];
            $email = $params['email'];
            $picture = $params['picture'];

            if (empty($name) OR empty($email)){
                Flash::error("Remplissez tous les champs requis");

                redirect('/user');
            }

        if (!empty(  $params['picture'] )){
            $picture =  File::to()->upload($picture);
        }

                $data = [
                    'name' =>$name,
                    'email' =>  $email,
                    'picture' => $picture,
                    'created_at' => Carbon::now()
                ];

            $result = Query::table('users')->insert($data);

            if ($result){
                Flash::success("Utilisateur ajouter avec success");

                redirect('/user');
            }else{
                Flash::error("Une erreur s'est produite");
                redirect('/user');
            }



        }

    }


    public function userEdit(ServerRequestInterface $request, ResponseInterface $response)
    {

        $id = $request->getAttribute('id');

        $user = User::where(['id' => $id])->first();

        return $this->view->render($response,"home/edit_user.html.twig", compact("user"));
    }

    public function userView(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');

        $user = User::where(['id' => $id])->first();

        return $this->view->render($response,"home/show_user.html.twig", compact("user"));
    }

    public function userEditRequest(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        $user = User::where(['id' => $id])->first();
        if($request->getMethod() === "POST"){
            $params = $this->getParams($request);

            $params['picture'] = File::to()->upload($params['picture'], $user->picture);

            $name = $params['name'];
            $email = $params['email'];
            $picture = $params['picture'];
            $data = [
                'name' =>$name,
                'email' =>  $email,
                'picture' => $picture,
                'updated_at' => Carbon::now()
            ];

            User::where(['id' => $id])->update($data);

             Flash::success('Mis a jour avec succes');

             redirect("/edit/user/{$id}");


        }

        return $this->view->render( $response,"home/edit_user.html.twig", compact("user"));
    }


    public function userDelete(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        $user = User::where(['id' => $id])->first();
        if (!is_null($user->picture)){
            File::to()->delete($user->picture);
        }
        User::where(['id' => $id])->delete();
     Flash::success('Utilisateur Supprimer avec success');

     redirect('/user');

    }


    public function auth(ServerRequestInterface $request, ResponseInterface $response)
    {
          Cookies::cookieName('user_name')->setValue('Stephane')->setExpire(10)->setPath('/auth')->setDomain('localhost')
              ->setSecure(false)->setHttpOnly(true)->save();

          var_dump($_COOKIE);
          die;
    }


}