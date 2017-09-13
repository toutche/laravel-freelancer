<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
	/**
	 * [index description]
	 * @param  Request $request [expects two parameters: columns (Array ["columnName"]) and where clause (Array [ ["whereClause1", "value"], ["whereClause2", "value"] ])]
	 * @return [JSON]           [Return in the JSON format with the list of courses validated by the rules]
	 */
    public function index(Request $request) {
    	$var = $request->only(['columns', 'where']);

    	if(empty($var['where'])) $var['where'] = [["status",1]];

		$query = Course::where($var['where'])->get($var['columns']);
		
    	return $query;
    }
}
