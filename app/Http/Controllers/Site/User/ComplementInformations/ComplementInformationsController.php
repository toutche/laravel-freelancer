<?php

namespace App\Http\Controllers\Site\User\ComplementInformations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\User\ComplementInformationsRequest;
use App\Models\Course;
use App\Models\Site\User\User;
use App\Models\Site\User\ComplementInformationsUser;
use Image;

class ComplementInformationsController extends Controller
{
    public function complementRegisterPerfil()
    {
    	$title = "Completar Perfil";
        $brazilianStates = array(
        'AC'=>'Acre',
        'AL'=>'Alagoas',
        'AP'=>'Amapá',
        'AM'=>'Amazonas',
        'BA'=>'Bahia',
        'CE'=>'Ceará',
        'DF'=>'Distrito Federal',
        'ES'=>'Espírito Santo',
        'GO'=>'Goiás',
        'MA'=>'Maranhão',
        'MT'=>'Mato Grosso',
        'MS'=>'Mato Grosso do Sul',
        'MG'=>'Minas Gerais',
        'PA'=>'Pará',
        'PB'=>'Paraíba',
        'PR'=>'Paraná',
        'PE'=>'Pernambuco',
        'PI'=>'Piauí',
        'RJ'=>'Rio de Janeiro',
        'RN'=>'Rio Grande do Norte',
        'RS'=>'Rio Grande do Sul',
        'RO'=>'Rondônia',
        'RR'=>'Roraima',
        'SC'=>'Santa Catarina',
        'SP'=>'São Paulo',
        'SE'=>'Sergipe',
        'TO'=>'Tocantins'
        );
        //Get all active courses on the table courses
        $courses = Course::where('status', 1)->get();
        //Copies the first occurrence (others option) of the collection
        $primaryocurrency = $courses[0];
        //Removes the first occurrence of the collection
        unset($courses[0]);
        //Adds the copy of the first occurrence of at the end of the collection
        $courses->push($primaryocurrency);
        
    	return view("site.complement_register_perfil", compact('title', 'brazilianStates', 'courses'));
    }

    public function postComplementRegisterPerfil(ComplementInformationsRequest $request)
    {
    	$dataForm = $request->except(['_token']);
        // Get the currently authenticated user's ID...
        $id = Auth::id();

        try {
            DB::transaction(function () use ($id, $dataForm) {
                //users table
                $user = User::find($id);

                $user->cpf = str_replace("-", "", str_replace(".", "", $dataForm['cpf']));
                $data = str_replace("/", "-", $dataForm['date_birth']);
                $user->date_birth = date("Y-m-d", strtotime($data));

                $phone = str_replace("(", "", $dataForm['phone']);
                $phone = str_replace(")", "", $phone);
                $phone = str_replace("-", "", $phone);
                $phone = str_replace(" ", "", $phone);
                $dataForm['phone'] = str_replace("-", "", $phone);
                $user->phone = $dataForm['phone'];

                $cell_phone = str_replace("(", "", $dataForm['cell_phone']);
                $cell_phone = str_replace(")", "", $cell_phone);
                $cell_phone = str_replace("-", "", $cell_phone);
                $cell_phone = str_replace(" ", "", $cell_phone);
                $dataForm['cell_phone'] = str_replace("-", "", $cell_phone);
                $user->cell_phone = $dataForm['cell_phone'];
                $user->status = 1;

                $user->save(); 

                //complement_informations_users table
                $complement_informations_user = new ComplementInformationsUser;
                $complement_informations_user->user_id = $id;
                $complement_informations_user->professional_title = $dataForm['professional_title'];
                $complement_informations_user->site = $dataForm['site'];
                $complement_informations_user->about_me = $dataForm['about_me'];

                $file = Input::file("profile_image");
                if(File::exists($file)) {
                    $img = Image::make($file->getRealPath());
                    Response::make($img->encode(explode("/", $img->mime())[1]));
                    $complement_informations_user->profile_image = $img;
                }
                $complement_informations_user->save();
                //educations table
                
                DB::commit();
            });
        } catch (\Exception $e) {
            DB::rollback();
        }

    	return 'Enviando formulário...';
    }

    public function showProfileImage($id) {
        $image = ComplementInformationsUser::where("user_id",$id)->first();
        $pic = Image::make($image->profile_image);
        $response = Response::make($pic->encode(explode("/", $pic->mime())[1]));

        //setting content-type
        $response->header('Content-Type', $pic->mime());

        return $response;
    }
}
