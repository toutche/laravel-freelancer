<?php

namespace App\Http\Controllers\Site\User\ComplementInformations;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\User\ComplementInformationsRequest;
use App\Models\Course;
use App\Models\Site\User\User;
use App\Models\Site\User\ComplementInformationsUser;
use App\Models\Site\User\EducationsUser;
use App\Models\Site\User\ExperiencesUser;
use App\Models\Site\User\UserComplemented;
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
        
        $userComplemented = UserComplemented::where('user_id', Auth::id())->first();
        $status = $userComplemented->status;
        if($status == 0) {
            return view("site.complement_register_perfil", compact('title', 'brazilianStates', 'courses'));
        }
        else {
            return "Dashboard";
        } 
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

                if($dataForm['phone'] != "") {
                    $phone = str_replace("(", "", $dataForm['phone']);
                    $phone = str_replace(")", "", $phone);
                    $phone = str_replace("-", "", $phone);
                    $phone = str_replace(" ", "", $phone);
                    $dataForm['phone'] = str_replace("-", "", $phone);
                    $user->phone = $dataForm['phone'];
                }
                
                if($dataForm['cell_phone'] != "") {
                    $cell_phone = str_replace("(", "", $dataForm['cell_phone']);
                    $cell_phone = str_replace(")", "", $cell_phone);
                    $cell_phone = str_replace("-", "", $cell_phone);
                    $cell_phone = str_replace(" ", "", $cell_phone);
                    $dataForm['cell_phone'] = str_replace("-", "", $cell_phone);
                    $user->cell_phone = $dataForm['cell_phone'];
                }
                
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
                
                //educations_users table
            
                $number_of_educations = session()->get('number_of_educations');

                for($i=1; $i<=$number_of_educations; $i++) {
                    $educations_user = new EducationsUser;
                    $select_degree = $dataForm['ed_select_degree_'][$i];
                    $educations_user->user_id = $id;
                    $educations_user->degree = $select_degree;
                    if($select_degree == "graduating") {
                        $educations_user->semester = $dataForm['ed_semester_'][$i];
                    } else if($select_degree == "graduate") {
                        $educations_user->crea_state = $dataForm['ed_crea_state_'][$i];
                        $educations_user->crea_number = $dataForm['ed_crea_number_'][$i];
                    }
                    $select_course = $dataForm['ed_select_course_'][$i];
                    $educations_user->course_id = $select_course;
                    if($select_course == "1") {
                        $educations_user->other_course = $dataForm['ed_other_course_'][$i];
                    }
                    $educations_user->college = $dataForm['ed_college_'][$i];
                    $educations_user->start_date = $dataForm['ed_start_date_'][$id];
                    $educations_user->end_date = $dataForm['ed_end_date_'][$id];
                    $educations_user->save();
                }

                //experiences_users table
                $number_of_experiences = session()->get('number_of_experiences');
                if ($number_of_experiences == 1) {
                    $ex_company_name = $dataForm['ex_company_name_'][$number_of_experiences];
                    $ex_responsibility_name = $dataForm['ex_responsibility_name_'][$number_of_experiences];
                    $ex_start_date = $dataForm['ex_start_date_'][$number_of_experiences];
                    $ex_end_date = $dataForm['ex_end_date_'][$number_of_experiences];
                    $ex_description = $dataForm['ex_description_'][$number_of_experiences];
                    if (!is_null($ex_company_name) || !is_null($ex_responsibility_name)
                        || !is_null($ex_start_date) || !is_null($ex_end_date) || !is_null($ex_description)) {
                        $experience_user = new ExperiencesUser;
                        $experience_user->user_id = $id;
                        $experience_user->company_name = $dataForm['ex_company_name_'][$number_of_experiences];
                        $experience_user->responsibility_name = $dataForm['ex_responsibility_name_'][$number_of_experiences];
                        $experience_user->start_date = $dataForm['ex_start_date_'][$number_of_experiences];
                        $experience_user->end_date = $dataForm['ex_end_date_'][$number_of_experiences];
                        $experience_user->description = $dataForm['ex_description_'][$number_of_experiences];
                        $experience_user->save();
                    }
                } else {
                    for($i=1; $i<=$number_of_experiences; $i++) {
                        $experience_user = new ExperiencesUser;
                        $experience_user->user_id = $id;
                        $experience_user->company_name = $dataForm['ex_company_name_'][$i];
                        $experience_user->responsibility_name = $dataForm['ex_responsibility_name_'][$i];
                        $experience_user->start_date = $dataForm['ex_start_date_'][$i];
                        $experience_user->end_date = $dataForm['ex_end_date_'][$i];
                        $experience_user->description = $dataForm['ex_description_'][$i];
                        $experience_user->save();
                    }    
                }
                
                $userComplemented = UserComplemented::where('user_id', $id)->first();
                $userComplemented->status = 1;
                $userComplemented->save();

                session()->forget('number_of_educations');
                session()->forget('number_of_experiences');

                DB::commit();

            });
            return 'Envia Dashboard...';
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error_title', "Erro BD");
            session()->flash('error_message', "Erro ao cadastrar o complemento do perfil.");
            Log::error('Error insert complement information user', ['user_id' => $id, 'error_message' => $e->getMessage()]);
            return redirect()->route('error');
        }
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
